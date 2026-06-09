<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Data Siswa</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Daftar seluruh siswa</p>
                </div>
            </div>

            <div class="mb-4 d-flex gap-2 flex-wrap">
                <a href="{{ route('guru.students.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">Semua</a>
                @foreach($classes as $kelas)
                <a href="{{ route('guru.students.index', ['class_id' => $kelas->id]) }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                    {{ $kelas->nama_kelas }}
                </a>
                @endforeach
            </div>

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);margin-bottom:20px;">
                <div class="table-responsive">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">NIS</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Nama</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Kelas</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Jenis Kelamin</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);transition:background 0.15s;" onmouseover="this.style.background='var(--md-sys-color-surface-container-low)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $student->nis }}</td>
                                <td style="padding:14px 20px;font-size:13px;font-weight:500;color:var(--md-sys-color-on-surface);">{{ $student->nama }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $student->kelas->nama_kelas ?? '-' }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $student->jenis_kelamin }}</td>
                                <td style="padding:14px 20px;">
                                    <a href="{{ route('guru.students.show', $student) }}" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/></svg>
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="padding:60px 20px;text-align:center;">
                                    <div style="width:56px;height:56px;border-radius:16px;background:var(--md-sys-color-surface-container-low);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    </div>
                                    <p style="font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);margin:0 0 4px;">Belum ada data siswa</p>
                                    <p style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin:0;">Data siswa akan muncul setelah ditambahkan</p>
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
