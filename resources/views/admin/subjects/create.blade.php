<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:800px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
                <div>
                    <h1 style="font-size:22px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">Tambah Mata Pelajaran</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:2px 0 0;">Buat mata pelajaran baru</p>
                </div>
                <a href="{{ route('admin.subjects.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;">Kembali</a>
            </div>

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;border-radius:16px;background:var(--md-sys-color-surface-container-low,var(--md-sys-color-surface));box-shadow:0 1px 3px rgba(0,0,0,0.06),0 1px 2px rgba(0,0,0,0.04);border:1px solid var(--md-sys-color-outline-variant);">
                <form action="{{ route('admin.subjects.store') }}" method="POST">
                    @csrf
                    <div style="margin-bottom:20px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Kode <span style="color:#EF4444;">*</span></label>
                        <input type="text" name="kode" class="@error('kode') is-invalid @enderror" value="{{ old('kode') }}" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;{{ $errors->has('kode') ? 'border-color:#EF4444;' : '' }}">
                        @error('kode') <div style="font-size:11px;color:#EF4444;margin-top:4px;">{{ $message }}</div> @enderror
                    </div>
                    <div style="margin-bottom:20px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Nama <span style="color:#EF4444;">*</span></label>
                        <input type="text" name="nama" class="@error('nama') is-invalid @enderror" value="{{ old('nama') }}" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;{{ $errors->has('nama') ? 'border-color:#EF4444;' : '' }}">
                        @error('nama') <div style="font-size:11px;color:#EF4444;margin-top:4px;">{{ $message }}</div> @enderror
                    </div>
                    <div style="margin-bottom:24px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Deskripsi</label>
                        <textarea name="deskripsi" rows="3" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;resize:vertical;">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div style="display:flex;gap:12px;">
                        <button style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;cursor:pointer;">Simpan</button>
                        <a href="{{ route('admin.subjects.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
