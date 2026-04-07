@extends('layouts.admin')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')
@section('page-sub', 'Kelola akun user login sistem')

@section('content')
    <!-- Header -->
    <div class="section-row">
        <div class="section-title">Manajemen User</div>
        <a href="{{ route('admin.users.create') }}" class="toolbar-btn primary" style="text-decoration:none;">+ Tambah User</a>
    </div>

    <!-- User Table Card -->
    <div class="card" style="animation: fadeIn .35s ease both;">
        <div class="card-head">
            <div>
                <div class="card-title"><span class="card-title-icon">👤</span> Daftar User</div>
                <div class="card-subtitle">{{ $totalUsers }} total user terdaftar</div>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <div class="table-toolbar">
            <form action="{{ route('admin.users.index') }}" method="GET" style="display:flex;align-items:center;gap:8px;flex:1;">
                <input class="search-input" type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email user...">
                <select name="role" style="height:36px;border:1px solid var(--border);border-radius:7px;padding:0 10px;font-size:12px;font-family:'Inter',sans-serif;color:var(--text);outline:none;background:var(--white);min-width:120px;">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="pasien" {{ request('role') == 'pasien' ? 'selected' : '' }}>Pasien</option>
                </select>
                <button type="submit" class="toolbar-btn">🔍 Cari</button>
                @if(request('search') || request('role'))
                    <a href="{{ route('admin.users.index') }}" class="toolbar-btn">✕ Reset</a>
                @endif
            </form>
        </div>

        <!-- Table -->
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:50px;">No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="width:90px;">Role</th>
                        <th>Data Pasien</th>
                        <th style="width:130px;">Tanggal Daftar</th>
                        <th style="width:160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td><span style="font-family:'JetBrains Mono',monospace;font-size:11px;color:var(--text-muted);">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</span></td>
                        <td><span class="patient-name">{{ $user->name }}</span></td>
                        <td><span style="font-size:12px;color:var(--text-muted);">{{ $user->email }}</span></td>
                        <td>
                            <span style="display:inline-block;padding:3px 10px;border-radius:4px;font-size:10px;font-weight:600;text-transform:uppercase;
                                {{ $user->role === 'admin' ? 'background:#fef3c7;color:#92400e;' : 'background:#dbeafe;color:#1e40af;' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td>
                            @if($user->pasien)
                                <span style="font-size:11px;color:var(--primary);font-weight:500;">{{ $user->pasien->nama }}</span>
                                <br><span style="font-size:10px;color:var(--text-muted);font-family:'JetBrains Mono',monospace;">RM: {{ $user->pasien->no_rekam_medis }}</span>
                            @else
                                <span style="font-size:11px;color:var(--text-muted);">-</span>
                            @endif
                        </td>
                        <td><span style="font-size:12px;color:var(--text-muted);">{{ $user->created_at->format('d M Y') }}</span></td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="action-btn" title="Lihat Detail">👁 Detail</a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus user {{ $user->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn danger" title="Hapus User">🗑 Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:48px 16px;">
                            <div style="font-size:32px;margin-bottom:8px;">👤</div>
                            <div style="font-weight:600;color:var(--text);margin-bottom:4px;">Belum ada user</div>
                            <div style="font-size:12px;color:var(--text-muted);margin-bottom:12px;">Tambahkan user baru untuk memulai</div>
                            <a href="{{ route('admin.users.create') }}" class="toolbar-btn primary" style="display:inline-flex;text-decoration:none;">+ Tambah User</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
        <div class="pagination">
            <div class="pagination-info">Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }} dari {{ $users->total() }} user</div>
            <div class="pagination-btns">
                @if ($users->onFirstPage())
                    <button class="page-btn" disabled>‹</button>
                @else
                    <a href="{{ $users->appends(request()->query())->previousPageUrl() }}" class="page-btn">‹</a>
                @endif

                @foreach ($users->appends(request()->query())->getUrlRange(1, $users->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="page-btn {{ $page == $users->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                @endforeach

                @if ($users->hasMorePages())
                    <a href="{{ $users->appends(request()->query())->nextPageUrl() }}" class="page-btn">›</a>
                @else
                    <button class="page-btn" disabled>›</button>
                @endif
            </div>
        </div>
        @endif
    </div>
@endsection
