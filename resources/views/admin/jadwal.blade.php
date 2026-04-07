@extends('layouts.admin')

@section('title', 'Jadwal Dokter')
@section('page-title', 'Jadwal Dokter Aktif')
@section('page-sub', 'Data jadwal poliklinik dari SIMRS terintegrasi')

@section('content')
    <!-- Header & Filter -->
    <div class="section-row">
        <div class="section-title">Jadwal Praktek Dokter</div>
    </div>

    @if($apiError)
        <div class="alert-banner alert-danger" style="margin-bottom:16px;padding:12px 18px;background:var(--danger-bg);border:1px solid #fecaca;border-radius:8px;color:var(--danger);font-size:12.5px;font-weight:600;display:flex;align-items:center;gap:8px;">
            ⚠️ {{ $apiError }}
        </div>
    @endif

    <div class="card" style="animation: fadeIn .35s ease both;">
        <div class="card-head">
            <div>
                <div class="card-title"><span class="card-title-icon">👨‍⚕️</span> Data Jadwal Dokter</div>
                <div class="card-subtitle">Menampilkan jadwal berdasarkan API Eklaim RSUD Sultan Fatah</div>
            </div>
            
            <!-- Date & Poli Filter Auto-Submit Form -->
            <form action="{{ route('admin.jadwal-dokter') }}" method="GET" id="filterForm" style="display:flex;align-items:center;gap:16px;">
                <div style="display:flex;align-items:center;gap:8px;">
                    <label style="font-size:12px;font-weight:600;color:var(--text-muted);">Pilih Tanggal:</label>
                    <input type="date" name="date" value="{{ $selectedDate }}" onchange="document.getElementById('filterForm').submit()"
                        style="height:32px;border:1px solid var(--border);border-radius:6px;padding:0 10px;font-size:12px;font-family:'Inter',sans-serif;color:var(--text);outline:none;background:var(--bg);">
                </div>
                <div style="display:flex;align-items:center;gap:8px;">
                    <label style="font-size:12px;font-weight:600;color:var(--text-muted);">Poliklinik:</label>
                    <select name="poli" onchange="document.getElementById('filterForm').submit()"
                        style="height:32px;border:1px solid var(--border);border-radius:6px;padding:0 10px;font-size:12px;font-family:'Inter',sans-serif;color:var(--text);outline:none;background:var(--bg);max-width:220px;">
                        <option value="">Semua Poliklinik</option>
                        @foreach($layananList as $layanan)
                            <option value="{{ $layanan }}" {{ $selectedPoli == $layanan ? 'selected' : '' }}>{{ $layanan }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:25%">Poliklinik</th>
                        <th style="width:35%">Nama Dokter</th>
                        <th style="width:15%">Hari Praktik</th>
                        <th style="width:25%">Jam Kerja</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataJadwal as $jadwal)
                    <tr>
                        <td>
                            <div style="font-weight:600;color:var(--text);font-size:12px;">{{ $jadwal['FS_NM_LAYANAN'] ?? '-' }}</div>
                            <div style="font-size:10px;color:var(--text-muted);font-family:'JetBrains Mono',monospace;">{{ $jadwal['FS_KD_LAYANAN'] ?? '' }}</div>
                        </td>
                        <td>
                            <div style="font-weight:600;color:var(--text);display:flex;align-items:center;gap:8px;">
                                <div style="width:28px;height:28px;border-radius:6px;background:var(--bg);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0;">👨‍⚕️</div>
                                {{ $jadwal['FS_NM_DOKTER'] ?? '-' }}
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-info">{{ $jadwal['FS_NM_HARI'] ?? '-' }}</span>
                        </td>
                        <td>
                            <div style="font-family:'JetBrains Mono',monospace;font-size:12px;font-weight:500;color:var(--text);">
                                {{ $jadwal['jadwal'] ?? '-' }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align:center;padding:48px 16px;">
                            <div style="font-size:32px;margin-bottom:8px;">🗓️</div>
                            <div style="font-weight:600;color:var(--text);margin-bottom:4px;">Jadwal Tidak Ditemukan</div>
                            <div style="font-size:12px;color:var(--text-muted);">Tidak ada jadwal dokter untuk tanggal <strong>{{ \Carbon\Carbon::parse($selectedDate)->format('d F Y') }}</strong>.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(count($dataJadwal) > 0)
        <div class="pagination">
            <div class="pagination-info">Menampilkan {{ count($dataJadwal) }} dokter terjadwal</div>
            <div class="pagination-btns">
                <span style="font-size:11px;color:var(--success);font-weight:600;display:flex;align-items:center;gap:4px;">
                    <span class="dot dot-success"></span> Tersinkronisasi dengan SIMRS
                </span>
            </div>
        </div>
        @endif
    </div>
@endsection
