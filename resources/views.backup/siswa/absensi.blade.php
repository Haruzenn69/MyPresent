<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 dark:text-white">Riwayat Absensi</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
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
                            @if($student)
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
                                                default => 'badge-gray',
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
                                    <td colspan="3" class="text-center text-gray-400 dark:text-gray-500">
                                        Belum ada data absensi
                                    </td>
                                </tr>
                                @endforelse
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
