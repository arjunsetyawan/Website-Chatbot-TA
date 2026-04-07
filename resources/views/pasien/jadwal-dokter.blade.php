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
    <style>
        /* ── PAGE-SPECIFIC STYLES ── */
        .jadwal-hero {
            background: linear-gradient(135deg, #0a2540 0%, #1a4a80 60%, #2d7dd2 100%);
            border-radius: 20px;
            padding: 36px 40px;
            margin-bottom: 24px;
            position: relative;
            overflow: hidden;
        }
        .jadwal-hero::before {
            content: '';
            position: absolute;
            top: -50px; right: -50px;
            width: 220px; height: 220px;
            border-radius: 50%;
            background: rgba(255,255,255,.06);
        }
        .jadwal-hero::after {
            content: '';
            position: absolute;
            bottom: -70px; right: 140px;
            width: 160px; height: 160px;
            border-radius: 50%;
            background: rgba(255,255,255,.04);
        }
        .jadwal-hero h1 {
            font-family: 'DM Serif Display', serif;
            font-size: 26px;
            color: #fff;
            margin-bottom: 8px;
        }
        .jadwal-hero p {
            font-size: 13.5px;
            color: rgba(255,255,255,.65);
            max-width: 520px;
            line-height: 1.6;
        }
        .jadwal-hero .hero-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }
        .hero-stats {
            display: flex;
            gap: 16px;
        }
        .hero-stat {
            background: rgba(255,255,255,.1);
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 14px;
            padding: 14px 20px;
            text-align: center;
            min-width: 100px;
            backdrop-filter: blur(6px);
        }
        .hero-stat .hs-val {
            font-size: 26px;
            font-weight: 700;
            color: #fff;
            line-height: 1;
        }
        .hero-stat .hs-label {
            font-size: 10.5px;
            color: rgba(255,255,255,.55);
            margin-top: 4px;
            font-weight: 500;
        }

        /* Date Filter */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 24px;
        }
        .filter-bar label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
        }
        .filter-bar input[type="date"] {
            height: 40px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 0 14px;
            font-size: 13px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text);
            outline: none;
            background: var(--white);
            transition: border-color .2s;
        }
        .filter-bar input[type="date"]:focus {
            border-color: var(--accent);
        }
        .filter-today {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 600;
            color: var(--accent);
            background: rgba(45,125,210,.08);
            padding: 6px 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background .2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .filter-today:hover { background: rgba(45,125,210,.15); }

        /* Doctor Cards */
        .dokter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .dokter-card {
            background: var(--card);
            border: 1.5px solid var(--border);
            border-radius: 16px;
            padding: 22px 24px;
            transition: all .25s ease;
            position: relative;
            overflow: hidden;
        }
        .dokter-card:hover {
            border-color: var(--accent);
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(10,37,64,.1);
        }
        .dokter-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--accent) 0%, var(--accent2) 100%);
            border-radius: 4px 0 0 4px;
        }
        .dc-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
        }
        .dc-avatar {
            width: 48px; height: 48px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(45,125,210,.25);
        }
        .dc-name {
            font-size: 14.5px;
            font-weight: 700;
            color: var(--text);
            line-height: 1.3;
        }
        .dc-poli {
            font-size: 11.5px;
            color: var(--accent);
            font-weight: 600;
            margin-top: 2px;
        }
        .dc-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .dc-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: var(--bg);
            border-radius: 10px;
        }
        .dc-row-icon {
            font-size: 17px;
            width: 22px;
            text-align: center;
            flex-shrink: 0;
        }
        .dc-row-info {
            flex: 1;
        }
        .dc-row-label {
            font-size: 10px;
            color: var(--text-muted);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
        }
        .dc-row-val {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            margin-top: 1px;
        }
        .dc-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 20px;
            background: rgba(34,197,94,.1);
            color: var(--success);
            margin-top: 14px;
        }
        .dc-status .dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--success);
            animation: pulse-dot 1.5s infinite;
        }

        /* Empty State */
        .empty-jadwal {
            text-align: center;
            padding: 60px 20px;
            background: var(--card);
            border: 1.5px dashed var(--border);
            border-radius: 16px;
        }
        .empty-jadwal .ej-icon {
            font-size: 48px;
            margin-bottom: 12px;
        }
        .empty-jadwal .ej-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
        }
        .empty-jadwal .ej-desc {
            font-size: 13px;
            color: var(--text-muted);
            max-width: 380px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Info Banner */
        .info-banner {
            background: rgba(45,125,210,.06);
            border: 1.5px solid rgba(45,125,210,.15);
            border-radius: 14px;
            padding: 18px 22px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 24px;
        }
        .info-banner .ib-icon { font-size: 20px; flex-shrink: 0; margin-top: 1px; }
        .info-banner .ib-text { font-size: 12.5px; color: var(--text-muted); line-height: 1.6; }
        .info-banner .ib-text strong { color: var(--text); }

        /* Error Banner */
        .error-banner {
            background: rgba(239,68,68,.06);
            border: 1.5px solid rgba(239,68,68,.2);
            border-radius: 14px;
            padding: 16px 22px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
            font-size: 13px;
            font-weight: 600;
            color: var(--danger);
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: .5; transform: scale(.8); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp .4s ease both; }
        .fade-up-d1 { animation-delay: .05s; }
        .fade-up-d2 { animation-delay: .1s; }
        .fade-up-d3 { animation-delay: .15s; }
    </style>
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
            <a class="nav-item" href="#">
                <span class="nav-icon">💬</span> Konsultasi Chatbot
                <span class="nav-badge">1</span>
            </a>
            <a class="nav-item active" href="{{ route('pasien.jadwal-dokter') }}">
                <span class="nav-icon">📅</span> Jadwal Dokter
            </a>
            <a class="nav-item" href="#">
                <span class="nav-icon">🗒️</span> Booking Konsultasi
            </a>

            <div class="nav-section-label" style="margin-top:12px;">Informasi</div>
            <a class="nav-item" href="#">
                <span class="nav-icon">ℹ️</span> Informasi Rumah Sakit
            </a>
            <a class="nav-item" href="#">
                <span class="nav-icon">❓</span> FAQ Kesehatan Paru
            </a>

            <div class="nav-section-label" style="margin-top:12px;">Akun</div>
            <a class="nav-item" href="#">
                <span class="nav-icon">⚙️</span> Pengaturan
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
                <div class="topbar-btn" title="Notifikasi">
                    🔔
                    <div class="notif-dot"></div>
                </div>
                <div class="topbar-btn" title="Bantuan">❓</div>
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
                                <div class="dc-row-icon">🏥</div>
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
