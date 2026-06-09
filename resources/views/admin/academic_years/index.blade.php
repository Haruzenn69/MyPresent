<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">
            @if(session('success'))
                <div style="display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:10px;border-left:4px solid #10B981;background:rgba(16,185,129,0.08);margin-bottom:20px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span style="font-size:13px;color:var(--md-sys-color-on-surface);">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div style="display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:10px;border-left:4px solid #EF4444;background:rgba(239,68,68,0.08);margin-bottom:20px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <span style="font-size:13px;color:var(--md-sys-color-on-surface);">{{ session('error') }}</span>
                </div>
            @endif

            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:16px;">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0 0 4px 0;">{{ __('Kelola Tahun Ajaran') }}</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:0;">Atur tahun ajaran dan semester aktif</p>
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 2fr;gap:20px;">
                <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface)" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        <h3 style="font-size:15px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">Tambah Tahun Ajaran</h3>
                    </div>
                    <form method="POST" action="{{ route('admin.academic-years.store') }}">
                        @csrf
                        <div style="margin-bottom:16px;">
                            <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Tahun (Contoh: 2024/2025)</label>
                            <input id="year" name="year" type="text" required placeholder="2024-2025" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                        </div>
                        <div style="margin-bottom:20px;">
                            <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Semester</label>
                            <select id="semester" name="semester" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
                            </select>
                        </div>
                        <button style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:10px 18px;font-size:13px;font-weight:500;cursor:pointer;width:100%;display:inline-flex;align-items:center;justify-content:center;gap:6px;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            Simpan
                        </button>
                    </form>
                </div>

                <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:0;">
                    <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);display:flex;align-items:center;justify-content:space-between;">
                        <div style="display:flex;align-items:center;gap:8px;">
                            <h3 style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">Daftar Tahun Ajaran</h3>
                            <span style="font-size:11px;font-weight:500;color:white;background:var(--md-sys-color-primary);border-radius:10px;padding:2px 8px;">{{ count($years) }}</span>
                        </div>
                    </div>
                    <div style="overflow-x:auto;">
                        <table style="width:100%;border-collapse:collapse;">
                            <thead>
                                <tr>
                                    <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Tahun Ajaran</th>
                                    <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Semester</th>
                                    <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Status</th>
                                    <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--md-sys-color-outline-variant);">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($years as $year)
                                <tr style="transition:background 0.15s;" onmouseenter="this.style.background='var(--md-sys-color-surface-container-low)'" onmouseleave="this.style.background='transparent'">
                                    <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface);border-bottom:1px solid var(--md-sys-color-outline-variant);font-weight:500;">{{ $year->year }}</td>
                                    <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);border-bottom:1px solid var(--md-sys-color-outline-variant);text-transform:uppercase;">{{ $year->semester }}</td>
                                    <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);border-bottom:1px solid var(--md-sys-color-outline-variant);text-align:center;">
                                        @if($year->is_active)
                                        <span style="font-size:11px;font-weight:500;border-radius:10px;padding:3px 10px;background:#10B981;color:white;">Aktif</span>
                                        @else
                                        <span style="font-size:11px;font-weight:500;border-radius:10px;padding:3px 10px;background:#F59E0B;color:white;">Non-Aktif</span>
                                        @endif
                                    </td>
                                    <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);border-bottom:1px solid var(--md-sys-color-outline-variant);text-align:center;">
                                        @if(!$year->is_active)
                                        <form method="POST" action="{{ route('admin.academic-years.activate', $year) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" style="background:rgba(13,148,136,0.12);color:#0D9488;border:none;border-radius:20px;padding:6px 14px;font-size:12px;font-weight:500;cursor:pointer;display:inline-flex;align-items:center;gap:4px;">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                                                Aktifkan
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if(count($years) === 0)
                    <div style="padding:40px 20px;text-align:center;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="1.5" opacity="0.4"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:8px 0 0 0;">Belum ada tahun ajaran.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
