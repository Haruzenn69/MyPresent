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
                            <span style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--md-sys-color-primary-container),#0D9488);color:white;display:flex;align-items:center;justify-content:center;font-size:34px;font-weight:700;flex-shrink:0;box-shadow:0 0 0 3px var(--md-sys-color-surface),0 0 0 5px rgba(13,148,136,0.2);">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</span>
                            <span style="position:absolute;bottom:-2px;left:50%;transform:translateX(-50%);display:flex;align-items:center;justify-content:center;">
    <span style="position:absolute;inset:-3px;background:var(--md-sys-color-surface-container-low);border-radius:16px;"></span>
    <span style="position:relative;background:rgba(245,158,11,0.2);color:#F59E0B;font-size:11px;font-weight:600;padding:3px 12px;border-radius:12px;border:1px solid rgba(245,158,11,0.35);line-height:1.4;text-transform:capitalize;">{{ Auth::user()->role ?? 'admin' }}</span>
</span>
                        </div>
                        <div>
                            <div style="font-size:24px;font-weight:600;color:var(--md-sys-color-on-surface);line-height:1.3;">{{ Auth::user()->name ?? 'Admin' }}</div>
                            <div style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin-top:4px;">{{ Auth::user()->email ?? '' }}</div>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 overflow-x-auto scrollbar-hide pt-3 mt-3 border-top" style="border-color:var(--md-sys-color-outline-variant) !important;">
                    <a href="{{ route('admin.users.create') }}" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;flex-shrink:0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        Tambah Akun
                    </a>
                    <a href="{{ route('admin.classes.create') }}" style="background:rgba(13,148,136,0.15);color:#0D9488;border:1px solid rgba(13,148,136,0.25);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;flex-shrink:0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        Tambah Kelas
                    </a>
                    <a href="{{ route('admin.laporan.index') }}" style="background:rgba(99,102,241,0.15);color:#6366F1;border:1px solid rgba(99,102,241,0.25);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;flex-shrink:0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                        Laporan
                    </a>
                    <a href="{{ route('admin.users.index') }}" style="background:rgba(245,158,11,0.15);color:#F59E0B;border:1px solid rgba(245,158,11,0.25);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;flex-shrink:0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20V10"/><path d="M18 20V4"/><path d="M6 20v-4"/></svg>
                        Kelola Akun
                    </a>
                    <a href="{{ route('admin.settings.index') }}" style="background:rgba(239,68,68,0.15);color:#EF4444;border:1px solid rgba(239,68,68,0.25);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;flex-shrink:0;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                        Pengaturan
                    </a>
                </div>
            </div>

            {{-- Stat Cards 2x2 --}}
            <div class="row g-3 mb-4">
                <div class="col-6 col-lg-3">
                    <div class="admin-card admin-card-hover" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.25);">
                        <div style="width:40px;height:40px;border-radius:12px;background:rgba(13,148,136,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div class="count-up" data-target="{{ $totalUser }}" style="font-size:28px;font-weight:700;color:var(--md-sys-color-on-surface);line-height:1.2;">{{ $totalUser }}</div>
                        <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);letter-spacing:0.5px;text-transform:uppercase;margin-top:4px;">Total User</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="admin-card admin-card-hover" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.25);">
                        <div style="width:40px;height:40px;border-radius:12px;background:rgba(16,185,129,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        </div>
                        <div class="count-up" data-target="{{ $totalKelas }}" style="font-size:28px;font-weight:700;color:var(--md-sys-color-on-surface);line-height:1.2;">{{ $totalKelas }}</div>
                        <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);letter-spacing:0.5px;text-transform:uppercase;margin-top:4px;">Total Kelas</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="admin-card admin-card-hover" style="--card-border:#F59E0B;--card-glow:rgba(245,158,11,0.25);">
                        <div style="width:40px;height:40px;border-radius:12px;background:rgba(245,158,11,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        </div>
                        <div class="count-up" data-target="{{ $totalGuru }}" style="font-size:28px;font-weight:700;color:var(--md-sys-color-on-surface);line-height:1.2;">{{ $totalGuru }}</div>
                        <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);letter-spacing:0.5px;text-transform:uppercase;margin-top:4px;">Total Guru</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="admin-card admin-card-hover" style="--card-border:#06B6D4;--card-glow:rgba(6,182,212,0.25);">
                        <div style="width:40px;height:40px;border-radius:12px;background:rgba(6,182,212,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#06B6D4" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div class="count-up" data-target="{{ $totalSiswa }}" style="font-size:28px;font-weight:700;color:var(--md-sys-color-on-surface);line-height:1.2;">{{ $totalSiswa }}</div>
                        <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);letter-spacing:0.5px;text-transform:uppercase;margin-top:4px;">Total Siswa</div>
                    </div>
                </div>
            </div>

            {{-- Ringkasan Kehadiran Hari Ini --}}
            @php
            $ringkasan = [
                ['label' => 'Hadir', 'value' => $todayStats['hadir'] ?? 0, 'color' => '#10B981', 'bg' => 'rgba(16,185,129,0.15)'],
                ['label' => 'Izin', 'value' => $todayStats['izin'] ?? 0, 'color' => '#06B6D4', 'bg' => 'rgba(6,182,212,0.15)'],
                ['label' => 'Sakit', 'value' => $todayStats['sakit'] ?? 0, 'color' => '#F59E0B', 'bg' => 'rgba(245,158,11,0.15)'],
                ['label' => 'Alfa', 'value' => $todayStats['alfa'] ?? 0, 'color' => '#EF4444', 'bg' => 'rgba(239,68,68,0.15)'],
                ['label' => 'Telat', 'value' => $todayStats['terlambat'] ?? 0, 'color' => '#0D9488', 'bg' => 'rgba(13,148,136,0.15)'],
            ];
            @endphp
            <div class="admin-card admin-card-hover" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.2);margin-bottom:20px;">
                <div style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);margin-bottom:12px;">Ringkasan Kehadiran Hari Ini</div>
                <div class="row g-2">
                    @foreach($ringkasan as $i => $r)
                    @php
                        $col = 'col-12 col-md';
                    @endphp
                    <div class="{{ $col }}">
                        <div class="text-center" style="padding:12px 8px;border-radius:12px;background:{{ $r['bg'] }};">
                            <div class="count-up" data-target="{{ $r['value'] }}" style="font-size:20px;font-weight:700;color:{{ $r['color'] }};line-height:1.2;">{{ $r['value'] }}</div>
                            <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);margin-top:4px;">{{ $r['label'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Tren Kehadiran --}}
            <div class="admin-card admin-card-hover" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.2);margin-bottom:20px;">
                <div style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);margin-bottom:12px;">Tren Kehadiran (7 Hari Terakhir)</div>
                <div class="overflow-x-auto">
                    <div style="min-width:400px;height:180px;">
                        <canvas id="adminAttendanceChart"></canvas>
                    </div>
                </div>
            </div>

            @php
            $warnaRole = ['admin' => '#EF4444', 'guru' => '#0D9488', 'siswa' => '#10B981'];
            $bgRole = ['admin' => 'rgba(239,68,68,0.2)', 'guru' => 'rgba(13,148,136,0.2)', 'siswa' => 'rgba(16,185,129,0.2)'];
            @endphp

            {{-- Peringatan --}}
            @if($warningStudents->count() > 0)
            <div class="admin-card admin-card-hover" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.2);margin-bottom:16px;border-left:3px solid #EF4444;">
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

            {{-- Akun Terbaru --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.2);margin-bottom:20px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <div style="width:32px;height:32px;border-radius:8px;background:rgba(13,148,136,0.2);display:flex;align-items:center;justify-content:center;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        </div>
                        <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Pengguna Terbaru</span>
                    </div>
                    <a href="{{ route('admin.users.index') }}" style="font-size:12px;font-weight:500;color:#0D9488;text-decoration:none;">Lihat Semua &rarr;</a>
                </div>
                <div class="overflow-x-auto">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant, rgba(255,255,255,0.06));">
                                <th style="font-size:11px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;padding:8px 12px;text-align:left;">Pengguna</th>
                                <th style="font-size:11px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;padding:8px 12px;text-align:left;">Peran</th>
                                <th style="font-size:11px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;padding:8px 12px;text-align:left;" class="d-none d-md-table-cell">Bergabung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentUsers as $user)
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant, rgba(255,255,255,0.04));">
                                <td style="padding:10px 12px;">
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <span style="width:32px;height:32px;border-radius:50%;background:{{ $bgRole[$user->role] ?? 'var(--md-sys-color-surface-container-high)' }};color:{{ $warnaRole[$user->role] ?? 'var(--md-sys-color-on-surface-variant)' }};display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:600;flex-shrink:0;">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        <div>
                                            <div style="font-size:13px;font-weight:500;color:var(--md-sys-color-on-surface);">{{ $user->name }}</div>
                                            <div style="font-size:11px;color:var(--md-sys-color-on-surface-variant);" class="d-md-none">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding:10px 12px;">
                                    <span style="background:{{ $bgRole[$user->role] ?? 'var(--md-sys-color-surface-container-high)' }};color:{{ $warnaRole[$user->role] ?? 'var(--md-sys-color-on-surface-variant)' }};font-size:11px;font-weight:600;padding:2px 10px;border-radius:20px;">{{ ucfirst($user->role) }}</span>
                                </td>
                                <td style="padding:10px 12px;font-size:12px;color:var(--md-sys-color-on-surface-variant);" class="d-none d-md-table-cell">{{ $user->created_at?->format('d M Y') ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('adminAttendanceChart').getContext('2d');
            const isDark = document.documentElement.classList.contains('dark');
            const isMobile = window.innerWidth < 576;
            const tickColor = isDark ? 'rgba(255,255,255,0.5)' : 'rgba(0,0,0,0.5)';
            const gridColor = isDark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.06)';
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [{
                        label: 'Siswa Hadir',
                        data: @json($chartData['values']),
                        backgroundColor: 'rgba(13, 148, 136, 0.6)',
                        borderColor: '#0D9488',
                        borderWidth: 2,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: { duration: 600 },
                    layout: {
                        padding: {
                            left: isMobile ? 4 : 8,
                            right: isMobile ? 4 : 8,
                            top: 4,
                            bottom: isMobile ? 0 : 4
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 5,
                                precision: 0,
                                color: tickColor,
                                font: {
                                    size: isMobile ? 9 : 11
                                },
                                maxTicksLimit: 6
                            },
                            grid: {
                                color: gridColor
                            }
                        },
                        x: {
                            ticks: {
                                color: tickColor,
                                font: {
                                    size: isMobile ? 8 : 11
                                },
                                maxRotation: isMobile ? 0 : 30,
                                minRotation: 0,
                                autoSkip: false
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
