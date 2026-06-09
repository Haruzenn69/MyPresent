<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Import Data Siswa</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Impor data siswa dari file CSV</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.students.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali
                    </a>
                </div>
            </div>

            @if($errors->any())
            <div class="admin-card" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.2);margin-bottom:20px;padding:16px 20px;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                    <span style="width:6px;height:6px;border-radius:50%;background:#EF4444;flex-shrink:0;"></span>
                    <span style="font-size:14px;font-weight:600;color:#EF4444;">Beberapa baris gagal diimpor</span>
                </div>
                <ul style="margin:0 0 0 16px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
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
                            <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Panduan Format CSV</span>
                        </div>
                        <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:0 0 16px;">Pastikan file CSV Anda mengikuti urutan kolom berikut:</p>
                        <div style="background:var(--md-sys-color-surface-container-low);border-radius:8px;padding:12px 16px;margin-bottom:16px;">
                            <code style="font-size:13px;color:var(--md-sys-color-on-surface);">NIS, Nama, Email, JK, Kelas, Alamat</code>
                        </div>
                        <ul style="margin:0 0 16px;padding-left:16px;font-size:13px;color:var(--md-sys-color-on-surface-variant);line-height:1.8;">
                            <li><strong style="color:var(--md-sys-color-on-surface);">NIS:</strong> Nomor Induk Siswa (unik).</li>
                            <li><strong style="color:var(--md-sys-color-on-surface);">Nama:</strong> Nama lengkap siswa.</li>
                            <li><strong style="color:var(--md-sys-color-on-surface);">Email:</strong> Digunakan untuk login akun.</li>
                            <li><strong style="color:var(--md-sys-color-on-surface);">JK:</strong> Isi 'L' untuk Laki-laki atau 'P' untuk Perempuan.</li>
                            <li><strong style="color:var(--md-sys-color-on-surface);">Kelas:</strong> Harus sesuai dengan nama kelas yang ada di sistem.</li>
                            <li><strong style="color:var(--md-sys-color-on-surface);">Alamat:</strong> Opsional.</li>
                        </ul>
                        <p style="font-size:12px;font-style:italic;color:var(--md-sys-color-on-surface-variant);margin:0;">Password akun siswa otomatis diset sama dengan NIS mereka.</p>
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
                        <form action="{{ route('admin.students.import.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="file" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Pilih File CSV</label>
                                <input type="file" name="file" accept=".csv" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                            </div>
                            <button type="submit" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;display:inline-flex;align-items:center;gap:6px;width:100%;justify-content:center;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Mulai Impor
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
