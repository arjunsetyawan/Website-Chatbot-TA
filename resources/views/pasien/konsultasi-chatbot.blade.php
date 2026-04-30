<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi Chatbot AI – RSUD Sultan Fatah</title>
    <meta name="description" content="Konsultasi kesehatan paru-paru secara real-time menggunakan Chatbot AI RSUD Sultan Fatah.">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css?v=3">
    <link rel="stylesheet" href="/css/konsultasi-chatbot.css?v=3">
    <style>
        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%) !important; transition: transform .3s ease !important; z-index: 200 !important; }
            .sidebar.open { transform: translateX(0) !important; }
            .main { margin-left: 0 !important; width: 100% !important; }
            .hamburger-btn { display: flex !important; }
            .topbar-left .breadcrumb { display: none !important; }
            .time-chip { display: none !important; }
        }
    </style>
</head>

<body>

    <!-- ══ SIDEBAR OVERLAY (Mobile) ══ -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <aside class="sidebar" id="sidebar">
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
            <a class="nav-item" href="{{ route('pasien.dashboard') }}"><span class="nav-icon">🏠</span> Dashboard</a>
            <a class="nav-item active" href="{{ route('pasien.konsultasi-chatbot') }}"><span class="nav-icon">💬</span> Konsultasi Chatbot<span class="nav-badge">AI</span></a>
            <a class="nav-item" href="{{ route('pasien.jadwal-dokter') }}"><span class="nav-icon">📅</span> Jadwal Dokter</a>
            <a class="nav-item" href="{{ route('pasien.booking.index') }}"><span class="nav-icon">🗒️</span> Booking Konsultasi</a>
            <div class="nav-section-label" style="margin-top:12px;">Informasi</div>
            <a class="nav-item" href="{{ route('pasien.informasi-rs') }}"><span class="nav-icon">ℹ️</span> Informasi Rumah Sakit</a>
            <a class="nav-item" href="{{ route('pasien.faq') }}"><span class="nav-icon">❓</span> FAQ</a>
            <div class="nav-section-label" style="margin-top:12px;">Akun</div>
            <a class="nav-item" href="{{ route('pasien.profil') }}"><span class="nav-icon">👤</span> Profil</a>
            <a class="nav-item" href="{{ route('logout.get') }}" style="color:rgba(239,68,68,.7);"><span class="nav-icon">🚪</span> Keluar</a>
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

    <div class="main">
        <header class="topbar">
            <div class="topbar-left">
                <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleSidebar()" aria-label="Toggle menu">
                    <span></span><span></span><span></span>
                </button>
                <span class="page-title">Konsultasi Chatbot</span>
                <span class="breadcrumb" style="color:var(--border);margin:0 6px;">›</span>
                <span class="breadcrumb">Chatbot AI Paru</span>
            </div>
            <div class="topbar-right">
                <div class="time-chip" id="clock"></div>
            </div>
        </header>

        <div class="content">

            <div class="chatbot-hero fade-up">
                <div class="hero-content">
                    <h1>🤖 Chatbot AI Kesehatan Paru</h1>
                    <p>Konsultasikan keluhan kesehatan paru-paru Anda secara langsung bersama asisten AI kami. Dapatkan informasi dan rekomendasi awal yang cepat dan akurat.</p>
                    <div class="hero-badges">
                        <span class="hero-badge">⚡ Respons Instan</span>
                        <span class="hero-badge">🔒 Privasi Terjaga</span>
                        <span class="hero-badge">🫁 Spesialis Paru</span>
                        <span class="hero-badge">🕐 24/7 Tersedia</span>
                    </div>
                </div>
                <div class="hero-right">
                    <div class="hero-bot-icon">🤖</div>
                    <div class="hero-status"><span class="dot"></span> Online &amp; Siap Membantu</div>
                </div>
            </div>

            <div class="info-strips fade-up fade-up-d1">
                <div class="info-strip">
                    <div class="strip-icon blue">💬</div>
                    <div class="strip-body">
                        <div class="strip-title">Tanya Gejala</div>
                        <div class="strip-desc">Ceritakan keluhan Anda dan dapatkan informasi awal tentang kondisi paru-paru.</div>
                    </div>
                </div>
                <div class="info-strip">
                    <div class="strip-icon teal">📋</div>
                    <div class="strip-body">
                        <div class="strip-title">Panduan Kesehatan</div>
                        <div class="strip-desc">Tanya tentang cara menjaga kesehatan paru dan tips pencegahan penyakit.</div>
                    </div>
                </div>
                <div class="info-strip">
                    <div class="strip-icon orange">🏥</div>
                    <div class="strip-body">
                        <div class="strip-title">Rujukan Dokter</div>
                        <div class="strip-desc">Jika diperlukan, chatbot akan merekomendasikan konsultasi langsung ke dokter spesialis.</div>
                    </div>
                </div>
            </div>

            <div class="chatbot-layout fade-up fade-up-d2">

                <div class="typebot-frame-card">
                    <!-- Botpress Webchat inline container -->
                    <!-- The embeddedChatId matches configuration in init script -->
                    <div id="bp-embedded-webchat" class="bp-inline-container"></div>
                </div>

                <div class="chatbot-sidebar-panel">

                    <div class="user-context-card">
                        <div class="uc-title">👤 Sesi Aktif</div>
                        <div class="uc-user">
                            <div class="uc-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}{{ strtoupper(substr(explode(' ', auth()->user()->name ?? 'Pasien')[1] ?? '', 0, 1)) }}</div>
                            <div>
                                <div class="uc-name">{{ auth()->user()->name ?? 'Pasien' }}</div>
                                <div class="uc-label">Pasien · RSUD Sultan Fatah</div>
                            </div>
                        </div>
                        <hr class="uc-divider">
                        <div class="uc-note">💡 Anda dapat berkonsultasi tentang gejala, menanyakan informasi penyakit paru, atau meminta rekomendasi tindakan.</div>
                    </div>

                    <div class="quick-topics-card">
                        <div class="qt-title">⚡ Topik Populer</div>
                        <div class="topic-item"><span class="topic-emoji">🫁</span> Gejala TBC Paru</div>
                        <div class="topic-item"><span class="topic-emoji">😮‍💨</span> Sesak Napas &amp; Penyebabnya</div>
                        <div class="topic-item"><span class="topic-emoji">🤧</span> Batuk Kronis &amp; Asma</div>
                        <div class="topic-item"><span class="topic-emoji">💊</span> Obat &amp; Pengobatan Paru</div>
                        <div class="topic-item"><span class="topic-emoji">🚭</span> Dampak Merokok pada Paru</div>
                        <div class="topic-item"><span class="topic-emoji">❤️</span> Saturasi Oksigen Normal</div>
                    </div>

                    <div class="tips-card">
                        <div class="tips-title">💡 Tips Konsultasi</div>
                        <div class="tip-item"><div class="tip-bullet">1</div> Deskripsikan gejala sejelas mungkin (kapan mulai, seberapa parah)</div>
                        <div class="tip-item"><div class="tip-bullet">2</div> Sebutkan riwayat penyakit atau alergi yang dimiliki</div>
                        <div class="tip-item"><div class="tip-bullet">3</div> Tanyakan satu topik per percakapan untuk hasil lebih akurat</div>
                        <div class="tip-item"><div class="tip-bullet">4</div> Konsultasi chatbot bukan pengganti diagnosa dokter</div>
                    </div>

                    <div class="booking-cta-card">
                        <div class="bca-icon">📅</div>
                        <div class="bca-title">Butuh Konsultasi Langsung?</div>
                        <div class="bca-desc">Booking jadwal dengan dokter spesialis paru RSUD Sultan Fatah sekarang.</div>
                        <a href="{{ route('pasien.booking.index') }}" class="bca-btn">🗓️ Booking Konsultasi</a>
                    </div>

                </div>
            </div>

            <div class="chatbot-footer-notice fade-up fade-up-d3">
                <span class="fn-icon">⚠️</span>
                <span><strong>Perhatian:</strong> Chatbot AI ini hanya memberikan informasi kesehatan umum dan bukan merupakan diagnosa medis resmi. Selalu konsultasikan keluhan serius Anda kepada dokter atau tenaga medis profesional di RSUD Sultan Fatah.</span>
            </div>

        </div>
    </div>

    {{-- Botpress Webchat v3.6 inline embed --}}
    <script src="https://cdn.botpress.cloud/webchat/v3.6/inject.js"></script>
    <script>
    /* ── BOTPRESS WEBCHAT ── */
    (function waitForBotpress() {
        if (!window.botpress) {
            return setTimeout(waitForBotpress, 100);
        }

        window.botpress.init({
            botId          : 'f75a4ad0-ecfc-445c-a4d3-fef54b0b2a6c',
            clientId       : '39e8fadd-f036-40aa-bc2e-7e5d1833586c',
            configuration  : {
                version                    : 'v2',
                botName                    : 'Asisten AI Paru – Sultan Fatah',
                color                      : '#2d7dd2',
                variant                    : 'solid',
                headerVariant              : 'solid',
                themeMode                  : 'light',
                fontFamily                 : 'inter',
                radius                     : 4,
                feedbackEnabled            : false,
                soundEnabled               : false,
                showPoweredBy              : false,
                footer                     : '',
                storageLocation            : 'sessionStorage',
                conversationHistory        : false,
                proactiveMessageEnabled    : false,
                /* Key: tells Botpress to render inside #bp-embedded-webchat */
                embeddedChatId             : 'bp-embedded-webchat',
            },
        });

        /* Open chat immediately and keep it open */
        window.botpress.on('ready', function () {
            window.botpress.open();
        });
        /* Fallback: if ready already fired */
        setTimeout(function () {
            try { window.botpress.open(); } catch(e) {}
        }, 1500);
    })();
    </script>

    <script>
    /* ── Quick topic chips → send message into Botpress ── */
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.topic-item').forEach(function (item) {
            item.addEventListener('click', function () {
                var text = item.textContent.trim().replace(/^\S+\s+/, '');
                if (window.botpress) {
                    try { window.botpress.open(); } catch (e) {}
                    try { window.botpress.sendMessage({ type: 'text', text: text }); } catch (e) {}
                }
            });
        });
    });
    </script>


    <script>
        // Sidebar toggle (mobile)
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const btn = document.getElementById('hamburgerBtn');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
            btn.classList.toggle('open');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('active');
            document.getElementById('hamburgerBtn').classList.remove('open');
        }
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', () => { if(window.innerWidth <= 1024) closeSidebar(); });
        });

        function updateClock() {
            const now = new Date();
            const days   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
            const d = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
            const t = `${String(now.getHours()).padStart(2,'0')}:${String(now.getMinutes()).padStart(2,'0')} WIB`;
            document.getElementById('clock').textContent = `${d} · ${t}`;
        }
        updateClock();
        setInterval(updateClock, 1000);

        function syncEmbedHeight() {
            const frameCard = document.querySelector('.typebot-frame-card');
            if (!frameCard) return;
            if (window.innerWidth <= 1024) {
                frameCard.style.minHeight = '';
                return;
            }
            const sidebar = document.querySelector('.chatbot-sidebar-panel');
            if (!sidebar) return;
            const sidebarH = sidebar.getBoundingClientRect().height;
            if (sidebarH > 0) frameCard.style.minHeight = sidebarH + 'px';
        }
        window.addEventListener('load', () => { setTimeout(syncEmbedHeight, 300); setTimeout(syncEmbedHeight, 1500); });
        window.addEventListener('resize', syncEmbedHeight);
        if (window.ResizeObserver) {
            const ro = new ResizeObserver(syncEmbedHeight);
            document.addEventListener('DOMContentLoaded', () => {
                const sidebar = document.querySelector('.chatbot-sidebar-panel');
                if (sidebar) ro.observe(sidebar);
            });
        }
    </script>

</body>
</html>
