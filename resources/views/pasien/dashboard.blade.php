<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pasien – RSUD Sultan Fatah</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
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
            <a class="nav-item active" href="#">
                <span class="nav-icon">🏠</span> Dashboard
            </a>
            <a class="nav-item" href="#">
                <span class="nav-icon">💬</span> Konsultasi Chatbot
                <span class="nav-badge">1</span>
            </a>
            <a class="nav-item" href="{{ route('pasien.jadwal-dokter') }}">
                <span class="nav-icon">📅</span> Jadwal Dokter
            </a>
            <a class="nav-item" href="{{ route('pasien.booking.index') }}">
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
                <div class="user-avatar">HS</div>
                <div class="user-info">
                    <div class="user-name">Harjuno Setyawan</div>
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
                <span class="page-title">Dashboard</span>
                <span class="breadcrumb" style="color:var(--border);margin:0 6px;">›</span>
                <span class="breadcrumb">Selamat Datang</span>
            </div>
            <div class="topbar-right">
                <div class="time-chip" id="clock">Rabu, 25 Feb 2026 · 12:00 WIB</div>
                <div class="topbar-btn" title="Notifikasi">
                    🔔
                    <div class="notif-dot"></div>
                </div>
                <div class="topbar-btn" title="Bantuan">❓</div>
            </div>
        </header>

        <!-- Content -->
        <div class="content">

            <!-- Greeting -->
            <div class="greeting-block">
                <div class="greeting-text">
                    <h1>Selamat Datang, Harjuno 👋</h1>
                    <p>Sistem Chatbot Kesehatan Paru – RSUD Sultan Fatah siap membantu Anda memahami kondisi kesehatan
                        dan menjawab pertanyaan seputar penyakit paru-paru.</p>
                </div>
                <div class="greeting-cta">
                    <button class="btn-outline-white">📅 Lihat Jadwal</button>
                    <button class="btn-primary">💬 Mulai Konsultasi →</button>
                </div>
            </div>

            <!-- Stat Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon blue">📋</div>
                        <span class="stat-trend up">↑ Aktif</span>
                    </div>
                    <div class="stat-value">3</div>
                    <div class="stat-label">Riwayat Konsultasi</div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon teal">📅</div>
                        <span class="stat-trend neutral">1 Mendatang</span>
                    </div>
                    <div class="stat-value">1</div>
                    <div class="stat-label">Booking Terjadwal</div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon orange">💊</div>
                        <span class="stat-trend up">↑ 98%</span>
                    </div>
                    <div class="stat-value">14</div>
                    <div class="stat-label">Hari Konsumsi Obat</div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon gold">⭐</div>
                        <span class="stat-trend up">Baik</span>
                    </div>
                    <div class="stat-value">82<span
                            style="font-size:16px;font-weight:500;color:var(--text-muted)">/100</span></div>
                    <div class="stat-label">Skor Kesehatan</div>
                </div>
            </div>

            <!-- Middle Row -->
            <div class="middle-row">

                <!-- Quick Access -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><span class="title-icon">⚡</span> Akses Cepat</div>
                        <span class="card-action">Lihat semua →</span>
                    </div>
                    <div class="card-body">
                        <div class="quick-grid">
                                <a href="#" class="quick-item" style="text-decoration:none;color:inherit;">
                                <div class="qi-icon" style="background:rgba(45,125,210,.1);">💬</div>
                                <div class="qi-label">Chatbot AI</div>
                                <div class="qi-desc">Tanya gejala paru</div>
                            </a>
                            <a href="{{ route('pasien.booking.index') }}" class="quick-item" style="text-decoration:none;color:inherit;">
                                <div class="qi-icon" style="background:rgba(38,166,153,.1);">📅</div>
                                <div class="qi-label">Booking</div>
                                <div class="qi-desc">Jadwal konsultasi</div>
                            </a>
                            <div class="quick-item">
                                <div class="qi-icon" style="background:rgba(244,132,95,.1);">🏥</div>
                                <div class="qi-label">Info RS</div>
                                <div class="qi-desc">Fasilitas & layanan</div>
                            </div>
                            <div class="quick-item">
                                <div class="qi-icon" style="background:rgba(233,196,106,.15);">❓</div>
                                <div class="qi-label">FAQ Paru</div>
                                <div class="qi-desc">Pertanyaan umum</div>
                            </div>
                            <div class="quick-item">
                                <div class="qi-icon" style="background:rgba(139,92,246,.1);">🛍️</div>
                                <div class="qi-label">Produk</div>
                                <div class="qi-desc">Alat & suplemen</div>
                            </div>
                            <div class="quick-item">
                                <div class="qi-icon" style="background:rgba(239,68,68,.08);">👤</div>
                                <div class="qi-label">Data Diri</div>
                                <div class="qi-desc">Kelola profil</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Health Metrics -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><span class="title-icon">📊</span> Metrik Kesehatan</div>
                        <span class="card-action">Update →</span>
                    </div>
                    <div class="card-body">
                        <div class="metric-list">
                            <div class="metric-item">
                                <div class="metric-icon">🫁</div>
                                <div class="metric-info">
                                    <div class="metric-name">Kapasitas Paru</div>
                                    <div class="metric-bar-wrap">
                                        <div class="metric-bar" style="width:72%;background:var(--accent);"></div>
                                    </div>
                                </div>
                                <div class="metric-right">
                                    <div class="metric-val">72%</div>
                                    <div class="metric-status warn">Cukup</div>
                                </div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-icon">❤️</div>
                                <div class="metric-info">
                                    <div class="metric-name">Saturasi O₂</div>
                                    <div class="metric-bar-wrap">
                                        <div class="metric-bar" style="width:97%;background:var(--success);"></div>
                                    </div>
                                </div>
                                <div class="metric-right">
                                    <div class="metric-val">97%</div>
                                    <div class="metric-status good">Normal</div>
                                </div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-icon">💊</div>
                                <div class="metric-info">
                                    <div class="metric-name">Kepatuhan Obat</div>
                                    <div class="metric-bar-wrap">
                                        <div class="metric-bar" style="width:98%;background:var(--accent2);"></div>
                                    </div>
                                </div>
                                <div class="metric-right">
                                    <div class="metric-val">98%</div>
                                    <div class="metric-status good">Sangat Baik</div>
                                </div>
                            </div>
                            <div class="metric-item">
                                <div class="metric-icon">🌬️</div>
                                <div class="metric-info">
                                    <div class="metric-name">Frekuensi Napas</div>
                                    <div class="metric-bar-wrap">
                                        <div class="metric-bar" style="width:60%;background:var(--accent3);"></div>
                                    </div>
                                </div>
                                <div class="metric-right">
                                    <div class="metric-val">18/m</div>
                                    <div class="metric-status good">Normal</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Row -->
            <div class="bottom-row">

                <!-- Appointments -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="title-icon">📅</span> Jadwal Booking Saya
                            <span style="font-size:11px;color:var(--text-muted);font-weight:400;margin-left:4px;">(2
                                jadwal)</span>
                        </div>
                        <span class="card-action">+ Booking Baru</span>
                    </div>
                    <div class="card-body">
                        <div class="appt-list">
                            <div class="appt-item">
                                <div class="appt-date">
                                    <div class="day">12</div>
                                    <div class="month">Mar</div>
                                </div>
                                <div class="appt-detail">
                                    <div class="appt-doctor">dr. Siti Rahayu, Sp.P</div>
                                    <div class="appt-spec">🫁 Spesialis Pulmonologi</div>
                                    <div class="appt-time">⏰ 09:00 – 10:00 WIB &nbsp;·&nbsp; Poli Paru Lt. 2</div>
                                </div>
                                <span class="appt-chip chip-confirmed">✓ Terkonfirmasi</span>
                            </div>
                            <div class="appt-item">
                                <div class="appt-date">
                                    <div class="day">20</div>
                                    <div class="month">Mar</div>
                                </div>
                                <div class="appt-detail">
                                    <div class="appt-doctor">dr. Ahmad Fauzi, Sp.P</div>
                                    <div class="appt-spec">🫁 Spesialis Pulmonologi</div>
                                    <div class="appt-time">⏰ 13:00 – 14:00 WIB &nbsp;·&nbsp; Poli Paru Lt. 2</div>
                                </div>
                                <span class="appt-chip chip-pending">⏳ Pending</span>
                            </div>
                        </div>
                        <a href="{{ route('pasien.booking.index') }}" style="display:block;text-decoration:none;">
                            <div
                                style="margin-top:14px;padding:12px;border-radius:12px;background:rgba(45,125,210,.05);border:1.5px dashed var(--border);text-align:center;cursor:pointer;color:var(--accent);font-size:12.5px;font-weight:600;">
                                + Tambah Booking Konsultasi
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Chat Preview -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="title-icon">🤖</span> Chat dengan AI Paru
                            <span style="font-size:11px;"><span class="live-dot"></span><span
                                    style="color:var(--success);font-weight:600;font-size:11px;">Online</span></span>
                        </div>
                        <span class="card-action">Buka Chat Penuh →</span>
                    </div>
                    <div class="card-body">
                        <div class="chat-preview">
                            <div class="chat-bubble bot">
                                <div class="bubble-avatar bot-av">🤖</div>
                                <div>
                                    <div class="bubble-content">Halo Harjuno! 👋 Saya asisten kesehatan digital RSUD
                                        Sultan Fatah. Ada keluhan paru-paru yang ingin Anda tanyakan?</div>
                                    <div class="bubble-time">12:00</div>
                                </div>
                            </div>
                            <div class="chat-bubble user">
                                <div class="bubble-avatar user-av">H</div>
                                <div>
                                    <div class="bubble-content">Saya sering batuk kering di malam hari, itu berbahaya?
                                    </div>
                                    <div class="bubble-time">12:01</div>
                                </div>
                            </div>
                            <div class="chat-bubble bot">
                                <div class="bubble-avatar bot-av">🤖</div>
                                <div>
                                    <div class="bubble-content">Batuk kering malam hari bisa disebabkan oleh beberapa
                                        faktor seperti udara kering, asma ringan, atau GERD. Saya sarankan Anda tetap
                                        menjaga kelembapan udara dan hindari paparan debu...</div>
                                    <div class="bubble-time">12:01</div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-input-row">
                            <input class="chat-input" type="text"
                                placeholder="Ketik keluhan atau pertanyaan Anda...">
                            <button class="chat-send">➤</button>
                        </div>
                    </div>
                </div>

            </div>
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

        // nav highlight (only prevent default on placeholder links)
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', e => {
                if (item.getAttribute('href') === '#') {
                    e.preventDefault();
                }
                document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
                item.classList.add('active');
            });
        });

        // quick item hover pulse
        document.querySelectorAll('.quick-item').forEach(qi => {
            qi.addEventListener('click', () => {
                qi.style.transform = 'scale(0.96)';
                setTimeout(() => qi.style.transform = '', 120);
            });
        });

        // simple chat send
        const input = document.querySelector('.chat-input');
        const sendBtn = document.querySelector('.chat-send');
        sendBtn.addEventListener('click', () => {
            if (!input.value.trim()) return;
            input.value = '';
            input.focus();
        });
        input.addEventListener('keydown', e => {
            if (e.key === 'Enter') sendBtn.click();
        });
    </script>
</body>

</html>
