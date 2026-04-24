<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya – RSUD Sultan Fatah</title>
    <meta name="description" content="Kelola data profil pasien RSUD Sultan Fatah Demak.">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/profil.css">
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
            <a class="nav-item" href="{{ route('pasien.faq') }}">
                <span class="nav-icon">❓</span> FAQ
            </a>

            <div class="nav-section-label" style="margin-top:12px;">Akun</div>
            <a class="nav-item active" href="{{ route('pasien.profil') }}">
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
                <span class="page-title">Profil</span>
                <span class="breadcrumb" style="color:var(--border);margin:0 6px;">›</span>
                <span class="breadcrumb">Data Diri Pasien</span>
            </div>
            <div class="topbar-right">
                <div class="time-chip" id="clock"></div>
            </div>
        </header>

        <div class="content">

            @php $hasPasien = !is_null($pasien); @endphp

            <!-- Hero -->
            <div class="profil-hero fade-up">
                <div class="profil-avatar-big">
                    {{ strtoupper(substr($user->name ?? 'P', 0, 1)) }}{{ strtoupper(substr(explode(' ', $user->name ?? 'Pasien')[1] ?? '', 0, 1)) }}
                </div>
                <div class="profil-hero-info">
                    <div class="profil-hero-badge">👤 Data Diri</div>
                    <h1>{{ $user->name }}</h1>
                    <p>{{ $user->email }} &nbsp;·&nbsp; Bergabung {{ $user->created_at->translatedFormat('F Y') }}</p>
                </div>
                <div class="profil-hero-status">
                    <div class="phs-label">Status Profil</div>
                    @if($hasPasien)
                        <div class="phs-badge lengkap">✅ Data Lengkap</div>
                    @else
                        <div class="phs-badge belum">⚠️ Belum Diisi</div>
                    @endif
                </div>
            </div>

            <!-- Flash messages -->
            @if(session('success'))
                <div class="alert alert-success fade-up">✅ {{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-error fade-up">❌ Terdapat kesalahan pada data yang diisi. Periksa kembali form di bawah.</div>
            @endif

            <!-- Notice jika belum ada data -->
            @if(!$hasPasien)
            <div class="profil-notice fade-up fd1">
                <span>ℹ️</span>
                <div>
                    <strong>Data profil Anda belum diisi.</strong> Lengkapi data di bawah ini agar proses booking konsultasi berjalan lebih lancar dan data medis Anda dapat tercatat dengan benar.
                </div>
            </div>
            @endif

            <!-- Main Grid -->
            <div class="profil-grid">

                <!-- LEFT: Summary Panel -->
                <div class="profil-card fade-up fd1" style="position:sticky;top:20px;">
                    <div class="profil-card-head">
                        <div class="profil-card-icon ic-blue">📋</div>
                        <div>
                            <div class="profil-card-title">Ringkasan Profil</div>
                            <div class="profil-card-sub">Data tersimpan saat ini</div>
                        </div>
                    </div>
                    <div class="profil-card-body">
                        <div class="profil-summary-avatar" id="summaryAvatar">
                            {{ strtoupper(substr($user->name ?? 'P', 0, 1)) }}{{ strtoupper(substr(explode(' ', $user->name ?? 'Pasien')[1] ?? '', 0, 1)) }}
                        </div>
                        <div class="profil-summary-name" id="summaryName">{{ $user->name }}</div>
                        <div class="profil-summary-email" id="summaryEmail">{{ $user->email }}</div>

                        <div class="profil-summary-rows">
                            <div class="profil-sumrow">
                                <span class="profil-sumrow-icon">🪪</span>
                                <div class="profil-sumrow-info">
                                    <div class="profil-sumrow-label">NIK</div>
                                    <div class="profil-sumrow-val {{ !$hasPasien ? 'empty' : '' }}" id="summaryNik">{{ $pasien->nik ?? '— Belum diisi' }}</div>
                                </div>
                            </div>
                            <div class="profil-sumrow">
                                <span class="profil-sumrow-icon">🚻</span>
                                <div class="profil-sumrow-info">
                                    <div class="profil-sumrow-label">Jenis Kelamin</div>
                                    <div class="profil-sumrow-val {{ !$hasPasien ? 'empty' : '' }}" id="summaryJk">{{ $pasien->jenis_kelamin ?? '— Belum diisi' }}</div>
                                </div>
                            </div>
                            <div class="profil-sumrow">
                                <span class="profil-sumrow-icon">📍</span>
                                <div class="profil-sumrow-info">
                                    <div class="profil-sumrow-label">Alamat</div>
                                    <div class="profil-sumrow-val {{ !$hasPasien ? 'empty' : '' }}" style="white-space:normal;font-size:12px;">{{ $pasien->alamat ?? '— Belum diisi' }}</div>
                                </div>
                            </div>
                            <div class="profil-sumrow">
                                <span class="profil-sumrow-icon">🏥</span>
                                <div class="profil-sumrow-info">
                                    <div class="profil-sumrow-label">No. Rekam Medis</div>
                                    <div class="profil-sumrow-val {{ ($hasPasien && $pasien->no_rekam_medis) ? '' : 'empty' }}">
                                        {{ ($hasPasien && $pasien->no_rekam_medis) ? $pasien->no_rekam_medis : '— Dikelola oleh admin' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Edit Form -->
                <div class="profil-card fade-up fd2">
                    <div class="profil-card-head">
                        <div class="profil-card-icon ic-teal">✏️</div>
                        <div>
                            <div class="profil-card-title">{{ $hasPasien ? 'Edit Profil' : 'Lengkapi Profil' }}</div>
                            <div class="profil-card-sub">{{ $hasPasien ? 'Perbarui data diri Anda' : 'Isi data diri untuk pertama kali' }}</div>
                        </div>
                    </div>
                    <div class="profil-card-body">
                        <form action="{{ route('pasien.profil.update') }}" method="POST" id="profilForm">
                            @csrf

                            <!-- Akun Section -->
                            <div class="form-section-label">
                                🔐 <span>Data Akun</span>
                                <div class="form-section-line"></div>
                            </div>

                            <div class="form-row-2">
                                <div class="form-row" style="margin-bottom:0;">
                                    <label class="form-label" for="name">Nama Lengkap <span class="required">*</span></label>
                                    <input type="text" class="form-input {{ $errors->has('name') ? 'is-error' : '' }}"
                                           id="name" name="name"
                                           value="{{ old('name', $user->name) }}"
                                           placeholder="Nama lengkap sesuai KTP">
                                    @error('name') <div class="form-error-msg">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-row" style="margin-bottom:0;">
                                    <label class="form-label" for="email">Email <span class="required">*</span></label>
                                    <input type="email" class="form-input {{ $errors->has('email') ? 'is-error' : '' }}"
                                           id="email" name="email"
                                           value="{{ old('email', $user->email) }}"
                                           placeholder="email@contoh.com">
                                    @error('email') <div class="form-error-msg">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Data Pasien Section -->
                            <div class="form-section-label">
                                🏥 <span>Data Pasien</span>
                                <div class="form-section-line"></div>
                            </div>

                            <div class="form-row">
                                <label class="form-label" for="nik">NIK (Nomor Induk Kependudukan) <span class="required">*</span></label>
                                <input type="text" class="form-input {{ $errors->has('nik') ? 'is-error' : '' }}"
                                       id="nik" name="nik" maxlength="16"
                                       value="{{ old('nik', $pasien->nik ?? '') }}"
                                       placeholder="16 digit sesuai KTP">
                                @error('nik') <div class="form-error-msg">{{ $message }}</div> @enderror
                                <div class="form-helper">Harus tepat 16 digit angka sesuai KTP.</div>
                            </div>

                            <div class="form-row">
                                <label class="form-label">Jenis Kelamin <span class="required">*</span></label>
                                <div class="gender-group">
                                    <label class="gender-opt {{ old('jenis_kelamin', $pasien->jenis_kelamin ?? '') === 'LAKI-LAKI' ? 'selected' : '' }}" id="opt-laki">
                                        <input type="radio" name="jenis_kelamin" value="LAKI-LAKI"
                                               {{ old('jenis_kelamin', $pasien->jenis_kelamin ?? '') === 'LAKI-LAKI' ? 'checked' : '' }}
                                               onchange="selectGender(this)">
                                        👨 Laki-laki
                                    </label>
                                    <label class="gender-opt {{ old('jenis_kelamin', $pasien->jenis_kelamin ?? '') === 'PEREMPUAN' ? 'selected' : '' }}" id="opt-perempuan">
                                        <input type="radio" name="jenis_kelamin" value="PEREMPUAN"
                                               {{ old('jenis_kelamin', $pasien->jenis_kelamin ?? '') === 'PEREMPUAN' ? 'checked' : '' }}
                                               onchange="selectGender(this)">
                                        👩 Perempuan
                                    </label>
                                </div>
                                @error('jenis_kelamin') <div class="form-error-msg">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-row">
                                <label class="form-label" for="alamat">Alamat Lengkap <span class="required">*</span></label>
                                <textarea class="form-textarea {{ $errors->has('alamat') ? 'is-error' : '' }}"
                                          id="alamat" name="alamat" rows="3"
                                          placeholder="Jl. Nama Jalan No. XX, Kelurahan, Kecamatan, Kota/Kabupaten">{{ old('alamat', $pasien->alamat ?? '') }}</textarea>
                                @error('alamat') <div class="form-error-msg">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-row">
                                <label class="form-label" for="keluhan_utama">Keluhan Utama <span class="opt">(opsional)</span></label>
                                <textarea class="form-textarea"
                                          id="keluhan_utama" name="keluhan_utama" rows="2"
                                          placeholder="Tuliskan keluhan utama yang sering Anda rasakan...">{{ old('keluhan_utama', $pasien->keluhan_utama ?? '') }}</textarea>
                            </div>

                            <div class="form-actions">
                                <div class="form-actions-info">
                                    <span style="color:var(--danger);">*</span> Wajib diisi &nbsp;·&nbsp;
                                    Data disimpan dengan aman dan terenkripsi
                                </div>
                                <button type="submit" class="btn-save" id="saveBtn">
                                    💾 Simpan Profil
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div><!-- /profil-grid -->

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

        // Gender radio styling
        function selectGender(radio) {
            document.querySelectorAll('.gender-opt').forEach(el => el.classList.remove('selected'));
            radio.closest('.gender-opt').classList.add('selected');
        }

        // NIK only numbers
        document.getElementById('nik').addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 16);
        });
    </script>
</body>
</html>
