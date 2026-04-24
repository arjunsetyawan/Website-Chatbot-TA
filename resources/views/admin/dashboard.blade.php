@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')
@section('page-sub', 'RSUD Sultan Fatah · Sistem Chatbot Penyakit Paru-Paru')

@section('content')
            <!-- STAT CARDS -->
            <div class="section-row">
                <div class="section-title">Ringkasan Hari Ini</div>
                <div style="font-size:11px;color:var(--text-muted);" id="date-label">Memuat...</div>
            </div>
            <div class="stats-grid">
                <!-- 1. Total Pasien -->
                <a href="{{ route('admin.pasien.index') }}" class="stat-card" style="text-decoration:none; color:inherit; display:block;">
                    <div class="stat-header">
                        <div class="stat-label-top">Total Pasien</div>
                        <div class="stat-icon-sm">👥</div>
                    </div>
                    <div class="stat-value">{{ $totalPasien }}</div>
                    <div class="stat-footer">
                        <span class="stat-delta delta-up">↑ {{ $pasienBaruBulanIni }}</span>
                        <span class="stat-footer-label">pasien baru bulan ini</span>
                    </div>
                </a>
                <!-- 2. Dokter Aktif -->
                <a href="{{ route('admin.jadwal-dokter') }}" class="stat-card" style="text-decoration:none; color:inherit; display:block;">
                    <div class="stat-header">
                        <div class="stat-label-top">Dokter Aktif</div>
                        <div class="stat-icon-sm">👨‍⚕️</div>
                    </div>
                    <div class="stat-value">{{ $totalDokterAktif }}</div>
                    <div class="stat-footer">
                        <span class="stat-delta delta-up">LIVE API</span>
                        <span class="stat-footer-label">jadwal hari ini</span>
                    </div>
                </a>
                <!-- 3. Booking Hari Ini -->
                <a href="{{ route('admin.booking.index') }}" class="stat-card" style="text-decoration:none; color:inherit; display:block;">
                    <div class="stat-header">
                        <div class="stat-label-top">Booking Hari Ini</div>
                        <div class="stat-icon-sm">📅</div>
                    </div>
                    <div class="stat-value">{{ $totalBookingHariIni }}</div>
                    <div class="stat-footer">
                        <span class="stat-delta delta-neutral">{{ $pendingBookingHariIni }} pending</span>
                        <span class="stat-footer-label">perlu konfirmasi</span>
                    </div>
                </a>
            </div>

            <!-- MAIN GRID -->
            <div class="main-grid">

                <!-- Data Pasien Table -->
                <div class="card">
                    <div class="card-head">
                        <div>
                            <div class="card-title"><span class="card-title-icon">👥</span> Data Pasien Terdaftar
                            </div>
                            <div class="card-subtitle">{{ $totalPasien }} total pasien · diperbarui baru saja</div>
                        </div>
                        <a href="{{ route('admin.pasien.create') }}" class="card-action-btn">+ Tambah Pasien</a>
                    </div>
                    <div class="table-toolbar">
                        <input class="search-input" type="text" placeholder="Cari nama atau ID pasien...">
                        <button class="toolbar-btn">⬇ Export</button>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID Pasien</th>
                                    <th>Nama Pasien</th>
                                    <th>Email</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pasiens as $pasien)
                                <tr>
                                    <td><span class="patient-id">RSF-{{ str_pad($pasien->id, 4, '0', STR_PAD_LEFT) }}</span></td>
                                    <td><span class="patient-name">{{ $pasien->name }}</span></td>
                                    <td>{{ $pasien->email }}</td>
                                    <td>{{ $pasien->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.pasien.show', $pasien->id) }}" class="action-btn">👁 Lihat</a>
                                        <a href="{{ route('admin.pasien.edit', $pasien->id) }}" class="action-btn">✏ Edit</a>
                                        <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus pasien ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn danger">🗑</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align:center;padding:32px;color:var(--text-muted);">
                                        Belum ada data pasien terdaftar.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        <div class="pagination-info">Menampilkan {{ $pasiens->firstItem() ?? 0 }}–{{ $pasiens->lastItem() ?? 0 }} dari {{ $pasiens->total() }} pasien</div>
                        <div class="pagination-btns">
                            @if ($pasiens->onFirstPage())
                                <button class="page-btn" disabled>‹</button>
                            @else
                                <a href="{{ $pasiens->previousPageUrl() }}" class="page-btn">‹</a>
                            @endif

                            @foreach ($pasiens->getUrlRange(1, $pasiens->lastPage()) as $page => $url)
                                <a href="{{ $url }}" class="page-btn {{ $page == $pasiens->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                            @endforeach

                            @if ($pasiens->hasMorePages())
                                <a href="{{ $pasiens->nextPageUrl() }}" class="page-btn">›</a>
                            @else
                                <button class="page-btn" disabled>›</button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- RIGHT COL -->
                <div class="right-col">

                    <!-- Jadwal Dokter -->
                    <div class="card">
                        <div class="card-head">
                            <div>
                                <div class="card-title"><span class="card-title-icon">👨‍⚕️</span> Jadwal Dokter Aktif
                                </div>
                                <div class="card-subtitle">{{ $totalDokterAktif }} dokter berpraktik hari ini</div>
                            </div>
                            <div style="display:flex;gap:8px;align-items:center;">
                                <form action="{{ route('admin.dashboard') }}" method="GET" id="dashboardPoliForm">
                                    <select name="poli" onchange="document.getElementById('dashboardPoliForm').submit()"
                                        style="height:28px;border:1px solid var(--border);border-radius:6px;padding:0 8px;font-size:10px;font-family:'Inter',sans-serif;color:var(--text);outline:none;background:var(--bg);max-width:110px;text-overflow:ellipsis;">
                                        <option value="">Semua Poliklinik</option>
                                        @foreach($layananList as $layanan)
                                            <option value="{{ $layanan }}" {{ $selectedPoli == $layanan ? 'selected' : '' }}>{{ $layanan }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                        <div class="doctor-list">
                            @forelse(array_slice($jadwalDokterAktif, 0, 4) as $jadwal)
                                <div class="doctor-item">
                                    <div class="doctor-avatar">👨‍⚕️</div>
                                    <div class="doctor-info">
                                        <div class="doctor-name" style="font-size:12px;font-weight:600;color:var(--text);">{{ $jadwal['FS_NM_DOKTER'] ?? '-' }}</div>
                                        <div class="doctor-spec" style="font-size:11px;color:var(--text-muted);">{{ $jadwal['FS_NM_LAYANAN'] ?? '-' }}</div>
                                    </div>
                                    <div class="doctor-right">
                                        <div class="doctor-schedule" style="font-family:'JetBrains Mono',monospace;font-size:11px;font-weight:600;color:var(--text);">{{ $jadwal['jadwal'] ?? '-' }}</div>
                                        <div class="doctor-slot"><span class="dot dot-success"></span> Tersedia</div>
                                    </div>
                                </div>
                            @empty
                                <div style="text-align:center;padding:24px 16px;">
                                    <div style="font-size:24px;margin-bottom:8px;">🗓️</div>
                                    <div style="font-size:12px;font-weight:600;color:var(--text);margin-bottom:4px;">Tidak Ada Jadwal</div>
                                    <div style="font-size:11px;color:var(--text-muted);">Belum ada jadwal dokter hari ini</div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Booking Hari Ini -->
                    <div class="card">
                        <div class="card-head">
                            <div>
                                <div class="card-title"><span class="card-title-icon">🗒️</span> Booking Hari Ini
                                </div>
                                <div class="card-subtitle">{{ $totalBookingHariIni }} terjadwal · {{ $pendingBookingHariIni }} pending</div>
                            </div>
                            <a href="{{ route('admin.booking.index') }}" class="card-action-btn" style="text-decoration:none;">Lihat Semua</a>
                        </div>
                        <div class="booking-list">
                            @forelse($konsultasiHariIni as $booking)
                            <a href="{{ route('admin.booking.index') }}" class="booking-item" style="text-decoration:none; color:inherit; display:flex;">
                                <div class="booking-time">{{ $booking->jam_booking ?? explode('-', $booking->jam_praktik)[0] ?? '-' }}</div>
                                <div class="booking-info">
                                    <div class="booking-patient" style="text-transform:capitalize;">{{ strtolower($booking->pasien->nama ?? $booking->user->name ?? 'Anonim') }}</div>
                                    <div class="booking-doctor" style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:130px;" title="{{ $booking->nama_dokter }}">{{ $booking->nama_dokter }}</div>
                                </div>
                                @if($booking->status == 'menunggu')
                                    <span class="badge badge-warning" title="Menunggu Konfirmasi">⏳</span>
                                @elseif($booking->status == 'terkonfirmasi')
                                    <span class="badge badge-success" title="Terkonfirmasi">✓</span>
                                @elseif($booking->status == 'dibatalkan')
                                    <span class="badge badge-danger" title="Dibatalkan">✕</span>
                                @else
                                    <span class="badge badge-info">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </a>
                            @empty
                            <div style="text-align:center;padding:24px 16px;">
                                <div style="font-size:24px;margin-bottom:8px;">🛋️</div>
                                <div style="font-size:12px;font-weight:600;color:var(--text);margin-bottom:4px;">Kosong</div>
                                <div style="font-size:11px;color:var(--text-muted);">Tidak ada booking untuk hari ini</div>
                            </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>

            <!-- BOTTOM ROW -->
            <div class="section-row">
                <div class="section-title">Detail Operasional</div>
            </div>
            <div class="bottom-row">

                <!-- Booking Konsultasi Terbaru -->
                <div class="card">
                    <div class="card-head">
                        <div>
                            <div class="card-title"><span class="card-title-icon">🗒️</span> Booking Terbaru</div>
                            <div class="card-subtitle">5 booking terakhir dari semua tanggal</div>
                        </div>
                        <a href="{{ route('admin.booking.index') }}" class="card-action-btn" style="text-decoration:none;">Lihat Semua</a>
                    </div>
                    <div style="padding: 4px 0;">
                        @forelse($recentBookings as $bk)
                        <a href="{{ route('admin.booking.index') }}" style="text-decoration:none;color:inherit;display:flex;align-items:center;gap:12px;padding:11px 18px;border-bottom:1px solid var(--border-light);transition:background .15s;" onmouseover="this.style.background='var(--row-hover)'" onmouseout="this.style.background=''">
                            <div style="flex:1;overflow:hidden;">
                                <div style="font-size:12.5px;font-weight:600;color:var(--text);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;text-transform:capitalize;">
                                    {{ strtolower($bk->pasien->nama ?? $bk->user->name ?? 'Anonim') }}
                                </div>
                                <div style="font-size:11px;color:var(--text-muted);margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" title="{{ $bk->nama_dokter }}">
                                    {{ $bk->nama_dokter ?? '-' }}
                                </div>
                                <div style="font-size:10.5px;color:var(--text-light);margin-top:2px;font-family:'JetBrains Mono',monospace;">
                                    {{ \Carbon\Carbon::parse($bk->tanggal_konsultasi)->format('d M Y') }}
                                </div>
                            </div>
                            <div style="flex-shrink:0;">
                                @if($bk->status === 'menunggu')
                                    <span class="badge badge-warning">⏳ Menunggu</span>
                                @elseif($bk->status === 'terkonfirmasi')
                                    <span class="badge badge-success">✓ Konfirmasi</span>
                                @elseif($bk->status === 'dibatalkan')
                                    <span class="badge badge-danger">✕ Batal</span>
                                @else
                                    <span class="badge badge-neutral">{{ ucfirst($bk->status) }}</span>
                                @endif
                            </div>
                        </a>
                        @empty
                        <div style="text-align:center;padding:36px 16px;">
                            <div style="font-size:28px;margin-bottom:8px;">🗓️</div>
                            <div style="font-size:12px;font-weight:600;color:var(--text);margin-bottom:4px;">Belum Ada Booking</div>
                            <div style="font-size:11px;color:var(--text-muted);">Belum ada data konsultasi di sistem</div>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Ringkasan Konsultasi -->
                <div class="card">
                    <div class="card-head">
                        <div>
                            <div class="card-title"><span class="card-title-icon">🗒️</span> Ringkasan Konsultasi</div>
                            <div class="card-subtitle">{{ $totalBookingBulanIni }} booking bulan ini</div>
                        </div>
                        <a href="{{ route('admin.booking.index') }}" class="card-action-btn" style="text-decoration:none;">Lihat Semua</a>
                    </div>
                    <div class="chatbot-stats">

                        <!-- Status breakdown -->
                        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px;margin-bottom:16px;">
                            <div style="background:var(--warning-bg, #fffbeb);border:1px solid #fde68a;border-radius:8px;padding:10px 12px;text-align:center;">
                                <div style="font-size:22px;font-weight:700;font-family:'JetBrains Mono',monospace;color:var(--warning);">{{ $totalMenunggu }}</div>
                                <div style="font-size:10px;color:var(--warning);font-weight:600;margin-top:2px;">⏳ Menunggu</div>
                            </div>
                            <div style="background:var(--success-bg);border:1px solid #bbf7d0;border-radius:8px;padding:10px 12px;text-align:center;">
                                <div style="font-size:22px;font-weight:700;font-family:'JetBrains Mono',monospace;color:var(--success);">{{ $totalTerkonfirmasi }}</div>
                                <div style="font-size:10px;color:var(--success);font-weight:600;margin-top:2px;">✓ Terkonfirmasi</div>
                            </div>
                            <div style="background:var(--danger-bg);border:1px solid #fecaca;border-radius:8px;padding:10px 12px;text-align:center;">
                                <div style="font-size:22px;font-weight:700;font-family:'JetBrains Mono',monospace;color:var(--danger);">{{ $totalDibatalkan }}</div>
                                <div style="font-size:10px;color:var(--danger);font-weight:600;margin-top:2px;">✕ Dibatalkan</div>
                            </div>
                        </div>

                        <!-- Confirmation rate bar -->
                        @php
                            $totalAll = $totalMenunggu + $totalTerkonfirmasi + $totalDibatalkan;
                            $konfirmasiRate = $totalAll > 0 ? round(($totalTerkonfirmasi / $totalAll) * 100) : 0;
                        @endphp
                        <div style="margin-bottom:16px;">
                            <div class="chatstat-row" style="margin-bottom:5px;">
                                <span class="chatstat-label" style="font-weight:600;color:var(--text);">Tingkat Konfirmasi</span>
                                <span class="chatstat-val" style="color:var(--success);">{{ $konfirmasiRate }}%</span>
                            </div>
                            <div style="height:8px;background:var(--bg);border-radius:20px;overflow:hidden;">
                                <div style="height:100%;width:{{ $konfirmasiRate }}%;background:linear-gradient(90deg,var(--success),#4ade80);border-radius:20px;"></div>
                            </div>
                        </div>

                        <!-- Booking per bulan ini vs kemarin -->
                        <div style="border-top:1px solid var(--border);padding-top:12px;">
                            <div style="font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--text-muted);margin-bottom:10px;">
                                📊 Statistik Booking
                            </div>
                            <div style="display:flex;flex-direction:column;gap:10px;">
                                <div class="chatstat-row">
                                    <span class="chatstat-label">📅 Total Booking Hari Ini</span>
                                    <span class="chatstat-val">{{ $totalBookingHariIni }}</span>
                                </div>
                                <div class="chatstat-bar-wrap">
                                    <div class="chatstat-bar" style="width:{{ $totalBookingHariIni > 0 ? min(100, $totalBookingHariIni * 10) : 0 }}%"></div>
                                </div>
                                <div class="chatstat-row" style="margin-top:4px;">
                                    <span class="chatstat-label">📆 Total Booking Bulan Ini</span>
                                    <span class="chatstat-val">{{ $totalBookingBulanIni }}</span>
                                </div>
                                <div class="chatstat-bar-wrap">
                                    <div class="chatstat-bar" style="width:{{ $totalBookingBulanIni > 0 ? min(100, $totalBookingBulanIni * 3) : 0 }}%;background:var(--info)"></div>
                                </div>
                                <div class="chatstat-row" style="margin-top:4px;">
                                    <span class="chatstat-label">⏳ Menunggu Konfirmasi</span>
                                    <span class="chatstat-val" style="color:var(--warning);">{{ $totalMenunggu }}</span>
                                </div>
                                <div class="chatstat-bar-wrap">
                                    <div class="chatstat-bar" style="width:{{ $totalAll > 0 ? round(($totalMenunggu / $totalAll) * 100) : 0 }}%;background:var(--warning)"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
@endsection
