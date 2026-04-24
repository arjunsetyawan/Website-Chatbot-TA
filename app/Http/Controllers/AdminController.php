<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use App\Models\Konsultasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    // ─── DASHBOARD ────────────────────────────────────────────────
    public function dashboard(Request $request)
    {
        $totalPasien = Pasien::count();

        $pasienBaruBulanIni = Pasien::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $pasienBaruHariIni = Pasien::whereDate('created_at', Carbon::now('Asia/Jakarta')->toDateString())->count();

        $pasienLaki      = Pasien::where('jenis_kelamin', 'LAKI-LAKI')->count();
        $pasienPerempuan = Pasien::where('jenis_kelamin', 'PEREMPUAN')->count();

        $totalUsers = User::count();
        $userBaruBulanIni = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $pasiens = Pasien::orderBy('created_at', 'desc')->paginate(6);

        $selectedPoli = $request->input('poli', '');
        $jadwalDokterAktif = [];
        $totalDokterAktif = 0;
        $layananList = [];
        try {
            $response = Http::post('https://eklaim.rsudsulfat.id/simrs_api/jadwal/apischeddoc.php', [
                'token'    => '842c9ab0a93c520a703fa90d484dc6f42fc646f8c94a7fa3b6aa772d4ca173d2',
                'name'     => '',
                'tglsched' => Carbon::now()->format('Y-m-d')
            ]);

            if ($response->successful()) {
                $result = $response->json();
                if (isset($result['status']) && $result['status'] === 'success' && isset($result['data'])) {
                    $allData = $result['data'];
                    $layananList = collect($allData)->pluck('FS_NM_LAYANAN')->unique()->sort()->values();

                    if ($selectedPoli) {
                        $jadwalDokterAktif = array_filter($allData, function ($item) use ($selectedPoli) {
                            return $item['FS_NM_LAYANAN'] == $selectedPoli;
                        });
                    } else {
                        $jadwalDokterAktif = $allData;
                    }
                    $totalDokterAktif = count($jadwalDokterAktif);
                }
            }
        } catch (\Exception $e) {
            // fail silently for dashboard stat
        }

        $today = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $konsultasiHariIni = Konsultasi::with(['pasien', 'user'])
            ->whereDate('tanggal_konsultasi', $today)
            ->orderBy('jam_booking')
            ->get();

        $totalBookingHariIni    = $konsultasiHariIni->count();
        $pendingBookingHariIni  = $konsultasiHariIni->where('status', 'menunggu')->count();

        // Statistik konsultasi keseluruhan
        $totalMenunggu       = Konsultasi::where('status', 'menunggu')->count();
        $totalTerkonfirmasi  = Konsultasi::where('status', 'terkonfirmasi')->count();
        $totalDibatalkan     = Konsultasi::where('status', 'dibatalkan')->count();
        $totalBookingBulanIni = Konsultasi::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // 5 booking konsultasi terbaru (semua tanggal)
        $recentBookings = Konsultasi::with(['pasien', 'user'])
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalPasien',
            'pasienBaruBulanIni',
            'pasienBaruHariIni',
            'pasienLaki',
            'pasienPerempuan',
            'pasiens',
            'totalDokterAktif',
            'jadwalDokterAktif',
            'layananList',
            'selectedPoli',
            'konsultasiHariIni',
            'totalBookingHariIni',
            'pendingBookingHariIni',
            'totalMenunggu',
            'totalTerkonfirmasi',
            'totalDibatalkan',
            'totalBookingBulanIni',
            'totalUsers',
            'userBaruBulanIni',
            'recentBookings'
        ));
    }

    // ═══════════════════════════════════════════════════════════════
    //   DATA BOOKING KONSULTASI
    // ═══════════════════════════════════════════════════════════════

    public function bookingIndex(Request $request)
    {
        // Auto-expire: booking menunggu yang tanggalnya sudah lewat
        Konsultasi::where('status', 'menunggu')
            ->whereDate('tanggal_konsultasi', '<', Carbon::today('Asia/Jakarta'))
            ->update(['status' => 'kadaluwarsa']);

        $query = Konsultasi::with(['pasien', 'user'])->orderByDesc('created_at');

        if ($search = $request->input('search')) {
            $query->whereHas('pasien', function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_rekam_medis', 'like', "%{$search}%");
            })->orWhere('nama_dokter', 'like', "%{$search}%");
        }

        $bookings = $query->paginate(10);

        $totalBookings   = Konsultasi::count();
        $pendingBookings = Konsultasi::where('status', 'menunggu')->count();

        return view('admin.booking.index', compact('bookings', 'totalBookings', 'pendingBookings'));
    }

    public function bookingApprove($id)
    {
        $booking = Konsultasi::findOrFail($id);

        // Tolak jika tanggal konsultasi sudah lewat
        if (Carbon::parse($booking->tanggal_konsultasi)->startOfDay()->lt(Carbon::today('Asia/Jakarta'))) {
            $booking->update(['status' => 'kadaluwarsa']);
            return redirect()->back()->with('error', 'Booking tidak dapat disetujui karena tanggal konsultasi sudah terlewat.');
        }

        if ($booking->status === 'menunggu') {
            $booking->update(['status' => 'terkonfirmasi']);
            return redirect()->back()->with('success', 'Booking berhasil disetujui.');
        }

        return redirect()->back()->with('error', 'Status booking tidak valid untuk disetujui.');
    }

    // ═══════════════════════════════════════════════════════════════
    //   DATA PASIEN (dari tabel pasiens)
    // ═══════════════════════════════════════════════════════════════

    // ─── PASIEN: INDEX (list) ─────────────────────────────────────
    public function pasienIndex(Request $request)
    {
        $query = Pasien::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('no_rekam_medis', 'like', "%{$search}%")
                  ->orWhere('no_registrasi', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('keluhan_utama', 'like', "%{$search}%");
            });
        }

        $totalPasien = Pasien::count();
        $pasiens = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.pasien.index', compact('pasiens', 'totalPasien'));
    }

    // ─── PASIEN: CREATE (show form) ───────────────────────────────
    public function pasienCreate()
    {
        return view('admin.pasien.create');
    }

    // ─── PASIEN: STORE (save new) ─────────────────────────────────
    public function pasienStore(Request $request)
    {
        $request->validate([
            'no_rekam_medis' => ['required', 'string', 'max:255', 'unique:pasiens,no_rekam_medis'],
            'no_registrasi'  => ['required', 'string', 'max:255', 'unique:pasiens,no_registrasi'],
            'nik'            => ['required', 'string', 'size:16', 'unique:pasiens,nik'],
            'nama'           => ['required', 'string', 'max:255'],
            'alamat'         => ['required', 'string'],
            'jenis_kelamin'  => ['required', 'in:LAKI-LAKI,PEREMPUAN'],
            'keluhan_utama'  => ['nullable', 'string'],
        ], [
            'no_rekam_medis.required' => 'No. Rekam Medis wajib diisi.',
            'no_rekam_medis.unique'   => 'No. Rekam Medis sudah terdaftar.',
            'no_registrasi.required'  => 'No. Registrasi wajib diisi.',
            'no_registrasi.unique'    => 'No. Registrasi sudah terdaftar.',
            'nik.required'            => 'NIK wajib diisi.',
            'nik.size'                => 'NIK harus 16 digit.',
            'nik.unique'              => 'NIK sudah terdaftar.',
            'nama.required'           => 'Nama wajib diisi.',
            'alamat.required'         => 'Alamat wajib diisi.',
            'jenis_kelamin.required'  => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in'        => 'Jenis kelamin tidak valid.',
        ]);

        Pasien::create($request->only([
            'no_rekam_medis', 'no_registrasi', 'nik',
            'nama', 'alamat', 'jenis_kelamin', 'keluhan_utama',
        ]));

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan.');
    }

    // ─── PASIEN: SHOW (detail) ────────────────────────────────────
    public function pasienShow($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('admin.pasien.show', compact('pasien'));
    }

    // ─── PASIEN: EDIT (show form) ─────────────────────────────────
    public function pasienEdit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('admin.pasien.edit', compact('pasien'));
    }

    // ─── PASIEN: UPDATE (save changes) ────────────────────────────
    public function pasienUpdate(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);

        $request->validate([
            'no_rekam_medis' => ['required', 'string', 'max:255', 'unique:pasiens,no_rekam_medis,' . $pasien->id],
            'no_registrasi'  => ['required', 'string', 'max:255', 'unique:pasiens,no_registrasi,' . $pasien->id],
            'nik'            => ['required', 'string', 'size:16', 'unique:pasiens,nik,' . $pasien->id],
            'nama'           => ['required', 'string', 'max:255'],
            'alamat'         => ['required', 'string'],
            'jenis_kelamin'  => ['required', 'in:LAKI-LAKI,PEREMPUAN'],
            'keluhan_utama'  => ['nullable', 'string'],
        ], [
            'no_rekam_medis.required' => 'No. Rekam Medis wajib diisi.',
            'no_rekam_medis.unique'   => 'No. Rekam Medis sudah terdaftar.',
            'no_registrasi.required'  => 'No. Registrasi wajib diisi.',
            'no_registrasi.unique'    => 'No. Registrasi sudah terdaftar.',
            'nik.required'            => 'NIK wajib diisi.',
            'nik.size'                => 'NIK harus 16 digit.',
            'nik.unique'              => 'NIK sudah terdaftar.',
            'nama.required'           => 'Nama wajib diisi.',
            'alamat.required'         => 'Alamat wajib diisi.',
            'jenis_kelamin.required'  => 'Jenis kelamin wajib dipilih.',
        ]);

        $pasien->update($request->only([
            'no_rekam_medis', 'no_registrasi', 'nik',
            'nama', 'alamat', 'jenis_kelamin', 'keluhan_utama',
        ]));

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    // ─── PASIEN: DESTROY (delete) ─────────────────────────────────
    public function pasienDestroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $nama = $pasien->nama;
        $pasien->delete();

        return redirect()->route('admin.pasien.index')
            ->with('success', "Data pasien {$nama} berhasil dihapus.");
    }

    // ═══════════════════════════════════════════════════════════════
    //   MANAJEMEN USER (dari tabel users)
    // ═══════════════════════════════════════════════════════════════

    // ─── USERS: INDEX ─────────────────────────────────────────────
    public function userIndex(Request $request)
    {
        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($role = $request->input('role')) {
            $query->where('role', $role);
        }

        $totalUsers = User::count();
        $users = $query->with('pasien')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.users.index', compact('users', 'totalUsers'));
    }

    // ─── USERS: CREATE ────────────────────────────────────────────
    public function userCreate()
    {
        $pasiens = Pasien::whereDoesntHave('user')->get();
        return view('admin.users.create', compact('pasiens'));
    }

    // ─── USERS: STORE ─────────────────────────────────────────────
    public function userStore(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'  => ['required', 'confirmed', Password::min(8)],
            'role'      => ['required', 'in:admin,pasien'],
            'pasien_id' => ['nullable', 'exists:pasiens,id'],
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.required'  => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password minimal 8 karakter.',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'pasien_id' => $request->role === 'pasien' ? $request->pasien_id : null,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    // ─── USERS: DETAIL (show) ─────────────────────────────────────
    public function userEdit($id)
    {
        $user = User::with('pasien')->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // ─── USERS: UPDATE ────────────────────────────────────────────
    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password'  => ['nullable', 'confirmed', Password::min(8)],
            'role'      => ['required', 'in:admin,pasien'],
            'pasien_id' => ['nullable', 'exists:pasiens,id'],
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password minimal 8 karakter.',
        ]);

        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->role      = $request->role;
        $user->pasien_id = $request->role === 'pasien' ? $request->pasien_id : null;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    // ─── USERS: DESTROY ───────────────────────────────────────────
    public function userDestroy($id)
    {
        $user = User::findOrFail($id);
        $nama = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "User {$nama} berhasil dihapus.");
    }

    // ─── JADWAL DOKTER DARI API SIMRS ────────────────────────────
    public function jadwalDokter(Request $request)
    {
        $selectedDate = $request->input('date', Carbon::now()->format('Y-m-d'));
        $selectedPoli = $request->input('poli', '');

        $dataJadwal = [];
        $layananList = [];
        $apiError = null;

        try {
            $response = Http::post('https://eklaim.rsudsulfat.id/simrs_api/jadwal/apischeddoc.php', [
                'token'    => '842c9ab0a93c520a703fa90d484dc6f42fc646f8c94a7fa3b6aa772d4ca173d2',
                'name'     => '',
                'tglsched' => $selectedDate
            ]);

            if ($response->successful()) {
                $result = $response->json();
                if (isset($result['status']) && $result['status'] === 'success' && isset($result['data'])) {
                    $allData = $result['data'];
                    $layananList = collect($allData)->pluck('FS_NM_LAYANAN')->unique()->sort()->values();

                    if ($selectedPoli) {
                        $dataJadwal = array_filter($allData, function ($item) use ($selectedPoli) {
                            return $item['FS_NM_LAYANAN'] == $selectedPoli;
                        });
                    } else {
                        $dataJadwal = $allData;
                    }
                }
            } else {
                $apiError = 'Gagal terhubung ke API SIMRS (Status: ' . $response->status() . ')';
            }
        } catch (\Exception $e) {
            $apiError = 'Terjadi kesalahan saat menghubungi API SIMRS: ' . $e->getMessage();
        }

        return view('admin.jadwal', compact('dataJadwal', 'selectedDate', 'apiError', 'layananList', 'selectedPoli'));
    }
}
