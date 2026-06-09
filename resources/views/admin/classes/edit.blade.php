<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Edit Kelas</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Perbarui informasi kelas</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.classes.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali
                    </a>
                </div>
            </div>

            @if(session('success'))
            <div class="admin-card" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.2);margin-bottom:20px;padding:16px 20px;display:flex;align-items:center;gap:10px;">
                <span style="width:6px;height:6px;border-radius:50%;background:#10B981;flex-shrink:0;"></span>
                <span style="font-size:14px;color:var(--md-sys-color-on-surface);">{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="admin-card" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.2);margin-bottom:20px;padding:16px 20px;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                    <span style="width:6px;height:6px;border-radius:50%;background:#EF4444;flex-shrink:0;"></span>
                    <span style="font-size:14px;color:var(--md-sys-color-on-surface);">Silakan perbaiki kesalahan berikut.</span>
                </div>
                @foreach($errors->all() as $error)
                <p style="margin:0 0 4px 16px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;">
                        <h3 style="font-size:18px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0 0 20px;">Info Kelas</h3>
                        <form method="POST" action="{{ route('admin.classes.update', $class) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;" for="nama_kelas">Nama Kelas</label>
                                <input id="nama_kelas" name="nama_kelas" type="text" value="{{ old('nama_kelas', $class->nama_kelas) }}" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                <x-input-error :messages="$errors->get('nama_kelas')" />
                            </div>
                            <div class="mb-3">
                                <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;" for="wali_kelas">Wali Kelas</label>
                                <select id="wali_kelas" name="wali_kelas" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                    <option value="">Tanpa wali kelas</option>
                                    @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('wali_kelas', $class->wali_kelas) == $teacher->id ? 'selected' : '' }}>{{ $teacher->nama }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('wali_kelas')" />
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;cursor:pointer;">Perbarui Kelas</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;">
                        <h3 style="font-size:18px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0 0 20px;">Tambah Siswa ke Kelas</h3>
                        <form method="POST" action="{{ route('admin.classes.addStudent', $class) }}" class="d-flex gap-2 mb-3">
                            @csrf
                            <select name="student_id" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;flex:1;">
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($availableStudents as $student)
                                <option value="{{ $student->id }}">{{ $student->nama }} ({{ $student->nis }})</option>
                                @endforeach
                            </select>
                            <button type="submit" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 20px;font-size:13px;font-weight:500;cursor:pointer;white-space:nowrap;">Tambah</button>
                        </form>

                        @if($class->students->isNotEmpty())
                        <h4 style="font-size:15px;font-weight:600;color:var(--md-sys-color-on-surface);margin:20px 0 12px;">Daftar Siswa kelas ini:</h4>
                        <div style="border:1px solid var(--md-sys-color-outline-variant);border-radius:12px;overflow:hidden;">
                            @foreach($class->students as $student)
                            <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 16px;border-bottom:1px solid var(--md-sys-color-outline-variant);font-size:13px;color:var(--md-sys-color-on-surface-variant);">
                                <span>{{ $student->nama }} ({{ $student->nis }})</span>
                                <form method="POST" action="{{ route('admin.classes.removeStudent', [$class, $student]) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:rgba(239,68,68,0.12);color:#EF4444;border:none;border-radius:10px;padding:6px 12px;font-size:12px;font-weight:500;display:inline-flex;align-items:center;gap:4px;cursor:pointer;">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
