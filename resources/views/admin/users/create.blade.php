@extends('layouts.admin')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User Baru')
@section('page-sub', 'Daftarkan user baru ke sistem')

@section('content')
    <div class="section-row">
        <div class="section-title">Form Tambah User</div>
        <a href="{{ route('admin.users.index') }}" class="toolbar-btn" style="text-decoration:none;">← Kembali</a>
    </div>

    <div class="card" style="max-width:600px;animation: fadeIn .35s ease both;">
        <div class="card-head">
            <div class="card-title"><span class="card-title-icon">➕</span> Data User Baru</div>
        </div>
        <div style="padding:24px;">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="form-group" style="margin-bottom:18px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:6px;">
                        Nama Lengkap <span style="color:var(--danger);">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        style="width:100%;height:38px;border:1px solid {{ $errors->has('name') ? 'var(--danger)' : 'var(--border)' }};border-radius:7px;padding:0 12px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text);outline:none;transition:border-color .15s;background:var(--white);"
                        placeholder="Masukkan nama lengkap">
                    @error('name')
                        <div style="font-size:11px;color:var(--danger);margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group" style="margin-bottom:18px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:6px;">
                        Email <span style="color:var(--danger);">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        style="width:100%;height:38px;border:1px solid {{ $errors->has('email') ? 'var(--danger)' : 'var(--border)' }};border-radius:7px;padding:0 12px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text);outline:none;transition:border-color .15s;background:var(--white);"
                        placeholder="contoh@email.com">
                    @error('email')
                        <div style="font-size:11px;color:var(--danger);margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Role -->
                <div class="form-group" style="margin-bottom:18px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:6px;">
                        Role <span style="color:var(--danger);">*</span>
                    </label>
                    <select name="role" id="roleSelect" required
                        style="width:100%;height:38px;border:1px solid var(--border);border-radius:7px;padding:0 12px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text);outline:none;transition:border-color .15s;background:var(--white);"
                        onchange="togglePasienField()">
                        <option value="pasien" {{ old('role', 'pasien') == 'pasien' ? 'selected' : '' }}>Pasien</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <!-- Data Pasien (hanya tampil jika role = pasien) -->
                <div class="form-group" style="margin-bottom:18px;" id="pasienField">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:6px;">
                        Relasi Data Pasien <span style="font-weight:400;color:var(--text-muted);">(opsional)</span>
                    </label>
                    <select name="pasien_id"
                        style="width:100%;height:38px;border:1px solid var(--border);border-radius:7px;padding:0 12px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text);outline:none;transition:border-color .15s;background:var(--white);">
                        <option value="">-- Tidak ada relasi --</option>
                        @foreach($pasiens as $p)
                            <option value="{{ $p->id }}" {{ old('pasien_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->nama }} (RM: {{ $p->no_rekam_medis }})
                            </option>
                        @endforeach
                    </select>
                    <div style="font-size:10px;color:var(--text-muted);margin-top:4px;">Hanya menampilkan data pasien yang belum terhubung dengan akun user</div>
                </div>

                <!-- Password -->
                <div class="form-group" style="margin-bottom:18px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:6px;">
                        Password <span style="color:var(--danger);">*</span>
                    </label>
                    <input type="password" name="password" required
                        style="width:100%;height:38px;border:1px solid {{ $errors->has('password') ? 'var(--danger)' : 'var(--border)' }};border-radius:7px;padding:0 12px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text);outline:none;transition:border-color .15s;background:var(--white);"
                        placeholder="Minimal 8 karakter">
                    @error('password')
                        <div style="font-size:11px;color:var(--danger);margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-group" style="margin-bottom:24px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:6px;">
                        Konfirmasi Password <span style="color:var(--danger);">*</span>
                    </label>
                    <input type="password" name="password_confirmation" required
                        style="width:100%;height:38px;border:1px solid var(--border);border-radius:7px;padding:0 12px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text);outline:none;transition:border-color .15s;background:var(--white);"
                        placeholder="Ulangi password">
                </div>

                <!-- Actions -->
                <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:16px;border-top:1px solid var(--border);">
                    <a href="{{ route('admin.users.index') }}" class="toolbar-btn" style="text-decoration:none;">Batal</a>
                    <button type="submit" class="toolbar-btn primary">💾 Simpan User</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function togglePasienField() {
        const role = document.getElementById('roleSelect').value;
        const field = document.getElementById('pasienField');
        field.style.display = role === 'pasien' ? 'block' : 'none';
    }
    togglePasienField();
</script>
@endsection
