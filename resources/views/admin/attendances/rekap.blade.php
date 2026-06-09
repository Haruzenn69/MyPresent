<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">
            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Rekapitulasi Kehadiran</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Rekap kehadiran per kelas dalam periode tertentu</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.attendances.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali ke Riwayat
                    </a>
                </div>
            </div>

            {{-- Filter Card --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;margin-bottom:20px;">
                <form method="GET" action="{{ route('admin.attendances.rekap') }}">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="start_date" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Dari Tanggal</label>
                            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Sampai Tanggal</label>
                            <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;width:100%;">Filter Periode</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Table Card --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:0;">
                <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Rekap Per Kelas</span>
                    <span style="font-size:12px;color:var(--md-sys-color-on-surface-variant);">{{ count($summary) }} kelas</span>
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Kelas</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Total Siswa</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Hadir</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Izin</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Sakit</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Alfa</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Terlambat</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($summary as $row)
                            @php
                            $total_entries = $row['total_siswa'];
                            $percentage = $total_entries > 0 ? round((($row['hadir'] + $row['terlambat']) / $total_entries) * 100, 1) : 0;
                            @endphp
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);transition:background 0.15s;" onmouseover="this.style.background='var(--md-sys-color-surface-container)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:14px 20px;font-size:13px;font-weight:600;color:var(--md-sys-color-on-surface);">{{ $row['kelas'] }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">{{ $total_entries }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">
                                    <span style="display:inline-block;padding:2px 10px;border-radius:10px;font-size:12px;font-weight:500;background:rgba(16,185,129,0.15);color:#10B981;">{{ $row['hadir'] }}</span>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">
                                    <span style="display:inline-block;padding:2px 10px;border-radius:10px;font-size:12px;font-weight:500;background:rgba(6,182,212,0.15);color:#06B6D4;">{{ $row['izin'] }}</span>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">
                                    <span style="display:inline-block;padding:2px 10px;border-radius:10px;font-size:12px;font-weight:500;background:rgba(245,158,11,0.15);color:#F59E0B;">{{ $row['sakit'] }}</span>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">
                                    <span style="display:inline-block;padding:2px 10px;border-radius:10px;font-size:12px;font-weight:500;background:rgba(239,68,68,0.15);color:#EF4444;">{{ $row['alfa'] }}</span>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">
                                    <span style="display:inline-block;padding:2px 10px;border-radius:10px;font-size:12px;font-weight:500;background:rgba(99,102,241,0.15);color:#6366F1;">{{ $row['terlambat'] }}</span>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">
                                    <span style="font-weight:600;color:var(--md-sys-color-on-surface);">{{ $percentage }}%</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
