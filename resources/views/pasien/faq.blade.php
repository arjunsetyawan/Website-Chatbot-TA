<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ – RSUD Sultan Fatah</title>
    <meta name="description" content="Pertanyaan yang sering diajukan seputar layanan chatbot, jadwal dokter, dan booking konsultasi RSUD Sultan Fatah.">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/faq.css">
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
            <a class="nav-item" href="{{ route('pasien.informasi-rs') }}">
                <span class="nav-icon">ℹ️</span> Informasi Rumah Sakit
            </a>
            <a class="nav-item active" href="{{ route('pasien.faq') }}">
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
        <header class="topbar">
            <div class="topbar-left">
                <span class="page-title">FAQ</span>
                <span class="breadcrumb" style="color:var(--border);margin:0 6px;">›</span>
                <span class="breadcrumb">Pertanyaan yang Sering Diajukan</span>
            </div>
            <div class="topbar-right">
                <div class="time-chip" id="clock"></div>
            </div>
        </header>

        <div class="content">

            <!-- Hero -->
            <div class="faq-hero fade-up">
                <div class="faq-hero-left">
                    <div class="faq-hero-badge">💬 Pusat Bantuan</div>
                    <h1>Pertanyaan yang Sering<br>Diajukan (FAQ)</h1>
                    <p>Temukan jawaban atas pertanyaan umum seputar chatbot, jadwal dokter, booking konsultasi, dan layanan RSUD Sultan Fatah Demak.</p>
                </div>
                <div class="faq-hero-stats">
                    <div class="fstat">
                        <div class="fstat-val">20</div>
                        <div class="fstat-label">Total Pertanyaan</div>
                    </div>
                    <div class="fstat">
                        <div class="fstat-val">4</div>
                        <div class="fstat-label">Kategori</div>
                    </div>
                </div>
            </div>

            <!-- Search -->
            <div class="faq-search-wrap fade-up fd1">
                <span class="faq-search-icon">🔍</span>
                <input type="text" class="faq-search" id="faqSearch" placeholder="Cari pertanyaan... (contoh: booking, jadwal, gejala)">
            </div>

            <!-- Category Chips -->
            <div class="faq-cats fade-up fd1" id="catFilter">
                <button class="faq-cat-btn active" data-cat="all">📋 Semua</button>
                <button class="faq-cat-btn" data-cat="chatbot">🤖 Chatbot</button>
                <button class="faq-cat-btn" data-cat="gejala">🫁 Gejala & Kesehatan</button>
                <button class="faq-cat-btn" data-cat="booking">📅 Jadwal & Booking</button>
                <button class="faq-cat-btn" data-cat="sistem">⚙️ Sistem & Akun</button>
            </div>

            <!-- ????????????????????????????????? CHATBOT CATEGORY ????????????????????????????????? -->
            <div class="faq-section-header" data-section="chatbot">
                <div class="faq-section-icon ic-blue">🤖</div>
                <span class="faq-section-label">Chatbot Kesehatan Paru</span>
                <div class="faq-section-line"></div>
            </div>
            <div class="faq-list" id="faqList">

                <div class="faq-item fade-up" data-cat="chatbot" data-keywords="chatbot kesehatan paru fitur website">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">1</div>
                        <div class="faq-q-text">Apa itu chatbot kesehatan paru?</div>
                        <span class="faq-q-cat chatbot">Chatbot</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Chatbot kesehatan paru adalah fitur pada website RSUD Sultan Fatah yang membantu memberikan informasi awal mengenai gejala penyakit paru-paru, tips kesehatan, dan arahan untuk berkonsultasi dengan dokter paru.
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="chatbot" data-keywords="chatbot diagnosis penyakit mendiagnosis">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">2</div>
                        <div class="faq-q-text">Apakah chatbot dapat mendiagnosis penyakit saya?</div>
                        <span class="faq-q-cat chatbot">Chatbot</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            <strong>Tidak.</strong> Chatbot hanya memberikan edukasi awal dan informasi umum. Diagnosis dan penanganan medis tetap harus dilakukan oleh dokter.
                            <div class="faq-highlight">💡 Gunakan chatbot sebagai panduan awal, bukan pengganti konsultasi medis.</div>
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="chatbot" data-keywords="chatbot penyakit asma tb pneumonia bronkitis ppok batuk sesak">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">3</div>
                        <div class="faq-q-text">Apa saja penyakit paru-paru yang dapat ditanyakan di chatbot?</div>
                        <span class="faq-q-cat chatbot">Chatbot</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Chatbot dapat memberikan informasi awal mengenai:
                            <ul>
                                <li>Asma</li>
                                <li>Tuberkulosis (TB)</li>
                                <li>Pneumonia</li>
                                <li>Bronkitis</li>
                                <li>PPOK (Penyakit Paru Obstruktif Kronik)</li>
                                <li>Batuk kronis</li>
                                <li>Sesak napas</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="chatbot" data-keywords="chatbot 24 jam kapan waktu akses">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">4</div>
                        <div class="faq-q-text">Apakah chatbot bisa digunakan 24 jam?</div>
                        <span class="faq-q-cat chatbot">Chatbot</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Ya. Chatbot dapat digunakan <strong>kapan saja</strong> selama website dapat diakses, tanpa batasan jam operasional.
                        </div>
                    </div>
                </div>

            </div><!-- /chatbot -->

            <!-- ????????????????????????????????? GEJALA CATEGORY ????????????????????????????????? -->
            <div class="faq-section-header" data-section="gejala">
                <div class="faq-section-icon ic-orange">🫁</div>
                <span class="faq-section-label">Gejala & Kesehatan</span>
                <div class="faq-section-line"></div>
            </div>
            <div class="faq-list">

                <div class="faq-item fade-up" data-cat="gejala" data-keywords="gejala batuk sesak nyeri dada demam dahak berdarah paru">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">5</div>
                        <div class="faq-q-text">Gejala apa saja yang perlu diperhatikan pada penyakit paru-paru?</div>
                        <span class="faq-q-cat gejala">Gejala</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Beberapa gejala yang umum perlu diwaspadai:
                            <ul>
                                <li>Batuk lebih dari 2 minggu</li>
                                <li>Sesak napas</li>
                                <li>Nyeri dada</li>
                                <li>Napas berbunyi (mengi)</li>
                                <li>Demam yang berlangsung lama</li>
                                <li>Batuk berdahak atau berdarah</li>
                            </ul>
                            <div class="faq-highlight">💡 Jika Anda mengalami gejala tersebut, sebaiknya segera berkonsultasi dengan dokter.</div>
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="gejala" data-keywords="rumah sakit igd darurat segera gawat sesak biru tidak sadar">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">6</div>
                        <div class="faq-q-text">Kapan saya harus segera ke rumah sakit?</div>
                        <span class="faq-q-cat gejala">Gejala</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Segera ke IGD atau rumah sakit apabila Anda mengalami:
                            <ul>
                                <li>Sesak napas berat yang tiba-tiba</li>
                                <li>Nyeri dada hebat</li>
                                <li>Bibir atau wajah membiru</li>
                                <li>Batuk darah dalam jumlah banyak</li>
                                <li>Demam tinggi yang tidak turun</li>
                                <li>Penurunan kesadaran</li>
                            </ul>
                            <div class="faq-urgent">⚠️ Kondisi ini termasuk darurat medis ??? jangan ditunda!</div>
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="gejala" data-keywords="dokumen ktp bpjs asuransi obat bawa konsultasi">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">7</div>
                        <div class="faq-q-text">Dokumen apa yang perlu dibawa saat konsultasi?</div>
                        <span class="faq-q-cat gejala">Kesehatan</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Sebaiknya membawa:
                            <ul>
                                <li>KTP (wajib)</li>
                                <li>Kartu BPJS atau asuransi (jika ada)</li>
                                <li>Hasil pemeriksaan sebelumnya (rontgen, lab, dll.)</li>
                                <li>Obat yang sedang dikonsumsi</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div><!-- /gejala -->

            <!-- ????????????????????????????????? BOOKING CATEGORY ????????????????????????????????? -->
            <div class="faq-section-header" data-section="booking">
                <div class="faq-section-icon ic-teal">📅</div>
                <span class="faq-section-label">Jadwal Dokter & Booking</span>
                <div class="faq-section-line"></div>
            </div>
            <div class="faq-list">

                <div class="faq-item fade-up" data-cat="booking" data-keywords="jadwal dokter paru lihat menu sidebar">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">8</div>
                        <div class="faq-q-text">Bagaimana cara melihat jadwal dokter paru?</div>
                        <span class="faq-q-cat booking">Jadwal</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Pilih menu <strong>"Jadwal Dokter"</strong> pada sidebar. Sistem akan menampilkan jadwal praktik dokter paru yang tersedia berdasarkan tanggal yang dipilih.
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="booking" data-keywords="jadwal terbaru real time simrs api update">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">9</div>
                        <div class="faq-q-text">Apakah jadwal dokter selalu terbaru?</div>
                        <span class="faq-q-cat booking">Jadwal</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Ya. Jadwal dokter diambil langsung dari sistem <strong>SIMRS RSUD Sultan Fatah</strong> melalui API sehingga data yang ditampilkan selalu mengikuti jadwal terbaru secara real-time.
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="booking" data-keywords="cara booking konsultasi langkah pilih dokter jam">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">10</div>
                        <div class="faq-q-text">Bagaimana cara melakukan booking konsultasi?</div>
                        <span class="faq-q-cat booking">Booking</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Ikuti langkah-langkah berikut:
                            <div style="margin-top:10px;display:flex;flex-direction:column;gap:8px;">
                                <div class="faq-step"><div class="faq-step-num">1</div><span>Buka menu <strong>"Booking Konsultasi"</strong> pada sidebar</span></div>
                                <div class="faq-step"><div class="faq-step-num">2</div><span>Pilih tanggal yang diinginkan</span></div>
                                <div class="faq-step"><div class="faq-step-num">3</div><span>Pilih dokter dan jam yang tersedia</span></div>
                                <div class="faq-step"><div class="faq-step-num">4</div><span>Isi keluhan singkat (opsional)</span></div>
                                <div class="faq-step"><div class="faq-step-num">5</div><span>Tekan tombol <strong>"Buat Booking"</strong></span></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="booking" data-keywords="keluhan tulis isi kolom gejala alasan">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">11</div>
                        <div class="faq-q-text">Apa yang harus saya tulis pada kolom keluhan?</div>
                        <span class="faq-q-cat booking">Booking</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Tuliskan <strong>gejala utama</strong> yang Anda rasakan, misalnya:
                            <div class="faq-highlight">"Saya batuk selama 2 minggu disertai sesak napas dan demam."</div>
                            Informasi ini membantu dokter mempersiapkan konsultasi lebih baik.
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="booking" data-keywords="batal batalkan booking riwayat">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">12</div>
                        <div class="faq-q-text">Apakah saya bisa membatalkan booking?</div>
                        <span class="faq-q-cat booking">Booking</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Ya. Booking yang sudah dibuat dapat dibatalkan melalui menu <strong>"Booking Konsultasi"</strong> pada bagian riwayat booking, selama jadwal konsultasi belum dimulai.
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="booking" data-keywords="datang lebih awal jam berapa registrasi antrean">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">13</div>
                        <div class="faq-q-text">Apakah saya harus datang lebih awal?</div>
                        <span class="faq-q-cat booking">Booking</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Ya. Disarankan datang <strong>15–30 menit sebelum jadwal</strong> konsultasi untuk proses registrasi dan pengambilan nomor antrean di loket pendaftaran.
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="booking" data-keywords="tidak bisa pilih jam slot penuh lewat dokter tidak praktik">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">14</div>
                        <div class="faq-q-text">Mengapa saya tidak bisa memilih jam konsultasi?</div>
                        <span class="faq-q-cat booking">Booking</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Kemungkinan penyebabnya:
                            <ul>
                                <li>Slot sudah penuh oleh pasien lain</li>
                                <li>Jam sudah lewat dari waktu sekarang</li>
                                <li>Dokter tidak praktik pada jam tersebut</li>
                            </ul>
                            Silakan pilih <strong>tanggal atau dokter lain</strong> yang masih tersedia.
                        </div>
                    </div>
                </div>

            </div><!-- /booking -->

            <!-- ????????????????????????????????? SISTEM & AKUN CATEGORY ????????????????????????????????? -->
            <div class="faq-section-header" data-section="sistem">
                <div class="faq-section-icon ic-purple">⚙️</div>
                <span class="faq-section-label">Sistem & Akun</span>
                <div class="faq-section-line"></div>
            </div>
            <div class="faq-list">

                <div class="faq-item fade-up" data-cat="sistem" data-keywords="data aman privasi perlindungan pribadi">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">15</div>
                        <div class="faq-q-text">Apakah data saya aman?</div>
                        <span class="faq-q-cat sistem">Sistem</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Ya. Data pengguna disimpan dengan aman dan mengikuti prinsip perlindungan data pribadi. Sistem hanya menyimpan data yang diperlukan dan <strong>tidak membagikan informasi pribadi</strong> tanpa izin.
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="sistem" data-keywords="gratis biaya bayar layanan chatbot jadwal">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">16</div>
                        <div class="faq-q-text">Apakah layanan ini gratis?</div>
                        <span class="faq-q-cat sistem">Sistem</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Layanan chatbot dan informasi jadwal dokter dapat digunakan secara <strong>gratis</strong>. Biaya konsultasi mengikuti ketentuan rumah sakit dan jenis layanan yang dipilih.
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="sistem" data-keywords="error website masalah gagal muat ulang">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">17</div>
                        <div class="faq-q-text">Apa yang harus saya lakukan jika website mengalami error?</div>
                        <span class="faq-q-cat sistem">Sistem</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Coba langkah berikut:
                            <ul>
                                <li>Muat ulang halaman (tekan <strong>F5</strong> atau refresh)</li>
                                <li>Logout lalu login kembali</li>
                                <li>Hapus cache browser</li>
                            </ul>
                            Jika masalah masih terjadi, hubungi admin atau petugas RSUD Sultan Fatah.
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="sistem" data-keywords="lupa password reset akun email nomor telepon">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">18</div>
                        <div class="faq-q-text">Saya lupa password akun, apa yang harus dilakukan?</div>
                        <span class="faq-q-cat sistem">Akun</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Pilih menu <strong>"Lupa Password"</strong> pada halaman login, lalu ikuti petunjuk untuk mereset password melalui email atau nomor telepon yang terdaftar.
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="sistem" data-keywords="riwayat konsultasi booking sebelumnya history lihat">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">19</div>
                        <div class="faq-q-text">Apakah saya bisa melihat riwayat konsultasi sebelumnya?</div>
                        <span class="faq-q-cat sistem">Akun</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Ya. Riwayat booking dan konsultasi dapat dilihat pada menu <strong>"Booking Konsultasi"</strong> di bagian <em>Riwayat Booking</em> atau melalui dashboard pengguna.
                        </div>
                    </div>
                </div>

                <div class="faq-item fade-up" data-cat="sistem" data-keywords="hp smartphone mobile responsif laptop akses">
                    <div class="faq-q" onclick="toggleFaq(this)">
                        <div class="faq-q-num">20</div>
                        <div class="faq-q-text">Apakah saya bisa menggunakan website ini melalui HP?</div>
                        <span class="faq-q-cat sistem">Sistem</span>
                        <span class="faq-arrow">›</span>
                    </div>
                    <div class="faq-a">
                        <div class="faq-a-inner">
                            Ya. Website dirancang <strong>responsif</strong> sehingga dapat digunakan melalui laptop maupun smartphone dengan nyaman.
                        </div>
                    </div>
                </div>

            </div><!-- /sistem -->

            <!-- Empty search state -->
            <div class="faq-empty" id="faqEmpty" style="display:none;">
                <div class="faq-empty-icon">🔍</div>
                <div class="faq-empty-text">Tidak ada pertanyaan yang cocok dengan pencarian Anda.<br>Coba kata kunci yang berbeda.</div>
            </div>

            <!-- Contact Card -->
            <div class="faq-contact-card fade-up fd2">
                <div class="fcc-left">
                    <div class="fcc-icon">💬</div>
                    <div>
                        <div class="fcc-title">Tidak menemukan jawaban yang Anda cari?</div>
                        <div class="fcc-desc">Hubungi petugas RSUD Sultan Fatah atau gunakan chatbot untuk pertanyaan lebih spesifik.<br>Kami siap membantu Anda.</div>
                    </div>
                </div>
                <a href="{{ route('pasien.konsultasi-chatbot') }}" class="fcc-btn">💬 Tanya Chatbot</a>
            </div>

        </div><!-- /content -->
    </div><!-- /main -->

    <script>
        // Live clock
        function updateClock() {
            const now = new Date();
            const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
            document.getElementById('clock').textContent =
                `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()} · ${String(now.getHours()).padStart(2,'0')}:${String(now.getMinutes()).padStart(2,'0')} WIB`;
        }
        updateClock(); setInterval(updateClock, 1000);

        // Accordion toggle
        function toggleFaq(qEl) {
            const item = qEl.closest('.faq-item');
            const answer = item.querySelector('.faq-a');
            const isOpen = item.classList.contains('open');

            // Close all
            document.querySelectorAll('.faq-item.open').forEach(el => {
                el.classList.remove('open');
                el.querySelector('.faq-a').style.maxHeight = null;
            });

            // Open clicked if it was closed
            if (!isOpen) {
                item.classList.add('open');
                answer.style.maxHeight = answer.scrollHeight + 'px';
            }
        }

        // Category filter
        document.querySelectorAll('.faq-cat-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.faq-cat-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const cat = btn.dataset.cat;
                filterFaq(cat, document.getElementById('faqSearch').value);
            });
        });

        // Search
        document.getElementById('faqSearch').addEventListener('input', function () {
            const activeCat = document.querySelector('.faq-cat-btn.active')?.dataset.cat || 'all';
            filterFaq(activeCat, this.value);
        });

        function filterFaq(cat, query) {
            const q = query.trim().toLowerCase();
            let anyVisible = false;

            document.querySelectorAll('.faq-item').forEach(item => {
                const itemCat = item.dataset.cat;
                const keywords = (item.dataset.keywords || '') + ' ' + item.querySelector('.faq-q-text').textContent;
                const catMatch = cat === 'all' || itemCat === cat;
                const queryMatch = !q || keywords.toLowerCase().includes(q);
                const visible = catMatch && queryMatch;
                item.style.display = visible ? '' : 'none';
                if (visible) anyVisible = true;
            });

            // Show/hide section headers
            document.querySelectorAll('.faq-section-header').forEach(header => {
                const sect = header.dataset.section;
                if (!sect) return;
                const catMatch = cat === 'all' || sect === cat;
                header.style.display = catMatch ? '' : 'none';
            });

            document.getElementById('faqEmpty').style.display = anyVisible ? 'none' : '';
        }
    </script>
</body>
</html>
