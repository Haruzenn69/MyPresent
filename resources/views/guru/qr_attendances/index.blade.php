<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Absensi via QR Code</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Daftar absensi QR Code</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('guru.qr-attendances.create') }}" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        + Buat QR Absensi
                    </a>
                </div>
            </div>

            @if(session('success'))
            <div class="admin-card" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.2);margin-bottom:20px;padding:16px 20px;display:flex;align-items:center;gap:10px;">
                <span style="width:6px;height:6px;border-radius:50%;background:#10B981;flex-shrink:0;"></span>
                <span style="font-size:14px;color:var(--md-sys-color-on-surface);">{{ session('success') }}</span>
            </div>
            @endif
            @if(session('error'))
            <div class="admin-card" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.2);margin-bottom:20px;padding:16px 20px;display:flex;align-items:center;gap:10px;">
                <span style="width:6px;height:6px;border-radius:50%;background:#EF4444;flex-shrink:0;"></span>
                <span style="font-size:14px;color:var(--md-sys-color-on-surface);">{{ session('error') }}</span>
            </div>
            @endif

            {{-- QR Attendances Table --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:0;">
                <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Daftar QR Absensi</span>
                </div>
                <div class="table-responsive">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Tanggal</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Kelas</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Status</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">QR Code</th>
                                <th style="padding:12px 20px;text-align:right;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $a)
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);transition:background 0.15s;" onmouseover="this.style.background='var(--md-sys-color-surface-container-low)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:14px 20px;font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);">{{ $a->tanggal->format('Y-m-d') }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $a->kelas->nama_kelas }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">
                                    @if($a->qr_expires_at && now()->greaterThan($a->qr_expires_at))
                                        <span style="background:rgba(239,68,68,0.12);color:#EF4444;border:none;border-radius:10px;padding:4px 10px;font-size:11px;font-weight:600;display:inline-block;">Kedaluwarsa</span>
                                    @elseif($a->qr_expires_at)
                                        <span style="background:rgba(16,185,129,0.12);color:#10B981;border:none;border-radius:10px;padding:4px 10px;font-size:11px;font-weight:600;display:inline-block;">Aktif</span>
                                        <small style="display:block;margin-top:2px;font-size:11px;color:var(--md-sys-color-on-surface-variant);">s/d {{ $a->qr_expires_at->format('H:i') }}</small>
                                    @else
                                        <span style="background:rgba(100,116,139,0.12);color:var(--md-sys-color-on-surface-variant);border:none;border-radius:10px;padding:4px 10px;font-size:11px;font-weight:600;display:inline-block;">Tanpa batas</span>
                                    @endif
                                </td>
                                <td style="padding:14px 20px;">
                                    <a href="{{ route('guru.qr-attendances.show', $a) }}" style="background:rgba(13,148,136,0.12);color:#0D9488;border:none;border-radius:10px;padding:6px 12px;font-size:12px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">Lihat QR</a>
                                </td>
                                <td style="padding:14px 20px;text-align:right;">
                                    <form action="{{ route('guru.qr-attendances.destroy', $a) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" style="background:rgba(239,68,68,0.12);color:#EF4444;border:none;border-radius:10px;padding:6px 12px;font-size:12px;font-weight:500;display:inline-flex;align-items:center;gap:4px;cursor:pointer;">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="padding:60px 20px;text-align:center;">
                                    <div style="width:56px;height:56px;border-radius:16px;background:var(--md-sys-color-surface-container-low);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                                    </div>
                                    <p style="font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);margin:0 0 4px;">Belum ada QR absensi.</p>
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
