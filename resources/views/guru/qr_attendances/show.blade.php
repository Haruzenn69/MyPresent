<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">QR Code Absensi</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Detail QR absensi {{ $attendance->kelas->nama_kelas }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('guru.qr-attendances.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali
                    </a>
                </div>
            </div>

            @if(session('success'))
            <div class="admin-card" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.2);margin-bottom:20px;padding:16px 20px;display:flex;align-items:center;gap:10px;">
                <span style="width:6px;height:6px;border-radius:50%;background:#10B981;flex-shrink:0;"></span>
                <span style="font-size:14px;color:var(--md-sys-color-on-surface);">{{ session('success') }}</span>
            </div>
            @endif

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;">
                        <h3 style="font-size:18px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0 0 20px;">Info Absensi</h3>
                        <table style="width:100%;border-collapse:collapse;">
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <td style="padding:10px 0;font-size:13px;color:var(--md-sys-color-on-surface-variant);">Kelas</td>
                                <td style="padding:10px 0;font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);text-align:right;">{{ $attendance->kelas->nama_kelas }}</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <td style="padding:10px 0;font-size:13px;color:var(--md-sys-color-on-surface-variant);">Tanggal</td>
                                <td style="padding:10px 0;font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);text-align:right;">{{ $attendance->tanggal->format('Y-m-d') }}</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <td style="padding:10px 0;font-size:13px;color:var(--md-sys-color-on-surface-variant);">Dibuat</td>
                                <td style="padding:10px 0;font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);text-align:right;">{{ $attendance->created_at->format('H:i') }}</td>
                            </tr>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <td style="padding:10px 0;font-size:13px;color:var(--md-sys-color-on-surface-variant);">Kadaluwarsa</td>
                                <td style="padding:10px 0;font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);text-align:right;">
                                    @if($attendance->qr_expires_at)
                                        {{ $attendance->qr_expires_at->format('H:i') }}
                                        @if(now()->greaterThan($attendance->qr_expires_at))
                                            <span style="background:rgba(239,68,68,0.12);color:#EF4444;border:none;border-radius:10px;padding:4px 10px;font-size:11px;font-weight:600;display:inline-block;margin-left:6px;">Kedaluwarsa</span>
                                        @endif
                                    @else
                                        <span style="color:var(--md-sys-color-on-surface-variant);font-weight:400;">Tanpa batas</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:10px 0;font-size:13px;color:var(--md-sys-color-on-surface-variant);border:none;">Total Hadir</td>
                                <td style="padding:10px 0;font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);text-align:right;border:none;">{{ $attendance->details->count() }}</td>
                            </tr>
                        </table>
                        <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:16px 0 4px;">URL Scan:</p>
                        <a href="{{ $attendance->qr_code_path }}" target="_blank" style="font-size:12px;color:var(--md-sys-color-primary);word-break:break-all;">{{ $attendance->qr_code_path }}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;text-align:center;">
                        <h3 style="font-size:18px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0 0 20px;text-align:left;">QR Code</h3>
                        <img src="{{ $qrData }}" alt="QR Code" style="max-width:300px;width:100%;">
                        <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin-top:12px;">Scan QR ini untuk absensi siswa</p>
                    </div>
                </div>
            </div>

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);margin-top:20px;padding:0;">
                <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Siswa yang sudah absen ({{ $attendance->details->count() }})</span>
                </div>
                <div class="table-responsive">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">No</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">NIS</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Nama</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendance->details as $d)
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);transition:background 0.15s;" onmouseover="this.style.background='var(--md-sys-color-surface-container-low)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:14px 20px;font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);">{{ $loop->iteration }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $d->student->nis }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $d->student->nama }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $d->created_at->format('H:i:s') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="padding:60px 20px;text-align:center;">
                                    <div style="width:56px;height:56px;border-radius:16px;background:var(--md-sys-color-surface-container-low);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="1.5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                    </div>
                                    <p style="font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);margin:0 0 4px;">Belum ada siswa yang absen.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
