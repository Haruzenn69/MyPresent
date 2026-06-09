<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800">Edit Siswa</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4">
            <div class="card p-6">
                <form method="POST" action="{{ route('admin.students.update', $student) }}">
                    @csrf @method('PUT')

                    <div class="mb-4">
                        <label class="input-label">NIS</label>
                        <input type="text" name="nis" value="{{ old('nis', $student->nis) }}" class="input w-full @error('nis') border-red-500 @enderror" required>
                        @error('nis')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="input-label">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama', $student->nama) }}" class="input w-full @error('nama') border-red-500 @enderror" required>
                        @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="input-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $student->user->email) }}" class="input w-full @error('email') border-red-500 @enderror" required>
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <label class="input-label">Password <span class="text-gray-400">(kosongkan jika tidak diubah)</span></label>
                            <input type="password" name="password" class="input w-full @error('password') border-red-500 @enderror">
                            @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="input-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="input w-full">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="input-label">Kelas</label>
                        <select name="kelas_id" class="input w-full @error('kelas_id') border-red-500 @enderror">
                            <option value="">-- Tanpa Kelas --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('kelas_id', $student->kelas_id) == $class->id ? 'selected' : '' }}>{{ $class->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="input-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="input w-full @error('jenis_kelamin') border-red-500 @enderror" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $student->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="input-label">Alamat</label>
                        <textarea name="alamat" rows="3" class="input w-full @error('alamat') border-red-500 @enderror">{{ old('alamat', $student->alamat) }}</textarea>
                        @error('alamat')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

<div class="flex gap-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('admin.students.index') }}" class="btn btn-ghost">Batal</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
