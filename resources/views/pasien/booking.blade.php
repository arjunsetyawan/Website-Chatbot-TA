<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Konsultasi Poli Paru – RSUD Sultan Fatah</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .booking-hero {
            background: linear-gradient(135deg, #0a2540 0%, #1a4a80 60%, #2d7dd2 100%);
            border-radius: 20px; padding: 34px 38px; margin-bottom: 24px;
            position: relative; overflow: hidden;
        }
        .booking-hero::before { content:''; position:absolute; top:-50px; right:-50px; width:220px; height:220px; border-radius:50%; background:rgba(255,255,255,.06); }
        .booking-hero::after { content:''; position:absolute; bottom:-70px; right:140px; width:160px; height:160px; border-radius:50%; background:rgba(255,255,255,.04); }
        .booking-hero h1 { font-family:'DM Serif Display',serif; font-size:25px; color:#fff; margin-bottom:6px; }
        .booking-hero p { font-size:13px; color:rgba(255,255,255,.6); max-width:480px; line-height:1.6; }
        .booking-hero .hero-inner { position:relative; z-index:1; display:flex; align-items:center; justify-content:space-between; }
        .hero-date-chip { background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.2); border-radius:12px; padding:12px 20px; text-align:center; backdrop-filter:blur(6px); }
        .hero-date-chip .hd-day { font-size:28px; font-weight:700; color:#fff; line-height:1; }
        .hero-date-chip .hd-info { font-size:10px; color:rgba(255,255,255,.55); margin-top:3px; }

        .alert-msg { padding:14px 20px; border-radius:12px; font-size:13px; font-weight:600; margin-bottom:20px; display:flex; align-items:center; gap:8px; animation:fadeUp .3s ease both; }
        .alert-success { background:rgba(34,197,94,.08); border:1.5px solid rgba(34,197,94,.2); color:#16a34a; }
        .alert-error { background:rgba(239,68,68,.08); border:1.5px solid rgba(239,68,68,.2); color:#dc2626; }

        .booking-grid { display:grid; grid-template-columns:1.1fr .9fr; gap:24px; margin-bottom:24px; }
        .section-card { background:var(--card); border:1.5px solid var(--border); border-radius:16px; overflow:hidden; }
        .section-head { padding:18px 24px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
        .section-title-text { font-size:14px; font-weight:700; color:var(--text); display:flex; align-items:center; gap:8px; }
        .section-body { padding:22px 24px; }

        /* Doctor Accordion */
        .dokter-block { border:1.5px solid var(--border); border-radius:14px; margin-bottom:12px; overflow:hidden; transition:border-color .2s; }
        .dokter-block.active { border-color:var(--accent); }
        .dokter-header { display:flex; align-items:center; gap:12px; padding:16px 18px; cursor:pointer; transition:background .2s; }
        .dokter-header:hover { background:rgba(45,125,210,.03); }
        .dh-avatar { width:42px; height:42px; border-radius:12px; background:linear-gradient(135deg,var(--accent),var(--accent2)); display:flex; align-items:center; justify-content:center; font-size:19px; flex-shrink:0; box-shadow:0 3px 10px rgba(45,125,210,.2); }
        .dh-info { flex:1; }
        .dh-name { font-size:13.5px; font-weight:700; color:var(--text); }
        .dh-poli { font-size:11px; color:var(--accent); font-weight:600; margin-top:1px; }
        .dh-meta { font-size:10.5px; color:var(--text-muted); margin-top:3px; }
        .dh-badge { font-size:10.5px; font-weight:600; padding:4px 10px; border-radius:20px; flex-shrink:0; }
        .dh-badge.available { background:rgba(34,197,94,.1); color:#16a34a; }
        .dh-badge.full { background:rgba(239,68,68,.08); color:#dc2626; }

        /* Slots Grid */
        .slots-panel { padding:0 18px 18px; display:none; }
        .slots-panel.show { display:block; }
        .slots-label { font-size:11.5px; font-weight:600; color:var(--text-muted); margin-bottom:10px; display:flex; align-items:center; gap:6px; }
        .slots-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(90px, 1fr)); gap:8px; margin-bottom:16px; }
        .slot-btn {
            padding:10px 6px; border:1.5px solid var(--border); border-radius:10px;
            background:var(--white); cursor:pointer; text-align:center;
            transition:all .2s; font-family:'Plus Jakarta Sans',sans-serif;
        }
        .slot-btn:hover:not(.disabled):not(.selected) { border-color:var(--accent); background:rgba(45,125,210,.04); }
        .slot-btn.selected { border-color:var(--accent); background:rgba(45,125,210,.08); box-shadow:0 0 0 3px rgba(45,125,210,.12); }
        .slot-btn.disabled { opacity:.35; cursor:not-allowed; background:var(--bg); }
        .slot-btn .sb-time { font-size:13px; font-weight:700; color:var(--text); }
        .slot-btn .sb-range { font-size:9.5px; color:var(--text-muted); margin-top:2px; }
        .slot-btn .sb-status { font-size:9px; font-weight:600; margin-top:3px; }
        .slot-btn .sb-status.avail { color:var(--success); }
        .slot-btn .sb-status.taken { color:var(--danger); }
        .slot-btn .sb-status.past-s { color:var(--text-muted); }
        .slot-btn input[type="radio"] { display:none; }

        .form-row { margin-bottom:16px; }
        .form-label { font-size:12px; font-weight:600; color:var(--text); margin-bottom:6px; display:block; }
        .form-label span { color:var(--text-muted); font-weight:400; }
        .form-textarea { width:100%; border:1.5px solid var(--border); border-radius:10px; padding:11px 14px; font-size:13px; font-family:'Plus Jakarta Sans',sans-serif; color:var(--text); outline:none; transition:border-color .2s; background:var(--white); min-height:80px; resize:vertical; }
        .form-textarea:focus { border-color:var(--accent); }
        .form-help { font-size:11px; color:var(--text-muted); margin-top:4px; }
        .form-error { font-size:11px; color:var(--danger); margin-top:4px; font-weight:600; }

        .submit-btn {
            background:linear-gradient(135deg,var(--accent),#1a6fc0); color:#fff; border:none;
            padding:13px 28px; border-radius:12px; font-size:13.5px; font-weight:700;
            font-family:'Plus Jakarta Sans',sans-serif; cursor:pointer; transition:all .2s;
            display:inline-flex; align-items:center; gap:8px;
            box-shadow:0 4px 14px rgba(45,125,210,.3);
        }
        .submit-btn:hover { transform:translateY(-1px); box-shadow:0 8px 20px rgba(45,125,210,.4); }
        .submit-btn:disabled { opacity:.5; cursor:not-allowed; transform:none; box-shadow:none; }

        .no-schedule { text-align:center; padding:40px 24px; }
        .no-schedule .ns-icon { font-size:48px; margin-bottom:10px; }
        .no-schedule .ns-title { font-size:15px; font-weight:700; color:var(--text); margin-bottom:6px; }
        .no-schedule .ns-desc { font-size:12.5px; color:var(--text-muted); line-height:1.6; max-width:360px; margin:0 auto 16px; }
        .ns-link { display:inline-flex; align-items:center; gap:6px; background:rgba(45,125,210,.08); color:var(--accent); font-size:12.5px; font-weight:600; padding:10px 18px; border-radius:10px; text-decoration:none; transition:background .2s; }
        .ns-link:hover { background:rgba(45,125,210,.15); }

        /* Date Picker Bar */
        .date-picker-bar {
            display:flex; align-items:center; gap:14px; margin-bottom:20px;
            background:var(--card); border:1.5px solid var(--border); border-radius:14px;
            padding:14px 22px; animation:fadeUp .3s ease both; animation-delay:.05s;
        }
        .dpb-label { font-size:13px; font-weight:600; color:var(--text); display:flex; align-items:center; gap:6px; }
        .dpb-input {
            height:38px; border:1.5px solid var(--border); border-radius:10px;
            padding:0 14px; font-size:13px; font-family:'Plus Jakarta Sans',sans-serif;
            color:var(--text); outline:none; background:var(--white); transition:border-color .2s;
        }
        .dpb-input:focus { border-color:var(--accent); }
        .dpb-today {
            display:inline-flex; align-items:center; gap:4px; font-size:11.5px; font-weight:600;
            color:var(--accent); background:rgba(45,125,210,.08); padding:7px 14px;
            border-radius:8px; border:none; cursor:pointer; transition:background .2s;
            font-family:'Plus Jakarta Sans',sans-serif; text-decoration:none;
        }
        .dpb-today:hover { background:rgba(45,125,210,.15); }
        .dpb-date-label { font-size:12px; color:var(--text-muted); margin-left:auto; }

        /* Legend */
        .slots-legend { display:flex; gap:16px; margin-bottom:14px; }
        .legend-item { display:flex; align-items:center; gap:5px; font-size:10.5px; color:var(--text-muted); }
        .legend-dot { width:10px; height:10px; border-radius:3px; }
        .legend-dot.avail { background:rgba(34,197,94,.3); border:1.5px solid rgba(34,197,94,.5); }
        .legend-dot.taken { background:rgba(239,68,68,.15); border:1.5px solid rgba(239,68,68,.3); }
        .legend-dot.past-l { background:rgba(107,126,148,.12); border:1.5px solid rgba(107,126,148,.2); }

        /* Booking List */
        .booking-list { display:flex; flex-direction:column; gap:10px; }
        .booking-item { display:flex; align-items:center; gap:14px; padding:14px 16px; border:1.5px solid var(--border); border-radius:12px; transition:border-color .2s; }
        .booking-item:hover { border-color:var(--accent); }
        .bi-date { text-align:center; min-width:48px; padding:8px; border-radius:10px; background:rgba(45,125,210,.08); }
        .bi-date .bi-day { font-size:18px; font-weight:700; color:var(--accent); line-height:1; }
        .bi-date .bi-month { font-size:9px; font-weight:600; color:var(--text-muted); text-transform:uppercase; margin-top:2px; }
        .bi-info { flex:1; }
        .bi-doctor { font-size:13px; font-weight:700; color:var(--text); }
        .bi-meta { font-size:11px; color:var(--text-muted); margin-top:2px; }
        .bi-keluhan { font-size:11px; color:var(--text-muted); margin-top:3px; font-style:italic; }
        .bi-status { display:inline-flex; align-items:center; gap:4px; font-size:10.5px; font-weight:600; padding:5px 12px; border-radius:20px; flex-shrink:0; }
        .bi-status.menunggu { background:rgba(245,158,11,.1); color:#d97706; }
        .bi-status.terkonfirmasi { background:rgba(34,197,94,.1); color:#16a34a; }
        .bi-status.selesai { background:rgba(107,126,148,.1); color:var(--text-muted); }
        .bi-status.dibatalkan { background:rgba(239,68,68,.08); color:#dc2626; }
        .bi-cancel-btn { font-size:11px; font-weight:600; color:var(--danger); background:rgba(239,68,68,.06); border:1px solid rgba(239,68,68,.15); padding:5px 10px; border-radius:6px; cursor:pointer; transition:all .2s; font-family:'Plus Jakarta Sans',sans-serif; }
        .bi-cancel-btn:hover { background:rgba(239,68,68,.12); }
        .empty-bookings { text-align:center; padding:32px 16px; color:var(--text-muted); font-size:12.5px; }

        @keyframes fadeUp { from{opacity:0;transform:translateY(14px);} to{opacity:1;transform:translateY(0);} }
        .fade-up { animation:fadeUp .35s ease both; }
        .fd1 { animation-delay:.06s; } .fd2 { animation-delay:.12s; } .fd3 { animation-delay:.18s; }
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
            <a class="nav-item" href="{{ route('pasien.dashboard') }}"><span class="nav-icon">🏠</span> Dashboard</a>
            <a class="nav-item" href="#"><span class="nav-icon">💬</span> Konsultasi Chatbot <span class="nav-badge">1</span></a>
            <a class="nav-item" href="{{ route('pasien.jadwal-dokter') }}"><span class="nav-icon">📅</span> Jadwal Dokter</a>
            <a class="nav-item active" href="{{ route('pasien.booking.index') }}"><span class="nav-icon">🗒️</span> Booking Konsultasi</a>
            <div class="nav-section-label" style="margin-top:12px;">Informasi</div>
            <a class="nav-item" href="#"><span class="nav-icon">ℹ️</span> Informasi Rumah Sakit</a>
            <a class="nav-item" href="#"><span class="nav-icon">❓</span> FAQ Kesehatan Paru</a>
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
            </div>
        </div>
    </aside>

    <!-- ══ MAIN ══ -->
    <div class="main">
        <header class="topbar">
            <div class="topbar-left">
                <span class="page-title">Booking Konsultasi</span>
                <span class="breadcrumb" style="color:var(--border);margin:0 6px;">›</span>
                <span class="breadcrumb">Poli Paru</span>
            </div>
            <div class="topbar-right">
                <div class="time-chip" id="clock"></div>
                <div class="topbar-btn" title="Notifikasi">🔔<div class="notif-dot"></div></div>
                <div class="topbar-btn" title="Bantuan">❓</div>
            </div>
        </header>

        <div class="content">
            <!-- Hero -->
            <div class="booking-hero fade-up">
                <div class="hero-inner">
                    <div>
                        <h1>🗒️ Booking Konsultasi Poli Paru</h1>
                        <p>Pilih dokter dan sesi waktu konsultasi yang tersedia. Setiap sesi berdurasi <strong>20 menit</strong> untuk memastikan pelayanan optimal tanpa antrian panjang.</p>
                    </div>
                    <div class="hero-date-chip">
                        <div class="hd-day">{{ \Carbon\Carbon::parse($selectedDate)->format('d') }}</div>
                        <div class="hd-info">{{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('F Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert-msg alert-success fade-up">✅ {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-msg alert-error fade-up">❌ {{ session('error') }}</div>
            @endif
            @if($apiError)
                <div class="alert-msg alert-error fade-up">⚠️ {{ $apiError }}</div>
            @endif

            <!-- Date Picker Bar -->
            <div class="date-picker-bar">
                <div class="dpb-label">📆 Pilih Tanggal Booking:</div>
                <form action="{{ route('pasien.booking.index') }}" method="GET" id="datePickerForm" style="display:flex;align-items:center;gap:10px;">
                    <input type="date" name="date" value="{{ $selectedDate }}" min="{{ $today }}" class="dpb-input" onchange="document.getElementById('datePickerForm').submit()">
                </form>
                @if($selectedDate !== $today)
                    <a href="{{ route('pasien.booking.index') }}" class="dpb-today">📌 Kembali ke Hari Ini</a>
                @endif
                <div class="dpb-date-label">
                    {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('l, d F Y') }}
                    @if($selectedDate === $today)
                        <span style="color:var(--success);font-weight:600;"> · Hari Ini</span>
                    @endif
                </div>
            </div>

            <!-- MAIN GRID -->
            <div class="booking-grid">
                <!-- LEFT: Booking Form -->
                <div class="section-card fade-up fd1">
                    <div class="section-head">
                        <div class="section-title-text">📋 Buat Booking Baru</div>
                        <span style="font-size:11px;color:var(--text-muted);">{{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('l, d M Y') }}</span>
                    </div>
                    <div class="section-body">
                        @if(count($dokterSlots) > 0)
                            <form action="{{ route('pasien.booking.store') }}" method="POST" id="bookingForm">
                                @csrf
                                <input type="hidden" name="tanggal_konsultasi" value="{{ $selectedDate }}">
                                <input type="hidden" name="nama_dokter" id="selected_dokter" value="">
                                <input type="hidden" name="jam_booking" id="selected_slot" value="">
                                <input type="hidden" name="jam_praktik" id="selected_jam_praktik" value="">
                                <input type="hidden" name="poli" id="selected_poli" value="">
                                <input type="hidden" name="kode_layanan" id="selected_kode" value="">

                                <!-- Legend -->
                                <div class="slots-legend">
                                    <div class="legend-item"><div class="legend-dot avail"></div> Tersedia</div>
                                    <div class="legend-item"><div class="legend-dot taken"></div> Sudah Dipesan</div>
                                    <div class="legend-item"><div class="legend-dot past-l"></div> Sudah Lewat</div>
                                </div>

                                <!-- Dokter Blocks -->
                                @foreach($dokterSlots as $i => $ds)
                                @php $dokter = $ds['dokter']; $slots = $ds['slots']; $avail = $ds['available_count']; @endphp
                                <div class="dokter-block {{ $i === 0 ? 'active' : '' }}" id="db-{{ $i }}">
                                    <div class="dokter-header" onclick="toggleDokter({{ $i }}, '{{ addslashes($dokter['FS_NM_DOKTER']) }}', '{{ $dokter['jadwal'] ?? '' }}', '{{ $dokter['FS_NM_LAYANAN'] ?? 'PARU' }}', '{{ $dokter['FS_KD_LAYANAN'] ?? '' }}')">
                                        <div class="dh-avatar">👨‍⚕️</div>
                                        <div class="dh-info">
                                            <div class="dh-name">{{ $dokter['FS_NM_DOKTER'] }}</div>
                                            <div class="dh-poli">🫁 {{ $dokter['FS_NM_LAYANAN'] ?? 'Poli Paru' }}</div>
                                            <div class="dh-meta">⏰ {{ $dokter['jadwal'] ?? '-' }} &nbsp;·&nbsp; 📅 {{ $dokter['FS_NM_HARI'] ?? '-' }}</div>
                                        </div>
                                        <div class="dh-badge {{ $avail > 0 ? 'available' : 'full' }}">
                                            {{ $avail > 0 ? $avail . ' sesi tersedia' : 'Penuh' }}
                                        </div>
                                    </div>
                                    <div class="slots-panel {{ $i === 0 ? 'show' : '' }}" id="sp-{{ $i }}">
                                        <div class="slots-label">⏰ Pilih Sesi Konsultasi (@ 20 menit)</div>
                                        @if(count($slots) > 0)
                                        <div class="slots-grid">
                                            @foreach($slots as $si => $slot)
                                            <div class="slot-btn {{ !$slot['available'] ? 'disabled' : '' }}"
                                                 id="slot-{{ $i }}-{{ $si }}"
                                                 @if($slot['available']) onclick="selectSlot({{ $i }}, {{ $si }}, '{{ $slot['time'] }}')" @endif>
                                                <div class="sb-time">{{ $slot['time'] }}</div>
                                                <div class="sb-range">{{ $slot['time'] }} – {{ $slot['end_time'] }}</div>
                                                <div class="sb-status {{ $slot['available'] ? 'avail' : ($slot['booked'] ? 'taken' : 'past-s') }}">
                                                    @if($slot['available']) ✓ Tersedia
                                                    @elseif($slot['booked']) ✕ Dipesan
                                                    @else ○ Lewat
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @else
                                        <div style="text-align:center;padding:16px;color:var(--text-muted);font-size:12px;">Tidak ada sesi yang tersedia.</div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach

                                @error('nama_dokter') <div class="form-error">{{ $message }}</div> @enderror
                                @error('jam_booking') <div class="form-error">{{ $message }}</div> @enderror

                                <!-- Keluhan -->
                                <div class="form-row" style="margin-top:16px;">
                                    <label class="form-label">Keluhan / Alasan Konsultasi <span>(opsional)</span></label>
                                    <textarea class="form-textarea" name="keluhan" placeholder="Ceritakan gejala yang Anda alami...">{{ old('keluhan') }}</textarea>
                                    <div class="form-help">Jelaskan gejala yang Anda rasakan agar dokter bisa mempersiapkan konsultasi.</div>
                                </div>

                                <!-- Selected Summary + Submit -->
                                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:14px;border-top:1px solid var(--border);">
                                    <div id="selectedSummary" style="font-size:11.5px;color:var(--text-muted);">
                                        📌 Pilih dokter dan sesi waktu terlebih dahulu
                                    </div>
                                    <button type="submit" class="submit-btn" id="submitBtn" disabled>📅 Buat Booking</button>
                                </div>
                            </form>
                        @else
                            <div class="no-schedule">
                                <div class="ns-icon">🗓️</div>
                                <div class="ns-title">Tidak Ada Jadwal Poli Paru di Tanggal Ini</div>
                                <div class="ns-desc">Maaf, tidak ada dokter poli paru yang praktik pada tanggal <strong>{{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}</strong>. Silakan pilih tanggal lain atau cek jadwal dokter.</div>
                                <a href="{{ route('pasien.jadwal-dokter') }}" class="ns-link">📅 Lihat Jadwal Dokter</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- RIGHT: Booking Mendatang -->
                <div class="section-card fade-up fd2">
                    <div class="section-head">
                        <div class="section-title-text">📅 Booking Mendatang</div>
                        <span style="font-size:11px;color:var(--accent);font-weight:600;">{{ $bookingMendatang->count() }} booking</span>
                    </div>
                    <div class="section-body">
                        @if($bookingMendatang->count() > 0)
                            <div class="booking-list">
                                @foreach($bookingMendatang as $booking)
                                <div class="booking-item">
                                    <div class="bi-date">
                                        <div class="bi-day">{{ $booking->tanggal_konsultasi->format('d') }}</div>
                                        <div class="bi-month">{{ $booking->tanggal_konsultasi->translatedFormat('M') }}</div>
                                    </div>
                                    <div class="bi-info">
                                        <div class="bi-doctor">{{ $booking->nama_dokter }}</div>
                                        <div class="bi-meta">🫁 {{ $booking->poli }} &nbsp;·&nbsp; ⏰ Sesi {{ $booking->jam_booking ?? $booking->jam_praktik ?? '-' }}</div>
                                        @if($booking->keluhan)
                                        <div class="bi-keluhan">"{{ Str::limit($booking->keluhan, 60) }}"</div>
                                        @endif
                                    </div>
                                    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:6px;">
                                        <span class="bi-status {{ $booking->status }}">
                                            @if($booking->status === 'menunggu') ⏳ Menunggu
                                            @elseif($booking->status === 'terkonfirmasi') ✓ Terkonfirmasi
                                            @endif
                                        </span>
                                        @if(in_array($booking->status, ['menunggu', 'terkonfirmasi']))
                                        <form action="{{ route('pasien.booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan booking ini?')">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="bi-cancel-btn">✕ Batalkan</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-bookings">
                                <div style="font-size:32px;margin-bottom:8px;">📭</div>
                                <div>Belum ada booking mendatang.</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Riwayat -->
            <div class="section-card fade-up fd3" style="margin-bottom:24px;">
                <div class="section-head">
                    <div class="section-title-text">📜 Riwayat Booking</div>
                    <span style="font-size:11px;color:var(--text-muted);">{{ $bookingSelesai->count() }} riwayat</span>
                </div>
                <div class="section-body">
                    @if($bookingSelesai->count() > 0)
                        <div class="booking-list">
                            @foreach($bookingSelesai as $booking)
                            <div class="booking-item" style="opacity:.7;">
                                <div class="bi-date" style="background:rgba(107,126,148,.08);">
                                    <div class="bi-day" style="color:var(--text-muted);">{{ $booking->tanggal_konsultasi->format('d') }}</div>
                                    <div class="bi-month">{{ $booking->tanggal_konsultasi->translatedFormat('M') }}</div>
                                </div>
                                <div class="bi-info">
                                    <div class="bi-doctor">{{ $booking->nama_dokter }}</div>
                                    <div class="bi-meta">🫁 {{ $booking->poli }}  ·  ⏰ Sesi {{ $booking->jam_booking ?? '-' }}  ·  {{ $booking->tanggal_konsultasi->translatedFormat('d M Y') }}</div>
                                </div>
                                <span class="bi-status {{ $booking->status }}">
                                    @if($booking->status === 'selesai') ✓ Selesai
                                    @elseif($booking->status === 'dibatalkan') ✕ Dibatalkan
                                    @else {{ ucfirst($booking->status) }}
                                    @endif
                                </span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-bookings">
                            <div style="font-size:32px;margin-bottom:8px;">📋</div>
                            <div>Belum ada riwayat booking sebelumnya.</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Clock
        function updateClock() {
            const now = new Date();
            const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
            const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
            document.getElementById('clock').textContent =
                `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()} · ${String(now.getHours()).padStart(2,'0')}:${String(now.getMinutes()).padStart(2,'0')} WIB`;
        }
        updateClock(); setInterval(updateClock, 1000);

        let currentDokterIdx = 0;

        function toggleDokter(idx, name, jam, poli, kode) {
            // Close all panels
            document.querySelectorAll('.slots-panel').forEach(p => p.classList.remove('show'));
            document.querySelectorAll('.dokter-block').forEach(b => b.classList.remove('active'));

            // Open selected
            document.getElementById('sp-' + idx).classList.add('show');
            document.getElementById('db-' + idx).classList.add('active');

            // Set doctor info
            currentDokterIdx = idx;
            document.getElementById('selected_dokter').value = name;
            document.getElementById('selected_jam_praktik').value = jam;
            document.getElementById('selected_poli').value = poli;
            document.getElementById('selected_kode').value = kode;

            // Reset slot selection
            document.getElementById('selected_slot').value = '';
            document.querySelectorAll('.slot-btn').forEach(s => s.classList.remove('selected'));
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('selectedSummary').innerHTML = '📌 Pilih sesi waktu untuk <strong>' + name + '</strong>';
        }

        function selectSlot(dokterIdx, slotIdx, time) {
            // Clear all selections
            document.querySelectorAll('.slot-btn').forEach(s => s.classList.remove('selected'));

            // Select this slot
            const slotEl = document.getElementById('slot-' + dokterIdx + '-' + slotIdx);
            slotEl.classList.add('selected');

            // Update hidden input
            document.getElementById('selected_slot').value = time;
            document.getElementById('submitBtn').disabled = false;

            // Update summary
            const dokterName = document.getElementById('selected_dokter').value;
            document.getElementById('selectedSummary').innerHTML =
                '📌 <strong>' + dokterName + '</strong> · Sesi <strong>' + time + '</strong> · {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat("d F Y") }}';
        }

        // Auto-select first doctor
        @if(count($dokterSlots ?? []) > 0)
            toggleDokter(0, '{{ addslashes($dokterSlots[0]["dokter"]["FS_NM_DOKTER"]) }}', '{{ $dokterSlots[0]["dokter"]["jadwal"] ?? "" }}', '{{ $dokterSlots[0]["dokter"]["FS_NM_LAYANAN"] ?? "PARU" }}', '{{ $dokterSlots[0]["dokter"]["FS_KD_LAYANAN"] ?? "" }}');
        @endif
    </script>
</body>
</html>
