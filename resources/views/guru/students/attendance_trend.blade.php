<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Tren Kehadiran Siswa</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">{{ $student->nama }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('guru.students.show', $student) }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali ke Detail Siswa
                    </a>
                </div>
            </div>

            @if(session('error'))
            <div class="admin-card" style="--card-border:#EF4444;margin-bottom:20px;padding:16px 20px;display:flex;align-items:center;gap:10px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span style="font-size:13px;color:var(--md-sys-color-on-surface);">{{ session('error') }}</span>
            </div>
            @endif

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;">
                    <div style="width:32px;height:32px;border-radius:8px;background:rgba(13,148,136,0.2);display:flex;align-items:center;justify-content:center;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
                    </div>
                    <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Grafik Kehadiran {{ $student->nama }} (Tahun Ajaran {{ $activeYear->year }} Semester {{ ucfirst($activeYear->semester) }})</span>
                </div>
                @if(count($chartLabels) > 0)
                <div style="position: relative; height: 400px;">
                    <canvas id="studentAttendanceTrendChart"></canvas>
                </div>
                @else
                <div style="padding:60px 20px;text-align:center;">
                    <div style="width:56px;height:56px;border-radius:16px;background:var(--md-sys-color-surface-container-low);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="1.5"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
                    </div>
                    <p style="font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);margin:0 0 4px;">Tidak ada data absensi</p>
                    <p style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin:0;">Tidak ada data absensi untuk siswa ini pada tahun ajaran aktif.</p>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('studentAttendanceTrendChart').getContext('2d');
    const chartLabels = @json($chartLabels);
    const chartDatasets = @json($chartDatasets);

    if (chartLabels.length > 0) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: chartDatasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true,
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Kehadiran'
                        },
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    }
                },
                plugins: {
                    title: {
                        display: false,
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                }
            }
        });
    }
});
</script>
@endpush
