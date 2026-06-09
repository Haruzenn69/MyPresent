<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">
            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Detail Akun</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Informasi lengkap akun {{ $user->name }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.users.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">&larr; Kembali</a>
                </div>
            </div>

            {{-- Content Card --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div style="margin-bottom:4px;font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);">Nama</div>
                        <div style="font-size:14px;color:var(--md-sys-color-on-surface);font-weight:500;">{{ $user->name }}</div>
                    </div>
                    <div class="col-md-6">
                        <div style="margin-bottom:4px;font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);">Email</div>
                        <div style="font-size:14px;color:var(--md-sys-color-on-surface);font-weight:500;">{{ $user->email }}</div>
                    </div>
                    <div class="col-md-6">
                        <div style="margin-bottom:4px;font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);">Role</div>
                        <div style="font-size:14px;color:var(--md-sys-color-on-surface);font-weight:500;text-transform:capitalize;">{{ $user->role }}</div>
                    </div>
                    @if($user->role === 'guru' && $user->teacher)
                    <div class="col-md-6">
                        <div style="margin-bottom:4px;font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);">NIP</div>
                        <div style="font-size:14px;color:var(--md-sys-color-on-surface);font-weight:500;">{{ $user->teacher->nip }}</div>
                    </div>
                    @endif
                    @if($user->role === 'siswa' && $user->student)
                    <div class="col-md-6">
                        <div style="margin-bottom:4px;font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);">NIS</div>
                        <div style="font-size:14px;color:var(--md-sys-color-on-surface);font-weight:500;">{{ $user->student->nis }}</div>
                    </div>
                    <div class="col-md-6">
                        <div style="margin-bottom:4px;font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);">Kelas</div>
                        <div style="font-size:14px;color:var(--md-sys-color-on-surface);font-weight:500;">{{ $user->student->kelas->nama_kelas ?? '-' }}</div>
                    </div>
                    <div class="col-md-6">
                        <div style="margin-bottom:4px;font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);">Jenis Kelamin</div>
                        <div style="font-size:14px;color:var(--md-sys-color-on-surface);font-weight:500;">{{ $user->student->jenis_kelamin }}</div>
                    </div>
                    <div class="col-md-6">
                        <div style="margin-bottom:4px;font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);">Alamat</div>
                        <div style="font-size:14px;color:var(--md-sys-color-on-surface);font-weight:500;">{{ $user->student->alamat ?? '-' }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.users.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">&larr; Kembali ke Daftar</a>
            </div>
        </div>
    </div>
</x-app-layout>
