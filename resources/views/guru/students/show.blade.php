<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Detail Siswa</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Informasi lengkap siswa</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('guru.students.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                        Kembali
                    </a>
                </div>
            </div>

            {{-- Detail Card --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);margin-bottom:24px;">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;">
                    <div style="width:32px;height:32px;border-radius:8px;background:rgba(13,148,136,0.2);display:flex;align-items:center;justify-content:center;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">{{ $student->nama }}</span>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <p style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:0 0 4px;text-transform:uppercase;letter-spacing:0.5px;">NIS</p>
                        <p style="font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);margin:0;">{{ $student->nis }}</p>
                    </div>
                    <div class="col-md-6">
                        <p style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:0 0 4px;text-transform:uppercase;letter-spacing:0.5px;">Kelas</p>
                        <p style="font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);margin:0;">{{ $student->kelas->nama_kelas ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:0 0 4px;text-transform:uppercase;letter-spacing:0.5px;">Jenis Kelamin</p>
                        <p style="font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);margin:0;">{{ $student->jenis_kelamin }}</p>
                    </div>
                    <div class="col-md-6">
                        <p style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin:0 0 4px;text-transform:uppercase;letter-spacing:0.5px;">Alamat</p>
                        <p style="font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);margin:0;">{{ $student->alamat ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <a href="{{ route('guru.students.attendance-trend', $student) }}" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
                    Lihat Tren Kehadiran
                </a>
            </div>

            @php
            $details = $student->attendanceDetails;
            $hadir = $details->where('status', 'hadir')->count();
            $sakit = $details->where('status', 'sakit')->count();
            $izin = $details->where('status', 'izin')->count();
            $alfa = $details->where('status', 'alfa')->count();
            $total = $details->count();
            @endphp

            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="admin-card" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.15);text-align:center;">
                        <h4 style="font-size:24px;font-weight:700;color:#10B981;margin:0 0 4px;">{{ $hadir }}</h4>
                        <p style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin:0;">Hadir</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="admin-card" style="--card-border:#F59E0B;--card-glow:rgba(245,158,11,0.15);text-align:center;">
                        <h4 style="font-size:24px;font-weight:700;color:#F59E0B;margin:0 0 4px;">{{ $sakit }}</h4>
                        <p style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin:0;">Sakit</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="admin-card" style="--card-border:#3B82F6;--card-glow:rgba(59,130,246,0.15);text-align:center;">
                        <h4 style="font-size:24px;font-weight:700;color:#3B82F6;margin:0 0 4px;">{{ $izin }}</h4>
                        <p style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin:0;">Izin</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="admin-card" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.15);text-align:center;">
                        <h4 style="font-size:24px;font-weight:700;color:#EF4444;margin:0 0 4px;">{{ $alfa }}</h4>
                        <p style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin:0;">Alfa</p>
                    </div>
                </div>
            </div>

            {{-- Riwayat Absensi --}}
            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:0;">
                <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);display:flex;justify-content:space-between;align-items:center;">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <div style="width:32px;height:32px;border-radius:8px;background:rgba(13,148,136,0.2);display:flex;align-items:center;justify-content:center;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0D9488" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Riwayat Absensi</span>
                    </div>
                </div>
                <div class="table-responsive">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Tanggal</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Kelas</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Status</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($student->attendanceDetails->sortByDesc(fn($d) => $d->attendance->tanggal)->take(10) as $detail)
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);transition:background 0.15s;" onmouseover="this.style.background='var(--md-sys-color-surface-container-low)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ \Carbon\Carbon::parse($detail->attendance->tanggal)->format('d/m/Y') }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $detail->attendance->kelas->nama_kelas ?? '-' }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-transform:capitalize;">{{ $detail->status }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $detail->keterangan ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="padding:60px 20px;text-align:center;">
                                    <div style="width:56px;height:56px;border-radius:16px;background:var(--md-sys-color-surface-container-low);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    </div>
                                    <p style="font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);margin:0 0 4px;">Belum ada data absensi</p>
                                    <p style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin:0;">Riwayat absensi akan muncul setelah pencatatan</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
