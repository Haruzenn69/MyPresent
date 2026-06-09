<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            @if(session('success'))
            <div class="admin-card" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.2);margin-bottom:20px;padding:16px 20px;display:flex;align-items:center;gap:10px;">
                <span style="width:6px;height:6px;border-radius:50%;background:#10B981;flex-shrink:0;"></span>
                <span style="font-size:14px;color:var(--md-sys-color-on-surface);">{{ session('success') }}</span>
            </div>
            @endif

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Riwayat Absensi</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Daftar riwayat absensi siswa</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('guru.attendances.rekap.pdf', request()->all()) }}" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">Rekap PDF</a>
                    <a href="{{ route('guru.attendances.create') }}" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">+ Input Absensi</a>
                </div>
            </div>

            <form method="GET" class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);margin-bottom:20px;">
                <div style="padding:20px;">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="class_id" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Kelas</label>
                            <select name="class_id" onchange="this.form.submit()" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                <option value="">Semua Kelas</option>
                                @foreach($classes as $kelas)
                                <option value="{{ $kelas->id }}" {{ request('class_id') == $kelas->id ? 'selected' : '' }}>
                                    {{ $kelas->nama_kelas }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="start_date" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Mulai Tanggal</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" onchange="this.form.submit()" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Sampai Tanggal</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" onchange="this.form.submit()" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            @if(request()->anyFilled('class_id', 'start_date', 'end_date'))
                            <a href="{{ route('guru.attendances.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;width:100%;justify-content:center;">Reset Filter</a>
                            @else
                            <div style="color:var(--md-sys-color-on-surface-variant);text-align:center;width:100%;font-size:13px;">Pilih filter untuk menyaring data</div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:0;">
                <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Riwayat Absensi</span>
                    <span style="font-size:12px;color:var(--md-sys-color-on-surface-variant);">{{ $attendances->total() }} data</span>
                </div>
                <div class="table-responsive">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Tanggal</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Kelas</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Guru</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Hadir</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Alfa</th>
                                <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $absensi)
                            @php
                            $hadir = $absensi->details->where('status', 'hadir')->count() + $absensi->details->where('status', 'terlambat')->count();
                            $alfa = $absensi->details->where('status', 'alfa')->count();
                            @endphp
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);transition:background 0.15s;" onmouseover="this.style.background='var(--md-sys-color-surface-container-low)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface);">{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y') }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface);">{{ $absensi->kelas->nama_kelas }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface);">{{ $absensi->guru->nama }}</td>
                                <td style="padding:14px 20px;text-align:center;font-size:13px;color:var(--md-sys-color-on-surface);">{{ $hadir }}</td>
                                <td style="padding:14px 20px;text-align:center;font-size:13px;color:var(--md-sys-color-on-surface);">{{ $alfa }}</td>
                                <td style="padding:14px 20px;text-align:center;">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ route('guru.attendances.show', $absensi) }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:6px 14px;font-size:12px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">Detail</a>
                                        <a href="{{ route('guru.attendances.edit', $absensi) }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:6px 14px;font-size:12px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">Edit</a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" style="padding:60px 20px;text-align:center;">
                                    <div style="width:56px;height:56px;border-radius:16px;background:var(--md-sys-color-surface-container-low);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="1.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    </div>
                                    <p style="font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);margin:0 0 4px;">Belum ada data absensi</p>
                                    <p style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin:0;">Belum ada data absensi untuk ditampilkan</p>
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
