<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">Edit Akun</h2>
            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-present-600 dark:hover:text-present-400">Kembali</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 card p-6">
            @if($errors->any())
                <div class="card p-4 border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 mb-4">
                    Silakan perbaiki kesalahan berikut.
                </div>
            @endif

            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="grid gap-4">
                    <div>
                        <x-input-label for="name" value="Nama" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 w-full" value="{{ old('name', $user->name) }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 w-full" value="{{ old('email', $user->email) }}" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="role" value="Role" />
                        <x-text-input id="role" name="role" type="text" class="mt-1 w-full bg-gray-100 dark:bg-gray-800" value="{{ ucfirst($user->role) }}" disabled />
                        <input type="hidden" name="role" value="{{ $user->role }}" />
                    </div>

                    @if($user->role === 'guru')
                        <div id="guru-fields">
                            <x-input-label for="nip" value="NIP Guru" />
                            <x-text-input id="nip" name="nip" type="text" class="mt-1 w-full" value="{{ old('nip', $user->teacher->nip ?? '') }}" required />
                            <x-input-error :messages="$errors->get('nip')" class="mt-2" />
                        </div>
                    @endif

                    @if($user->role === 'siswa')
                        <div id="siswa-fields" class="grid gap-4">
                            <div>
                                <x-input-label for="nis" value="NIS Siswa" />
                                <x-text-input id="nis" name="nis" type="text" class="mt-1 w-full" value="{{ old('nis', $user->student->nis ?? '') }}" required />
                                <x-input-error :messages="$errors->get('nis')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="kelas_id" value="Kelas" />
                                <select id="kelas_id" name="kelas_id" class="input mt-1" required>
                                    <option value="">Pilih kelas</option>
                                    @forelse(isset($classes) && $classes ? $classes : [] as $class)
                                        <option value="{{ $class->id }}" {{ old('kelas_id', $user->student->kelas_id ?? '') == $class->id ? 'selected' : '' }}>{{ $class->nama_kelas }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-input-error :messages="$errors->get('kelas_id')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
                                <select id="jenis_kelamin" name="jenis_kelamin" class="input mt-1" required>
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin', $user->student->jenis_kelamin ?? '') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin', $user->student->jenis_kelamin ?? '') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="alamat" value="Alamat" />
                                <textarea id="alamat" name="alamat" class="input mt-1" rows="3">{{ old('alamat', $user->student->alamat ?? '') }}</textarea>
                                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                            </div>
                        </div>
                    @endif

                    <div>
                        <x-input-label for="password" value="Password Baru (kosongkan jika tidak diubah)" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 w-full" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="btn btn-primary">Perbarui Akun</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
