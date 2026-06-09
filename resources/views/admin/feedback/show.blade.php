<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:28px;">
                <a href="{{ route('admin.feedback.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:50%;width:36px;height:36px;display:flex;align-items:center;justify-content:center;text-decoration:none;flex-shrink:0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                </a>
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0 0 4px 0;">Detail Feedback</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:0;">Lihat detail dan kelola feedback</p>
                </div>
            </div>

            <div style="display:grid;grid-template-columns:7fr 5fr;gap:20px;">
                <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:28px;">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
                        <div>
                            <h3 style="font-size:17px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0 0 4px 0;">{{ $feedback->user->name }}</h3>
                            <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:0;">{{ $feedback->user->email }}</p>
                            <p style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0 0;">{{ ucfirst($feedback->user->role) }}</p>
                        </div>
                        <div style="text-align:right;">
                            @php
                                $statusBadge = match($feedback->status) {
                                    'pending' => 'background:#F59E0B;color:white;',
                                    'dibaca' => 'background:#3B82F6;color:white;',
                                    'ditindaklanjuti' => 'background:#10B981;color:white;',
                                    default => 'background:#6B7280;color:white;',
                                };
                                $statusLabel = match($feedback->status) {
                                    'pending' => 'Pending',
                                    'dibaca' => 'Dibaca',
                                    'ditindaklanjuti' => 'Ditindaklanjuti',
                                    default => $feedback->status,
                                };
                            @endphp
                            <span style="font-size:11px;font-weight:500;border-radius:10px;padding:4px 12px;display:inline-block;margin-bottom:6px;{{ $statusBadge }}">{{ $statusLabel }}</span>
                            <br>
                            <small style="font-size:12px;color:var(--md-sys-color-on-surface-variant);">{{ $feedback->created_at->isoFormat('D MMMM YYYY, HH:mm') }}</small>
                        </div>
                    </div>

                    <div style="margin-bottom:16px;">
                        <span style="font-size:11px;font-weight:500;color:white;background:var(--md-sys-color-primary);border-radius:10px;padding:4px 12px;display:inline-block;">{{ ucfirst($feedback->category) }}</span>
                    </div>

                    <div style="padding:16px;border-radius:12px;background:var(--md-sys-color-surface-container-low);">
                        <p style="font-size:14px;color:var(--md-sys-color-on-surface);margin:0;white-space:pre-wrap;line-height:1.6;">{{ $feedback->message }}</p>
                    </div>

                    @if($feedback->reply)
                    <div style="margin-top:16px;padding:16px;border-radius:12px;background:rgba(13,148,136,0.08);border-left:3px solid #0D9488;">
                        <small style="font-size:12px;font-weight:600;color:#0D9488;display:block;margin-bottom:6px;">Balasan Anda:</small>
                        <p style="font-size:13px;color:var(--md-sys-color-on-surface);margin:0;white-space:pre-wrap;line-height:1.6;">{{ $feedback->reply }}</p>
                    </div>
                    @endif
                </div>

                <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;">
                    <h3 style="font-size:15px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0 0 20px 0;">Tanggapan</h3>

                    <form method="POST" action="{{ route('admin.feedback.update', $feedback) }}">
                        @csrf

                        <div style="margin-bottom:16px;">
                            <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Status</label>
                            <select name="status" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                <option value="pending" {{ $feedback->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="dibaca" {{ $feedback->status === 'dibaca' ? 'selected' : '' }}>Dibaca</option>
                                <option value="ditindaklanjuti" {{ $feedback->status === 'ditindaklanjuti' ? 'selected' : '' }}>Ditindaklanjuti</option>
                            </select>
                        </div>

                        <div style="margin-bottom:16px;">
                            <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Balasan (opsional)</label>
                            <textarea name="reply" rows="5" placeholder="Tulis balasan Anda..." style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;resize:vertical;">{{ old('reply', $feedback->reply) }}</textarea>
                        </div>

                        <div style="display:flex;gap:10px;">
                            <button type="submit" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;cursor:pointer;flex:1;">Simpan</button>
                            <form method="POST" action="{{ route('admin.feedback.destroy', $feedback) }}" onsubmit="return confirm('Hapus feedback ini?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:rgba(239,68,68,0.12);color:#EF4444;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;cursor:pointer;display:inline-flex;align-items:center;gap:4px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
