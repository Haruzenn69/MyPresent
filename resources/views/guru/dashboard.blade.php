<x-app-layout>
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
                            <span style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--md-sys-color-primary-container),#0D9488);color:white;display:flex;align-items:center;justify-content:center;font-size:34px;font-weight:700;flex-shrink:0;box-shadow:0 0 0 3px var(--md-sys-color-surface),0 0 0 5px rgba(13,148,136,0.2);">{{ strtoupper(substr(Auth::user()->name ?? 'G', 0, 1)) }}</span>
                            <span style="position:absolute;bottom:-2px;left:50%;transform:translateX(-50%);display:flex;align-items:center;justify-content:center;">
                                <span style="position:absolute;inset:-3px;background:var(--md-sys-color-surface-container-low);border-radius:16px;"></span>
                                <span style="position:relative;background:rgba(59,130,246,0.2);color:#3B82F6;font-size:11px;font-weight:600;padding:3px 12px;border-radius:12px;border:1px solid rgba(59,130,246,0.35);line-height:1.4;text-transform:capitalize;">Guru</span>
                            </span>
                        </div>
                        <div>
                            <div style="font-size:24px;font-weight:600;color:var(--md-sys-color-on-surface);line-height:1.3;">{{ Auth::user()->name ?? 'Guru' }}</div>
                            <div style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin-top:4px;">{{ Auth::user()->email ?? '' }}</div>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 overflow-x-auto scrollbar-hide pt-3 mt-3 border-top" style="border-color:var(--md-sys-color-outline-variant) !important;">
                    <a href="{{ route('guru.attendances.index') }}" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;flex-shrink:0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                        Buat Absensi
                    </a>
                    <a href="{{ route('guru.qr-attendances.index') }}" style="background:rgba(99,102,241,0.15);color:#6366F1;border:1px solid rgba(99,102,241,0.25);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;flex-shrink:0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                        Scan QR
                    </a>
                    <a href="{{ route('guru.students.index') }}" style="background:rgba(13,148,136,0.15);color:#0D9488;border:1px solid rgba(13,148,136,0.25);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;flex-shrink:0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        Lihat Siswa
                    </a>
                    <a href="{{ route('guru.classes.index') }}" style="background:rgba(245,158,11,0.15);color:#F59E0B;border:1px solid rgba(245,158,11,0.25);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;flex-shrink:0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        Kelas Saya
                    </a>
                </div>
            </div>

            {{-- Stat Cards --}}
            <div class="row g-3 mb-4">
                <div class="col-6 col-lg-3">
                    <div class="admin-card admin-card-hover" style="--card-border:#6366F1;--card-glow:rgba(99,102,241,0.25);">
                        <div style="width:40px;height:40px;border-radius:12px;background:rgba(99,102,241,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2"><path d="M21 12a9 9 0 0 1-9 9m9-9a9 9 0 0 0-9-9m9 9H3m9 9a9 9 0 0 1-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 0 1 9-9"/></svg>
                        </div>
                        <div class="count-up" data-target="{{ $totalAbsensi }}" style="font-size:28px;font-weight:700;color:var(--md-sys-color-on-surface);line-height:1.2;">{{ $totalAbsensi }}</div>
                        <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);letter-spacing:0.5px;text-transform:uppercase;margin-top:4px;">Total Absensi</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="admin-card admin-card-hover" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.25);">
                        <div style="width:40px;height:40px;border-radius:12px;background:rgba(16,185,129,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                        </div>
                        <div class="count-up" data-target="{{ $kehadiranHariIni }}" style="font-size:28px;font-weight:700;color:var(--md-sys-color-on-surface);line-height:1.2;">{{ $kehadiranHariIni }}</div>
                        <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);letter-spacing:0.5px;text-transform:uppercase;margin-top:4px;">Kehadiran Hari Ini</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="admin-card admin-card-hover" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.25);">
                        <div style="width:40px;height:40px;border-radius:12px;background:rgba(13,148,136,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div class="count-up" data-target="{{ $siswaDiabsen }}" style="font-size:28px;font-weight:700;color:var(--md-sys-color-on-surface);line-height:1.2;">{{ $siswaDiabsen }}</div>
                        <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);letter-spacing:0.5px;text-transform:uppercase;margin-top:4px;">Siswa Diabsen</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="admin-card admin-card-hover" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.25);">
                        <div style="width:40px;height:40px;border-radius:12px;background:rgba(239,68,68,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2"><path d="M12 9v4"/><path d="M12 17h.01"/><path d="M10.29 3.86l-8.6 14.89A1.73 1.73 0 0 0 3.17 21h17.66a1.73 1.73 0 0 0 1.48-2.25l-8.6-14.89a1.73 1.73 0 0 0-3.42 0z"/></svg>
                        </div>
                        <div class="count-up" data-target="{{ $peringatanCount }}" style="font-size:28px;font-weight:700;color:var(--md-sys-color-on-surface);line-height:1.2;">{{ $peringatanCount }}</div>
                        <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);letter-spacing:0.5px;text-transform:uppercase;margin-top:4px;">Peringatan</div>
                    </div>
                </div>
            </div>

            {{-- Ringkasan Kehadiran --}}
            @if(isset($myClassStats) && $myClassStats)
            <div class="admin-card admin-card-hover" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.2);margin-bottom:20px;">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
                    <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Kehadiran Hari Ini</span>
                    <span style="font-size:12px;color:var(--md-sys-color-on-surface-variant);opacity:0.5;">&middot;</span>
                    <span style="font-size:12px;color:var(--md-sys-color-primary);font-weight:500;">{{ $myClassStats->nama_kelas ?? '-' }}</span>
                </div>
                <p style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin:0 0 16px;">{{ now()->isoFormat('D MMMM YYYY') }} &middot; <strong style="color:var(--md-sys-color-on-surface);">{{ $myClassStats->total_siswa ?? 0 }}</strong> siswa</p>

                @if(isset($todayAttendance) && $todayAttendance)
                <div class="row g-2">
                    @php
                    $stats = [
                        ['label' => 'Hadir', 'value' => $todayAttendance->hadir_count, 'color' => '#10B981', 'pill' => 'rgba(16,185,129,0.15)'],
                        ['label' => 'Izin', 'value' => $todayAttendance->izin_count, 'color' => '#06B6D4', 'pill' => 'rgba(6,182,212,0.15)'],
                        ['label' => 'Sakit', 'value' => $todayAttendance->sakit_count, 'color' => '#F59E0B', 'pill' => 'rgba(245,158,11,0.15)'],
                        ['label' => 'Alfa', 'value' => $todayAttendance->alfa_count, 'color' => '#EF4444', 'pill' => 'rgba(239,68,68,0.15)'],
                        ['label' => 'Telat', 'value' => $todayAttendance->terlambat_count, 'color' => '#6366F1', 'pill' => 'rgba(99,102,241,0.15)'],
                    ];
                    @endphp
                    @foreach($stats as $i => $s)
                    <div class="col-12 col-md">
                        <div style="text-align:center;padding:12px 8px;border-radius:12px;background:{{ $s['pill'] }};">
                            <div class="count-up" data-target="{{ $s['value'] }}" style="font-size:20px;font-weight:700;color:{{ $s['color'] }};line-height:1.2;">{{ $s['value'] }}</div>
                            <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);margin-top:4px;">{{ $s['label'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:0;">Belum ada data absensi hari ini.</p>
                @endif
            </div>
            @endif

            {{-- Tren Kehadiran --}}
            <div class="admin-card admin-card-hover" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.2);margin-bottom:20px;">
                <div style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);margin-bottom:12px;">Tren Kehadiran (7 Hari Terakhir)</div>
                <div class="overflow-x-auto">
                    <div style="min-width:350px;height:180px;">
                        <canvas id="guruChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Peringatan --}}
            @if(isset($warningStudents) && $warningStudents->count() > 0)
            <div class="admin-card admin-card-hover" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.2);margin-bottom:20px;border-left:3px solid #EF4444;">
                <div style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:600;color:#F87171;margin-bottom:12px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#F87171" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                    Peringatan Ketidakhadiran (Alfa &ge; 3 Kali)
                </div>
                @foreach($warningStudents as $student)
                <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 12px;border-radius:8px;background:rgba(239,68,68,0.1);margin-bottom:6px;">
                    <div style="min-width:0;">
                        <div style="font-size:13px;font-weight:500;color:var(--md-sys-color-on-surface);">{{ $student->nama }} ({{ $student->nis }})</div>
                        <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);">Kelas: {{ $student->kelas->nama_kelas ?? '-' }}</div>
                    </div>
                    <span style="background:rgba(239,68,68,0.2);color:#F87171;font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;white-space:nowrap;">
                        {{ $student->alfa_count }} Kali Alfa
                    </span>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('guruChart');
            if (!ctx) return;
            var isDark = document.documentElement.classList.contains('dark');
            var isMobile = window.innerWidth < 576;
            var tickColor = isDark ? 'rgba(255,255,255,0.5)' : 'rgba(0,0,0,0.5)';
            var gridColor = isDark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.06)';
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartData['labels'] ?? []),
                    datasets: [{
                        label: 'Siswa Hadir',
                        data: @json($chartData['values'] ?? []),
                        borderColor: '#0D9488',
                        backgroundColor: 'rgba(13,148,136,0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: isMobile ? 2 : 3,
                        pointBackgroundColor: '#0D9488'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { color: tickColor, font: { size: isMobile ? 9 : 11 }, stepSize: 1, precision: 0 },
                            grid: { color: gridColor }
                        },
                        x: {
                            ticks: { color: tickColor, font: { size: isMobile ? 8 : 11 }, maxRotation: 0 },
                            grid: { display: false }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
