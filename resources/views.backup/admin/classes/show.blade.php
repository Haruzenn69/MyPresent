<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">Detail Kelas</h2>
            <a href="{{ route('admin.classes.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 text-sm">Kembali</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 card p-6">
            <div class="grid gap-4">
                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Nama Kelas</div>
                    <div class="font-medium text-gray-900 dark:text-white">{{ $class->nama_kelas }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Wali Kelas</div>
                    <div class="font-medium text-gray-900 dark:text-white">{{ $class->waliKelas->nama ?? '-' }}</div>
                </div>
                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">Jumlah Siswa</div>
                    <div class="font-medium text-gray-900 dark:text-white">{{ $class->students->count() }}</div>
                </div>

                @if($class->students->isNotEmpty())
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Daftar Siswa</div>
                        <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                            @foreach($class->students as $student)
                                <li>{{ $student->nama }} ({{ $student->nis }})</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
