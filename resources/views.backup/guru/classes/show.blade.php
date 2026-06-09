<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">Kelas {{ $class->nama_kelas }}</h2>
            <a href="{{ route('guru.classes.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:underline">← Kembali</a>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            <div class="card p-6 mb-4">
                <p class="text-sm text-gray-600 dark:text-gray-400">Wali Kelas: <strong class="text-gray-900 dark:text-white">{{ $class->waliKelas->nama ?? '-' }}</strong></p>
                <p class="text-sm text-gray-600 dark:text-gray-400">Jumlah Siswa: <strong class="text-gray-900 dark:text-white">{{ $class->students->count() }}</strong></p>
            </div>
            <div class="card">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($class->students as $student)
                            <tr>
                                <td>{{ $student->nis }}</td>
                                <td class="font-medium">{{ $student->nama }}</td>
                                <td class="text-gray-600 dark:text-gray-400">{{ $student->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center">Belum ada siswa di kelas ini</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
