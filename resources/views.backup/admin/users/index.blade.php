<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">Kelola Akun</h2>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Tambah Akun</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4">
            @if(session('success'))
            <div class="card p-4 border-green-400 dark:border-green-700 text-green-800 dark:text-green-300 text-sm mb-4">{{ session('success') }}</div>
            @endif
            <div class="card card-border">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td class="font-medium">{{ $user->name }}</td>
                                <td class="text-gray-600 dark:text-gray-400">{{ $user->email }}</td>
                                <td class="capitalize text-gray-600 dark:text-gray-400">{{ $user->role }}</td>
                                <td>
                                    <div class="flex items-center gap-3 justify-between">
                                        <div class="flex gap-2 items-center">
                                            <a href="{{ route('admin.users.show', $user) }}" class="text-present-600 dark:text-present-400 hover:underline text-xs">Detail</a>
                                            <a href="{{ route('admin.users.edit', $user) }}" class="text-yellow-600 dark:text-yellow-400 hover:underline text-xs">Edit</a>
                                        </div>
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus akun ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="icon-danger" aria-label="Hapus {{ $user->name }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                  <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-gray-400 dark:text-gray-500">Belum ada akun</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
