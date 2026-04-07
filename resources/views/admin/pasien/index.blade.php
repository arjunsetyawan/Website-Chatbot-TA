@extends('layouts.admin')

@section('title', 'Data Pasien')
@section('page-title', 'Data Pasien')
@section('page-sub', 'Kelola data pasien terdaftar')

@section('content')
    <!-- Header -->
    <div class="section-row">
        <div class="section-title">Data Pasien Terdaftar</div>
        <a href="{{ route('admin.pasien.create') }}" class="toolbar-btn primary" style="text-decoration:none;">+ Tambah Data Pasien</a>
    </div>

    <!-- Patient Table Card -->
    <div class="card" style="animation: fadeIn .35s ease both;">
        <div class="card-head">
            <div>
                <div class="card-title"><span class="card-title-icon">🏥</span> Daftar Data Pasien</div>
                <div class="card-subtitle">{{ $totalPasien }} total data pasien terdaftar</div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="table-toolbar">
            <form action="{{ route('admin.pasien.index') }}" method="GET" style="display:flex;align-items:center;gap:8px;flex:1;">
                <input class="search-input" type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, no rekam medis, NIK, alamat...">
                <button type="submit" class="toolbar-btn">🔍 Cari</button>
                @if(request('search'))
                    <a href="{{ route('admin.pasien.index') }}" class="toolbar-btn">✕ Reset</a>
                @endif
            </form>
        </div>

        <!-- Table -->
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:140px;">No. Rekam Medis</th>
                        <th style="width:140px;">No. Registrasi</th>
                        <th style="width:140px;">NIK</th>
                        <th>Nama</th>
                        <th style="width:90px;">Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Keluhan Utama</th>
                        <th style="width:220px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pasiens as $pasien)
                    <tr>
                        <td><span class="patient-id">{{ $pasien->no_rekam_medis }}</span></td>
                        <td><span style="font-family:'JetBrains Mono',monospace;font-size:11px;color:var(--primary);font-weight:500;">{{ $pasien->no_registrasi }}</span></td>
                        <td><span style="font-family:'JetBrains Mono',monospace;font-size:11px;color:var(--text-muted);">{{ $pasien->nik }}</span></td>
                        <td><span class="patient-name">{{ $pasien->nama }}</span></td>
                        <td>
                            <span style="display:inline-block;padding:2px 8px;border-radius:4px;font-size:10px;font-weight:600;
                                {{ $pasien->jenis_kelamin === 'LAKI-LAKI' ? 'background:#dbeafe;color:#1e40af;' : 'background:#fce7f3;color:#9d174d;' }}">
                                {{ $pasien->jenis_kelamin === 'LAKI-LAKI' ? 'L' : 'P' }}
                            </span>
                        </td>
                        <td><span style="font-size:11.5px;color:var(--text-muted);display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $pasien->alamat }}</span></td>
                        <td><span style="font-size:11.5px;color:var(--text-muted);display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $pasien->keluhan_utama ?? '-' }}</span></td>
                        <td>
                            <div style="display:flex;align-items:center;gap:4px;flex-wrap:nowrap;">
                                <a href="{{ route('admin.pasien.show', $pasien->id) }}" class="action-btn" title="Lihat Detail" style="display:inline-flex;align-items:center;gap:2px;">👁 Lihat</a>
                                <a href="{{ route('admin.pasien.edit', $pasien->id) }}" class="action-btn" title="Edit Data Pasien" style="display:inline-flex;align-items:center;gap:2px;">✏ Edit</a>
                                <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST" style="display:inline-flex;margin:0;" onsubmit="return confirm('Yakin ingin menghapus data pasien {{ $pasien->nama }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn danger" title="Hapus Data Pasien" style="display:inline-flex;align-items:center;gap:2px;">🗑 Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center;padding:48px 16px;">
                            <div style="font-size:32px;margin-bottom:8px;">📋</div>
                            <div style="font-weight:600;color:var(--text);margin-bottom:4px;">Belum ada data pasien</div>
                            <div style="font-size:12px;color:var(--text-muted);margin-bottom:12px;">Tambahkan data pasien baru untuk memulai</div>
                            <a href="{{ route('admin.pasien.create') }}" class="toolbar-btn primary" style="display:inline-flex;text-decoration:none;">+ Tambah Data Pasien</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pasiens->hasPages())
        <div class="pagination">
            <div class="pagination-info">Menampilkan {{ $pasiens->firstItem() }}–{{ $pasiens->lastItem() }} dari {{ $pasiens->total() }} data pasien</div>
            <div class="pagination-btns">
                @if ($pasiens->onFirstPage())
                    <button class="page-btn" disabled>‹</button>
                @else
                    <a href="{{ $pasiens->appends(request()->query())->previousPageUrl() }}" class="page-btn">‹</a>
                @endif

                @foreach ($pasiens->appends(request()->query())->getUrlRange(1, $pasiens->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="page-btn {{ $page == $pasiens->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                @endforeach

                @if ($pasiens->hasMorePages())
                    <a href="{{ $pasiens->appends(request()->query())->nextPageUrl() }}" class="page-btn">›</a>
                @else
                    <button class="page-btn" disabled>›</button>
                @endif
            </div>
        </div>
        @endif
    </div>
@endsection
