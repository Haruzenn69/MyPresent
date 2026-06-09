<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">Data Kelas</h2>
            <a href="{{ route('guru.classes.create') }}" class="btn btn-primary">+ Tambah Kelas</a>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            @if(session('success'))<div class="card p-4 border-green-400 dark:border-green-700 text-green-800 dark:text-green-300 mb-4">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="card p-4 border-red-400 dark:border-red-700 text-red-800 dark:text-red-300 mb-4">{{ session('error') }}</div>@endif
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
                            @forelse($classes as $kelas)
                            <tr>
                                <td class="font-medium">{{ $kelas->nama_kelas }}</td>
                                <td class="text-gray-600 dark:text-gray-400">{{ $kelas->waliKelas->nama ?? '-' }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('guru.classes.show', $kelas) }}" class="btn btn-ghost text-xs">Detail</a>
                                        <a href="{{ route('guru.classes.edit', $kelas) }}" class="btn btn-ghost text-xs">Edit</a>
                                        <form method="POST" action="{{ route('guru.classes.destroy', $kelas) }}" onsubmit="return confirm('Hapus kelas ini?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger text-xs">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center">Belum ada kelas</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
