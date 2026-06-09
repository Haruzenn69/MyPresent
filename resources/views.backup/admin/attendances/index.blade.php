<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Absensi (Admin)') }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('admin.attendances.rekap') }}" class="btn btn-primary text-sm">
                    Rekapitulasi
                </a>
                <a href="{{ route('admin.attendances.export', request()->all()) }}" class="btn btn-danger text-sm">
                    Export PDF
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Filter --}}
            <div class="card p-6">
                <form method="GET" action="{{ route('admin.attendances.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <x-input-label for="class_id" value="Kelas" />
                        <select name="class_id" id="class_id" class="input w-full">
                            <option value="">Semua Kelas</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->nama_kelas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="start_date" value="Dari Tanggal" />
                        <x-text-input type="date" name="start_date" id="start_date" class="w-full" value="{{ request('start_date') }}" />
                    </div>
                    <div>
                        <x-input-label for="end_date" value="Sampai Tanggal" />
                        <x-text-input type="date" name="end_date" id="end_date" class="w-full" value="{{ request('end_date') }}" />
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="btn btn-primary w-full justify-center">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kelas</th>
                                    <th>Guru</th>
                                    <th class="text-center">H</th>
                                    <th class="text-center">I</th>
                                    <th class="text-center">S</th>
                                    <th class="text-center">A</th>
                                    <th class="text-center">T</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendances as $attendance)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }}</td>
                                        <td class="font-medium">{{ $attendance->kelas->nama_kelas }}</td>
                                        <td>{{ $attendance->guru->nama }}</td>
                                        <td class="text-center text-green-600 dark:text-green-400 font-bold">{{ $attendance->total_hadir }}</td>
                                        <td class="text-center text-blue-600 dark:text-blue-400 font-bold">{{ $attendance->total_izin }}</td>
                                        <td class="text-center text-yellow-600 dark:text-yellow-400 font-bold">{{ $attendance->total_sakit }}</td>
                                        <td class="text-center text-red-600 dark:text-red-400 font-bold">{{ $attendance->total_alfa }}</td>
                                        <td class="text-center text-orange-600 dark:text-orange-400 font-bold">{{ $attendance->total_terlambat }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.attendances.show', $attendance) }}" class="btn btn-ghost text-xs">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Data absensi tidak ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
