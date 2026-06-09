<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 dark:text-white leading-tight">
            {{ __('Kelola Tahun Ajaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
            <div class="card p-4 border-green-400 dark:border-green-700 text-green-800 dark:text-green-300">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="card p-4 border-red-400 dark:border-red-700 text-red-800 dark:text-red-300">
                {{ session('error') }}
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Form Tambah --}}
                <div class="card p-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-900 dark:text-white">Tambah Tahun Ajaran</h3>
                    <form method="POST" action="{{ route('admin.academic-years.store') }}" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="year" value="Tahun (Contoh: 2024/2025)" />
                            <x-text-input id="year" name="year" type="text" class="mt-1 block w-full" required placeholder="2024/2025" />
                        </div>
                        <div>
                            <x-input-label for="semester" value="Semester" />
                            <select id="semester" name="semester" class="input mt-1 block w-full">
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
                            </select>
                        </div>
                        <x-primary-button class="w-full justify-center">Simpan</x-primary-button>
                    </form>
                </div>

                {{-- Daftar Tahun Ajaran --}}
                <div class="md:col-span-2 card p-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-900 dark:text-white">Daftar Tahun Ajaran</h3>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($years as $year)
                                <tr>
                                    <td>{{ $year->year }}</td>
                                    <td class="uppercase">{{ $year->semester }}</td>
                                    <td class="text-center">
                                        @if($year->is_active)
                                            <span class="badge badge-green">Aktif</span>
                                        @else
                                            <span class="badge badge-yellow">Non-Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center space-x-2">
                                        @if(!$year->is_active)
                                        <form method="POST" action="{{ route('admin.academic-years.activate', $year) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="btn btn-ghost text-xs">Aktifkan</button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.academic-years.destroy', $year) }}" class="inline" onsubmit="return confirm('Hapus tahun ajaran ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-xs">Hapus</button>
                                        </form>
                                        @else
                                        <span class="text-gray-400 dark:text-gray-500 text-xs">-</span>
                                        @endif
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
