<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">
            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Tambah Akun Baru</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Buat akun baru untuk guru atau siswa</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.users.index', request('role') ? ['role' => request('role')] : []) }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">&larr; Kembali</a>
                </div>
            </div>

            @if($errors->any())
            <div class="admin-card" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.2);margin-bottom:20px;padding:16px 20px;display:flex;align-items:center;gap:10px;">
                <span style="width:6px;height:6px;border-radius:50%;background:#EF4444;flex-shrink:0;"></span>
                <span style="font-size:14px;color:var(--md-sys-color-on-surface);">Silakan perbaiki kesalahan berikut.</span>
            </div>
            @endif

            {{-- Content Card --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Nama</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;" />
                        <x-input-error :messages="$errors->get('name')" />
                    </div>
                    <div class="mb-3">
                        <label for="email" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;" />
                        <x-input-error :messages="$errors->get('email')" />
                    </div>
                    <div class="mb-3">
                        <label for="role" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Role</label>
                        <select id="role" name="role" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                            <option value="">Pilih role</option>
                            <option value="admin" {{ old('role', request('role')) === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="guru" {{ old('role', request('role')) === 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="siswa" {{ old('role', request('role')) === 'siswa' ? 'selected' : '' }}>Siswa</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" />
                    </div>
                    <div id="guru-fields" class="{{ old('role', request('role')) === 'guru' ? '' : 'd-none' }}">
                        <div class="mb-3">
                            <label for="nip" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">NIP Guru</label>
                            <input id="nip" name="nip" type="text" value="{{ old('nip') }}" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;" />
                            <x-input-error :messages="$errors->get('nip')" />
                        </div>
                        <div class="mb-3">
                            <label for="bidang_studi" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Bidang Studi</label>
                            <select id="bidang_studi" name="bidang_studi" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                <option value="">-- Pilih Bidang Studi --</option>
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ old('bidang_studi') == $subject->id ? 'selected' : '' }}>{{ $subject->nama }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('bidang_studi')" />
                        </div>
                    </div>
                    <div id="siswa-fields" class="{{ old('role', request('role')) === 'siswa' ? '' : 'd-none' }}">
                        <div class="mb-3">
                            <label for="nis" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">NIS Siswa</label>
                            <input id="nis" name="nis" type="text" value="{{ old('nis') }}" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;" />
                            <x-input-error :messages="$errors->get('nis')" />
                        </div>
                        <div class="mb-3">
                            <label for="kelas_id" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Kelas</label>
                            <select id="kelas_id" name="kelas_id" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('kelas_id') == $class->id ? 'selected' : '' }}>{{ $class->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Alamat</label>
                            <textarea id="alamat" name="alamat" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Password</label>
                        <input id="password" name="password" type="password" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;" />
                        <x-input-error :messages="$errors->get('password')" />
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;" />
                        <x-input-error :messages="$errors->get('password_confirmation')" />
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.users.index', request('role') ? ['role' => request('role')] : []) }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">&larr; Batal</a>
                        <button type="submit" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('role').addEventListener('change', function() {
            document.getElementById('guru-fields').classList.toggle('d-none', this.value !== 'guru');
            document.getElementById('siswa-fields').classList.toggle('d-none', this.value !== 'siswa');
        });
    </script>
</x-app-layout>
