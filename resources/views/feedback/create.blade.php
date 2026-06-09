<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:700px;">

            {{-- Page Header --}}
            <div class="d-flex align-items-center gap-3 mb-4">
                <a href="{{ url()->previous() }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;text-decoration:none;flex-shrink:0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                </a>
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Kirim Masukan</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Kritik, saran, dan masukan Anda sangat berarti</p>
                </div>
            </div>

            @if(session('success'))
            <div class="admin-card" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.2);margin-bottom:20px;padding:16px 20px;display:flex;align-items:center;gap:10px;">
                <span style="width:6px;height:6px;border-radius:50%;background:#10B981;flex-shrink:0;"></span>
                <span style="font-size:14px;color:var(--md-sys-color-on-surface);">{{ session('success') }}</span>
            </div>
            @endif

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:32px;">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width:64px;height:64px;background:var(--md-sys-color-primary-container);">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            <line x1="9" y1="10" x2="15" y2="10"/>
                        </svg>
                    </div>
                    <h3 style="font-size:18px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0 0 4px;">Sampaikan Masukan Anda</h3>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:0;">Kritik, saran, dan masukan Anda sangat berarti untuk pengembangan aplikasi ini.</p>
                </div>

                <form method="POST" action="{{ route('feedback.store') }}">
                    @csrf

                    <div style="margin-bottom:16px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Kategori</label>
                        <select name="category" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                            <option value="masukan" {{ old('category') === 'masukan' ? 'selected' : '' }}>Masukan</option>
                            <option value="saran" {{ old('category') === 'saran' ? 'selected' : '' }}>Saran</option>
                            <option value="kritik" {{ old('category') === 'kritik' ? 'selected' : '' }}>Kritik</option>
                            <option value="laporan" {{ old('category') === 'laporan' ? 'selected' : '' }}>Laporan</option>
                            <option value="lainnya" {{ old('category') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('category') <div style="font-size:12px;color:#EF4444;margin-top:4px;">{{ $message }}</div> @enderror
                    </div>

                    <div style="margin-bottom:16px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Pesan</label>
                        <textarea name="message" rows="5" placeholder="Tulis pesan Anda di sini..." required minlength="10" maxlength="2000" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;resize:vertical;">{{ old('message') }}</textarea>
                        @error('message') <div style="font-size:12px;color:#EF4444;margin-top:4px;">{{ $message }}</div> @enderror
                        <div class="d-flex justify-content-end mt-1">
                            <small style="font-size:11px;color:var(--md-sys-color-on-surface-variant);" id="charCount">0 / 2000</small>
                        </div>
                    </div>

                    <button type="submit" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:10px 24px;font-size:14px;font-weight:500;cursor:pointer;width:100%;display:flex;align-items:center;justify-content:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        Kirim Masukan
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.querySelector('textarea[name="message"]')?.addEventListener('input', function () {
            document.getElementById('charCount').textContent = this.value.length + ' / 2000';
        });
    </script>
    @endpush
</x-app-layout>
