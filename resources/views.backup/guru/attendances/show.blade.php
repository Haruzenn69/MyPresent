<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">
                Detail Absensi — {{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }}
            </h2>
            <a href="{{ route('guru.attendances.index') }}"
               class="text-sm text-gray-600 dark:text-gray-400 hover:underline">← Kembali</a>
<a href="{{ route('guru.attendances.pdf', $attendance) }}"
    			   class="btn btn-danger text-sm"> ⬇ Download PDF</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            <div class="card p-6 mb-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Kelas: <strong class="text-gray-900 dark:text-white">{{ $attendance->kelas->nama_kelas ?? '-' }}</strong>
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Guru: <strong class="text-gray-900 dark:text-white">{{ $attendance->guru->nama ?? '-' }}</strong>
                </p>
            </div>

            <div class="card">
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
