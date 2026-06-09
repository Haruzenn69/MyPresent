<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">Tambah Kelas</h2>
            <a href="{{ route('admin.classes.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400">Kembali</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 card p-6">
            @if($errors->any())
                <div class="card p-4 border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 mb-4">
                    Silakan perbaiki kesalahan berikut.
                </div>
            @endif

            <form method="POST" action="{{ route('admin.classes.store') }}">
                @csrf
                <div class="grid gap-4">
                    <div>
                        <x-input-label for="nama_kelas" value="Nama Kelas" />
                        <x-text-input id="nama_kelas" name="nama_kelas" type="text" class="mt-1 w-full" value="{{ old('nama_kelas') }}" required />
                        <x-input-error :messages="$errors->get('nama_kelas')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="wali_kelas" value="Wali Kelas" />
                        <select id="wali_kelas" name="wali_kelas" class="input mt-1">
                            <option value="">Tanpa wali kelas</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('wali_kelas') == $teacher->id ? 'selected' : '' }}>{{ $teacher->nama }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('wali_kelas')" class="mt-2" />
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary">Simpan Kelas</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
