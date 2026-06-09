<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Data Guru</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Daftar seluruh guru</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.teachers.import') }}" style="background:rgba(13,148,136,0.15);color:#0D9488;border:1px solid rgba(13,148,136,0.25);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Impor CSV
                    </a>
                </div>
            </div>

            @if(session('success'))
            <div class="admin-card" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.2);margin-bottom:20px;padding:16px 20px;display:flex;align-items:center;gap:10px;">
                <span style="width:6px;height:6px;border-radius:50%;background:#10B981;flex-shrink:0;"></span>
                <span style="font-size:14px;color:var(--md-sys-color-on-surface);">{{ session('success') }}</span>
            </div>
            @endif

            {{-- Search --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);margin-bottom:20px;">
                <form method="GET" class="row g-2 align-items-end">
                    <div class="col-md-9">
                        <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Cari</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari NIP, Nama, atau Email..." value="{{ request('search') }}" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                    </div>
                    <div class="col-auto d-flex gap-2">
                        <button style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;">Cari</button>
                        <a href="{{ route('admin.teachers.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;">Reset</a>
                    </div>
                </form>
            </div>

            {{-- Table --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:0;">
                <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Daftar Guru</span>
                    <span style="font-size:12px;color:var(--md-sys-color-on-surface-variant);">{{ $teachers->total() }} guru</span>
                </div>
                <div class="table-responsive">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">NIP</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Nama</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Email</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Bidang Studi</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $teacher)
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);transition:background 0.15s;" onmouseover="this.style.background='var(--md-sys-color-surface-container-low)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $teacher->nip }}</td>
                                <td style="padding:14px 20px;font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);">{{ $teacher->nama }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ optional($teacher->user)->email ?? '-' }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ optional($teacher->bidangStudi)->nama ?? '-' }}</td>
                                <td style="padding:14px 20px;">
                                    @if($teacher->user)
                                    <a href="{{ route('admin.users.edit', $teacher->user) }}" style="background:rgba(245,158,11,0.12);color:#F59E0B;border:none;border-radius:10px;padding:6px 12px;font-size:12px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        Edit
                                    </a>
                                    @else
                                    <span style="font-size:13px;color:var(--md-sys-color-on-surface-variant);">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="padding:60px 20px;text-align:center;">
                                    <div style="width:56px;height:56px;border-radius:16px;background:var(--md-sys-color-surface-container-low);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    </div>
                                    <p style="font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);margin:0 0 4px;">Belum ada data guru</p>
                                    <p style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin:0;">Impor data guru untuk memulai</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($teachers->hasPages())
                <div style="padding:16px 20px;border-top:1px solid var(--md-sys-color-outline-variant);">
                    {{ $teachers->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
