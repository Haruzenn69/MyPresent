<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">
                Edit Absensi — {{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }}
            </h2>
            <a href="{{ route('guru.attendances.show', $attendance) }}" class="text-sm text-gray-500 dark:text-gray-400 hover:underline">← Kembali</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">

            <div class="card p-4 mb-4 text-sm text-gray-600 dark:text-gray-400">
                Kelas: <strong class="text-gray-900 dark:text-white">{{ $attendance->kelas->nama_kelas ?? '-' }}</strong> |
                Tanggal: <strong class="text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }}</strong>
            </div>

            <form method="POST" action="{{ route('guru.attendances.update', $attendance) }}">
                @csrf @method('PUT')
                <div class="card p-6 mb-4 overflow-x-auto">
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th class="text-center">Hadir</th>
                                    <th class="text-center">Sakit</th>
                                    <th class="text-center">Izin</th>
                                    <th class="text-center">Alfa</th>
                                    <th class="text-center">Telat</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendance->details as $detail)
                                <tr>
                                    <td class="font-medium">{{ $detail->student->nama }}</td>
                                    @foreach(['hadir','sakit','izin','alfa','terlambat'] as $status)
                                    <td class="text-center">
                                        <input type="radio"
                                            name="absensi[{{ $detail->id }}][status]"
                                            value="{{ $status }}"
                                            {{ $detail->status === $status ? 'checked' : '' }}>
                                    </td>
                                    @endforeach
                                    <td>
                                        <input type="text"
                                            name="absensi[{{ $detail->id }}][keterangan]"
                                            value="{{ $detail->keterangan }}"
                                            class="input text-xs"
                                            placeholder="Opsional">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
