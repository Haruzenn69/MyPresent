<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:800px;">
            @if(session('success'))
                <div style="display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:10px;border-left:4px solid #10B981;background:rgba(16,185,129,0.08);margin-bottom:20px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span style="font-size:13px;color:var(--md-sys-color-on-surface);">{{ session('success') }}</span>
                </div>
            @endif

            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:16px;">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0 0 4px 0;">Pengaturan Aplikasi</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:0;">Konfigurasi pengaturan aplikasi</p>
                </div>
            </div>

            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:28px;">
                    <div style="display:flex;align-items:center;gap:8px;padding-bottom:16px;border-bottom:1px solid var(--md-sys-color-outline-variant);margin-bottom:24px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface)" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/></svg>
                        <h3 style="font-size:15px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">Umum</h3>
                    </div>

                    <div style="margin-bottom:20px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Nama Sekolah</label>
                        <input type="text" name="settings[sekolah_nama]" value="{{ \App\Models\Setting::getValue('sekolah_nama', 'SMK Contoh') }}" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                    </div>

                    <div style="margin-bottom:20px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Alamat Sekolah</label>
                        <textarea name="settings[sekolah_alamat]" rows="2" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;resize:vertical;">{{ \App\Models\Setting::getValue('sekolah_alamat', 'Jl. Contoh No. 1') }}</textarea>
                    </div>

                    <div style="margin-bottom:28px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Kepala Sekolah</label>
                        <input type="text" name="settings[sekolah_kepsek]" value="{{ \App\Models\Setting::getValue('sekolah_kepsek', '') }}" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                    </div>

                    <div style="display:flex;align-items:center;gap:8px;padding-bottom:16px;border-bottom:1px solid var(--md-sys-color-outline-variant);margin-bottom:24px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface)" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        <h3 style="font-size:15px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">Absensi</h3>
                    </div>

                    <div style="margin-bottom:20px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Batas Alfa Peringatan</label>
                        <input type="number" name="settings[batas_alfa_peringatan]" value="{{ \App\Models\Setting::getValue('batas_alfa_peringatan', 3) }}" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                        <small style="font-size:11px;color:var(--md-sys-color-on-surface-variant);margin-top:4px;display:block;">Jumlah alfa sebelum muncul peringatan di dashboard.</small>
                    </div>

                    <div style="margin-bottom:20px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Jam Mulai Sesi Pagi</label>
                        <input type="time" name="settings[jam_pagi_mulai]" value="{{ \App\Models\Setting::getValue('jam_pagi_mulai', '07:00') }}" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                    </div>

                    <div style="margin-bottom:28px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Masa Berlaku QR Code (menit)</label>
                        <input type="number" name="settings[qr_expiry_minutes]" value="{{ \App\Models\Setting::getValue('qr_expiry_minutes', 120) }}" min="1" max="720" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                        <small style="font-size:11px;color:var(--md-sys-color-on-surface-variant);margin-top:4px;display:block;">Default 120 menit (2 jam). Maksimal 720 menit (12 jam).</small>
                    </div>

                    <div style="padding-top:20px;border-top:1px solid var(--md-sys-color-outline-variant);">
                        <button style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:10px 28px;font-size:13px;font-weight:500;cursor:pointer;display:inline-flex;align-items:center;gap:6px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            Simpan Pengaturan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
