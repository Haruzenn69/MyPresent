<x-app-layout>
    @if($student)
    @php
    $details = $student->attendanceDetails;
    $hadir = $details->where('status', 'hadir')->count();
    $terlambat = $details->where('status', 'terlambat')->count();
    $sakit = $details->where('status', 'sakit')->count();
    $izin = $details->where('status', 'izin')->count();
    $alfa = $details->where('status', 'alfa')->count();
    $total = $details->count();
    $persen = $total > 0 ? round((($hadir + $terlambat) / $total) * 100) : 0;
    @endphp

    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            {{-- Profile Greeting --}}
            <div class="admin-card admin-card-hover" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.2);margin-bottom:24px;background:linear-gradient(135deg,var(--md-sys-color-surface-container-low),rgba(13,148,136,0.06));">
                <div>
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:16px;">
                        <span style="width:8px;height:8px;border-radius:50%;background:#10B981;flex-shrink:0;"></span>
                        <span style="font-size:13px;color:var(--md-sys-color-on-surface-variant);">Hai, selamat datang</span>
                        <span style="font-size:12px;color:var(--md-sys-color-on-surface-variant);opacity:0.5;">&middot;</span>
                        <span style="font-size:12px;color:var(--md-sys-color-on-surface-variant);">{{ date('d M Y') }}</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:20px;">
                        <div style="position:relative;">
                            <span style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--md-sys-color-secondary-container),#06B6D4);color:white;display:flex;align-items:center;justify-content:center;font-size:34px;font-weight:700;flex-shrink:0;box-shadow:0 0 0 3px var(--md-sys-color-surface),0 0 0 5px rgba(6,182,212,0.2);">{{ strtoupper(substr($student->nama, 0, 1)) }}</span>
                            <span style="position:absolute;bottom:-2px;left:50%;transform:translateX(-50%);display:flex;align-items:center;justify-content:center;">
                                <span style="position:absolute;inset:-3px;background:var(--md-sys-color-surface-container-low);border-radius:16px;"></span>
                                <span style="position:relative;background:rgba(139,92,246,0.2);color:#8B5CF6;font-size:11px;font-weight:600;padding:3px 12px;border-radius:12px;border:1px solid rgba(139,92,246,0.35);line-height:1.4;text-transform:capitalize;">Siswa</span>
                            </span>
                        </div>
                        <div>
                            <div style="font-size:24px;font-weight:600;color:var(--md-sys-color-on-surface);line-height:1.3;">{{ $student->nama }}</div>
                            <div style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin-top:4px;">NIS: {{ $student->nis }} &middot; {{ $student->kelas->nama_kelas ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stat Cards --}}
            <div class="row g-3 mb-4">
                <div class="col-6 col-lg-3">
                    <div class="admin-card admin-card-hover" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.25);">
                        <div style="width:40px;height:40px;border-radius:12px;background:rgba(13,148,136,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                        </div>
                        <div class="count-up" data-target="{{ $hadir }}" style="font-size:28px;font-weight:700;color:var(--md-sys-color-on-surface);line-height:1.2;">{{ $hadir }}</div>
                        <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);letter-spacing:0.5px;text-transform:uppercase;margin-top:4px;">Hadir</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="admin-card admin-card-hover" style="--card-border:#8B5CF6;--card-glow:rgba(139,92,246,0.25);">
                        <div style="width:40px;height:40px;border-radius:12px;background:rgba(139,92,246,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#8B5CF6" stroke-width="2"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
                        </div>
                        <div class="count-up" data-target="{{ $persen }}" data-suffix="%" style="font-size:28px;font-weight:700;color:var(--md-sys-color-on-surface);line-height:1.2;">{{ $persen }}%</div>
                        <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);letter-spacing:0.5px;text-transform:uppercase;margin-top:4px;">Kehadiran</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="admin-card admin-card-hover" style="--card-border:#F59E0B;--card-glow:rgba(245,158,11,0.25);">
                        <div style="width:40px;height:40px;border-radius:12px;background:rgba(245,158,11,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2"><path d="M12 6v6l4 2"/><circle cx="12" cy="12" r="10"/></svg>
                        </div>
                        <div class="count-up" data-target="{{ $sakit }}" style="font-size:28px;font-weight:700;color:var(--md-sys-color-on-surface);line-height:1.2;">{{ $sakit }}</div>
                        <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);letter-spacing:0.5px;text-transform:uppercase;margin-top:4px;">Sakit</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="admin-card admin-card-hover" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.25);">
                        <div style="width:40px;height:40px;border-radius:12px;background:rgba(239,68,68,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:10px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                        </div>
                        <div class="count-up" data-target="{{ $alfa }}" style="font-size:28px;font-weight:700;color:var(--md-sys-color-on-surface);line-height:1.2;">{{ $alfa }}</div>
                        <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);letter-spacing:0.5px;text-transform:uppercase;margin-top:4px;">Alfa</div>
                    </div>
                </div>
            </div>

            {{-- Absensi Terbaru --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.2);margin-bottom:20px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
                    <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Absensi Terbaru</span>
                    <a href="{{ route('siswa.absensi') }}" style="font-size:12px;font-weight:500;color:#0D9488;text-decoration:none;">Lihat Semua &rarr;</a>
                </div>
                @forelse($student->attendanceDetails->sortByDesc('created_at')->take(5) as $detail)
                <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--md-sys-color-outline-variant);">
                    <span style="font-size:13px;color:var(--md-sys-color-on-surface-variant);">
                        {{ \Carbon\Carbon::parse($detail->created_at)->isoFormat('D MMMM YYYY') }}
                    </span>
                    @php
                        $statusStyle = match($detail->status) {
                            'hadir' => 'background:rgba(16,185,129,0.15);color:#10B981;',
                            'izin' => 'background:rgba(6,182,212,0.15);color:#06B6D4;',
                            'sakit' => 'background:rgba(245,158,11,0.15);color:#F59E0B;',
                            'alfa' => 'background:rgba(239,68,68,0.15);color:#EF4444;',
                            'terlambat' => 'background:rgba(99,102,241,0.15);color:#6366F1;',
                            default => 'background:rgba(255,255,255,0.1);color:var(--md-sys-color-on-surface-variant);',
                        };
                    @endphp
                    <span style="{{ $statusStyle }}font-size:11px;font-weight:600;padding:3px 12px;border-radius:20px;">
                        {{ ucfirst($detail->status) }}
                    </span>
                </div>
                @empty
                <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:0;">Belum ada data absensi.</p>
                @endforelse
            </div>

        </div>
    </div>
    @endif
</x-app-layout>
