@extends('layouts.admin')

@section('title', 'Detail User')
@section('page-title', 'Detail User')
@section('page-sub', 'Informasi lengkap akun user')

@section('content')
    <div class="section-row">
        <div class="section-title">Detail User</div>
        <a href="{{ route('admin.users.index') }}" class="toolbar-btn" style="text-decoration:none;">← Kembali</a>
    </div>

    <div class="card" style="max-width:650px;animation: fadeIn .35s ease both;">
        <div class="card-head">
            <div>
                <div class="card-title"><span class="card-title-icon">👤</span> {{ $user->name }}</div>
                <div class="card-subtitle">{{ $user->email }}</div>
            </div>
        </div>
        <div style="padding:0;">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">Nama Lengkap</div>
                <div style="font-size:13px;font-weight:600;color:var(--text);">{{ $user->name }}</div>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">Email</div>
                <div style="font-size:13px;color:var(--text);">{{ $user->email }}</div>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">Role</div>
                <div>
                    <span style="display:inline-block;padding:3px 12px;border-radius:4px;font-size:11px;font-weight:600;text-transform:uppercase;
                        {{ $user->role === 'admin' ? 'background:#fef3c7;color:#92400e;' : 'background:#dbeafe;color:#1e40af;' }}">
                        {{ $user->role }}
                    </span>
                </div>
            </div>

            @if($user->pasien)
            <div style="padding:16px 24px;border-bottom:1px solid var(--border-light);background:rgba(77,163,227,0.04);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);margin-bottom:10px;">Data Pasien Terkait</div>
                <div style="display:flex;flex-direction:column;gap:6px;">
                    <div style="display:flex;justify-content:space-between;">
                        <span style="font-size:11.5px;color:var(--text-muted);">Nama Pasien</span>
                        <span style="font-size:12px;font-weight:600;color:var(--text);">{{ $user->pasien->nama }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;">
                        <span style="font-size:11.5px;color:var(--text-muted);">No. Rekam Medis</span>
                        <span style="font-size:12px;color:var(--primary);font-family:'JetBrains Mono',monospace;">{{ $user->pasien->no_rekam_medis }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;">
                        <span style="font-size:11.5px;color:var(--text-muted);">No. Registrasi</span>
                        <span style="font-size:12px;color:var(--text);font-family:'JetBrains Mono',monospace;">{{ $user->pasien->no_registrasi }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;">
                        <span style="font-size:11.5px;color:var(--text-muted);">NIK</span>
                        <span style="font-size:12px;color:var(--text);font-family:'JetBrains Mono',monospace;">{{ $user->pasien->nik }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;">
                        <span style="font-size:11.5px;color:var(--text-muted);">Jenis Kelamin</span>
                        <span style="font-size:12px;color:var(--text);">{{ $user->pasien->jenis_kelamin }}</span>
                    </div>
                </div>
            </div>
            @else
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">Data Pasien Terkait</div>
                <div style="font-size:13px;color:var(--text-muted);">-</div>
            </div>
            @endif

            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">Tanggal Daftar</div>
                <div style="font-size:13px;color:var(--text);">{{ $user->created_at->format('d F Y, H:i') }} WIB</div>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">Terakhir Diperbarui</div>
                <div style="font-size:13px;color:var(--text);">{{ $user->updated_at->format('d F Y, H:i') }} WIB</div>
            </div>
        </div>
    </div>

    <!-- Danger Zone -->
    @if($user->id !== auth()->id())
    <div class="card" style="max-width:650px;margin-top:16px;border-color:#fecaca;animation: fadeIn .35s .1s ease both;">
        <div class="card-head" style="border-bottom-color:#fecaca;">
            <div class="card-title" style="color:var(--danger);"><span class="card-title-icon">⚠️</span> Zona Berbahaya</div>
        </div>
        <div style="padding:18px 24px;display:flex;align-items:center;justify-content:space-between;">
            <div>
                <div style="font-size:12.5px;font-weight:600;color:var(--text);">Hapus User</div>
                <div style="font-size:11px;color:var(--text-muted);margin-top:2px;">Tindakan ini tidak dapat dibatalkan dan akan menghapus akun secara permanen.</div>
            </div>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('PERHATIAN: Yakin ingin menghapus user {{ $user->name }}? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="toolbar-btn" style="background:var(--danger);color:#fff;border-color:var(--danger);">🗑 Delete User</button>
            </form>
        </div>
    </div>
    @endif
@endsection
