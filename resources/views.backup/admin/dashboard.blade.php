<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 dark:text-white">Dashboard Admin</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            {{-- Ringkasan Hari Ini --}}
            <div class="card p-6 mb-6">
                <h3 class="font-bold text-lg mb-4 text-gray-900 dark:text-white">Ringkasan Kehadiran Seluruh Siswa Hari Ini</h3>
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-3">
                    <div class="stat-card text-center">
                        <p class="stat-value text-green-600 dark:text-green-400">{{ $todayStats['hadir'] }}</p>
                        <p class="stat-label">Hadir</p>
                    </div>
                    <div class="stat-card text-center">
                        <p class="stat-value text-blue-600 dark:text-blue-400">{{ $todayStats['izin'] }}</p>
                        <p class="stat-label">Izin</p>
                    </div>
                    <div class="stat-card text-center">
                        <p class="stat-value text-yellow-600 dark:text-yellow-400">{{ $todayStats['sakit'] }}</p>
                        <p class="stat-label">Sakit</p>
                    </div>
                    <div class="stat-card text-center">
                        <p class="stat-value text-red-600 dark:text-red-400">{{ $todayStats['alfa'] }}</p>
                        <p class="stat-label">Alfa</p>
                    </div>
                    <div class="stat-card text-center">
                        <p class="stat-value text-purple-600 dark:text-purple-400">{{ $todayStats['terlambat'] }}</p>
                        <p class="stat-label">Telat</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                {{-- Statistik Angka --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="stat-card text-center flex flex-col justify-center">
                        <p class="text-3xl font-bold text-present-600 dark:text-present-400">{{ $totalUser }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Total User</p>
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
                        <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $totalSiswa }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Total Siswa</p>
                    </div>
                </div>

                {{-- Grafik Tren --}}
                <div class="lg:col-span-2 card p-6">
                    <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Tren Kehadiran Sekolah (7 Hari Terakhir)</h3>
                    <div class="relative h-48 md:h-64">
                        <canvas id="adminAttendanceChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Peringatan --}}
            @if($warningStudents->count() > 0)
            <div class="card mb-6 border-l-4 border-l-red-500">
                <div class="card-body">
                    <h3 class="font-bold text-red-600 dark:text-red-400 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        Peringatan Ketidakhadiran (Alfa &ge; 3 Kali)
                    </h3>
                    <div class="space-y-3">
                        @foreach($warningStudents as $student)
                        <div class="flex justify-between items-center p-3 bg-red-50 dark:bg-red-900/20 rounded-positivus">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $student->nama }} ({{ $student->nis }})</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Kelas: {{ $student->kelas->nama_kelas ?? '-' }}</p>
                            </div>
                            <span class="bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold">
                                {{ $student->alfa_count }} Kali Alfa
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            {{-- Aksi Cepat --}}
            <div class="card p-6 mb-6">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Aksi Cepat</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    				<a href="{{ route('admin.users.create') }}"
        				class="btn btn-primary justify-center gap-2">
        				<span class="text-lg">+</span> Tambah Akun
    				</a>
    				<a href="{{ route('admin.classes.create') }}"
        				class="btn btn-primary justify-center gap-2">
        				<span class="text-lg">+</span> Tambah Kelas
    				</a>
                    <a href="{{ route('admin.students.import') }}"
        				class="btn btn-primary justify-center gap-2">
        				<span class="text-lg">&#8593;</span> Import Siswa
    				</a>
                    <a href="{{ route('admin.attendances.index') }}"
        				class="btn btn-primary justify-center gap-2">
        				<span class="text-lg">&#128202;</span> Lihat Laporan
    				</a>
    				<a href="{{ route('admin.users.index') }}"
        				class="btn btn-secondary justify-center gap-2">
        				<span class="text-lg">&#128101;</span> Kelola Akun
    				</a>
				</div>
            </div>

            {{-- User Terbaru --}}
            <div class="card">
                <div class="card-header">
                    <h3 class="font-bold text-gray-900 dark:text-white">Akun Terbaru</h3>
                </div>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentUsers as $user)
                            <tr>
                                <td class="font-medium">{{ $user->name }}</td>
                                <td class="text-gray-500 dark:text-gray-400">{{ $user->email }}</td>
                                <td>
                                    @php
                                        $warna = match($user->role) {
                                            'admin' => 'badge-red',
                                            'guru'  => 'badge-blue',
                                            'siswa' => 'badge-green',
                                            default => 'badge-gray',
                                        };
                                    @endphp
                                    <span class="badge {{ $warna }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
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
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartData['labels']),
                    datasets: [{
                        label: 'Siswa Hadir',
                        data: @json($chartData['values']),
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        borderColor: '#3b82f6',
                        borderWidth: 2,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: { duration: 800 },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { 
                                stepSize: 5,
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
                        legend: { display: false }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
