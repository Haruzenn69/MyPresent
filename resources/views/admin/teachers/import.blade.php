<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Impor Guru</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Impor data guru dari file CSV</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.teachers.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
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
                    <span style="font-size:14px;font-weight:600;color:#EF4444;">Terdapat kesalahan</span>
                </div>
                <ul style="margin:0 0 0 16px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">
                    @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row g-4">
                <div class="col-md-5">
                    <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:16px;">
                            <div style="width:32px;height:32px;border-radius:8px;background:rgba(13,148,136,0.2);display:flex;align-items:center;justify-content:center;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                            </div>
                            <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Petunjuk Format CSV</span>
                        </div>
                        <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:0 0 8px;">Format CSV: <code style="background:var(--md-sys-color-surface-container-low);padding:2px 8px;border-radius:4px;font-size:12px;">NIP, Nama, Email, Kode Mapel</code></p>
                        <p style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin:0;">Baris pertama adalah header (akan dilewati). Kolom Kode Mapel opsional, diisi kode atau nama mapel yang sudah ada.</p>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;">
                            <div style="width:32px;height:32px;border-radius:8px;background:rgba(13,148,136,0.2);display:flex;align-items:center;justify-content:center;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            </div>
                            <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Upload File</span>
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Pilih file CSV</label>
                                <input type="file" name="file" accept=".csv,.txt" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                            </div>
                            <button style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;display:inline-flex;align-items:center;gap:6px;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Impor
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
