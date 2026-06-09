<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Tambah Siswa</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Buat akun siswa baru</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.students.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Batal
                    </a>
                </div>
            </div>

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;">
                <form method="POST" action="{{ route('admin.students.store') }}">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <x-input-label for="nis" value="NIS" />
                                <x-text-input id="nis" name="nis" type="text" class="form-control" value="{{ old('nis') }}" required />
                                @error('nis')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <x-input-label for="nama" value="Nama" />
                                <x-text-input id="nama" name="nama" type="text" class="form-control" value="{{ old('nama') }}" required />
                                @error('nama')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <x-input-label for="email" value="Email" />
                                <x-text-input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" required />
                                @error('email')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <x-input-label for="kelas_id" value="Kelas" />
                                <select id="kelas_id" name="kelas_id" class="form-select" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                    <option value="">-- Tanpa Kelas --</option>
                                    @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('kelas_id') == $class->id ? 'selected' : '' }}>{{ $class->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <x-input-label for="password" value="Password" />
                                <x-text-input id="password" name="password" type="password" class="form-control" required />
                                @error('password')
                                <x-input-error :messages="$message" />
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <x-input-label for="alamat" value="Alamat" />
                                <textarea id="alamat" name="alamat" class="form-control" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;min-height:80px;">{{ old('alamat') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 pt-3 border-top" style="border-color:var(--md-sys-color-outline-variant) !important;">
                        <a href="{{ route('admin.students.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;">Batal</a>
                        <button type="submit" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;display:inline-flex;align-items:center;gap:6px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
