<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 dark:text-white">Dashboard Siswa</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">

            @if($student)
            {{-- Info Siswa --}}
            <div class="card p-6 mb-4">
                <h3 class="font-bold text-lg mb-1 text-gray-900 dark:text-white">{{ $student->nama }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    NIS: {{ $student->nis }} |
                    Kelas: {{ $student->kelas->nama_kelas ?? '-' }}
                </p>
            </div>

            {{-- Rekap Kehadiran --}}
            @php
                $details = $student->attendanceDetails;
                $hadir = $details->where('status', 'hadir')->count();
                $terlambat = $details->where('status', 'terlambat')->count();
                $sakit = $details->where('status', 'sakit')->count();
                $izin  = $details->where('status', 'izin')->count();
                $alfa  = $details->where('status', 'alfa')->count();
                $total = $details->count();
                $persen = $total > 0 ? round((($hadir + $terlambat) / $total) * 100) : 0;
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                <div class="stat-card text-center">
                    <p class="stat-value text-green-600 dark:text-green-400">{{ $hadir }}</p>
                    <p class="stat-label">Hadir</p>
                </div>
                <div class="stat-card text-center">
                    <p class="stat-value text-present-600 dark:text-present-400">{{ $persen }}%</p>
                    <p class="stat-label">Kehadiran</p>
                </div>
                <div class="stat-card text-center">
                    <p class="stat-value text-yellow-600 dark:text-yellow-400">{{ $sakit }}</p>
                    <p class="stat-label">Sakit</p>
                </div>
                <div class="stat-card text-center">
                    <p class="stat-value text-red-600 dark:text-red-400">{{ $alfa }}</p>
                    <p class="stat-label">Alfa</p>
                </div>
            </div>

            {{-- Absensi Terbaru --}}
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-900 dark:text-white">Absensi Terbaru</h3>
                    <a href="{{ route('siswa.absensi') }}"
                       class="text-sm text-present-600 dark:text-present-400 hover:underline">
                        Lihat Semua &rarr;
                    </a>
                </div>
                <div class="space-y-2">
                    @forelse($student->attendanceDetails->sortByDesc('created_at')->take(5) as $detail)
                    <div class="flex justify-between items-center text-sm py-2 border-b-2 border-gray-900 dark:border-gray-700 last:border-b-0">
                        <span class="text-gray-600 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($detail->attendance->tanggal)->format('d/m/Y') }}
                        </span>
                        @php
                            $warna = match($detail->status) {
                                'hadir' => 'badge-green',
                                'terlambat' => 'badge-blue',
                                'sakit' => 'badge-yellow',
                                'izin'  => 'badge-blue',
                                'alfa'  => 'badge-red',
                                default => 'badge-gray',
                            };
                        @endphp
                        <span class="badge {{ $warna }}">
                            {{ ucfirst($detail->status) }}
                        </span>
                    </div>
                    @empty
                    <p class="text-gray-400 dark:text-gray-500 text-sm">Belum ada data absensi</p>
                    @endforelse
                </div>
            </div>

            @else
            <div class="card p-6 text-center border-l-4 border-l-yellow-500">
                <p class="text-yellow-600 dark:text-yellow-400">
                    Data siswa belum terdaftar. Hubungi guru untuk mendaftarkan akunmu.
                </p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
