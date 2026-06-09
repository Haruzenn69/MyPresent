<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Edit Absensi</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }}</p>
                </div>
                <a href="{{ route('guru.attendances.show', $attendance) }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">Kembali</a>
            </div>

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);margin-bottom:20px;">
                <div style="padding:20px;">
                    <div style="font-size:13px;color:var(--md-sys-color-on-surface-variant);">
                        Kelas: <strong style="color:var(--md-sys-color-on-surface);">{{ $attendance->kelas->nama_kelas ?? '-' }}</strong> |
                        Tanggal: <strong style="color:var(--md-sys-color-on-surface);">{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }}</strong>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('guru.attendances.update', $attendance) }}">
                @csrf
                @method('PUT')

                <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:0;">
                    <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);">
                        <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Edit Data Kehadiran</span>
                    </div>
                    <div style="padding:20px;">
                        <div class="table-responsive">
                            <table style="width:100%;border-collapse:collapse;">
                                <thead>
                                    <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                        <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Nama</th>
                                        <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Hadir</th>
                                        <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Sakit</th>
                                        <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Izin</th>
                                        <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Alfa</th>
                                        <th style="padding:12px 20px;text-align:center;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Telat</th>
                                        <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attendance->details as $detail)
                                    <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);transition:background 0.15s;" onmouseover="this.style.background='var(--md-sys-color-surface-container-low)'" onmouseout="this.style.background='transparent'">
                                        <td style="padding:14px 20px;font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);">{{ $detail->student->nama }}</td>
                                        <td style="padding:14px 20px;text-align:center;">
                                            <input type="radio" class="form-check-input" name="absensi[{{ $detail->id }}][status]" value="hadir" {{ $detail->status === 'hadir' ? 'checked' : '' }}>
                                        </td>
                                        <td style="padding:14px 20px;text-align:center;">
                                            <input type="radio" class="form-check-input" name="absensi[{{ $detail->id }}][status]" value="sakit" {{ $detail->status === 'sakit' ? 'checked' : '' }}>
                                        </td>
                                        <td style="padding:14px 20px;text-align:center;">
                                            <input type="radio" class="form-check-input" name="absensi[{{ $detail->id }}][status]" value="izin" {{ $detail->status === 'izin' ? 'checked' : '' }}>
                                        </td>
                                        <td style="padding:14px 20px;text-align:center;">
                                            <input type="radio" class="form-check-input" name="absensi[{{ $detail->id }}][status]" value="alfa" {{ $detail->status === 'alfa' ? 'checked' : '' }}>
                                        </td>
                                        <td style="padding:14px 20px;text-align:center;">
                                            <input type="radio" class="form-check-input" name="absensi[{{ $detail->id }}][status]" value="terlambat" {{ $detail->status === 'terlambat' ? 'checked' : '' }}>
                                        </td>
                                        <td style="padding:14px 20px;">
                                            <input type="text" name="absensi[{{ $detail->id }}][keterangan]" value="{{ $detail->keterangan }}" placeholder="Opsional" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:8px 12px;width:100%;">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div style="display:flex;gap:10px;margin-top:20px;">
                    <button type="submit" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;cursor:pointer;">Simpan Perubahan</button>
                    <a href="{{ route('guru.attendances.show', $attendance) }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
