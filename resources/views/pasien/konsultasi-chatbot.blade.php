<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi Chatbot AI – RSUD Sultan Fatah</title>
    <meta name="description" content="Konsultasi kesehatan paru-paru secara real-time menggunakan Chatbot AI RSUD Sultan Fatah.">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/konsultasi-chatbot.css">
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
            <a class="nav-item active" href="{{ route('pasien.konsultasi-chatbot') }}">
                <span class="nav-icon">💬</span> Konsultasi Chatbot
                <span class="nav-badge">AI</span>
            </a>
            <a class="nav-item" href="{{ route('pasien.jadwal-dokter') }}">
                <span class="nav-icon">📅</span> Jadwal Dokter
            </a>
            <a class="nav-item" href="{{ route('pasien.booking.index') }}">
                <span class="nav-icon">🗒️</span> Booking Konsultasi
            </a>

            <div class="nav-section-label" style="margin-top:12px;">Informasi</div>
            <a class="nav-item" href="{{ route('pasien.informasi-rs') }}">
                <span class="nav-icon">ℹ️</span> Informasi Rumah Sakit
            </a>
            <a class="nav-item" href="{{ route('pasien.faq') }}"><span class="nav-icon">❓</span> FAQ</a>

            <div class="nav-section-label" style="margin-top:12px;">Akun</div>
            <a class="nav-item" href="{{ route('pasien.profil') }}"><span class="nav-icon">👤</span> Profil</a>
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
                <span class="page-title">Konsultasi Chatbot</span>
                <span class="breadcrumb" style="color:var(--border);margin:0 6px;">›</span>
                <span class="breadcrumb">Chatbot AI Paru</span>
            </div>
            <div class="topbar-right">
                <div class="time-chip" id="clock"></div>
            </div>
        </header>

        <!-- Content -->
        <div class="content">

            <!-- Hero Banner -->
            <div class="chatbot-hero fade-up">
                <div class="hero-content">
                    <h1>🤖 Chatbot AI Kesehatan Paru</h1>
                    <p>Konsultasikan keluhan kesehatan paru-paru Anda secara langsung bersama asisten AI kami.
                        Dapatkan informasi dan rekomendasi awal yang cepat dan akurat.</p>
                    <div class="hero-badges">
                        <span class="hero-badge">⚡ Respons Instan</span>
                        <span class="hero-badge">🔒 Privasi Terjaga</span>
                        <span class="hero-badge">🫁 Spesialis Paru</span>
                        <span class="hero-badge">🕐 24/7 Tersedia</span>
                    </div>
                </div>
                <div class="hero-right">
                    <div class="hero-bot-icon">🤖</div>
                    <div class="hero-status">
                        <span class="dot"></span> Online & Siap Membantu
                    </div>
                </div>
            </div>

            <!-- Info Strips -->
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

            <!-- Main Chat Layout -->
            <div class="chatbot-layout fade-up fade-up-d2">

                <!-- Typebot Embed -->
                <div class="typebot-frame-card">
                    <div class="typebot-frame-header">
                        <div class="tfh-left">
                            <div class="tfh-avatar">🤖</div>
                            <div class="tfh-info">
                                <div class="tfh-name">Asisten AI Paru – Sultan Fatah</div>
                                <div class="tfh-sub">Powered by ChatGPT · RSUD Sultan Fatah</div>
                            </div>
                        </div>
                        <div class="tfh-online">
                            <span class="dot"></span> Online
                        </div>
                    </div>
                    <div class="typebot-embed-wrapper">
                        <!-- Loading state -->
                        <div class="typebot-loading" id="typebotLoading">
                            <div class="loading-spinner"></div>
                            <div class="loading-text">Memuat chatbot AI...</div>
                        </div>
                        <!-- Typebot Standard Embed -->
                        <typebot-standard style="width:100%;height:100%;"></typebot-standard>
                    </div>
                </div>

                <!-- Sidebar Panel -->
                <div class="chatbot-sidebar-panel">

                    <!-- User Context -->
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
                        <div class="uc-note">
                            💡 Anda dapat berkonsultasi tentang gejala, menanyakan informasi penyakit paru, atau meminta rekomendasi tindakan.
                        </div>
                    </div>

                    <!-- Quick Topics -->
                    <div class="quick-topics-card">
                        <div class="qt-title">⚡ Topik Populer</div>
                        <div class="topic-item"><span class="topic-emoji">🫁</span> Gejala TBC Paru</div>
                        <div class="topic-item"><span class="topic-emoji">😮‍💨</span> Sesak Napas & Penyebabnya</div>
                        <div class="topic-item"><span class="topic-emoji">🤧</span> Batuk Kronis & Asma</div>
                        <div class="topic-item"><span class="topic-emoji">💊</span> Obat & Pengobatan Paru</div>
                        <div class="topic-item"><span class="topic-emoji">🚭</span> Dampak Merokok pada Paru</div>
                        <div class="topic-item"><span class="topic-emoji">❤️</span> Saturasi Oksigen Normal</div>
                    </div>

                    <!-- Tips -->
                    <div class="tips-card">
                        <div class="tips-title">💡 Tips Konsultasi</div>
                        <div class="tip-item">
                            <div class="tip-bullet">1</div>
                            Deskripsikan gejala sejelas mungkin (kapan mulai, seberapa parah)
                        </div>
                        <div class="tip-item">
                            <div class="tip-bullet">2</div>
                            Sebutkan riwayat penyakit atau alergi yang dimiliki
                        </div>
                        <div class="tip-item">
                            <div class="tip-bullet">3</div>
                            Tanyakan satu topik per percakapan untuk hasil lebih akurat
                        </div>
                        <div class="tip-item">
                            <div class="tip-bullet">4</div>
                            Konsultasi chatbot bukan pengganti diagnosa dokter
                        </div>
                    </div>

                    <!-- Booking CTA -->
                    <div class="booking-cta-card">
                        <div class="bca-icon">📅</div>
                        <div class="bca-title">Butuh Konsultasi Langsung?</div>
                        <div class="bca-desc">Booking jadwal dengan dokter spesialis paru RSUD Sultan Fatah sekarang.</div>
                        <a href="{{ route('pasien.booking.index') }}" class="bca-btn">🗓️ Booking Konsultasi</a>
                    </div>

                </div><!-- /sidebar panel -->
            </div><!-- /chatbot-layout -->

            <!-- Footer Notice -->
            <div class="chatbot-footer-notice fade-up fade-up-d3">
                <span class="fn-icon">⚠️</span>
                <span><strong>Perhatian:</strong> Chatbot AI ini hanya memberikan informasi kesehatan umum dan bukan merupakan diagnosa medis resmi. Selalu konsultasikan keluhan serius Anda kepada dokter atau tenaga medis profesional di RSUD Sultan Fatah.</span>
            </div>

        </div><!-- /content -->
    </div><!-- /main -->

    <!-- Typebot Embed Script -->
    <script>
        // Typebot init
        const typebotInitScript = document.createElement("script");
        typebotInitScript.type = "module";
        typebotInitScript.innerHTML = `
            import Typebot from 'https://cdn.jsdelivr.net/npm/@typebot.io/js@0/dist/web.js';

            Typebot.initStandard({
                typebot: "basic-chat-gpt-2udedxd",
            });

            // Hide loading once typebot is ready
            window.addEventListener('load', function() {
                setTimeout(() => {
                    const loader = document.getElementById('typebotLoading');
                    if (loader) loader.classList.add('hidden');
                }, 2000);
            });
        `;
        document.body.append(typebotInitScript);

        // Hide loader after 3s fallback
        setTimeout(() => {
            const loader = document.getElementById('typebotLoading');
            if (loader) loader.classList.add('hidden');
        }, 3000);
    </script>

    <script>
        // Live clock
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

        // Sync embed height to match sidebar panel
        function syncEmbedHeight() {
            const sidebar = document.querySelector('.chatbot-sidebar-panel');
            const frameCard = document.querySelector('.typebot-frame-card');
            if (!sidebar || !frameCard) return;
            const sidebarH = sidebar.getBoundingClientRect().height;
            if (sidebarH > 0) {
                frameCard.style.minHeight = sidebarH + 'px';
            }
        }

        // Run after content loads and on resize
        window.addEventListener('load', () => {
            setTimeout(syncEmbedHeight, 300);
            setTimeout(syncEmbedHeight, 1500);
        });
        window.addEventListener('resize', syncEmbedHeight);

        // Watch sidebar for height changes
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
