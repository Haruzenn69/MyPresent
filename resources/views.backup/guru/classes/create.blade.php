<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">Tambah Kelas</h2>
            <a href="{{ route('guru.classes.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:underline">← Kembali</a>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-xl mx-auto px-4">
            <div class="card p-6">
                <form method="POST" action="{{ route('guru.classes.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="input-label">Nama Kelas</label>
                        <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}"
                            class="input @error('nama_kelas') border-red-500 @enderror"
                            placeholder="Contoh: XII RPL 1">
                        @error('nama_kelas')<p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-6">
                        <label class="input-label">Wali Kelas</label>
                        <select name="wali_kelas" class="input">
                            <option value="">-- Pilih Wali Kelas --</option>
                            @foreach($teachers as $guru)
                            <option value="{{ $guru->id }}" {{ old('wali_kelas') == $guru->id ? 'selected' : '' }}>{{ $guru->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full btn btn-primary">Simpan Kelas</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
