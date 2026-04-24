<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Konsultasi;

class PasienController extends Controller
{
    const SLOT_DURATION = 20; // minutes per session

    // ═══════════════════════════════════════════════════════════════
    //   HELPER: Fetch Poli Paru schedule from SIMRS API
    // ═══════════════════════════════════════════════════════════════
    private function fetchJadwalPoliParu(string $date): array
    {
        $dataJadwal = [];
        $apiError = null;

        try {
            $response = Http::timeout(15)->post('https://eklaim.rsudsulfat.id/simrs_api/jadwal/apischeddoc.php', [
                'token'    => '842c9ab0a93c520a703fa90d484dc6f42fc646f8c94a7fa3b6aa772d4ca173d2',
                'name'     => '',
                'tglsched' => $date,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                if (isset($result['status']) && $result['status'] === 'success' && isset($result['data'])) {
                    $dataJadwal = collect($result['data'])->filter(function ($item) {
                        return stripos($item['FS_NM_LAYANAN'] ?? '', 'PARU') !== false;
                    })->values()->toArray();
                }
            } else {
                $apiError = 'Gagal terhubung ke server jadwal RSUD.';
            }
        } catch (\Exception $e) {
            $apiError = 'Terjadi gangguan saat memuat data jadwal. Silakan coba lagi nanti.';
        }

        return ['data' => $dataJadwal, 'error' => $apiError];
    }

    // ═══════════════════════════════════════════════════════════════
    //   HELPER: Generate 20-minute time slots from doctor schedule
    // ═══════════════════════════════════════════════════════════════
    private function generateSlots(string $jadwalStr, string $date, string $dokterName): array
    {
        // Parse "13:00 - Selesai" or "08:00 - 12:00"
        $parts = array_map('trim', explode('-', $jadwalStr));
        if (count($parts) < 2) return [];

        $startTime = $parts[0];
        $endPart   = $parts[1];

        // Parse start — create directly in Asia/Jakarta timezone (no conversion)
        try {
            $start = Carbon::createFromFormat('H:i', $startTime, 'Asia/Jakarta');
        } catch (\Exception $e) {
            return [];
        }

        // Parse end — "Selesai" defaults to 17:00
        if (stripos($endPart, 'selesai') !== false || empty(trim($endPart))) {
            $end = Carbon::createFromFormat('H:i', '17:00', 'Asia/Jakarta');
        } else {
            try {
                $end = Carbon::createFromFormat('H:i', trim($endPart), 'Asia/Jakarta');
            } catch (\Exception $e) {
                $end = Carbon::createFromFormat('H:i', '17:00', 'Asia/Jakarta');
            }
        }

        // Get existing bookings for this doctor on this date
        $bookedSlots = Konsultasi::where('nama_dokter', $dokterName)
            ->where('tanggal_konsultasi', $date)
            ->whereIn('status', ['menunggu', 'terkonfirmasi'])
            ->pluck('jam_booking')
            ->toArray();

        // Generate slots with proper timezone for "past" detection
        $slots = [];
        $current = $start->copy();
        $now = Carbon::now('Asia/Jakarta');
        $isToday = Carbon::parse($date, 'Asia/Jakarta')->isToday();
        $isFutureDate = Carbon::parse($date, 'Asia/Jakarta')->isAfter(Carbon::today('Asia/Jakarta'));

        while ($current->lt($end)) {
            $slotTime = $current->format('H:i');
            $isBooked = in_array($slotTime, $bookedSlots);

            // Build full datetime for comparison: date + slot time
            $slotDateTime = Carbon::parse($date . ' ' . $slotTime, 'Asia/Jakarta');
            $isPast = $isToday && $slotDateTime->lt($now);

            $slots[] = [
                'time'      => $slotTime,
                'end_time'  => $current->copy()->addMinutes(self::SLOT_DURATION)->format('H:i'),
                'available' => !$isBooked && !$isPast,
                'booked'    => $isBooked,
                'past'      => $isPast,
            ];

            $current->addMinutes(self::SLOT_DURATION);
        }

        return $slots;
    }

    // ═══════════════════════════════════════════════════════════════
    //   DASHBOARD
    // ═══════════════════════════════════════════════════════════════
    public function dashboard()
    {
        $user = auth()->user();
        $now  = Carbon::now('Asia/Jakarta');

        // Booking mendatang: tanggal > hari ini ATAU tanggal hari ini & jam booking belum lewat
        $bookingMendatang = Konsultasi::where('user_id', $user->id)
            ->whereIn('status', ['menunggu', 'terkonfirmasi'])
            ->where(function ($q) use ($now) {
                $q->where('tanggal_konsultasi', '>', $now->toDateString())
                  ->orWhere(function ($q2) use ($now) {
                      $q2->where('tanggal_konsultasi', $now->toDateString())
                         ->where('jam_booking', '>=', $now->format('H:i'));
                  });
            })
            ->orderBy('tanggal_konsultasi')
            ->orderBy('jam_booking')
            ->limit(3)
            ->get();

        // Hitung statistik
        $totalKonsultasi  = Konsultasi::where('user_id', $user->id)->count();
        $bookingTerjadwal = Konsultasi::where('user_id', $user->id)
            ->whereIn('status', ['menunggu', 'terkonfirmasi'])
            ->where(function ($q) use ($now) {
                $q->where('tanggal_konsultasi', '>', $now->toDateString())
                  ->orWhere(function ($q2) use ($now) {
                      $q2->where('tanggal_konsultasi', $now->toDateString())
                         ->where('jam_booking', '>=', $now->format('H:i'));
                  });
            })
            ->count();

        return view('pasien.dashboard', compact(
            'user',
            'bookingMendatang',
            'totalKonsultasi',
            'bookingTerjadwal',
        ));
    }

    // ═══════════════════════════════════════════════════════════════
    //   INFORMASI RUMAH SAKIT
    // ═══════════════════════════════════════════════════════════════
    public function informasiRs()
    {
        return view('pasien.informasi-rs');
    }

    // ═══════════════════════════════════════════════════════════════
    //   KONSULTASI CHATBOT
    // ═══════════════════════════════════════════════════════════════
    public function konsultasiChatbot()
    {
        $user = auth()->user();
        return view('pasien.konsultasi-chatbot', compact('user'));
    }

    // ═══════════════════════════════════════════════════════════════
    //   FAQ
    // ═══════════════════════════════════════════════════════════════
    public function faq()
    {
        return view('pasien.faq');
    }

    // ═══════════════════════════════════════════════════════════════
    //   PROFIL
    // ═══════════════════════════════════════════════════════════════
    public function profil()
    {
        $user   = auth()->user();
        $pasien = $user->pasien; // nullable — bisa null jika belum diisi
        return view('pasien.profil', compact('user', 'pasien'));
    }

    public function profilUpdate(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'          => 'required|string|max:100',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'nik'           => 'required|digits:16|unique:pasiens,nik,' . ($user->pasien_id ?? 'NULL') . ',id',
            'alamat'        => 'required|string|max:500',
            'jenis_kelamin' => 'required|in:LAKI-LAKI,PEREMPUAN',
            'keluhan_utama' => 'nullable|string|max:500',
        ], [
            'name.required'          => 'Nama lengkap wajib diisi.',
            'email.required'         => 'Email wajib diisi.',
            'email.unique'           => 'Email sudah digunakan oleh akun lain.',
            'nik.required'           => 'NIK wajib diisi.',
            'nik.digits'             => 'NIK harus 16 digit angka.',
            'nik.unique'             => 'NIK sudah terdaftar pada pasien lain.',
            'alamat.required'        => 'Alamat wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        ]);

        // Update nama & email di tabel users
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // Upsert tabel pasiens — no_rekam_medis & no_registrasi dikelola oleh admin, tidak diubah di sini
        $pasienData = [
            'nik'           => $request->nik,
            'nama'          => $request->name,
            'alamat'        => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'keluhan_utama' => $request->keluhan_utama ?: null,
        ];

        if ($user->pasien) {
            // Update pasien yang sudah ada
            $user->pasien->update($pasienData);
        } else {
            // Buat pasien baru dan hubungkan ke user
            $pasien = \App\Models\Pasien::create($pasienData);
            $user->update(['pasien_id' => $pasien->id]);
        }

        return redirect()->route('pasien.profil')
                         ->with('success', 'Profil berhasil disimpan!');
    }

    // ═══════════════════════════════════════════════════════════════
    //   JADWAL DOKTER
    // ═══════════════════════════════════════════════════════════════
    public function jadwalDokter(Request $request)
    {
        $selectedDate = $request->input('date', Carbon::now('Asia/Jakarta')->format('Y-m-d'));
        $result = $this->fetchJadwalPoliParu($selectedDate);

        $dataJadwal = $result['data'];
        $apiError = $result['error'];

        return view('pasien.jadwal-dokter', compact('dataJadwal', 'selectedDate', 'apiError'));
    }

    // ═══════════════════════════════════════════════════════════════
    //   BOOKING KONSULTASI
    // ═══════════════════════════════════════════════════════════════

    public function bookingIndex(Request $request)
    {
        $user = auth()->user();
        $now  = Carbon::now('Asia/Jakarta');
        $selectedDate = $request->input('date', $now->format('Y-m-d'));
        $today = $now->format('Y-m-d');

        // Validate: cannot book in the past
        if (Carbon::parse($selectedDate)->lt(Carbon::parse($today))) {
            $selectedDate = $today;
        }

        // Fetch Poli Paru schedule for the selected date
        $result = $this->fetchJadwalPoliParu($selectedDate);
        $dataJadwal = $result['data'];
        $apiError = $result['error'];

        // Generate slots for each doctor
        $dokterSlots = [];
        foreach ($dataJadwal as $jadwal) {
            $dokterName = $jadwal['FS_NM_DOKTER'] ?? '';
            $jadwalStr  = $jadwal['jadwal'] ?? '';
            $slots = $this->generateSlots($jadwalStr, $selectedDate, $dokterName);

            $dokterSlots[] = [
                'dokter'          => $jadwal,
                'slots'           => $slots,
                'available_count' => collect($slots)->where('available', true)->count(),
            ];
        }

        // Get user's bookings
        $bookings = Konsultasi::where('user_id', $user->id)
            ->orderByDesc('tanggal_konsultasi')
            ->orderByDesc('created_at')
            ->get();

        $bookingMendatang = $bookings->filter(function ($b) use ($now) {
            if (!in_array($b->status, ['menunggu', 'terkonfirmasi'])) return false;

            // Tanggal mendatang → selalu tampil
            if ($b->tanggal_konsultasi->gt(Carbon::today('Asia/Jakarta'))) return true;

            // Hari ini → cek apakah jam booking belum lewat
            if ($b->tanggal_konsultasi->eq(Carbon::today('Asia/Jakarta'))) {
                $jamBooking = $b->jam_booking ?? '00:00';
                return $jamBooking >= $now->format('H:i');
            }

            return false;
        });

        $bookingSelesai = $bookings->filter(function ($b) use ($now) {
            // Sudah selesai atau dibatalkan
            if (in_array($b->status, ['selesai', 'dibatalkan'])) return true;

            // Tanggal sudah lewat
            if ($b->tanggal_konsultasi->lt(Carbon::today('Asia/Jakarta'))) return true;

            // Hari ini tapi jam sudah lewat
            if ($b->tanggal_konsultasi->eq(Carbon::today('Asia/Jakarta'))) {
                $jamBooking = $b->jam_booking ?? '00:00';
                return $jamBooking < $now->format('H:i');
            }

            return false;
        });

        return view('pasien.booking', compact(
            'dataJadwal', 'dokterSlots', 'apiError', 'today', 'selectedDate',
            'bookingMendatang', 'bookingSelesai'
        ));
    }

    public function bookingStore(Request $request)
    {
        $request->validate([
            'nama_dokter'        => ['required', 'string', 'max:255'],
            'tanggal_konsultasi' => ['required', 'date', 'after_or_equal:today'],
            'jam_booking'        => ['required', 'string', 'max:10'],
            'jam_praktik'        => ['nullable', 'string', 'max:100'],
            'poli'               => ['nullable', 'string', 'max:100'],
            'kode_layanan'       => ['nullable', 'string', 'max:50'],
            'keluhan'            => ['nullable', 'string', 'max:1000'],
        ], [
            'nama_dokter.required'              => 'Pilih dokter yang akan dikonsultasikan.',
            'tanggal_konsultasi.required'        => 'Tanggal konsultasi wajib diisi.',
            'tanggal_konsultasi.after_or_equal'  => 'Tanggal konsultasi tidak boleh di masa lalu.',
            'jam_booking.required'               => 'Pilih sesi waktu konsultasi.',
        ]);

        // Validate: if booking today, the slot must not be in the past
        $now = Carbon::now('Asia/Jakarta');
        $bookingDate = Carbon::parse($request->tanggal_konsultasi);
        if ($bookingDate->isToday()) {
            $slotTime = Carbon::parse($request->tanggal_konsultasi . ' ' . $request->jam_booking, 'Asia/Jakarta');
            if ($slotTime->lt($now)) {
                return redirect()->route('pasien.booking.index', ['date' => $request->tanggal_konsultasi])
                    ->with('error', 'Sesi jam ' . $request->jam_booking . ' sudah terlewat. Silakan pilih sesi yang belum lewat.');
            }
        }

        // Check if slot is still available
        $existing = Konsultasi::where('nama_dokter', $request->nama_dokter)
            ->where('tanggal_konsultasi', $request->tanggal_konsultasi)
            ->where('jam_booking', $request->jam_booking)
            ->whereIn('status', ['menunggu', 'terkonfirmasi'])
            ->exists();

        if ($existing) {
            return redirect()->route('pasien.booking.index', ['date' => $request->tanggal_konsultasi])
                ->with('error', 'Maaf, sesi jam ' . $request->jam_booking . ' sudah dipesan pasien lain. Silakan pilih sesi lain.');
        }

        $user = auth()->user();

        Konsultasi::create([
            'user_id'            => $user->id,
            'pasien_id'          => $user->pasien_id,
            'tanggal_konsultasi' => $request->tanggal_konsultasi,
            'nama_dokter'        => $request->nama_dokter,
            'poli'               => $request->poli ?? 'PARU',
            'jam_praktik'        => $request->jam_praktik,
            'jam_booking'        => $request->jam_booking,
            'kode_layanan'       => $request->kode_layanan,
            'keluhan'            => $request->keluhan,
            'status'             => 'menunggu',
        ]);

        return redirect()->route('pasien.booking.index', ['date' => $request->tanggal_konsultasi])
            ->with('success', 'Booking konsultasi berhasil dibuat untuk sesi jam ' . $request->jam_booking . '! Silakan tunggu konfirmasi dari pihak rumah sakit.');
    }

    public function bookingCancel($id)
    {
        $booking = Konsultasi::where('user_id', auth()->id())->findOrFail($id);

        if (in_array($booking->status, ['menunggu', 'terkonfirmasi'])) {
            $booking->update(['status' => 'dibatalkan']);
            return redirect()->route('pasien.booking.index')
                ->with('success', 'Booking konsultasi berhasil dibatalkan.');
        }

        return redirect()->route('pasien.booking.index')
            ->with('error', 'Booking ini tidak dapat dibatalkan.');
    }
}
