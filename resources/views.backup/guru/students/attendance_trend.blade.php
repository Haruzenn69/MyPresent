<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white leading-tight">
                {{ __('Tren Kehadiran Siswa') }} - {{ $student->nama }}
            </h2>
            <a href="{{ route('guru.students.show', $student) }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 text-sm">← Kembali ke Detail Siswa</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('error'))
            <div class="card p-4 border-red-400 dark:border-red-700 text-red-800 dark:text-red-300 mb-6">
                {{ session('error') }}
            </div>
            @endif

            <div class="card p-6">
                <h3 class="font-bold text-lg mb-4 text-gray-900 dark:text-white">Grafik Kehadiran {{ $student->nama }} (Tahun Ajaran {{ $activeYear->year }} Semester {{ ucfirst($activeYear->semester) }})</h3>
                @if(count($chartLabels) > 0)
                <div class="relative h-96">
                    <canvas id="studentAttendanceTrendChart"></canvas>
                </div>
                @else
                <p class="text-gray-500 dark:text-gray-400 italic text-center py-8">Tidak ada data absensi untuk siswa ini pada tahun ajaran aktif.</p>
                @endif
            </div>

        </div>
    </div>

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
                        datasets: [
                            {
                                label: 'Hadir',
                                data: chartDatasets.hadir,
                                backgroundColor: 'rgba(52, 211, 153, 0.7)', // green-400
                                borderColor: 'rgba(52, 211, 153, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Izin',
                                data: chartDatasets.izin,
                                backgroundColor: 'rgba(96, 165, 250, 0.7)', // blue-400
                                borderColor: 'rgba(96, 165, 250, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Sakit',
                                data: chartDatasets.sakit,
                                backgroundColor: 'rgba(251, 191, 36, 0.7)', // yellow-400
                                borderColor: 'rgba(251, 191, 36, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Alfa',
                                data: chartDatasets.alfa,
                                backgroundColor: 'rgba(239, 68, 68, 0.7)', // red-400
                                borderColor: 'rgba(239, 68, 68, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Terlambat',
                                data: chartDatasets.terlambat,
                                backgroundColor: 'rgba(249, 115, 22, 0.7)', // orange-400
                                borderColor: 'rgba(249, 115, 22, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                stacked: true,
                                title: { display: true, text: 'Tanggal' }
                            },
                            y: {
                                stacked: true,
                                beginAtZero: true,
                                title: { display: true, text: 'Jumlah Kehadiran' },
                                ticks: { stepSize: 1, precision: 0 }
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
</x-app-layout>
