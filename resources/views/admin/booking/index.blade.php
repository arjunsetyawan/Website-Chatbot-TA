@extends('layouts.admin')

@section('title', 'Booking Konsultasi')
@section('page-title', 'Booking Konsultasi')
@section('page-sub', 'Kelola semua jadwal reservasi pasien')

@section('content')
<div class="card">
    <div class="card-head">
        <div>
            <div class="card-title">Daftar Booking Konsultasi</div>
            <div class="card-subtitle">{{ $totalBookings }} Total booking · {{ $pendingBookings }} Menunggu konfirmasi</div>
        </div>
        <div class="table-toolbar" style="margin-top:0; border-top:none; padding-top:0;">
            <form action="{{ route('admin.booking.index') }}" method="GET" style="margin:0;">
                <input class="search-input" type="text" name="search" value="{{ request('search') }}" placeholder="Cari pasien / dokter...">
            </form>
        </div>
    </div>
    
    @if(session('success'))
        <div style="padding: 12px 16px; background: var(--success-bg); color: var(--success); border-bottom: 1px solid #bbf7d0; font-size: 13px;">
            ✓ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="padding: 12px 16px; background: var(--danger-bg); color: var(--danger); border-bottom: 1px solid #fecaca; font-size: 13px;">
            ✕ {{ session('error') }}
        </div>
    @endif

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Waktu Booking</th>
                    <th>Pasien</th>
                    <th>Dokter Spesialis</th>
                    <th>Keluhan Singkat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $b)
                <tr>
                    <td>
                        <div style="font-weight:600; color:var(--text);">
                            {{ \Carbon\Carbon::parse($b->tanggal_konsultasi)->format('d M Y') }}
                        </div>
                        <div style="font-size:11px; color:var(--text-muted); font-family:'JetBrains Mono',monospace;">
                            Jam: {{ $b->jam_booking ?? explode('-', $b->jam_praktik)[0] ?? '-' }}
                        </div>
                    </td>
                    <td>
                        <div style="color:var(--text);">{{ $b->pasien->nama ?? $b->user->name ?? 'Anonim' }}</div>
                        @if($b->pasien)
                            <div style="font-size:11px; color:var(--text-muted);">RM: {{ $b->pasien->no_rekam_medis ?? '-' }}</div>
                        @endif
                    </td>
                    <td>
                        <div style="color:var(--text);">{{ $b->nama_dokter }}</div>
                        <div style="font-size:11px; color:var(--text-muted);">{{ $b->poli }}</div>
                    </td>
                    <td>
                        <div style="max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; color:var(--text-muted);">
                            {{ $b->keluhan ?: '-' }}
                        </div>
                    </td>
                    <td>
                        @if($b->status == 'menunggu')
                            <span class="badge badge-warning">⏳ Menunggu</span>
                        @elseif($b->status == 'terkonfirmasi')
                            <span class="badge badge-success">✓ Terkonfirmasi</span>
                        @elseif($b->status == 'selesai')
                            <span class="badge badge-info">✔ Selesai</span>
                        @elseif($b->status == 'dibatalkan')
                            <span class="badge badge-danger">✕ Dibatalkan</span>
                        @elseif($b->status == 'kadaluwarsa')
                            <span class="badge badge-neutral">🕐 Kadaluwarsa</span>
                        @else
                            <span class="badge badge-info">{{ ucfirst($b->status) }}</span>
                        @endif
                    </td>
                    <td>
                        @if($b->status == 'menunggu')
                        <form action="{{ route('admin.booking.approve', $b->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Konfirmasi booking ini?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn" style="background:var(--success-bg); color:var(--success); border-color:#bbf7d0;">
                                ✓ Setujui
                            </button>
                        </form>
                        @elseif($b->status == 'kadaluwarsa')
                        <span style="font-size:11px; color:var(--text-light); font-style:italic;">🕐 Sudah terlewat</span>
                        @else
                        <span style="font-size:12px; color:var(--text-muted);">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:32px;color:var(--text-muted);">
                        Belum ada data booking konsultasi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="pagination">
        <div class="pagination-info">Menampilkan {{ $bookings->firstItem() ?? 0 }}–{{ $bookings->lastItem() ?? 0 }} dari {{ $bookings->total() }} booking</div>
        <div class="pagination-btns">
            @if ($bookings->onFirstPage())
                <button class="page-btn" disabled>‹</button>
            @else
                <a href="{{ $bookings->previousPageUrl() }}" class="page-btn">‹</a>
            @endif

            @foreach ($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="page-btn {{ $page == $bookings->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach

            @if ($bookings->hasMorePages())
                <a href="{{ $bookings->nextPageUrl() }}" class="page-btn">›</a>
            @else
                <button class="page-btn" disabled>›</button>
            @endif
        </div>
    </div>
</div>
@endsection
