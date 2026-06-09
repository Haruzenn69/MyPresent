<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 dark:text-white">Dashboard Guru</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            {{-- Ringkasan Wali Kelas (Jika Ada) --}}
            @if(isset($myClassStats) && $myClassStats)
            <div class="card mb-6 border-l-4 border-l-present-500">
                <div class="card-body">
                    <h3 class="font-bold text-lg mb-4 text-present-600 dark:text-present-400">Ringkasan Kelas Binaan: {{ $myClassStats['nama'] }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Total Siswa: <span class="font-bold text-gray-900 dark:text-white">{{ $myClassStats['total_siswa'] }}</span></p>
                    @if($myClassStats['attendance'])
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                        <div class="card text-center p-3 sm:p-4">
                            <p class="text-2xl sm:text-3xl font-bold text-green-600 dark:text-green-400">{{ $myClassStats['attendance']->hadir_count }}</p>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Hadir</p>
                        </div>
                        <div class="card text-center p-3 sm:p-4">
                            <p class="text-2xl sm:text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $myClassStats['attendance']->izin_count }}</p>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Izin</p>
                        </div>
                        <div class="card text-center p-3 sm:p-4">
                            <p class="text-2xl sm:text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $myClassStats['attendance']->sakit_count }}</p>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Sakit</p>
                        </div>
                        <div class="card text-center p-3 sm:p-4">
                            <p class="text-2xl sm:text-3xl font-bold text-red-600 dark:text-red-400">{{ $myClassStats['attendance']->alfa_count }}</p>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Alfa</p>
                        </div>
                        <div class="card text-center p-3 sm:p-4">
                            <p class="text-2xl sm:text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $myClassStats['attendance']->terlambat_count }}</p>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Telat</p>
                        </div>
                    </div>
                    @else
                    <div class="card-dashed">
                        <p class="text-gray-500 dark:text-gray-400 italic">Belum ada data absensi untuk kelas binaan hari ini.</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- Ringkasan Hari Ini --}}
            <div class="card p-6 mb-6">
                <h3 class="font-bold text-lg mb-4 text-gray-900 dark:text-white">Ringkasan Kehadiran Hari Ini ({{ now()->isoFormat('D MMMM YYYY') }})</h3>
                @if($todayAttendance)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                    <div class="card text-center p-3 sm:p-4">
                        <p class="text-2xl sm:text-3xl font-bold text-green-600 dark:text-green-400">{{ $todayAttendance->hadir_count }}</p>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Hadir</p>
                    </div>
                    <div class="card text-center p-3 sm:p-4">
                        <p class="text-2xl sm:text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $todayAttendance->izin_count }}</p>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Izin</p>
                    </div>
                    <div class="card text-center p-3 sm:p-4">
                        <p class="text-2xl sm:text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $todayAttendance->sakit_count }}</p>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Sakit</p>
                    </div>
                    <div class="card text-center p-3 sm:p-4">
                        <p class="text-2xl sm:text-3xl font-bold text-red-600 dark:text-red-400">{{ $todayAttendance->alfa_count }}</p>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Alfa</p>
                    </div>
                    <div class="card text-center p-3 sm:p-4">
                        <p class="text-2xl sm:text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $todayAttendance->terlambat_count }}</p>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Telat</p>
                    </div>
                </div>
                @else
                <div class="card-dashed">
                    <p class="text-gray-500 dark:text-gray-400 italic">Belum ada data absensi hari ini.</p>
                </div>
                @endif
            </div>

            {{-- Peringatan --}}
            @if($warningStudents->count() > 0)
            <div class="card mb-6 border-l-4 border-l-yellow-500">
                <div class="card-body">
                    <h3 class="font-bold text-yellow-600 dark:text-yellow-400 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        Peringatan Ketidakhadiran (Alfa &ge; 3 Kali)
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($warningStudents as $student)
                        <div class="flex justify-between items-center p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-positivus border-2 border-yellow-400 dark:border-yellow-700">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $student->nama }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $student->kelas->nama_kelas ?? '-' }}</p>
                            </div>
                            <span class="bg-yellow-600 text-white px-3 py-1 rounded-full text-xs font-bold">
                                {{ $student->alfa_count }} Kali
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                {{-- Statistik Angka --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="stat-card text-center flex flex-col justify-center">
                        <p class="text-3xl font-bold text-present-600 dark:text-present-400">{{ $totalSiswa }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Total Siswa</p>
                    </div>
                    <div class="stat-card text-center flex flex-col justify-center">
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $totalKelas }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Total Kelas</p>
                    </div>
                    <div class="stat-card text-center flex flex-col justify-center">
                        <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $totalGuru }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Total Guru</p>
                    </div>
                    <div class="stat-card text-center flex flex-col justify-center">
                        <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $totalAbsensi }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Absensi Anda</p>
                    </div>
                </div>

                {{-- Grafik Tren --}}
                <div class="lg:col-span-2 card p-6">
                    <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Tren Kehadiran (7 Hari Terakhir)</h3>
                    <div class="relative h-48 md:h-64">
                        <canvas id="attendanceChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Aksi Cepat --}}
            <div class="card p-6">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Aksi Cepat</h3>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('guru.attendances.create') }}"
                       class="btn btn-primary">
                        + Input Absensi Hari Ini
                    </a>
                    <a href="{{ route('guru.attendances.index') }}"
                       class="btn btn-secondary">
                        &#128203; Riwayat Absensi
                    </a>
                    <a href="{{ route('guru.students.index') }}"
                       class="btn btn-secondary">
                        &#128101; Data Siswa
                    </a>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('attendanceChart').getContext('2d');
            const isDark = document.documentElement.classList.contains('dark');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [{
                        label: 'Siswa Hadir',
                        data: @json($chartData['values']),
                        borderColor: 'rgb(37, 99, 235)',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 500
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { 
                                stepSize: 1,
                                precision: 0,
                                color: isDark ? '#9ca3af' : '#6b7280'
                            },
                            grid: {
                                color: isDark ? '#374151' : '#f3f4f6'
                            }
                        },
                        x: {
                            ticks: {
                                color: isDark ? '#9ca3af' : '#6b7280'
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
