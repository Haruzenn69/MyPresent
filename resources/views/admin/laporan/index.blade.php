<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">
            @if(session('error'))
                <div style="display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:10px;border-left:4px solid #EF4444;background:rgba(239,68,68,0.08);margin-bottom:20px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#EF4444" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <span style="font-size:13px;color:var(--md-sys-color-on-surface);">{{ session('error') }}</span>
                </div>
            @endif

            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:16px;">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0 0 4px 0;">Laporan Absensi</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:0;">Cetak laporan absensi siswa dan kelas</p>
                </div>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(380px,1fr));gap:20px;margin-bottom:24px;">
                <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        <h3 style="font-size:15px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">Laporan Per Siswa</h3>
                    </div>
                    <form action="{{ route('admin.laporan.siswa-pdf') }}" method="GET" target="_blank">
                        <div style="margin-bottom:16px;">
                            <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Siswa <span style="color:#EF4444;">*</span></label>
                            <select name="student_id" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                <option value="">Pilih Siswa</option>
                                @foreach(\App\Models\Student::orderBy('nama')->get() as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->nis }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                            <div style="margin-bottom:16px;">
                                <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Dari Tanggal</label>
                                <input type="date" name="start_date" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                            </div>
                            <div style="margin-bottom:16px;">
                                <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Sampai Tanggal</label>
                                <input type="date" name="end_date" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                            </div>
                        </div>
                        <button style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;display:inline-flex;align-items:center;gap:6px;cursor:pointer;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            Cetak PDF
                        </button>
                    </form>
                </div>

                <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                        <h3 style="font-size:15px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">Laporan Per Kelas</h3>
                    </div>
                    <form action="{{ route('admin.laporan.kelas-pdf') }}" method="GET" target="_blank">
                        <div style="margin-bottom:16px;">
                            <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Kelas <span style="color:#EF4444;">*</span></label>
                            <select name="class_id" required style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                <option value="">Pilih Kelas</option>
                                @foreach(\App\Models\ClassRoom::orderBy('nama_kelas')->get() as $c)
                                    <option value="{{ $c->id }}">{{ $c->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                            <div style="margin-bottom:16px;">
                                <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Dari Tanggal</label>
                                <input type="date" name="start_date" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                            </div>
                            <div style="margin-bottom:16px;">
                                <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Sampai Tanggal</label>
                                <input type="date" name="end_date" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                            </div>
                        </div>
                        <button style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;display:inline-flex;align-items:center;gap:6px;cursor:pointer;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            Cetak PDF
                        </button>
                    </form>
                </div>
            </div>

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><rect x="2" y="3" width="20" height="18" rx="2"/><line x1="2" y1="9" x2="22" y2="9"/></svg>
                    <h3 style="font-size:15px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">Export Excel</h3>
                </div>
                <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:16px;">
                    <form action="{{ route('admin.export.attendance') }}" method="GET" style="display:flex;gap:8px;flex-wrap:wrap;align-items:flex-end;">
                        <select name="class_id" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;flex:1;min-width:120px;">
                            <option value="">Semua Kelas</option>
                            @foreach(\App\Models\ClassRoom::orderBy('nama_kelas')->get() as $c)
                                <option value="{{ $c->id }}">{{ $c->nama_kelas }}</option>
                            @endforeach
                        </select>
                        <input type="date" name="start_date" placeholder="Dari" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;flex:1;min-width:120px;">
                        <input type="date" name="end_date" placeholder="Sampai" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;flex:1;min-width:120px;">
                        <button style="background:#10B981;color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;display:inline-flex;align-items:center;gap:6px;cursor:pointer;white-space:nowrap;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            Export Absensi
                        </button>
                    </form>
                    <div>
                        <a href="{{ route('admin.export.student-report') }}" style="background:#10B981;color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;display:inline-flex;align-items:center;gap:6px;text-decoration:none;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                            Export Laporan Siswa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
