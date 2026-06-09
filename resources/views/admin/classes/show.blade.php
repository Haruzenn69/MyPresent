<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Detail Kelas</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Informasi lengkap kelas</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.classes.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali
                    </a>
                    <a href="{{ route('admin.classes.edit', $class) }}" style="background:rgba(245,158,11,0.12);color:#F59E0B;border:1px solid rgba(245,158,11,0.25);border-radius:20px;padding:8px 20px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit Kelas
                    </a>
                </div>
            </div>

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;margin-bottom:24px;">
                <div class="row g-3">
                    <div class="col-md-6">
                        <p style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:0 0 4px;">Nama Kelas</p>
                        <p style="font-size:15px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">{{ $class->nama_kelas }}</p>
                    </div>
                    <div class="col-md-6">
                        <p style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:0 0 4px;">Wali Kelas</p>
                        <p style="font-size:15px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">{{ $class->waliKelas->nama ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:0 0 4px;">Jumlah Siswa</p>
                        <p style="font-size:15px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">{{ $class->students->count() }}</p>
                    </div>
                </div>
            </div>

            @if($class->students->isNotEmpty())
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:0;">
                <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);">
                    <h3 style="font-size:16px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Daftar Siswa</h3>
                </div>
                <div style="padding:0;">
                    @foreach($class->students as $student)
                    <div style="padding:14px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);font-size:14px;color:var(--md-sys-color-on-surface-variant);display:flex;align-items:center;gap:8px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        {{ $student->nama }} ({{ $student->nis }})
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
