<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">Detail Akun</h2>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400">Kembali</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 card p-6">
            <div class="grid gap-4">
                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Nama</div>
                    <div class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Email</div>
                    <div class="font-medium text-gray-900 dark:text-white">{{ $user->email }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Role</div>
                    <div class="font-medium text-gray-900 dark:text-white capitalize">{{ $user->role }}</div>
                </div>

                @if($user->role === 'guru' && $user->teacher)
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">NIP</div>
                        <div class="font-medium text-gray-900 dark:text-white">{{ $user->teacher->nip }}</div>
                    </div>
                @endif

                @if($user->role === 'siswa' && $user->student)
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">NIS</div>
                        <div class="font-medium text-gray-900 dark:text-white">{{ $user->student->nis }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Kelas</div>
                        <div class="font-medium text-gray-900 dark:text-white">{{ $user->student->kelas->nama_kelas ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Jenis Kelamin</div>
                        <div class="font-medium text-gray-900 dark:text-white">{{ $user->student->jenis_kelamin }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Alamat</div>
                        <div class="font-medium text-gray-900 dark:text-white">{{ $user->student->alamat ?? '-' }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
