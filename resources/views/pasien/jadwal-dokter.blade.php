<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Dokter Poli Paru – RSUD Sultan Fatah</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/jadwal-dokter.css">
</head>

<body>

    <!-- ══ SIDEBAR ══ -->                                                                                                                                                                                                                                                                                                                              
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-mark">
                <div class="logo-icon">🫁</div>
                <div>
                    <div class="logo-text">Sultan Fatah</div>
                    <div class="logo-sub">RSUD · Chatbot Paru</div>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu Utama</div>
            <a class="nav-item" href="{{ route('pasien.dashboard') }}">
                <span class="nav-icon">🏠</span> Dashboard
            </a>
            <a class="nav-item" href="{{ route('pasien.konsultasi-chatbot') }}">
                <span class="nav-icon">💬</span> Konsultasi Chatbot
                <span class="nav-badge">AI</span>
            </a>
            <a class="nav-item active" href="{{ route('pasien.jadwal-dokter') }}">
                <span class="nav-icon">📅</span> Jadwal Dokter
            </a>
            <a class="nav-item" href="{{ route('pasien.booking.index') }}">
                <span class="nav-icon">🗒️</span> Booking Konsultasi
            </a>

            <div class="nav-section-label" style="margin-top:12px;">Informasi</div>
            <a class="nav-item" href="{{ route('pasien.informasi-rs') }}">
                <span class="nav-icon">ℹ️</span> Informasi Rumah Sakit
            </a>
            <a class="nav-item" href="{{ route('pasien.faq') }}">
                <span class="nav-icon">❓</span> FAQ
            </a>

            <div class="nav-section-label" style="margin-top:12px;">Akun</div>
            <a class="nav-item" href="{{ route('pasien.profil') }}">
                <span class="nav-icon">👤</span> Profil
            </a>
            <a class="nav-item" href="{{ route('logout.get') }}" style="color:rgba(239,68,68,.7);">
                <span class="nav-icon">🚪</span> Keluar
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-card">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}{{ strtoupper(substr(explode(' ', auth()->user()->name ?? 'Pasien')[1] ?? '', 0, 1)) }}</div>
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name ?? 'Pasien' }}</div>
                    <div class="user-role">Pasien</div>
                </div>
                <span style="color:rgba(255,255,255,.3);font-size:14px;">⋮</span>
            </div>
        </div>
    </aside>

    <!-- ══ MAIN ══ -->
    <div class="main">

        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-left">
                <span class="page-title">Jadwal Dokter</span>
                <span class="breadcrumb" style="color:var(--border);margin:0 6px;">›</span>
                <span class="breadcrumb">Poli Paru</span>
            </div>
            <div class="topbar-right">
                <div class="time-chip" id="clock"></div>
            </div>
        </header>

        <!-- Content -->
        <div class="content">

            <!-- Hero Section -->
            <div class="jadwal-hero fade-up">
                <div class="hero-row">
                    <div>
                        <h1>📅 Jadwal Dokter Poli Paru</h1>
                        <p>Lihat jadwal praktik dokter spesialis paru di RSUD Sultan Fatah. Data diperbarui secara real-time dari sistem SIMRS rumah sakit.</p>
                    </div>
                    <div class="hero-stats">
                        <div class="hero-stat">
                            <div class="hs-val">{{ count($dataJadwal) }}</div>
                            <div class="hs-label">Dokter Tersedia</div>
                        </div>
                        <div class="hero-stat">
                            <div class="hs-val">{{ \Carbon\Carbon::parse($selectedDate)->format('d') }}</div>
                            <div class="hs-label">{{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('F Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Banner -->
            <div class="info-banner fade-up fade-up-d1">
                <div class="ib-icon">ℹ️</div>
                <div class="ib-text">
                    <strong>Informasi Poli Paru RSUD Sultan Fatah</strong><br>
                    Jadwal dokter spesialis paru di bawah diambil langsung dari sistem SIMRS. Pastikan Anda datang <strong>15 menit sebelum jam praktik</strong> dan membawa kartu identitas serta rekam medis. Jadwal dapat berubah sewaktu-waktu.
                </div>
            </div>

            <!-- Date Filter -->
            <div class="filter-bar fade-up fade-up-d2">
                <label>📆 Pilih Tanggal:</label>
                <form action="{{ route('pasien.jadwal-dokter') }}" method="GET" id="dateForm" style="display:flex;align-items:center;gap:10px;">
                    <input type="date" name="date" value="{{ $selectedDate }}" onchange="document.getElementById('dateForm').submit()">
                </form>
                <a href="{{ route('pasien.jadwal-dokter') }}" class="filter-today">📌 Hari Ini</a>
                <span style="font-size:12px;color:var(--text-muted);margin-left:4px;">
                    {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('l, d F Y') }}
                </span>
            </div>

            @if($apiError)
                <div class="error-banner fade-up">⚠️ {{ $apiError }}</div>
            @endif

            <!-- Doctor Cards -->
            @if(count($dataJadwal) > 0)
                <div class="dokter-grid">
                    @foreach($dataJadwal as $i => $jadwal)
                    <div class="dokter-card fade-up" style="animation-delay:{{ ($i * 0.06) + 0.15 }}s;">
                        <div class="dc-header">
                            <div class="dc-avatar">👨‍⚕️</div>
                            <div>
                                <div class="dc-name">{{ $jadwal['FS_NM_DOKTER'] ?? 'Dokter' }}</div>
                                <div class="dc-poli">🫁 {{ $jadwal['FS_NM_LAYANAN'] ?? 'Poli Paru' }}</div>
                            </div>
                        </div>
                        <div class="dc-details">
                            <div class="dc-row">
                                <div class="dc-row-icon">📅</div>
                                <div class="dc-row-info">
                                    <div class="dc-row-label">Hari Praktik</div>
                                    <div class="dc-row-val">{{ $jadwal['FS_NM_HARI'] ?? '-' }}</div>
                                </div>
                            </div>
                            <div class="dc-row">
                                <div class="dc-row-icon">⏰</div>
                                <div class="dc-row-info">
                                    <div class="dc-row-label">Jam Praktik</div>
                                    <div class="dc-row-val">{{ $jadwal['jadwal'] ?? '-' }}</div>
                                </div>
                            </div>
                            @if(isset($jadwal['FS_KD_LAYANAN']))
                            <div class="dc-row">
                                <div class="dc-row-icon">🏷️</div>
                                <div class="dc-row-info">
                                    <div class="dc-row-label">Kode Layanan</div>
                                    <div class="dc-row-val" style="font-family:'JetBrains Mono',monospace;font-size:12px;color:var(--accent);">{{ $jadwal['FS_KD_LAYANAN'] }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="dc-status">
                            <span class="dot"></span> Tersedia Hari Ini
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Additional Info -->
                <div class="card fade-up" style="animation-delay:.4s;">
                    <div class="card-header">
                        <div class="card-title"><span class="title-icon">💡</span> Tips untuk Pasien Poli Paru</div>
                    </div>
                    <div class="card-body">
                        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;">
                            <div style="padding:18px;background:var(--bg);border-radius:12px;">
                                <div style="font-size:24px;margin-bottom:8px;">📋</div>
                                <div style="font-size:12.5px;font-weight:700;color:var(--text);margin-bottom:4px;">Persiapan Dokumen</div>
                                <div style="font-size:11.5px;color:var(--text-muted);line-height:1.5;">Bawa KTP, kartu BPJS (jika ada), dan hasil pemeriksaan sebelumnya untuk konsultasi yang lebih efektif.</div>
                            </div>
                            <div style="padding:18px;background:var(--bg);border-radius:12px;">
                                <div style="font-size:24px;margin-bottom:8px;">⏰</div>
                                <div style="font-size:12.5px;font-weight:700;color:var(--text);margin-bottom:4px;">Datang Tepat Waktu</div>
                                <div style="font-size:11.5px;color:var(--text-muted);line-height:1.5;">Disarankan hadir 15-30 menit sebelum jadwal untuk proses registrasi dan pengambilan nomor antrian.</div>
                            </div>
                            <div style="padding:18px;background:var(--bg);border-radius:12px;">
                                <div style="font-size:24px;margin-bottom:8px;">📞</div>
                                <div style="font-size:12.5px;font-weight:700;color:var(--text);margin-bottom:4px;">Konfirmasi Jadwal</div>
                                <div style="font-size:11.5px;color:var(--text-muted);line-height:1.5;">Jadwal dapat berubah sewaktu-waktu. Hubungi bagian pendaftaran untuk konfirmasi ketersediaan dokter.</div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-jadwal fade-up fade-up-d2">
                    <div class="ej-icon">🗓️</div>
                    <div class="ej-title">Tidak Ada Jadwal Poli Paru</div>
                    <div class="ej-desc">
                        Tidak ditemukan jadwal dokter poli paru untuk tanggal <strong>{{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}</strong>.
                        Coba pilih tanggal lain atau hubungi bagian pendaftaran RSUD Sultan Fatah.
                    </div>
                </div>
            @endif

        </div><!-- /content -->
    </div><!-- /main -->

    <script>
        // live clock
        function updateClock() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const d = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
            const t = `${String(now.getHours()).padStart(2,'0')}:${String(now.getMinutes()).padStart(2,'0')} WIB`;
            document.getElementById('clock').textContent = `${d} · ${t}`;
        }
        updateClock();
        setInterval(updateClock, 1000);
    </script>
</body>

</html>
