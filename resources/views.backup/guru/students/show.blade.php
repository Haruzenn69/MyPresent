<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">
                Detail Siswa
            </h2>
            <a href="{{ route('guru.students.index') }}"
               class="text-sm text-gray-600 dark:text-gray-400 hover:underline">← Kembali</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Info Siswa --}}
            <div class="card p-6 mb-4">
                <h3 class="font-bold text-lg mb-3 text-gray-900 dark:text-white">{{ $student->nama }}</h3>
                <div class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">NIS</p>
                        <p class="font-bold text-gray-900 dark:text-white">{{ $student->nis }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Kelas</p>
                        <p class="font-bold text-gray-900 dark:text-white">{{ $student->kelas->nama_kelas ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Jenis Kelamin</p>
                        <p class="font-bold text-gray-900 dark:text-white">{{ $student->jenis_kelamin }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400">Alamat</p>
                        <p class="font-bold text-gray-900 dark:text-white">{{ $student->alamat ?? '-' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="mb-6 flex gap-2">
                <a href="{{ route('guru.students.attendance-trend', $student) }}" class="btn btn-secondary">
                    <span class="mr-1">📈</span> Lihat Tren Kehadiran
                </a>
            </div>

            {{-- Rekap Kehadiran --}}
            @php
                $details = $student->attendanceDetails;
                $hadir = $details->where('status', 'hadir')->count();
                $sakit = $details->where('status', 'sakit')->count();
                $izin  = $details->where('status', 'izin')->count();
                $alfa  = $details->where('status', 'alfa')->count();
                $total = $details->count();
            @endphp

            <div class="grid grid-cols-4 gap-3 mb-4">
                <div class="stat-card">
                    <p class="stat-value text-green-600 dark:text-green-400">{{ $hadir }}</p>
                    <p class="stat-label">Hadir</p>
                </div>
                <div class="stat-card">
                    <p class="stat-value text-yellow-600 dark:text-yellow-400">{{ $sakit }}</p>
                    <p class="stat-label">Sakit</p>
                </div>
                <div class="stat-card">
                    <p class="stat-value text-blue-600 dark:text-blue-400">{{ $izin }}</p>
                    <p class="stat-label">Izin</p>
                </div>
                <div class="stat-card">
                    <p class="stat-value text-red-600 dark:text-red-400">{{ $alfa }}</p>
                    <p class="stat-label">Alfa</p>
                </div>
            </div>

            {{-- Riwayat Absensi --}}
            <div class="card">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th class="text-center">Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($student->attendanceDetails as $detail)
                            <tr>
                                <td>
                                    {{ \Carbon\Carbon::parse($detail->attendance->tanggal)->format('d/m/Y') }}
                                </td>
                                <td class="text-center">
                                    @php
                                        $warna = match($detail->status) {
                                            'hadir' => 'badge-green',
                                            'sakit' => 'badge-yellow',
                                            'izin'  => 'badge-blue',
                                            'alfa'  => 'badge-red',
                                        };
                                    @endphp
                                    <span class="badge {{ $warna }}">
                                        {{ ucfirst($detail->status) }}
                                    </span>
                                </td>
                                <td class="text-gray-500 dark:text-gray-400">
                                    {{ $detail->keterangan ?? '-' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    Belum ada data absensi
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
