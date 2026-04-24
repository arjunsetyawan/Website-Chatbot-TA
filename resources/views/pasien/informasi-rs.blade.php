<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Rumah Sakit – RSUD Sultan Fatah</title>
    <meta name="description" content="Informasi umum, sejarah, tugas pokok, dan dokumen resmi RSUD Sultan Fatah Kabupaten Demak.">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/informasi-rs.css">
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
            <a class="nav-item" href="{{ route('pasien.jadwal-dokter') }}">
                <span class="nav-icon">📅</span> Jadwal Dokter
            </a>
            <a class="nav-item" href="{{ route('pasien.booking.index') }}">
                <span class="nav-icon">🗒️</span> Booking Konsultasi
            </a>

            <div class="nav-section-label" style="margin-top:12px;">Informasi</div>
            <a class="nav-item active" href="{{ route('pasien.informasi-rs') }}">
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
                <span class="page-title">Informasi Rumah Sakit</span>
                <span class="breadcrumb" style="color:var(--border);margin:0 6px;">›</span>
                <span class="breadcrumb">RSUD Sultan Fatah Demak</span>
            </div>
            <div class="topbar-right">
                <div class="time-chip" id="clock"></div>
            </div>
        </header>

        <!-- Content -->
        <div class="content">

            <!-- ══ HERO BANNER ══ -->
            <div class="rs-hero">
                <div class="rs-hero-content">
                    <div class="rs-hero-badge">🏥 Profil Resmi</div>
                    <h1>RSUD Sultan Fatah<br>Kabupaten Demak</h1>
                    <p>Rumah Sakit Umum Daerah milik Pemerintah Kabupaten Demak yang melayani masyarakat sejak 2020 dengan semangat memberikan pelayanan kesehatan yang berkualitas, merata, dan terjangkau.</p>
                    <div class="rs-hero-divider"></div>
                    <div class="rs-hero-stats">
                        <div class="hero-stat">
                            <div class="hero-stat-value">2020</div>
                            <div class="hero-stat-label">Mulai Beroperasi</div>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <div class="hero-stat-value">Tipe C</div>
                            <div class="hero-stat-label">Izin Operasional</div>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <div class="hero-stat-value">KM 21</div>
                            <div class="hero-stat-label">Jl. Semarang–Purwodadi</div>
                        </div>
                        <div class="hero-stat-divider"></div>
                        <div class="hero-stat">
                            <div class="hero-stat-value">10+</div>
                            <div class="hero-stat-label">Dokumen Resmi</div>
                        </div>
                    </div>
                </div>

                <!-- Decorative dot pattern -->
                <div class="rs-hero-deco">
                    @for ($r = 0; $r < 6; $r++)
                        @for ($c = 0; $c < 6; $c++)
                            <span></span>
                        @endfor
                    @endfor
                </div>

            </div>

            <!-- ══ TABS ══ -->
            <div class="rs-tabs" id="rsTabs">
                <button class="rs-tab-btn active" data-tab="overview" id="tab-overview">
                    <span class="tab-icon">🏥</span> Profil & Fasilitas
                </button>
                <button class="rs-tab-btn" data-tab="sejarah" id="tab-sejarah">
                    <span class="tab-icon">📜</span> Sejarah & Informasi
                </button>
                <button class="rs-tab-btn" data-tab="dokumen" id="tab-dokumen">
                    <span class="tab-icon">📄</span> Dokumen Resmi
                </button>
            </div>

            <!-- ════════════════════════════════════ -->
            <!-- PANEL 1: OVERVIEW / PROFIL             -->
            <!-- ════════════════════════════════════ -->
            <div class="rs-panel active" id="panel-overview">

                <!-- Info Cards Grid -->
                <div class="overview-grid">
                    <div class="info-card">
                        <div class="info-card-header">
                            <div class="info-card-icon ic-blue">📍</div>
                            <div>
                                <div class="info-card-title">Lokasi & Kontak</div>
                                <div class="info-card-subtitle">Alamat & informasi umum</div>
                            </div>
                        </div>
                        <div class="info-detail-list">
                            <div class="info-detail-item">
                                <span class="info-detail-key">Alamat</span>
                                <span class="info-detail-val">Jl. Raya Semarang–Purwodadi KM 21 No. 107, Desa Brambang, Kec. Karangawen</span>
                            </div>
                            <div class="info-detail-item">
                                <span class="info-detail-key">Kabupaten</span>
                                <span class="info-detail-val">Demak, Jawa Tengah</span>
                            </div>
                            <div class="info-detail-item">
                                <span class="info-detail-key">Website</span>
                                <span class="info-detail-val">rsudsulfat.demakkab.go.id</span>
                            </div>
                            <div class="info-detail-item">
                                <span class="info-detail-key">Tipe RS</span>
                                <span class="info-detail-val">Tipe C (RSUD)</span>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-header">
                            <div class="info-card-icon ic-teal">📅</div>
                            <div>
                                <div class="info-card-title">Tanggal Penting</div>
                                <div class="info-card-subtitle">Sejarah pendirian & operasional</div>
                            </div>
                        </div>
                        <div class="info-detail-list">
                            <div class="info-detail-item">
                                <span class="info-detail-key">Izin Pendirian</span>
                                <span class="info-detail-val">19 Februari 2018</span>
                            </div>
                            <div class="info-detail-item">
                                <span class="info-detail-key">Izin Operasional</span>
                                <span class="info-detail-val">13 Desember 2019</span>
                            </div>
                            <div class="info-detail-item">
                                <span class="info-detail-key">Peresmian</span>
                                <span class="info-detail-val">15 Desember 2019</span>
                            </div>
                            <div class="info-detail-item">
                                <span class="info-detail-key">Mulai Beroperasi</span>
                                <span class="info-detail-val">15 Mei 2020</span>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-header">
                            <div class="info-card-icon ic-orange">🏗️</div>
                            <div>
                                <div class="info-card-title">Pembangunan</div>
                                <div class="info-card-subtitle">Tahapan konstruksi gedung</div>
                            </div>
                        </div>
                        <div class="info-detail-list">
                            <div class="info-detail-item">
                                <span class="info-detail-key">2017</span>
                                <span class="info-detail-val">Gedung manajemen & poliklinik</span>
                            </div>
                            <div class="info-detail-item">
                                <span class="info-detail-key">2018</span>
                                <span class="info-detail-val">IGD, radiologi, rawat inap, bersalin & anak</span>
                            </div>
                            <div class="info-detail-item">
                                <span class="info-detail-key">2019</span>
                                <span class="info-detail-val">Farmasi, laboratorium, gizi, laundry & penunjang</span>
                            </div>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-header">
                            <div class="info-card-icon ic-purple">⭐</div>
                            <div>
                                <div class="info-card-title">Layanan Perdana</div>
                                <div class="info-card-subtitle">Saat mulai beroperasi Mei 2020</div>
                            </div>
                        </div>
                        <div class="service-tags">
                            <span class="service-tag">🫁 Spesialis Penyakit Dalam</span>
                            <span class="service-tag">🤰 Kebidanan & Kandungan</span>
                            <span class="service-tag">👂 THT</span>
                            <span class="service-tag">🦷 Poliklinik Umum & Gigi</span>
                            <span class="service-tag">🩻 Radiologi</span>
                            <span class="service-tag">🔬 Laboratorium</span>
                            <span class="service-tag">✅ Medical Check Up</span>
                        </div>
                    </div>
                </div>

                <!-- Photo Info Cards -->
                <div class="section-label" style="margin-bottom:14px;">
                    <span class="section-label-text">Visi, Struktur & Nilai Budaya</span>
                    <div class="section-label-line"></div>
                    <span style="font-size:11px;color:var(--text-muted);white-space:nowrap;">Klik ⤢ untuk perbesar gambar</span>
                </div>
                <div class="photo-cards-grid">

                    <!-- Card 1: Visi & Misi -->
                    <div class="photo-info-card">
                        <div class="photo-img-wrap" onclick="openLightbox('/img/visi.jpeg', 'Visi & Misi RSUD Sultan Fatah')">
                            <img src="/img/visi.jpeg" alt="Visi & Misi RSUD Sultan Fatah">
                            <div class="photo-img-overlay">
                                <span class="photo-img-badge">🎯 Visi & Misi</span>
                                <button class="photo-expand-btn" title="Perbesar">⤢</button>
                            </div>
                        </div>
                        <div class="photo-card-body">
                            <div class="photo-card-title">
                                <div class="photo-card-title-icon ic-blue">🎯</div>
                                Visi & Misi RS
                            </div>
                            <div class="photo-card-highlight">"Menjadi Rumah Sakit Unggulan yang Terpercaya bagi Masyarakat Demak"</div>
                            <div class="photo-card-divider"></div>
                            <div style="font-size:11px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px;">Misi</div>
                            <ul class="photo-card-points">
                                <li>Memberikan pelayanan kesehatan yang berkualitas, aman, dan terjangkau</li>
                                <li>Meningkatkan SDM yang profesional dan berintegritas tinggi</li>
                                <li>Menyediakan sarana & prasarana kesehatan yang memadai</li>
                                <li>Menyelenggarakan manajemen rumah sakit yang transparan dan akuntabel</li>
                                <li>Mendukung program kesehatan Pemerintah Kabupaten Demak</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card 2: Struktur Organisasi -->
                    <div class="photo-info-card">
                        <div class="photo-img-wrap" onclick="openLightbox('/img/struktur.jpeg', 'Struktur Organisasi RSUD Sultan Fatah')">
                            <img src="/img/struktur.jpeg" alt="Struktur Organisasi RSUD Sultan Fatah">
                            <div class="photo-img-overlay">
                                <span class="photo-img-badge">🏢 Struktur Organisasi</span>
                                <button class="photo-expand-btn" title="Perbesar">⤢</button>
                            </div>
                        </div>
                        <div class="photo-card-body">
                            <div class="photo-card-title">
                                <div class="photo-card-title-icon ic-teal">🏢</div>
                                Struktur Organisasi
                            </div>
                            <div class="photo-card-desc">RSUD Sultan Fatah dipimpin oleh Direktur yang membawahi beberapa bidang dan bagian fungsional.</div>
                            <div class="photo-card-divider"></div>
                            <ul class="photo-card-points">
                                <li><strong>Direktur</strong> → Pimpinan tertinggi RS</li>
                                <li><strong>Bagian Tata Usaha</strong> → Administrasi, kepegawaian & keuangan</li>
                                <li><strong>Bidang Pelayanan</strong> → Pelayanan medis & keperawatan</li>
                                <li><strong>Bidang Penunjang</strong> → Farmasi, laboratorium, radiologi & gizi</li>
                                <li><strong>Komite Medis</strong> → Mutu & etika pelayanan klinis</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Card 3: Nilai Budaya -->
                    <div class="photo-info-card">
                        <div class="photo-img-wrap" onclick="openLightbox('/img/nilai.jpg', 'Nilai Budaya Kerja RSUD Sultan Fatah')">
                            <img src="/img/nilai.jpg" alt="Nilai Budaya Kerja RSUD Sultan Fatah">
                            <div class="photo-img-overlay">
                                <span class="photo-img-badge">⭐ Nilai Budaya</span>
                                <button class="photo-expand-btn" title="Perbesar">⤢</button>
                            </div>
                        </div>
                        <div class="photo-card-body">
                            <div class="photo-card-title">
                                <div class="photo-card-title-icon ic-orange">⭐</div>
                                Nilai Budaya Kerja
                            </div>
                            <div class="photo-card-desc">Budaya kerja RSUD Sultan Fatah Demak tercermin dalam nilai-nilai <strong>PASIK</strong>:</div>
                            <div class="nilai-tags">
                                <span class="nilai-tag p">P – Profesional</span>
                                <span class="nilai-tag a">A – Akuntabel</span>
                                <span class="nilai-tag s">S – Semangat</span>
                                <span class="nilai-tag i">I – Inovatif</span>
                                <span class="nilai-tag k">K – Kerjasama</span>
                            </div>
                            <div class="photo-card-divider"></div>
                            <ul class="photo-card-points">
                                <li><strong>Profesional</strong> – Kompeten & berdedikasi dalam setiap layanan</li>
                                <li><strong>Akuntabel</strong> – Bertanggung jawab atas setiap tindakan</li>
                                <li><strong>Semangat</strong> – Selalu bersemangat melayani masyarakat</li>
                                <li><strong>Inovatif</strong> – Terus berinovasi untuk peningkatan mutu</li>
                                <li><strong>Kerjasama</strong> – Kolaborasi tim yang solid & harmonis</li>
                            </ul>
                        </div>
                    </div>

                </div><!-- /photo-cards-grid -->

            </div><!-- /panel-overview -->


            <!-- ════════════════════════════════════ -->
            <!-- PANEL 2: SEJARAH & INFORMASI           -->
            <!-- ════════════════════════════════════ -->
            <div class="rs-panel" id="panel-sejarah">

                <!-- Timeline Sejarah -->
                <div class="timeline-container">
                    <div class="timeline-header">
                        <div class="timeline-header-icon">📜</div>
                        <div class="timeline-header-text">
                            <h2>Sejarah RSUD Sultan Fatah</h2>
                            <p>Perjalanan pembangunan dan pengembangan rumah sakit dari 2017 hingga saat ini</p>
                        </div>
                    </div>

                    <p style="font-size:13px;color:var(--text-muted);line-height:1.8;margin-bottom:24px;">
                        Dalam beberapa tahun terakhir, industri rumah sakit di Indonesia mengalami perkembangan yang signifikan. Hal ini didukung oleh berbagai kebijakan pemerintah yang bertujuan meningkatkan kualitas layanan kesehatan agar lebih mudah diakses, cepat, merata, dan terjangkau oleh masyarakat. Seiring dengan pertumbuhan penduduk dan meningkatnya kebutuhan layanan kesehatan, permintaan terhadap fasilitas rumah sakit juga semakin tinggi. Kondisi ini mendorong Pemerintah Kabupaten Demak untuk menambah layanan kesehatan, khususnya di wilayah selatan.
                    </p>

                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-year">2017</div>
                            <div class="timeline-item-title">Tahap Awal Pembangunan</div>
                            <div class="timeline-item-desc">Dibangunlah RSUD Sultan Fatah Kabupaten Demak yang berlokasi di Desa Brambang, Kecamatan Karangawen, tepatnya di Jl. Raya Semarang–Purwodadi KM 21 No. 107. Pembangunan dimulai dengan gedung manajemen dan poliklinik.</div>
                            <div class="timeline-badge-row">
                                <span class="timeline-badge">🏢 Gedung Manajemen</span>
                                <span class="timeline-badge">🏥 Poliklinik</span>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-year">2018</div>
                            <div class="timeline-item-title">Pembangunan Fasilitas Utama & Izin Pendirian</div>
                            <div class="timeline-item-desc">Pembangunan diperluas mencakup fasilitas utama pelayanan medis. Izin pendirian resmi diterbitkan pada 19 Februari 2018.</div>
                            <div class="timeline-badge-row">
                                <span class="timeline-badge">🚑 IGD</span>
                                <span class="timeline-badge">🩻 Radiologi</span>
                                <span class="timeline-badge">🛏️ Rawat Inap</span>
                                <span class="timeline-badge">🤰 Layanan Bersalin</span>
                                <span class="timeline-badge">👶 Perawatan Anak</span>
                                <span class="timeline-badge">📋 Izin Pendirian: 19 Feb 2018</span>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-dot"></div>
                            <div class="timeline-year">2019</div>
                            <div class="timeline-item-title">Pembangunan Penunjang & Peresmian</div>
                            <div class="timeline-item-desc">Pembangunan fasilitas penunjang medis dilengkapi. Izin Operasional diterbitkan 13 Desember 2019 (Tipe C). RSUD Sultan Fatah diresmikan pada 15 Desember 2019 oleh Bupati Demak, H.M. Natsir.</div>
                            <div class="timeline-badge-row">
                                <span class="timeline-badge">💊 Farmasi</span>
                                <span class="timeline-badge">🔬 Laboratorium</span>
                                <span class="timeline-badge">🥗 Gizi</span>
                                <span class="timeline-badge">👕 Laundry</span>
                                <span class="timeline-badge">✅ Izin Operasional: 13 Des 2019</span>
                                <span class="timeline-badge">🎉 Peresmian: 15 Des 2019</span>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-dot highlight"></div>
                            <div class="timeline-year">Mei 2020</div>
                            <div class="timeline-item-title">🚀 Mulai Beroperasi Melayani Masyarakat</div>
                            <div class="timeline-item-desc">RSUD Sultan Fatah mulai beroperasi secara penuh pada 15 Mei 2020, dengan layanan awal yang mencakup berbagai spesialisasi dan penunjang diagnostik. Seiring waktu, layanan terus berkembang untuk memenuhi kebutuhan masyarakat, khususnya di wilayah Karangawen, Mranggen, dan Guntur.</div>
                        </div>
                    </div>
                </div>

                <!-- Milestone chips -->
                <div class="section-label" style="margin-top:0;">
                    <span class="section-label-text">Tonggak Penting</span>
                    <div class="section-label-line"></div>
                </div>
                <div class="milestone-row">
                    <div class="milestone-chip">
                        <span class="milestone-chip-icon">📋</span>
                        <div class="milestone-chip-text">
                            <div class="milestone-chip-label">Izin Pendirian</div>
                            <div class="milestone-chip-date">19 Februari 2018</div>
                        </div>
                    </div>
                    <div class="milestone-chip">
                        <span class="milestone-chip-icon">✅</span>
                        <div class="milestone-chip-text">
                            <div class="milestone-chip-label">Izin Operasional (Tipe C)</div>
                            <div class="milestone-chip-date">13 Desember 2019</div>
                        </div>
                    </div>
                    <div class="milestone-chip">
                        <span class="milestone-chip-icon">📋</span>
                        <div class="milestone-chip-text">
                            <div class="milestone-chip-label">Peresmian oleh Bupati</div>
                            <div class="milestone-chip-date">15 Desember 2019</div>
                        </div>
                    </div>
                    <div class="milestone-chip">
                        <span class="milestone-chip-icon">📋</span>
                        <div class="milestone-chip-text">
                            <div class="milestone-chip-label">Mulai Beroperasi</div>
                            <div class="milestone-chip-date">15 Mei 2020</div>
                        </div>
                    </div>
                </div>

                <!-- TPF Grid -->
                <div class="section-label" style="margin-top:24px;">
                    <span class="section-label-text">Tugas, Fungsi & Wewenang</span>
                    <div class="section-label-line"></div>
                </div>
                <div class="tpf-grid">
                    <div class="tpf-card">
                        <div class="tpf-card-icon ic-blue">🏥</div>
                        <div class="tpf-card-title">Tugas Pokok</div>
                        <ul class="tpf-list">
                            <li>Penyembuhan dan pemulihan kesehatan</li>
                            <li>Peningkatan dan pencegahan penyakit</li>
                            <li>Pelayanan rujukan pasien</li>
                            <li>Pendidikan dan pelatihan</li>
                            <li>Penelitian dan pengembangan</li>
                            <li>Pengabdian kepada masyarakat</li>
                        </ul>
                    </div>
                    <div class="tpf-card">
                        <div class="tpf-card-icon ic-teal">⚙️</div>
                        <div class="tpf-card-title">Fungsi</div>
                        <ul class="tpf-list">
                            <li>Perumusan kebijakan teknis pelayanan</li>
                            <li>Pelayanan medis, keperawatan & penunjang</li>
                            <li>Monitoring, evaluasi & pelaporan</li>
                            <li>Pelayanan rujukan</li>
                            <li>Pendidikan, pelatihan & penelitian</li>
                            <li>Pengelolaan keuangan, SDM & administrasi</li>
                        </ul>
                    </div>
                    <div class="tpf-card">
                        <div class="tpf-card-icon ic-purple">⚖️</div>
                        <div class="tpf-card-title">Wewenang</div>
                        <ul class="tpf-list">
                            <li>Menetapkan kebijakan pelayanan</li>
                            <li>Memberikan layanan sesuai indikasi medis</li>
                            <li>Melakukan rujukan pasien</li>
                            <li>Menjalin kerja sama berbagai pihak</li>
                            <li>Menggunakan teknologi peningkatan layanan</li>
                            <li>Mengelola sumber daya rumah sakit</li>
                            <li>Menjamin perlindungan hukum nakes</li>
                            <li>Menyusun pedoman & prosedur pelayanan</li>
                        </ul>
                    </div>
                </div>

            </div><!-- /panel-sejarah -->


            <!-- ════════════════════════════════════ -->
            <!-- PANEL 3: DOKUMEN RESMI                -->
            <!-- ════════════════════════════════════ -->
            <div class="rs-panel" id="panel-dokumen">

                <div class="doc-note">
                    <span class="doc-note-icon">📎</span>
                    <div>
                        Semua dokumen di bawah ini merupakan dokumen resmi RSUD Sultan Fatah Kabupaten Demak yang dapat diakses oleh publik. Klik tombol <strong>Buka / Unduh</strong> untuk membuka dokumen dalam tab baru.
                    </div>
                </div>

                <div class="section-label">
                    <span class="section-label-text">Daftar Dokumen Resmi (10 Dokumen)</span>
                    <div class="section-label-line"></div>
                </div>

                <div class="doc-grid">

                    <a class="doc-card" href="https://rsudsulfat.demakkab.go.id/wp-content/uploads/2020/08/DATA-UMUM-RSUD-SULTAN-FATAH-DEMAK-2021.pdf" target="_blank" rel="noopener" id="doc-1">
                        <div class="doc-icon">📄</div>
                        <div class="doc-info">
                            <div class="doc-name">Data Umum RSUD Sultan Fatah</div>
                            <div class="doc-meta">
                                <span class="doc-meta-tag">PDF</span>
                                Data Umum 2021
                            </div>
                        </div>
                        <div class="doc-action">↗</div>
                    </a>

                    <a class="doc-card" href="https://rsudsulfat.demakkab.go.id/wp-content/uploads/2020/08/IZIN_USAHA_022000417097.pdf" target="_blank" rel="noopener" id="doc-2">
                        <div class="doc-icon">📄</div>
                        <div class="doc-info">
                            <div class="doc-name">Izin Usaha RSUD Sultan Fatah</div>
                            <div class="doc-meta">
                                <span class="doc-meta-tag">PDF</span>
                                No. 022000417097
                            </div>
                        </div>
                        <div class="doc-action">↗</div>
                    </a>

                    <a class="doc-card" href="https://rsudsulfat.demakkab.go.id/wp-content/uploads/2020/08/IZIN_USAHA_0220004170979-1-JUNI.pdf" target="_blank" rel="noopener" id="doc-3">
                        <div class="doc-icon">📄</div>
                        <div class="doc-info">
                            <div class="doc-name">Izin Usaha – Edisi 1 Juni</div>
                            <div class="doc-meta">
                                <span class="doc-meta-tag">PDF</span>
                                No. 0220004170979
                            </div>
                        </div>
                        <div class="doc-action">↗</div>
                    </a>

                    <a class="doc-card" href="https://rsudsulfat.demakkab.go.id/wp-content/uploads/2020/08/Ijin-Nuklir-RSUD-Sultan-Fatah-Kab.-Demak.pdf" target="_blank" rel="noopener" id="doc-4">
                        <div class="doc-icon">⚗️</div>
                        <div class="doc-info">
                            <div class="doc-name">Izin Nuklir</div>
                            <div class="doc-meta">
                                <span class="doc-meta-tag">PDF</span>
                                RSUD Sultan Fatah Kab. Demak
                            </div>
                        </div>
                        <div class="doc-action">↗</div>
                    </a>

                    <a class="doc-card" href="https://rsudsulfat.demakkab.go.id/wp-content/uploads/2020/08/IJIN-OPRASIONAL.pdf" target="_blank" rel="noopener" id="doc-5">
                        <div class="doc-icon">📄</div>
                        <div class="doc-info">
                            <div class="doc-name">Izin Operasional</div>
                            <div class="doc-meta">
                                <span class="doc-meta-tag">PDF</span>
                                Diterbitkan 13 Desember 2019
                            </div>
                        </div>
                        <div class="doc-action">↗</div>
                    </a>

                    <a class="doc-card" href="https://rsudsulfat.demakkab.go.id/wp-content/uploads/2020/08/IZIN-LINGKUNGAN.pdf" target="_blank" rel="noopener" id="doc-6">
                        <div class="doc-icon">📄</div>
                        <div class="doc-info">
                            <div class="doc-name">Izin Lingkungan</div>
                            <div class="doc-meta">
                                <span class="doc-meta-tag">PDF</span>
                                Analisis Dampak Lingkungan
                            </div>
                        </div>
                        <div class="doc-action">↗</div>
                    </a>

                    <a class="doc-card" href="https://rsudsulfat.demakkab.go.id/wp-content/uploads/2020/08/IZIN-PENDIRIAN-RS.SULFAT.pdf" target="_blank" rel="noopener" id="doc-7">
                        <div class="doc-icon">🏛️</div>
                        <div class="doc-info">
                            <div class="doc-name">Izin Pendirian Rumah Sakit</div>
                            <div class="doc-meta">
                                <span class="doc-meta-tag">PDF</span>
                                Diterbitkan 19 Februari 2018
                            </div>
                        </div>
                        <div class="doc-action">↗</div>
                    </a>

                    <a class="doc-card" href="https://rsudsulfat.demakkab.go.id/wp-content/uploads/2020/08/LAMPIRAN-IZIN-USAHA.pdf" target="_blank" rel="noopener" id="doc-8">
                        <div class="doc-icon">📄</div>
                        <div class="doc-info">
                            <div class="doc-name">Lampiran Izin Usaha</div>
                            <div class="doc-meta">
                                <span class="doc-meta-tag">PDF</span>
                                Lampiran pendukung izin
                            </div>
                        </div>
                        <div class="doc-action">↗</div>
                    </a>

                    <a class="doc-card" href="https://rsudsulfat.demakkab.go.id/wp-content/uploads/2020/08/IZIN-USAHA.pdf" target="_blank" rel="noopener" id="doc-9">
                        <div class="doc-icon">📄</div>
                        <div class="doc-info">
                            <div class="doc-name">Izin Usaha</div>
                            <div class="doc-meta">
                                <span class="doc-meta-tag">PDF</span>
                                Dokumen izin usaha umum
                            </div>
                        </div>
                        <div class="doc-action">↗</div>
                    </a>

                    <a class="doc-card" href="https://rsudsulfat.demakkab.go.id/wp-content/uploads/2020/08/IZIN-KOMERSIAL.pdf" target="_blank" rel="noopener" id="doc-10">
                        <div class="doc-icon">📄</div>
                        <div class="doc-info">
                            <div class="doc-name">Izin Komersial</div>
                            <div class="doc-meta">
                                <span class="doc-meta-tag">PDF</span>
                                Operasional komersial RS
                            </div>
                        </div>
                        <div class="doc-action">↗</div>
                    </a>

                </div><!-- /doc-grid -->

            </div><!-- /panel-dokumen -->

        </div><!-- /content -->
    </div><!-- /main -->

    <!-- ══ LIGHTBOX ══ -->
    <div class="lightbox-overlay" id="lightboxOverlay" onclick="closeLightbox()">
        <button class="lightbox-close" onclick="closeLightbox()" id="lightboxClose">✕</button>
        <img class="lightbox-img" id="lightboxImg" src="" alt="">
    </div>

    <script>
        // ── LIVE CLOCK ──
        function updateClock() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            const d = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
            const t = `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')} WIB`;
            document.getElementById('clock').textContent = `${d} · ${t}`;
        }
        updateClock();
        setInterval(updateClock, 1000);

        // ══ TABS ══
        document.querySelectorAll('.rs-tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const tabId = btn.dataset.tab;

                // Update buttons
                document.querySelectorAll('.rs-tab-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                // Update panels
                document.querySelectorAll('.rs-panel').forEach(p => p.classList.remove('active'));
                document.getElementById('panel-' + tabId).classList.add('active');
            });
        });

        // ── SIDEBAR NAV HIGHLIGHT ──
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', e => {
                if (item.getAttribute('href') === '#') {
                    e.preventDefault();
                }
            });
        });

        // ── LIGHTBOX ──
        function openLightbox(src, alt) {
            const overlay = document.getElementById('lightboxOverlay');
            const img = document.getElementById('lightboxImg');
            img.src = src;
            img.alt = alt;
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            document.getElementById('lightboxOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeLightbox();
        });

        // Prevent closing when clicking the image itself
        document.getElementById('lightboxImg').addEventListener('click', e => {
            e.stopPropagation();
        });
    </script>
</body>

</html>
