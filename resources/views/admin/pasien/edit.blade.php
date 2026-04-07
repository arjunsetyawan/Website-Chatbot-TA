@extends('layouts.admin')

@section('title', 'Edit Data Pasien')
@section('page-title', 'Edit Data Pasien')
@section('page-sub', 'Perbarui data pasien')

@section('content')
    <div class="section-row">
        <div class="section-title">Form Edit Data Pasien</div>
        <a href="{{ route('admin.pasien.index') }}" class="toolbar-btn" style="text-decoration:none;">← Kembali</a>
    </div>

    <div class="card" style="max-width:700px;animation: fadeIn .35s ease both;">
        <div class="card-head">
            <div>
                <div class="card-title"><span class="card-title-icon">✏️</span> Edit Data Pasien</div>
                <div class="card-subtitle">RM: {{ $pasien->no_rekam_medis }} · {{ $pasien->nama }}</div>
            </div>
        </div>
        <div style="padding:24px;">
            <form action="{{ route('admin.pasien.update', $pasien->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- No. Rekam Medis -->
                <div class="form-group" style="margin-bottom:18px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:6px;">
                        No. Rekam Medis <span style="color:var(--danger);">*</span>
                    </label>
                    <input type="text" name="no_rekam_medis" value="{{ old('no_rekam_medis', $pasien->no_rekam_medis) }}" required
                        style="width:100%;height:38px;border:1px solid {{ $errors->has('no_rekam_medis') ? 'var(--danger)' : 'var(--border)' }};border-radius:7px;padding:0 12px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text);outline:none;transition:border-color .15s;background:var(--white);"
                        placeholder="Masukkan No. Rekam Medis">
                    @error('no_rekam_medis')
                        <div style="font-size:11px;color:var(--danger);margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- No. Registrasi -->
                <div class="form-group" style="margin-bottom:18px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:6px;">
                        No. Registrasi <span style="color:var(--danger);">*</span>
                    </label>
                    <input type="text" name="no_registrasi" value="{{ old('no_registrasi', $pasien->no_registrasi) }}" required
                        style="width:100%;height:38px;border:1px solid {{ $errors->has('no_registrasi') ? 'var(--danger)' : 'var(--border)' }};border-radius:7px;padding:0 12px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text);outline:none;transition:border-color .15s;background:var(--white);"
                        placeholder="Contoh: RG2025A0001234">
                    @error('no_registrasi')
                        <div style="font-size:11px;color:var(--danger);margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIK -->
                <div class="form-group" style="margin-bottom:18px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:6px;">
                        NIK <span style="color:var(--danger);">*</span>
                    </label>
                    <input type="text" name="nik" value="{{ old('nik', $pasien->nik) }}" required maxlength="16"
                        style="width:100%;height:38px;border:1px solid {{ $errors->has('nik') ? 'var(--danger)' : 'var(--border)' }};border-radius:7px;padding:0 12px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text);outline:none;transition:border-color .15s;background:var(--white);"
                        placeholder="16 digit NIK">
                    @error('nik')
                        <div style="font-size:11px;color:var(--danger);margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama -->
                <div class="form-group" style="margin-bottom:18px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:6px;">
                        Nama Lengkap <span style="color:var(--danger);">*</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama', $pasien->nama) }}" required
                        style="width:100%;height:38px;border:1px solid {{ $errors->has('nama') ? 'var(--danger)' : 'var(--border)' }};border-radius:7px;padding:0 12px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text);outline:none;transition:border-color .15s;background:var(--white);"
                        placeholder="Masukkan nama lengkap pasien">
                    @error('nama')
                        <div style="font-size:11px;color:var(--danger);margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="form-group" style="margin-bottom:18px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:6px;">
                        Alamat <span style="color:var(--danger);">*</span>
                    </label>
                    <textarea name="alamat" required rows="3"
                        style="width:100%;border:1px solid {{ $errors->has('alamat') ? 'var(--danger)' : 'var(--border)' }};border-radius:7px;padding:10px 12px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text);outline:none;transition:border-color .15s;background:var(--white);resize:vertical;"
                        placeholder="Masukkan alamat lengkap">{{ old('alamat', $pasien->alamat) }}</textarea>
                    @error('alamat')
                        <div style="font-size:11px;color:var(--danger);margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-group" style="margin-bottom:18px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:6px;">
                        Jenis Kelamin <span style="color:var(--danger);">*</span>
                    </label>
                    <select name="jenis_kelamin" required
                        style="width:100%;height:38px;border:1px solid {{ $errors->has('jenis_kelamin') ? 'var(--danger)' : 'var(--border)' }};border-radius:7px;padding:0 12px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text);outline:none;transition:border-color .15s;background:var(--white);">
                        <option value="">-- Pilih --</option>
                        <option value="LAKI-LAKI" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'LAKI-LAKI' ? 'selected' : '' }}>LAKI-LAKI</option>
                        <option value="PEREMPUAN" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'PEREMPUAN' ? 'selected' : '' }}>PEREMPUAN</option>
                    </select>
                    @error('jenis_kelamin')
                        <div style="font-size:11px;color:var(--danger);margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Keluhan Utama -->
                <div class="form-group" style="margin-bottom:24px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--text);margin-bottom:6px;">
                        Keluhan Utama <span style="font-weight:400;color:var(--text-muted);">(opsional)</span>
                    </label>
                    <textarea name="keluhan_utama" rows="3"
                        style="width:100%;border:1px solid var(--border);border-radius:7px;padding:10px 12px;font-size:13px;font-family:'Inter',sans-serif;color:var(--text);outline:none;transition:border-color .15s;background:var(--white);resize:vertical;"
                        placeholder="Deskripsi keluhan utama pasien">{{ old('keluhan_utama', $pasien->keluhan_utama) }}</textarea>
                </div>

                <!-- Actions -->
                <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:16px;border-top:1px solid var(--border);">
                    <a href="{{ route('admin.pasien.index') }}" class="toolbar-btn" style="text-decoration:none;">Batal</a>
                    <button type="submit" class="toolbar-btn primary">💾 Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
