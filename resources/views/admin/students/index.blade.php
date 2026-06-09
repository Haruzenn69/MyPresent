<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Kelola Siswa</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Daftar seluruh siswa</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.students.import') }}" style="background:rgba(99,102,241,0.15);color:#6366F1;border:1px solid rgba(99,102,241,0.25);border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Impor CSV
                    </a>
                    <a href="{{ route('admin.students.create') }}" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 18px;font-size:13px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:6px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Tambah Siswa
                    </a>
                </div>
            </div>

            @if(session('success'))
            <div class="admin-card" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.2);margin-bottom:20px;padding:16px 20px;display:flex;align-items:center;gap:10px;">
                <span style="width:6px;height:6px;border-radius:50%;background:#10B981;flex-shrink:0;"></span>
                <span style="font-size:14px;color:var(--md-sys-color-on-surface);">{{ session('success') }}</span>
            </div>
            @endif

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:0;">
                <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Daftar Siswa</span>
                    <span style="font-size:12px;color:var(--md-sys-color-on-surface-variant);">{{ $students->total() }} siswa</span>
                </div>
                <div class="table-responsive">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);">
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">NIS</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Nama</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Kelas</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Jenis Kelamin</th>
                                <th style="padding:12px 20px;text-align:right;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                            <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);transition:background 0.15s;" onmouseover="this.style.background='var(--md-sys-color-surface-container-low)'" onmouseout="this.style.background='transparent'">
                                <td style="padding:14px 20px;font-size:13px;font-weight:500;color:var(--md-sys-color-on-surface);">{{ $student->nis }}</td>
                                <td style="padding:14px 20px;font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);">{{ $student->nama }}</td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">
                                    @if($student->kelas)
                                    <span style="background:rgba(13,148,136,0.12);color:#0D9488;font-size:12px;font-weight:500;padding:4px 12px;border-radius:12px;">{{ $student->kelas->nama_kelas }}</span>
                                    @else
                                    <span style="color:var(--md-sys-color-on-surface-variant);opacity:0.5;">—</span>
                                    @endif
                                </td>
                                <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $student->jenis_kelamin === 'Laki-laki' ? 'L' : 'P' }}</td>
                                <td style="padding:14px 20px;text-align:right;">
                                    <div class="d-flex gap-1 justify-content-end">
                                        <a href="{{ route('admin.students.show', $student) }}" style="background:rgba(13,148,136,0.12);color:#0D9488;border:none;border-radius:10px;padding:6px 12px;font-size:12px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                            Detail
                                        </a>
                                        <a href="{{ route('admin.students.edit', $student) }}" style="background:rgba(245,158,11,0.12);color:#F59E0B;border:none;border-radius:10px;padding:6px 12px;font-size:12px;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.students.destroy', $student) }}" onsubmit="return confirm('Hapus siswa ini?')" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background:rgba(239,68,68,0.12);color:#EF4444;border:none;border-radius:10px;padding:6px 12px;font-size:12px;font-weight:500;display:inline-flex;align-items:center;gap:4px;cursor:pointer;">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="padding:60px 20px;text-align:center;">
                                    <div style="width:56px;height:56px;border-radius:16px;background:var(--md-sys-color-surface-container-low);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--md-sys-color-on-surface-variant)" stroke-width="1.5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                    </div>
                                    <p style="font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);margin:0 0 4px;">Belum ada siswa</p>
                                    <p style="font-size:12px;color:var(--md-sys-color-on-surface-variant);margin:0;">Tambahkan siswa baru untuk memulai</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($students->hasPages())
                <div style="padding:16px 20px;border-top:1px solid var(--md-sys-color-outline-variant);">
                    {{ $students->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
