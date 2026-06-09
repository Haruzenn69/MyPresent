<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white leading-tight">
                {{ __('Detail Absensi') }} - {{ $attendance->kelas->nama_kelas }} ({{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }})
            </h2>
            <a href="{{ route('admin.attendances.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400">Kembali</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="card p-6">
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Guru Pengampu</p>
                        <p class="font-bold text-gray-900 dark:text-white">{{ $attendance->guru->nama }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal</p>
                        <p class="font-bold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($attendance->tanggal)->isoFormat('dddd, D MMMM YYYY') }}</p>
                    </div>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th class="text-center">Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendance->details as $detail)
                                <tr>
                                    <td class="font-medium">{{ $detail->student->nama }}</td>
                                    <td class="text-center">
                                        @php
                                            $badge = match($detail->status) {
                                                'hadir' => 'badge-green',
                                                'izin' => 'badge-blue',
                                                'sakit' => 'badge-yellow',
                                                'alfa' => 'badge-red',
                                                'terlambat' => 'badge-blue',
                                                default => 'badge-gray',
                                            };
                                        @endphp
                                        <span class="badge {{ $badge }}">
                                            {{ $detail->status }}
                                        </span>
                                    </td>
                                    <td class="text-gray-600 dark:text-gray-400 italic">{{ $detail->keterangan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
