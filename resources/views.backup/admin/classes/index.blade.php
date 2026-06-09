<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">Kelola Kelas</h2>
            <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">+ Tambah Kelas</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4">
            @if(session('success'))<div class="card p-4 border-green-400 dark:border-green-700 text-green-800 dark:text-green-300 text-sm mb-4">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="card p-4 border-red-400 dark:border-red-700 text-red-800 dark:text-red-300 text-sm mb-4">{{ session('error') }}</div>@endif
            <div class="card">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Kelas</th>
                                <th>Wali Kelas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(isset($classes) && $classes ? $classes : [] as $class)
                            <tr>
                                <td class="font-medium">{{ $class->nama_kelas }}</td>
                                <td class="text-gray-600 dark:text-gray-400">{{ $class->waliKelas->nama ?? '-' }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.classes.show', $class) }}" class="text-present-600 dark:text-present-400 hover:underline text-xs">Detail</a>
                                        <a href="{{ route('admin.classes.edit', $class) }}" class="text-yellow-600 dark:text-yellow-400 hover:underline text-xs">Edit</a>
                                        <form method="POST" action="{{ route('admin.classes.destroy', $class) }}" onsubmit="return confirm('Hapus kelas ini?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-600 dark:text-red-400 hover:underline text-xs">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-gray-400 dark:text-gray-500">Belum ada kelas</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
