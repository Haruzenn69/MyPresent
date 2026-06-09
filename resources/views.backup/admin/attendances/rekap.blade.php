<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white leading-tight">
                {{ __('Rekapitulasi Kehadiran (Admin)') }}
            </h2>
            <a href="{{ route('admin.attendances.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400">Kembali ke Riwayat</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Filter --}}
            <div class="card p-6">
                <form method="GET" action="{{ route('admin.attendances.rekap') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-input-label for="start_date" value="Dari Tanggal" />
                        <x-text-input type="date" name="start_date" id="start_date" class="w-full" value="{{ request('start_date') }}" />
                    </div>
                    <div>
                        <x-input-label for="end_date" value="Sampai Tanggal" />
                        <x-text-input type="date" name="end_date" id="end_date" class="w-full" value="{{ request('end_date') }}" />
                    </div>
                    <div class="flex items-end">
                        <x-primary-button class="w-full justify-center">
                            Filter Periode
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="p-6 text-gray-900 dark:text-gray-100 overflow-x-auto">
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kelas</th>
                                    <th class="text-center">Total Siswa</th>
                                    <th class="text-center">Hadir</th>
                                    <th class="text-center">Izin</th>
                                    <th class="text-center">Sakit</th>
                                    <th class="text-center">Alpa</th>
                                    <th class="text-center">Terlambat</th>
                                    <th class="text-center">Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($summary as $row)
                                    @php
                                        $total_entries = $row['hadir'] + $row['izin'] + $row['sakit'] + $row['alfa'] + $row['terlambat'];
                                        $percentage = $total_entries > 0 ? round((($row['hadir'] + $row['terlambat']) / $total_entries) * 100, 1) : 0;
                                    @endphp
                                    <tr>
                                        <td class="font-bold">{{ $row['kelas'] }}</td>
                                        <td class="text-center">{{ $row['total_siswa'] }}</td>
                                        <td class="text-center font-bold text-green-600 dark:text-green-400">{{ $row['hadir'] }}</td>
                                        <td class="text-center font-bold text-blue-600 dark:text-blue-400">{{ $row['izin'] }}</td>
                                        <td class="text-center font-bold text-yellow-600 dark:text-yellow-400">{{ $row['sakit'] }}</td>
                                        <td class="text-center font-bold text-red-600 dark:text-red-400">{{ $row['alfa'] }}</td>
                                        <td class="text-center font-bold text-orange-600 dark:text-orange-400">{{ $row['terlambat'] }}</td>
                                        <td class="text-center">
                                            <div class="flex items-center gap-2">
<div class="flex-1 bg-gray-200 dark:bg-dark-card rounded-full h-2 min-w-[50px]">
                                                     <div class="bg-present-600 dark:bg-present-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                                </div>
                                                <span class="font-bold text-gray-900 dark:text-white">{{ $percentage }}%</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
