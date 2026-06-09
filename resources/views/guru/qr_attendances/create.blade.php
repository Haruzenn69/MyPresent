<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Buat Absensi via QR Code</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Buat QR absensi baru untuk kelas</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('guru.qr-attendances.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali
                    </a>
                </div>
            </div>

            @if($errors->any())
            <div class="admin-card" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.2);margin-bottom:20px;padding:16px 20px;display:flex;align-items:center;gap:10px;">
                <span style="width:6px;height:6px;border-radius:50%;background:#EF4444;flex-shrink:0;"></span>
                <span style="font-size:14px;color:var(--md-sys-color-on-surface);">Silakan perbaiki kesalahan berikut.</span>
            </div>
            @endif

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;max-width:600px;">
                <form action="{{ route('guru.qr-attendances.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Kelas <span style="color:#EF4444;">*</span></label>
                        <select name="class_id" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                            <option value="">Pilih Kelas</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Tanggal <span style="color:#EF4444;">*</span></label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                    </div>
                    <div class="mb-3">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Kadaluwarsa (menit)</label>
                        <input type="number" name="expires_in" value="{{ \App\Models\Setting::getValue('qr_expiry_minutes', 120) }}" min="1" max="720" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                        <small style="font-size:12px;color:var(--md-sys-color-on-surface-variant);display:block;margin-top:4px;">Default {{ \App\Models\Setting::getValue('qr_expiry_minutes', 120) }} menit (kosongkan untuk default). Maksimal 720 menit (12 jam).</small>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;cursor:pointer;">Buat QR Code</button>
                        <a href="{{ route('guru.qr-attendances.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
