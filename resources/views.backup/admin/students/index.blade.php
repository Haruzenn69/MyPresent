<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">Kelola Siswa</h2>
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary">+ Tambah Siswa</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4">
            @if(session('success'))<div class="card p-4 border-green-400 dark:border-green-700 text-green-800 dark:text-green-300 mb-4">{{ session('success') }}</div>@endif
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
                                <td class="text-gray-600 dark:text-gray-400">{{ $student->kelas?->nama_kelas ?? '-' }}</td>
                                <td class="text-gray-600 dark:text-gray-400">{{ $student->jenis_kelamin === 'Laki-laki' ? 'L' : 'P' }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.students.show', $student) }}" class="text-present-600 dark:text-present-400 hover:underline text-xs">Detail</a>
                                        <a href="{{ route('admin.students.edit', $student) }}" class="text-yellow-600 dark:text-yellow-400 hover:underline text-xs">Edit</a>
                                        <form method="POST" action="{{ route('admin.students.destroy', $student) }}" onsubmit="return confirm('Hapus siswa ini?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-600 dark:text-red-400 hover:underline text-xs">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center text-gray-400 dark:text-gray-500">Belum ada siswa</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
