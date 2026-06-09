<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">
            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Riwayat Absensi</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Kelola riwayat absensi semua kelas</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.attendances.rekap') }}" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Rekapitulasi
                    </a>
                    <a href="{{ route('admin.attendances.export', request()->all()) }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Export PDF
                    </a>
                </div>
            </div>

            {{-- Filter Card --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;margin-bottom:20px;">
                <form method="GET" action="{{ route('admin.attendances.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="class_id" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Kelas</label>
                            <select name="class_id" id="class_id" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                <option value="">Semua Kelas</option>
                                @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>{{ $class->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="start_date" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Dari Tanggal</label>
                            <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Sampai Tanggal</label>
                            <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;width:100%;">Filter</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Table Card --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:0;">
                <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Data Absensi</span>
                    <span style="font-size:12px;color:var(--md-sys-color-on-surface-variant);">{{ $attendances->total() }} records</span>
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Tanggal</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Kelas</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Guru</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">H</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">I</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">S</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">A</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">T</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $attendance)
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);transition:background 0.15s;" onmouseover="this.style.background='var(--md-sys-color-surface-container)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface);">{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $attendance->kelas->nama_kelas }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $attendance->guru->nama }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">
                                    <span style="display:inline-block;padding:2px 10px;border-radius:10px;font-size:12px;font-weight:500;background:rgba(16,185,129,0.15);color:#10B981;">{{ $attendance->details->where('status', 'hadir')->count() }}</span>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">
                                    <span style="display:inline-block;padding:2px 10px;border-radius:10px;font-size:12px;font-weight:500;background:rgba(6,182,212,0.15);color:#06B6D4;">{{ $attendance->details->where('status', 'izin')->count() }}</span>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">
                                    <span style="display:inline-block;padding:2px 10px;border-radius:10px;font-size:12px;font-weight:500;background:rgba(245,158,11,0.15);color:#F59E0B;">{{ $attendance->details->where('status', 'sakit')->count() }}</span>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">
                                    <span style="display:inline-block;padding:2px 10px;border-radius:10px;font-size:12px;font-weight:500;background:rgba(239,68,68,0.15);color:#EF4444;">{{ $attendance->details->where('status', 'alfa')->count() }}</span>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">
                                    <span style="display:inline-block;padding:2px 10px;border-radius:10px;font-size:12px;font-weight:500;background:rgba(99,102,241,0.15);color:#6366F1;">{{ $attendance->details->where('status', 'terlambat')->count() }}</span>
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:center;">
                                    <a href="{{ route('admin.attendances.show', $attendance) }}" style="display:inline-block;padding:4px 14px;border-radius:20px;font-size:12px;font-weight:500;background:rgba(13,148,136,0.15);color:#0D9488;text-decoration:none;white-space:nowrap;">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" style="padding:60px 20px;text-align:center;">
                                    <div style="display:flex;flex-direction:column;align-items:center;gap:12px;">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="1.5" opacity="0.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                        <span style="font-size:14px;color:var(--md-sys-color-on-surface-variant);">Tidak ada data absensi</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($attendances->hasPages())
                <div style="padding:16px 20px;border-top:1px solid var(--md-sys-color-outline-variant);">
                    {{ $attendances->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
