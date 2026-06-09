<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:16px;">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0 0 4px 0;">Audit Trail</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:0;">Log aktivitas sistem</p>
                </div>
            </div>

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:20px 24px;margin-bottom:20px;">
                <form method="GET" style="display:flex;flex-wrap:wrap;gap:12px;align-items:flex-end;">
                    <div style="min-width:160px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Aksi</label>
                        <select name="action" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;">
                            <option value="">Semua Aksi</option>
                            <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Created</option>
                            <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Updated</option>
                            <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }}>Deleted</option>
                        </select>
                    </div>
                    <div style="flex:1;min-width:180px;">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Cari Model</label>
                        <input type="text" name="model_type" placeholder="Cari model..." value="{{ request('model_type') }}" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                    </div>
                    <div style="display:flex;gap:8px;">
                        <button style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;cursor:pointer;">Filter</button>
                        <a href="{{ route('admin.audit-logs.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-block;">Reset</a>
                    </div>
                </form>
            </div>

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:0;">
                <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);display:flex;align-items:center;justify-content:space-between;">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <h3 style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">Riwayat Aktivitas</h3>
                        <span style="font-size:11px;font-weight:500;color:white;background:var(--md-sys-color-primary);border-radius:10px;padding:2px 8px;">{{ $logs->total() }}</span>
                    </div>
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Waktu</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">User</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Aksi</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Model</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                                <tr style="transition:background 0.15s;" onmouseenter="this.style.background='var(--md-sys-color-surface-container-low)'" onmouseleave="this.style.background='transparent'">
                                    <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);border-bottom:1px solid var(--md-sys-color-outline-variant);">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                    <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface);border-bottom:1px solid var(--md-sys-color-outline-variant);font-weight:500;">{{ $log->user?->name ?? 'System' }}</td>
                                    <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                        @if($log->action == 'created') <span style="font-size:11px;font-weight:500;border-radius:10px;padding:3px 10px;background:#10B981;color:white;">CREATED</span>
                                        @elseif($log->action == 'updated') <span style="font-size:11px;font-weight:500;border-radius:10px;padding:3px 10px;background:#F59E0B;color:white;">UPDATED</span>
                                        @elseif($log->action == 'deleted') <span style="font-size:11px;font-weight:500;border-radius:10px;padding:3px 10px;background:#EF4444;color:white;">DELETED</span>
                                        @else <span style="font-size:11px;font-weight:500;border-radius:10px;padding:3px 10px;background:#6B7280;color:white;">{{ strtoupper($log->action) }}</span>
                                        @endif
                                    </td>
                                    <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);border-bottom:1px solid var(--md-sys-color-outline-variant);">{{ class_basename($log->model_type) }} #{{ $log->model_id }}</td>
                                    <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);border-bottom:1px solid var(--md-sys-color-outline-variant);">{{ $log->description }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="padding:40px 20px;text-align:center;">
                                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="1.5" opacity="0.4"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:8px 0 0 0;">Belum ada log.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div style="margin-top:16px;display:flex;justify-content:center;">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
