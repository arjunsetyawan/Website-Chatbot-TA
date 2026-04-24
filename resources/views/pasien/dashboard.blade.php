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
            <a class="nav-item active" href="{{ route('pasien.dashboard') }}">
                <span class="nav-icon">🏠</span> Dashboard
            </a>
            <a class="nav-item" href="{{ route('pasien.konsultasi-chatbot') }}">
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
                <div class="user-avatar">{{ strtoupper(substr(explode(' ', trim($user->name ?? 'P'))[0], 0, 1) . (isset(explode(' ', trim($user->name ?? ''))[1]) ? substr(explode(' ', trim($user->name ?? ''))[1], 0, 1) : '')) }}</div>
                <div class="user-info">
                    <div class="user-name">{{ $user->name ?? 'Pasien' }}</div>
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
            </div>
        </header>

        <!-- Content -->
        <div class="content">

            <!-- Greeting -->
            <div class="greeting-block">
                <div class="greeting-text">
                    <h1>Selamat Datang, {{ explode(' ', $user->name ?? 'Pasien')[0] }} 👋</h1>
                    <p>Sistem Chatbot Kesehatan Paru – RSUD Sultan Fatah siap membantu Anda memahami kondisi kesehatan
                        dan menjawab pertanyaan seputar penyakit paru-paru.</p>
                </div>
                <div class="greeting-cta">
                    <a href="{{ route('pasien.jadwal-dokter') }}" class="btn-outline-white" style="text-decoration:none;">📅 Lihat Jadwal</a>
                    <a href="{{ route('pasien.konsultasi-chatbot') }}" class="btn-primary" style="text-decoration:none;">💬 Mulai Konsultasi →</a>
                </div>
            </div>

            <!-- Stat Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon blue">📋</div>
                        <span class="stat-trend up">↑ Aktif</span>
                    </div>
                    <div class="stat-value">{{ $totalKonsultasi }}</div>
                    <div class="stat-label">Riwayat Konsultasi</div>
                </div>
                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon teal">📅</div>
                        <span class="stat-trend neutral">{{ $bookingTerjadwal }} Mendatang</span>
                    </div>
                    <div class="stat-value">{{ $bookingTerjadwal }}</div>
                    <div class="stat-label">Booking Terjadwal</div>
                </div>
            </div>

            <!-- Quick Access (full width) -->
            <div style="margin-bottom:20px;">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><span class="title-icon">⚡</span> Akses Cepat</div>
                    </div>
                    <div class="card-body">
                        <div class="quick-grid">
                            <a href="{{ route('pasien.konsultasi-chatbot') }}" class="quick-item" style="text-decoration:none;color:inherit;">
                                <div class="qi-icon" style="background:rgba(45,125,210,.1);">💬</div>
                                <div class="qi-label">Chatbot AI</div>
                                <div class="qi-desc">Tanya gejala paru</div>
                            </a>
                            <a href="{{ route('pasien.booking.index') }}" class="quick-item" style="text-decoration:none;color:inherit;">
                                <div class="qi-icon" style="background:rgba(38,166,153,.1);">📅</div>
                                <div class="qi-label">Booking</div>
                                <div class="qi-desc">Jadwal konsultasi</div>
                            </a>
                            <a href="{{ route('pasien.informasi-rs') }}" class="quick-item" style="text-decoration:none;color:inherit;">
                                <div class="qi-icon" style="background:rgba(244,132,95,.1);">🏥</div>
                                <div class="qi-label">Info RS</div>
                                <div class="qi-desc">Fasilitas &amp; layanan</div>
                            </a>
                            <a href="{{ route('pasien.faq') }}" class="quick-item" style="text-decoration:none;color:inherit;">
                                <div class="qi-icon" style="background:rgba(233,196,106,.15);">❓</div>
                                <div class="qi-label">FAQ</div>
                                <div class="qi-desc">Pertanyaan umum</div>
                            </a>
                            <a href="{{ route('pasien.profil') }}" class="quick-item" style="text-decoration:none;color:inherit;">
                                <div class="qi-icon" style="background:rgba(239,68,68,.08);">👤</div>
                                <div class="qi-label">Data Diri</div>
                                <div class="qi-desc">Kelola profil</div>
                            </a>
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
                            <span style="font-size:11px;color:var(--text-muted);font-weight:400;margin-left:4px;">({{ $bookingMendatang->count() }}
                                jadwal)</span>
                        </div>
                        <a href="{{ route('pasien.booking.index') }}" class="card-action" style="text-decoration:none;">+ Booking Baru</a>
                    </div>
                    <div class="card-body" style="display:flex;flex-direction:column;{{ $bookingMendatang->isEmpty() ? 'align-items:center;justify-content:center;min-height:280px;' : '' }}">
                        @if($bookingMendatang->isEmpty())
                            <div style="text-align:center;color:var(--text-muted);">
                                <div style="font-size:44px;margin-bottom:14px;opacity:.6;">📅</div>
                                <div style="font-size:14px;font-weight:700;color:var(--text);margin-bottom:6px;">Belum ada booking mendatang</div>
                                <div style="font-size:12.5px;margin-bottom:20px;">Buat booking konsultasi pertama Anda</div>
                                <a href="{{ route('pasien.booking.index') }}" style="text-decoration:none;display:inline-block;padding:10px 22px;background:var(--accent);color:#fff;border-radius:12px;font-size:12.5px;font-weight:700;">
                                    + Buat Booking Sekarang
                                </a>
                            </div>
                        @else
                            <div class="appt-list">
                                @foreach($bookingMendatang as $bk)
                                <div class="appt-item">
                                    <div class="appt-date">
                                        <div class="day">{{ $bk->tanggal_konsultasi->format('d') }}</div>
                                        <div class="month">{{ $bk->tanggal_konsultasi->translatedFormat('M') }}</div>
                                    </div>
                                    <div class="appt-detail">
                                        <div class="appt-doctor">{{ $bk->nama_dokter }}</div>
                                        <div class="appt-spec">🩺 {{ $bk->poli }}</div>
                                        <div class="appt-time">⏰ {{ $bk->jam_booking ?? $bk->jam_praktik ?? '-' }}</div>
                                    </div>
                                    @if($bk->status === 'terkonfirmasi')
                                        <span class="appt-chip chip-confirmed">✓ Terkonfirmasi</span>
                                    @elseif($bk->status === 'menunggu')
                                        <span class="appt-chip chip-pending">⏳ Menunggu</span>
                                    @else
                                        <span class="appt-chip">{{ ucfirst($bk->status) }}</span>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            <a href="{{ route('pasien.booking.index') }}" style="display:block;text-decoration:none;margin-top:14px;">
                                <div style="padding:12px;border-radius:12px;background:rgba(45,125,210,.05);border:1.5px dashed var(--border);text-align:center;cursor:pointer;color:var(--accent);font-size:12.5px;font-weight:600;">
                                    + Tambah Booking Konsultasi
                                </div>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Konsultasi AI CTA Card -->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <span class="title-icon">🤖</span> Konsultasi AI Paru
                            <span style="font-size:11px;"><span class="live-dot"></span><span style="color:var(--success);font-weight:600;font-size:11px;">Online</span></span>
                        </div>
                        <a href="{{ route('pasien.konsultasi-chatbot') }}" class="card-action" style="text-decoration:none;">Buka →</a>
                    </div>
                    <div class="card-body">
                        <div style="text-align:center;padding:20px 16px 12px;">
                            <div style="font-size:48px;margin-bottom:12px;">🫁</div>
                            <div style="font-size:15px;font-weight:700;color:var(--text);margin-bottom:8px;">Chatbot Kesehatan Paru</div>
                            <div style="font-size:12.5px;color:var(--text-muted);line-height:1.7;margin-bottom:20px;">
                                Tanyakan keluhan seputar penyakit paru-paru kepada asisten AI kami.
                                Tersedia 24 jam setiap hari, gratis dan mudah diakses.
                            </div>
                            <div style="display:flex;flex-direction:column;gap:10px;">
                                <a href="{{ route('pasien.konsultasi-chatbot') }}" style="text-decoration:none;display:block;padding:12px 20px;background:var(--accent);color:#fff;border-radius:12px;font-size:13px;font-weight:700;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                                    💬 Mulai Konsultasi Sekarang
                                </a>
                                <a href="{{ route('pasien.faq') }}" style="text-decoration:none;display:block;padding:10px 20px;background:rgba(45,125,210,.07);color:var(--accent);border:1.5px solid rgba(45,125,210,.2);border-radius:12px;font-size:12.5px;font-weight:600;" onmouseover="this.style.background='rgba(45,125,210,.13)'" onmouseout="this.style.background='rgba(45,125,210,.07)'">
                                    ❓ Lihat FAQ Penyakit Paru
                                </a>
                            </div>
                        </div>
                        <div style="border-top:1px solid var(--border);padding-top:14px;margin-top:4px;">
                            <div style="font-size:11px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px;">Topik Populer</div>
                            <div style="display:flex;flex-wrap:wrap;gap:6px;">
                                <a href="{{ route('pasien.konsultasi-chatbot') }}" style="text-decoration:none;font-size:11.5px;padding:5px 12px;border-radius:20px;background:rgba(45,125,210,.07);color:var(--accent);border:1px solid rgba(45,125,210,.15);font-weight:500;">Batuk kering</a>
                                <a href="{{ route('pasien.konsultasi-chatbot') }}" style="text-decoration:none;font-size:11.5px;padding:5px 12px;border-radius:20px;background:rgba(45,125,210,.07);color:var(--accent);border:1px solid rgba(45,125,210,.15);font-weight:500;">Sesak napas</a>
                                <a href="{{ route('pasien.konsultasi-chatbot') }}" style="text-decoration:none;font-size:11.5px;padding:5px 12px;border-radius:20px;background:rgba(45,125,210,.07);color:var(--accent);border:1px solid rgba(45,125,210,.15);font-weight:500;">TBC</a>
                                <a href="{{ route('pasien.konsultasi-chatbot') }}" style="text-decoration:none;font-size:11.5px;padding:5px 12px;border-radius:20px;background:rgba(45,125,210,.07);color:var(--accent);border:1px solid rgba(45,125,210,.15);font-weight:500;">Asma</a>
                                <a href="{{ route('pasien.konsultasi-chatbot') }}" style="text-decoration:none;font-size:11.5px;padding:5px 12px;border-radius:20px;background:rgba(45,125,210,.07);color:var(--accent);border:1px solid rgba(45,125,210,.15);font-weight:500;">PPOK</a>
                            </div>
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
