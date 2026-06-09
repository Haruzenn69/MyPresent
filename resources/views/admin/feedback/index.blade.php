<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">
            @if(session('success'))
                <div style="display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:10px;border-left:4px solid #10B981;background:rgba(16,185,129,0.08);margin-bottom:20px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span style="font-size:13px;color:var(--md-sys-color-on-surface);">{{ session('success') }}</span>
                </div>
            @endif

            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:16px;">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0 0 4px 0;">Feedback &amp; Masukan</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:0;">Kelola feedback dari pengguna</p>
                </div>
            </div>

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;margin-bottom:20px;">
                <form method="GET" style="display:flex;flex-wrap:wrap;gap:12px;align-items:flex-end;">
                    <div style="flex:1;min-width:160px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Kategori</label>
                        <select name="category" onchange="this.form.submit()" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                            <option value="">Semua Kategori</option>
                            <option value="saran" {{ request('category') === 'saran' ? 'selected' : '' }}>Saran</option>
                            <option value="kritik" {{ request('category') === 'kritik' ? 'selected' : '' }}>Kritik</option>
                            <option value="masukan" {{ request('category') === 'masukan' ? 'selected' : '' }}>Masukan</option>
                            <option value="laporan" {{ request('category') === 'laporan' ? 'selected' : '' }}>Laporan</option>
                            <option value="lainnya" {{ request('category') === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div style="flex:1;min-width:140px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Status</label>
                        <select name="status" onchange="this.form.submit()" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="dibaca" {{ request('status') === 'dibaca' ? 'selected' : '' }}>Dibaca</option>
                            <option value="ditindaklanjuti" {{ request('status') === 'ditindaklanjuti' ? 'selected' : '' }}>Ditindaklanjuti</option>
                        </select>
                    </div>
                    <div>
                        <a href="{{ route('admin.feedback.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-block;">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:0;">
                <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);display:flex;align-items:center;justify-content:space-between;">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <h3 style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">Daftar Feedback</h3>
                        <span style="font-size:11px;font-weight:500;color:white;background:var(--md-sys-color-primary);border-radius:10px;padding:2px 8px;">{{ $feedbacks->total() }}</span>
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Dari</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Kategori</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Pesan</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Status</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Tanggal</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($feedbacks as $feedback)
                            <tr style="transition:background 0.15s;" onmouseenter="this.style.background='var(--md-sys-color-surface-container-low)'" onmouseleave="this.style.background='transparent'">
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface);border-bottom:1px solid var(--md-sys-color-outline-variant);font-weight:500;">{{ $feedback->user->name }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                    @php
                                        $catLabel = match($feedback->category) {
                                            'saran' => 'Saran',
                                            'kritik' => 'Kritik',
                                            'masukan' => 'Masukan',
                                            'laporan' => 'Laporan',
                                            default => 'Lainnya',
                                        };
                                    @endphp
                                    <span style="font-size:11px;font-weight:500;color:white;background:var(--md-sys-color-primary);border-radius:10px;padding:3px 10px;">{{ $catLabel }}</span>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);border-bottom:1px solid var(--md-sys-color-outline-variant);max-width:300px;">
                                    <div style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:300px;">{{ $feedback->message }}</div>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                    @php
                                        $statusStyle = match($feedback->status) {
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
                                    <span style="font-size:11px;font-weight:500;border-radius:10px;padding:3px 10px;{{ $statusStyle }}">{{ $statusLabel }}</span>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);border-bottom:1px solid var(--md-sys-color-outline-variant);">{{ $feedback->created_at->format('d/m/Y H:i') }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                    <a href="{{ route('admin.feedback.show', $feedback) }}" style="background:rgba(13,148,136,0.12);color:#0D9488;border:none;border-radius:20px;padding:6px 14px;font-size:12px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="padding:40px 20px;text-align:center;">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="1.5" opacity="0.4"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:8px 0 0 0;">Belum ada feedback</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($feedbacks->hasPages())
                <div style="padding:12px 20px;border-top:1px solid var(--md-sys-color-outline-variant);display:flex;justify-content:center;">
                    {{ $feedbacks->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
