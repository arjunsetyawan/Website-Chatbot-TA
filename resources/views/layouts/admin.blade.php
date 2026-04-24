<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') – RSUD Sultan Fatah</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css">
    @yield('styles')
</head>

<body>

    <!-- ══ SIDEBAR ══ -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-mark">🫁</div>
            <div>
                <div class="logo-text">RSUD Sultan Fatah</div>
                <div class="logo-sub">Admin Panel</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Utama</div>
            <a class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <span class="nav-icon">▦</span> Dashboard
            </a>
            <a class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <span class="nav-icon">👤</span> Manajemen User
            </a>
            <a class="nav-item {{ request()->routeIs('admin.pasien.*') ? 'active' : '' }}" href="{{ route('admin.pasien.index') }}">
                <span class="nav-icon">🏥</span> Data Pasien
            </a>
            <a class="nav-item {{ request()->routeIs('admin.jadwal-dokter') ? 'active' : '' }}" href="{{ route('admin.jadwal-dokter') }}">
                <span class="nav-icon">📅</span> Jadwal Dokter
            </a>
            <a class="nav-item {{ request()->routeIs('admin.booking.*') ? 'active' : '' }}" href="{{ route('admin.booking.index') }}">
                <span class="nav-icon">🗒️</span> Booking Konsultasi
                @php $globalPendingBookings = \App\Models\Konsultasi::where('status', 'menunggu')->count(); @endphp
                @if($globalPendingBookings > 0)
                <span class="nav-badge red">{{ $globalPendingBookings }}</span>
                @endif
            </a>

            <div class="nav-label" style="margin-top:10px;">Akun</div>
            <a class="nav-item" href="{{ route('logout.get') }}" style="color:rgba(239,68,68,.7);">
                <span class="nav-icon">🚪</span> Keluar
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="admin-card">
                <div class="admin-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}</div>
                <div>
                    <div class="admin-name">{{ Auth::user()->name ?? 'Admin Sistem' }}</div>
                    <div class="admin-role">Super Administrator</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- ══ MAIN ══ -->
    <div class="main">

        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-left">
                <div class="topbar-title">@yield('page-title', 'Dashboard Admin')</div>
                <div class="topbar-sub">@yield('page-sub', 'RSUD Sultan Fatah · Sistem Chatbot Penyakit Paru-Paru')</div>
            </div>
            <div class="topbar-right">
                <div class="topbar-clock" id="clock">--:-- WIB</div>
                <div class="topbar-icon-btn" title="Notifikasi">
                    🔔
                    <div class="topbar-dot"></div>
                </div>
                <div class="topbar-icon-btn" title="Pengaturan">⚙️</div>
            </div>
        </header>

        <!-- Content -->
        <div class="content">
            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="alert-banner alert-success" style="margin-bottom:16px;padding:12px 18px;background:var(--success-bg);border:1px solid #bbf7d0;border-radius:8px;color:var(--success);font-size:12.5px;font-weight:600;display:flex;align-items:center;gap:8px;">
                ✅ {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="alert-banner alert-danger" style="margin-bottom:16px;padding:12px 18px;background:var(--danger-bg);border:1px solid #fecaca;border-radius:8px;color:var(--danger);font-size:12.5px;font-weight:600;display:flex;align-items:center;gap:8px;">
                ⚠️ {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ];
            const h = String(now.getHours()).padStart(2, '0');
            const m = String(now.getMinutes()).padStart(2, '0');
            const s = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').textContent = `${h}:${m}:${s} WIB`;
            const dateLabel = document.getElementById('date-label');
            if (dateLabel) {
                dateLabel.textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
            }
        }
        updateClock();
        setInterval(updateClock, 1000);
    </script>
    @yield('scripts')
</body>

</html>
