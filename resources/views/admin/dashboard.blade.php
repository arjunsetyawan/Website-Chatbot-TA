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
                <!-- 4. Sesi Chatbot -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-label-top">Sesi Chatbot</div>
                        <div class="stat-icon-sm">💬</div>
                    </div>
                    <div class="stat-value">63</div>
                    <div class="stat-footer">
                        <span class="stat-delta delta-up">↑ 12%</span>
                        <span class="stat-footer-label">vs kemarin</span>
                    </div>
                </div>
                <!-- 5. Pertanyaan Terjawab -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-label-top">Pertanyaan Terjawab</div>
                        <div class="stat-icon-sm">✅</div>
                    </div>
                    <div class="stat-value">89<span
                            style="font-size:14px;font-weight:500;color:var(--text-muted)">%</span></div>
                    <div class="stat-footer">
                        <span class="stat-delta delta-down">7 fallback</span>
                        <span class="stat-footer-label">tidak cocok rule</span>
                    </div>
                </div>
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

                <!-- Activity Log -->
                <div class="card">
                    <div class="card-head">
                        <div class="card-title"><span class="card-title-icon">📋</span> Log Aktivitas</div>
                        <button class="card-action-btn">Lihat Semua</button>
                    </div>
                    <div class="log-list">
                        <div class="log-item">
                            <div class="log-dot-col">
                                <div class="log-dot-outer success"></div>
                                <div class="log-line"></div>
                            </div>
                            <div class="log-content">
                                <div class="log-action">Booking baru dikonfirmasi</div>
                                <div class="log-detail">Harjuno Setyawan → dr. Siti Rahayu</div>
                                <div class="log-time">12:03 WIB</div>
                            </div>
                        </div>
                        <div class="log-item">
                            <div class="log-dot-col">
                                <div class="log-dot-outer info"></div>
                                <div class="log-line"></div>
                            </div>
                            <div class="log-content">
                                <div class="log-action">Pasien baru didaftarkan</div>
                                <div class="log-detail">RSF-0142 · Nuraini Hasanah</div>
                                <div class="log-time">11:47 WIB</div>
                            </div>
                        </div>
                        <div class="log-item">
                            <div class="log-dot-col">
                                <div class="log-dot-outer warning"></div>
                                <div class="log-line"></div>
                            </div>
                            <div class="log-content">
                                <div class="log-action">Jadwal dokter diperbarui</div>
                                <div class="log-detail">dr. Ahmad Fauzi — slot ditambah 2</div>
                                <div class="log-time">11:12 WIB</div>
                            </div>
                        </div>
                        <div class="log-item">
                            <div class="log-dot-col">
                                <div class="log-dot-outer danger"></div>
                                <div class="log-line"></div>
                            </div>
                            <div class="log-content">
                                <div class="log-action">Booking dibatalkan</div>
                                <div class="log-detail">RSF-0130 · Sari Indrawati</div>
                                <div class="log-time">10:55 WIB</div>
                            </div>
                        </div>
                        <div class="log-item">
                            <div class="log-dot-col">
                                <div class="log-dot-outer success"></div>
                                <div class="log-line"></div>
                            </div>
                            <div class="log-content">
                                <div class="log-action">Admin login berhasil</div>
                                <div class="log-detail">IP: 192.168.1.10 · Chrome/Win</div>
                                <div class="log-time">08:01 WIB</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chatbot Stats – Rule-Based -->
                <div class="card">
                    <div class="card-head">
                        <div>
                            <div class="card-title"><span class="card-title-icon">💬</span> Statistik Chatbot</div>
                            <div class="card-subtitle">Rule-Based · 63 sesi hari ini</div>
                        </div>
                        <button class="card-action-btn">+ Tambah Rule</button>
                    </div>
                    <div class="chatbot-stats">

                        <!-- Matched vs Fallback donut summary -->
                        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px;margin-bottom:4px;">
                            <div
                                style="background:var(--success-bg);border:1px solid #bbf7d0;border-radius:8px;padding:10px 12px;text-align:center;">
                                <div
                                    style="font-size:19px;font-weight:700;font-family:'JetBrains Mono',monospace;color:var(--success);">
                                    56</div>
                                <div style="font-size:10px;color:var(--success);font-weight:600;margin-top:2px;">✓
                                    Terjawab</div>
                            </div>
                            <div
                                style="background:var(--danger-bg);border:1px solid #fecaca;border-radius:8px;padding:10px 12px;text-align:center;">
                                <div
                                    style="font-size:19px;font-weight:700;font-family:'JetBrains Mono',monospace;color:var(--danger);">
                                    7</div>
                                <div style="font-size:10px;color:var(--danger);font-weight:600;margin-top:2px;">✗
                                    Fallback</div>
                            </div>
                            <div
                                style="background:var(--border-light);border:1px solid var(--border);border-radius:8px;padding:10px 12px;text-align:center;">
                                <div
                                    style="font-size:19px;font-weight:700;font-family:'JetBrains Mono',monospace;color:var(--text);">
                                    42</div>
                                <div style="font-size:10px;color:var(--text-muted);font-weight:600;margin-top:2px;">
                                    Rule Aktif</div>
                            </div>
                        </div>

                        <!-- Match rate bar -->
                        <div>
                            <div class="chatstat-row" style="margin-bottom:5px;">
                                <span class="chatstat-label" style="font-weight:600;color:var(--text);">Rule Match
                                    Rate</span>
                                <span class="chatstat-val" style="color:var(--success);">88.9%</span>
                            </div>
                            <div style="height:8px;background:var(--bg);border-radius:20px;overflow:hidden;">
                                <div
                                    style="height:100%;width:89%;background:linear-gradient(90deg,var(--success),#4ade80);border-radius:20px;">
                                </div>
                            </div>
                        </div>

                        <!-- Top keyword hits -->
                        <div style="border-top:1px solid var(--border);padding-top:12px;">
                            <div
                                style="font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--text-muted);margin-bottom:9px;">
                                Kata Kunci Paling Sering Cocok</div>
                            <div>
                                <div class="chatstat-row">
                                    <span class="chatstat-label">🔑 "sesak nafas"</span>
                                    <span class="chatstat-val">21 kali</span>
                                </div>
                                <div class="chatstat-bar-wrap">
                                    <div class="chatstat-bar" style="width:100%"></div>
                                </div>
                            </div>
                            <div style="margin-top:8px;">
                                <div class="chatstat-row">
                                    <span class="chatstat-label">🔑 "batuk berdahak"</span>
                                    <span class="chatstat-val">17 kali</span>
                                </div>
                                <div class="chatstat-bar-wrap">
                                    <div class="chatstat-bar" style="width:81%;background:var(--info)"></div>
                                </div>
                            </div>
                            <div style="margin-top:8px;">
                                <div class="chatstat-row">
                                    <span class="chatstat-label">🔑 "jadwal dokter"</span>
                                    <span class="chatstat-val">11 kali</span>
                                </div>
                                <div class="chatstat-bar-wrap">
                                    <div class="chatstat-bar" style="width:52%;background:var(--warning)"></div>
                                </div>
                            </div>
                            <div style="margin-top:8px;">
                                <div class="chatstat-row">
                                    <span class="chatstat-label">🔑 "cara booking"</span>
                                    <span class="chatstat-val">7 kali</span>
                                </div>
                                <div class="chatstat-bar-wrap">
                                    <div class="chatstat-bar" style="width:33%;background:var(--text-muted)"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Fallback alert -->
                        <div style="border-top:1px solid var(--border);padding-top:12px;">
                            <div
                                style="font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--text-muted);margin-bottom:9px;">
                                ⚠️ Pertanyaan Fallback Terbaru</div>
                            <div style="display:flex;flex-direction:column;gap:6px;">
                                <div
                                    style="display:flex;align-items:center;justify-content:space-between;padding:7px 10px;background:var(--danger-bg);border:1px solid #fecaca;border-radius:7px;">
                                    <span style="font-size:11.5px;color:var(--text);font-style:italic;">"apakah saya
                                        boleh olahraga?"</span>
                                    <button class="action-btn"
                                        style="font-size:10px;padding:3px 8px;border-color:#fca5a5;color:var(--danger);">+
                                        Rule</button>
                                </div>
                                <div
                                    style="display:flex;align-items:center;justify-content:space-between;padding:7px 10px;background:var(--danger-bg);border:1px solid #fecaca;border-radius:7px;">
                                    <span style="font-size:11.5px;color:var(--text);font-style:italic;">"obat apa yang
                                        harus diminum?"</span>
                                    <button class="action-btn"
                                        style="font-size:10px;padding:3px 8px;border-color:#fca5a5;color:var(--danger);">+
                                        Rule</button>
                                </div>
                                <div
                                    style="display:flex;align-items:center;justify-content:space-between;padding:7px 10px;background:var(--danger-bg);border:1px solid #fecaca;border-radius:7px;">
                                    <span style="font-size:11.5px;color:var(--text);font-style:italic;">"berapa lama
                                        masa pemulihan?"</span>
                                    <button class="action-btn"
                                        style="font-size:10px;padding:3px 8px;border-color:#fca5a5;color:var(--danger);">+
                                        Rule</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- System Status -->
                <div class="card">
                    <div class="card-head">
                        <div class="card-title"><span class="card-title-icon">🖥️</span> Status Sistem</div>
                        <span style="font-size:11px;color:var(--success);font-weight:600;">● Semua Normal</span>
                    </div>
                    <div class="sys-list">
                        <div class="sys-item">
                            <div class="sys-name"><span class="sys-icon">🌐</span> Web Server (Apache)</div>
                            <div class="sys-info">
                                <div class="sys-status ok">Online</div>
                                <div class="sys-uptime">Uptime 99.98%</div>
                            </div>
                        </div>
                        <div class="sys-item">
                            <div class="sys-name"><span class="sys-icon">🗄️</span> Database (MySQL)</div>
                            <div class="sys-info">
                                <div class="sys-status ok">Online</div>
                                <div class="sys-uptime">142ms latency</div>
                            </div>
                        </div>
                        <div class="sys-item">
                            <div class="sys-name"><span class="sys-icon">🤖</span> AI / NLP Engine</div>
                            <div class="sys-info">
                                <div class="sys-status ok">Online</div>
                                <div class="sys-uptime">1.3s avg resp.</div>
                            </div>
                        </div>
                        <div class="sys-item">
                            <div class="sys-name"><span class="sys-icon">📧</span> Email Notifikasi</div>
                            <div class="sys-info">
                                <div class="sys-status ok">Online</div>
                                <div class="sys-uptime">Queue: 0</div>
                            </div>
                        </div>
                        <div class="sys-item">
                            <div class="sys-name"><span class="sys-icon">💾</span> Disk Storage</div>
                            <div class="sys-info">
                                <div class="sys-status warn">68% Terpakai</div>
                                <div class="sys-uptime">34.2 GB / 50 GB</div>
                            </div>
                        </div>
                        <div class="sys-item">
                            <div class="sys-name"><span class="sys-icon">🔒</span> SSL Certificate</div>
                            <div class="sys-info">
                                <div class="sys-status ok">Valid</div>
                                <div class="sys-uptime">Exp: 12 Des 2026</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
@endsection
