@extends('layouts.admin')

@section('title', 'Detail Data Pasien')
@section('page-title', 'Detail Data Pasien')
@section('page-sub', 'Informasi lengkap data pasien')

@section('content')
    <div class="section-row">
        <div class="section-title">Detail Data Pasien</div>
        <a href="{{ route('admin.pasien.index') }}" class="toolbar-btn" style="text-decoration:none;">← Kembali</a>
    </div>

    <div class="card" style="max-width:700px;animation: fadeIn .35s ease both;">
        <div class="card-head">
            <div>
                <div class="card-title"><span class="card-title-icon">👤</span> {{ $pasien->nama }}</div>
                <div class="card-subtitle">RM: {{ $pasien->no_rekam_medis }}</div>
            </div>
            <div style="display:flex;gap:8px;">
                <a href="{{ route('admin.pasien.edit', $pasien->id) }}" class="card-action-btn" style="text-decoration:none;">✏ Edit</a>
            </div>
        </div>
        <div style="padding:0;">
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">No. Rekam Medis</div>
                <div style="font-size:13px;font-weight:600;color:var(--text);font-family:'JetBrains Mono',monospace;">{{ $pasien->no_rekam_medis }}</div>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">No. Registrasi</div>
                <div style="font-size:13px;font-weight:600;color:var(--primary);font-family:'JetBrains Mono',monospace;">{{ $pasien->no_registrasi }}</div>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">NIK</div>
                <div style="font-size:13px;color:var(--text);font-family:'JetBrains Mono',monospace;">{{ $pasien->nik }}</div>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">Nama Lengkap</div>
                <div style="font-size:13px;font-weight:600;color:var(--text);">{{ $pasien->nama }}</div>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">Jenis Kelamin</div>
                <div>
                    <span style="display:inline-block;padding:3px 10px;border-radius:4px;font-size:11px;font-weight:600;
                        {{ $pasien->jenis_kelamin === 'LAKI-LAKI' ? 'background:#dbeafe;color:#1e40af;' : 'background:#fce7f3;color:#9d174d;' }}">
                        {{ $pasien->jenis_kelamin }}
                    </span>
                </div>
            </div>
            <div style="display:flex;align-items:flex-start;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);min-width:120px;">Alamat</div>
                <div style="font-size:13px;color:var(--text);text-align:right;">{{ $pasien->alamat }}</div>
            </div>
            <div style="display:flex;align-items:flex-start;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);min-width:120px;">Keluhan Utama</div>
                <div style="font-size:13px;color:var(--text);text-align:right;max-width:450px;">{{ $pasien->keluhan_utama ?? '-' }}</div>
            </div>
            @if($pasien->user)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);background:rgba(77,163,227,0.04);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">Akun Login</div>
                <div style="font-size:13px;color:var(--primary);">{{ $pasien->user->email }}</div>
            </div>
            @endif
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid var(--border-light);">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">Tanggal Daftar</div>
                <div style="font-size:13px;color:var(--text);">{{ $pasien->created_at->format('d F Y, H:i') }} WIB</div>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:16px 24px;">
                <div style="font-size:12px;font-weight:600;color:var(--text-muted);">Terakhir Diperbarui</div>
                <div style="font-size:13px;color:var(--text);">{{ $pasien->updated_at->format('d F Y, H:i') }} WIB</div>
            </div>
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="card" style="max-width:700px;margin-top:16px;border-color:#fecaca;animation: fadeIn .35s .1s ease both;">
        <div class="card-head" style="border-bottom-color:#fecaca;">
            <div class="card-title" style="color:var(--danger);"><span class="card-title-icon">⚠️</span> Zona Berbahaya</div>
        </div>
        <div style="padding:18px 24px;display:flex;align-items:center;justify-content:space-between;">
            <div>
                <div style="font-size:12.5px;font-weight:600;color:var(--text);">Hapus Data Pasien</div>
                <div style="font-size:11px;color:var(--text-muted);margin-top:2px;">Tindakan ini tidak dapat dibatalkan dan akan menghapus data secara permanen.</div>
            </div>
            <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST" onsubmit="return confirm('PERHATIAN: Yakin ingin menghapus data pasien {{ $pasien->nama }}? Tindakan ini tidak dapat dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="toolbar-btn" style="background:var(--danger);color:#fff;border-color:var(--danger);">🗑 Hapus Data Pasien</button>
            </form>
        </div>
    </div>
@endsection
