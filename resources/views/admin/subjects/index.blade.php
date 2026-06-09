<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">
            @if(session('success'))
                <div style="display:flex;align-items:center;gap:12px;background:rgba(16,185,129,0.08);border-left:4px solid #10B981;border-radius:10px;padding:14px 18px;margin-bottom:24px;">
                    <span style="width:8px;height:8px;border-radius:50%;background:#10B981;flex-shrink:0;"></span>
                    <span style="font-size:13px;color:#10B981;font-weight:500;">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div style="display:flex;align-items:center;gap:12px;background:rgba(239,68,68,0.08);border-left:4px solid #EF4444;border-radius:10px;padding:14px 18px;margin-bottom:24px;">
                    <span style="width:8px;height:8px;border-radius:50%;background:#EF4444;flex-shrink:0;"></span>
                    <span style="font-size:13px;color:#EF4444;font-weight:500;">{{ session('error') }}</span>
                </div>
            @endif

            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
                <div>
                    <h1 style="font-size:22px;font-weight:600;color:var(--md-sys-color-on-surface);margin:0;">Mata Pelajaran</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:2px 0 0;">{{ $subjects->count() }} mata pelajaran terdaftar</p>
                </div>
                <a href="{{ route('admin.subjects.create') }}" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;">+ Tambah</a>
            </div>

            <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:24px;border-radius:16px;background:var(--md-sys-color-surface-container-low,var(--md-sys-color-surface));box-shadow:0 1px 3px rgba(0,0,0,0.06),0 1px 2px rgba(0,0,0,0.04);border:1px solid var(--md-sys-color-outline-variant);overflow:hidden;">
                <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:16px;border-bottom:1px solid var(--md-sys-color-outline-variant);margin-bottom:16px;">
                    <div style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Data Mata Pelajaran</div>
                    <span style="font-size:11px;font-weight:600;color:var(--md-sys-color-primary);background:rgba(var(--md-sys-color-primary-rgb,99,102,241),0.1);padding:2px 10px;border-radius:20px;">{{ $subjects->count() }} item</span>
                </div>
                <div class="table-responsive">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr style="border-bottom:2px solid var(--md-sys-color-outline-variant);">
                                 <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Kode</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Nama</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;">Deskripsi</th>
                                <th style="padding:12px 20px;text-align:left;font-size:12px;font-weight:600;color:var(--md-sys-color-on-surface-variant);text-transform:uppercase;letter-spacing:0.5px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subjects as $subject)
                                <tr style="border-bottom:1px solid var(--md-sys-color-outline-variant);transition:background 0.15s;" onmouseover="this.style.background='rgba(0,0,0,0.02)'" onmouseout="this.style.background=''">
                                    <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $subject->kode }}</td>
                                    <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ $subject->nama }}</td>
                                    <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);">{{ Str::limit($subject->deskripsi, 50) }}</td>
                                    <td style="padding:14px 20px;font-size:13px;color:var(--md-sys-color-on-surface-variant);text-align:right;">
                                        <a href="{{ route('admin.subjects.edit', $subject) }}" style="background:rgba(245,158,11,0.12);color:#F59E0B;border:none;border-radius:20px;padding:4px 14px;font-size:12px;font-weight:500;text-decoration:none;display:inline-block;">Ubah</a>
                                        <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus mata pelajaran ini?')">
                                            @csrf @method('DELETE')
                                            <button style="background:rgba(239,68,68,0.12);color:#EF4444;border:none;border-radius:20px;padding:4px 14px;font-size:12px;font-weight:500;cursor:pointer;">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="padding:48px 20px;text-align:center;">
                                        <div style="font-size:40px;margin-bottom:12px;opacity:0.3;">&#x1F4DA;</div>
                                        <div style="font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);margin-bottom:4px;">Belum ada mata pelajaran</div>
                                        <div style="font-size:12px;color:var(--md-sys-color-on-surface-variant);">Tambahkan mata pelajaran baru untuk memulai.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if(method_exists($subjects, 'links'))
                    <div style="display:flex;align-items:center;justify-content:space-between;padding-top:16px;border-top:1px solid var(--md-sys-color-outline-variant);margin-top:16px;">
                        <div style="font-size:12px;color:var(--md-sys-color-on-surface-variant);">Menampilkan {{ $subjects->firstItem() ?? 0 }} - {{ $subjects->lastItem() ?? 0 }} dari {{ $subjects->total() ?? $subjects->count() }}</div>
                        <div>{{ $subjects->links() }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
