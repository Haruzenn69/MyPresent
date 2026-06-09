<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 dark:text-white">Data Siswa</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            {{-- Filter Kelas --}}
            <div class="mb-4 flex gap-2 flex-wrap">
                <a href="{{ route('guru.students.index') }}"
                   class="btn btn-secondary text-sm">Semua</a>
                @foreach($classes as $kelas)
                <a href="{{ route('guru.students.index', ['kelas' => $kelas->id]) }}"
                   class="btn btn-secondary text-sm">
                    {{ $kelas->nama_kelas }}
                </a>
                @endforeach
            </div>

            <div class="card">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jenis Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                            <tr>
                                <td class="text-gray-600 dark:text-gray-400">{{ $student->nis }}</td>
                                <td class="font-medium">{{ $student->nama }}</td>
                                <td class="text-gray-600 dark:text-gray-400">{{ $student->kelas->nama_kelas ?? '-' }}</td>
                                <td class="text-gray-600 dark:text-gray-400">{{ $student->jenis_kelamin }}</td>
                                <td>
                                    <a href="{{ route('guru.students.show', $student) }}"
                                       class="btn btn-ghost text-xs">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Belum ada data siswa
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
