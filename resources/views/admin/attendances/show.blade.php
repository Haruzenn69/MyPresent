<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">
            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Detail Absensi</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">{{ $attendance->kelas->nama_kelas }} &bull; {{ \Carbon\Carbon::parse($attendance->tanggal)->isoFormat('dddd, D MMMM YYYY') }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.attendances.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali
                    </a>
                </div>
            </div>

            {{-- Info Guru & Tanggal --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;margin-bottom:20px;">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:40px;height:40px;border-radius:50%;background:rgba(13,148,136,0.15);display:flex;align-items:center;justify-content:center;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                            <div>
                                <p style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:0 0 2px;">Guru Pengampu</p>
                                <p style="font-size:15px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">{{ $attendance->guru->nama }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:40px;height:40px;border-radius:50%;background:rgba(13,148,136,0.15);display:flex;align-items:center;justify-content:center;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            </div>
                            <div>
                                <p style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:0 0 2px;">Tanggal</p>
                                <p style="font-size:15px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">{{ \Carbon\Carbon::parse($attendance->tanggal)->isoFormat('dddd, D MMMM YYYY') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status Summary --}}
            @php
            $total = $attendance->details->count();
            $hadir = $attendance->details->where('status', 'hadir')->count();
            $izin = $attendance->details->where('status', 'izin')->count();
            $sakit = $attendance->details->where('status', 'sakit')->count();
            $alfa = $attendance->details->where('status', 'alfa')->count();
            $terlambat = $attendance->details->where('status', 'terlambat')->count();
            @endphp
            <div class="row g-3 mb-4">
                <div class="col-md-2 col-6">
                    <div class="admin-card" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.15);padding:16px;text-align:center;">
                        <span style="font-size:22px;font-weight:700;color:#10B981;">{{ $hadir }}</span>
                        <p style="font-size:11px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Hadir</p>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="admin-card" style="--card-border:#06B6D4;--card-glow:rgba(6,182,212,0.15);padding:16px;text-align:center;">
                        <span style="font-size:22px;font-weight:700;color:#06B6D4;">{{ $izin }}</span>
                        <p style="font-size:11px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Izin</p>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="admin-card" style="--card-border:#F59E0B;--card-glow:rgba(245,158,11,0.15);padding:16px;text-align:center;">
                        <span style="font-size:22px;font-weight:700;color:#F59E0B;">{{ $sakit }}</span>
                        <p style="font-size:11px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Sakit</p>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="admin-card" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.15);padding:16px;text-align:center;">
                        <span style="font-size:22px;font-weight:700;color:#EF4444;">{{ $alfa }}</span>
                        <p style="font-size:11px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Alfa</p>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="admin-card" style="--card-border:#6366F1;--card-glow:rgba(99,102,241,0.15);padding:16px;text-align:center;">
                        <span style="font-size:22px;font-weight:700;color:#6366F1;">{{ $terlambat }}</span>
                        <p style="font-size:11px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Terlambat</p>
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <div class="admin-card" style="--card-border:var(--md-sys-color-outline-variant);--card-glow:none;padding:16px;text-align:center;">
                        <span style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);">{{ $total }}</span>
                        <p style="font-size:11px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Total</p>
                    </div>
                </div>
            </div>

            {{-- Detail Siswa Table --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:0;">
                <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Daftar Siswa</span>
                    <span style="font-size:12px;color:var(--md-sys-color-on-surface-variant);">{{ $total }} siswa</span>
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Nama Siswa</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Status</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendance->details as $detail)
                            @php
                            $pillStyle = match($detail->status) {
                                'hadir' => 'background:rgba(16,185,129,0.15);color:#10B981;',
                                'izin' => 'background:rgba(6,182,212,0.15);color:#06B6D4;',
                                'sakit' => 'background:rgba(245,158,11,0.15);color:#F59E0B;',
                                'alfa' => 'background:rgba(239,68,68,0.15);color:#EF4444;',
                                'terlambat' => 'background:rgba(99,102,241,0.15);color:#6366F1;',
                                default => 'background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);',
                            };
                            @endphp
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);transition:background 0.15s;" onmouseover="this.style.background='var(--md-sys-color-surface-container)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:14px 20px;font-size:13px;font-weight:500;color:var(--md-sys-color-on-surface);">{{ $detail->student->nama }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">
                                    <span style="display:inline-block;padding:4px 14px;border-radius:20px;font-size:12px;font-weight:500;{{ $pillStyle }}">{{ ucfirst($detail->status) }}</span>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $detail->keterangan ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
