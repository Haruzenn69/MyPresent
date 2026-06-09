<x-app-layout>
    <div style="background:var(--md-sys-color-surface);min-height:100vh;">
        <div class="container-fluid py-4" style="max-width:1200px;">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                <div>
                    <h1 style="font-size:22px;font-weight:700;color:var(--md-sys-color-on-surface);margin:0;">Input Absensi</h1>
                    <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant);margin:4px 0 0;">Catat kehadiran siswa</p>
                </div>
            </div>

            <form method="POST" action="{{ route('guru.attendances.store') }}" id="formAbsensi">
                @csrf

                @if($errors->any())
                <div class="admin-card" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.2);margin-bottom:20px;padding:16px 20px;display:flex;align-items:center;gap:10px;">
                    <span style="width:6px;height:6px;border-radius:50%;background:#EF4444;flex-shrink:0;margin-top:2px;"></span>
                    <div>
                        @foreach($errors->all() as $error)
                        <p style="margin:0;font-size:14px;color:var(--md-sys-color-on-surface);">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);margin-bottom:20px;">
                    <div style="padding:20px;">
                        <div style="margin-bottom:16px;">
                            <label for="class_id" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Kelas</label>
                            <select name="class_id" id="class_id" onchange="tampilkanSiswa(this.value)" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($classes as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="tanggal" style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant);margin-bottom:4px;display:block;">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:10px 14px;width:100%;">
                        </div>
                    </div>
                </div>

                @foreach($classes as $kelas)
                <div id="kelas-{{ $kelas->id }}" class="d-none admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);margin-bottom:20px;padding:0;">
                    <div style="padding:16px 20px;border-bottom:1px solid var(--md-sys-color-outline-variant);">
                        <span style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface);">Siswa Kelas {{ $kelas->nama_kelas }}</span>
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
                                    @foreach($kelas->students as $student)
                                    @php $sudahAbsen = in_array($student->id, $attendedToday ?? []); @endphp
                                    <tr data-student="{{ $student->id }}" data-sudah="{{ $sudahAbsen ? '1' : '0' }}" style="border-bottom:1px solid var(--md-sys-color-outline-variant);transition:background 0.15s;" onmouseover="this.style.background='var(--md-sys-color-surface-container-low)'" onmouseout="this.style.background='transparent'">
                                        <td style="padding:14px 20px;font-size:14px;font-weight:500;color:var(--md-sys-color-on-surface);">{{ $student->nama }}</td>
                                        <td style="padding:14px 20px;text-align:center;">
                                            <input type="radio" class="form-check-input" name="absensi[{{ $student->id }}][status]" value="hadir" @if($sudahAbsen || !old('absensi.'.$student->id.'.status') || old('absensi.'.$student->id.'.status') == 'hadir') checked @endif @if($sudahAbsen) disabled @endif>
                                        </td>
                                        <td style="padding:14px 20px;text-align:center;">
                                            <input type="radio" class="form-check-input" name="absensi[{{ $student->id }}][status]" value="sakit" @if(old('absensi.'.$student->id.'.status') == 'sakit') checked @endif @if($sudahAbsen) disabled @endif>
                                        </td>
                                        <td style="padding:14px 20px;text-align:center;">
                                            <input type="radio" class="form-check-input" name="absensi[{{ $student->id }}][status]" value="izin" @if(old('absensi.'.$student->id.'.status') == 'izin') checked @endif @if($sudahAbsen) disabled @endif>
                                        </td>
                                        <td style="padding:14px 20px;text-align:center;">
                                            <input type="radio" class="form-check-input" name="absensi[{{ $student->id }}][status]" value="alfa" @if(old('absensi.'.$student->id.'.status') == 'alfa') checked @endif @if($sudahAbsen) disabled @endif>
                                        </td>
                                        <td style="padding:14px 20px;text-align:center;">
                                            <input type="radio" class="form-check-input" name="absensi[{{ $student->id }}][status]" value="terlambat" @if(old('absensi.'.$student->id.'.status') == 'terlambat') checked @endif @if($sudahAbsen) disabled @endif>
                                        </td>
                                        <td style="padding:14px 20px;">
                                            <input type="text" name="absensi[{{ $student->id }}][keterangan]" placeholder="Opsional" @if($sudahAbsen) disabled @endif style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant);background:var(--md-sys-color-surface);color:var(--md-sys-color-on-surface);font-size:13px;padding:8px 12px;width:100%;">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach

                <div style="display:flex;gap:10px;">
                    <button type="submit" style="background:var(--md-sys-color-primary);color:white;border:none;border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;cursor:pointer;">Simpan Absensi</button>
                    <a href="{{ route('guru.attendances.index') }}" style="background:rgba(100,116,139,0.15);color:var(--md-sys-color-on-surface-variant);border:1px solid var(--md-sys-color-outline-variant);border-radius:20px;padding:8px 24px;font-size:13px;font-weight:500;text-decoration:none;">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
    function tampilkanSiswa(classId) {
        document.querySelectorAll('[id^="kelas-"]').forEach(el => el.classList.add('d-none'));
        if (classId) {
            document.getElementById('kelas-' + classId)?.classList.remove('d-none');
        }
    }

    function aturDisabled() {
        const tgl = document.querySelector('input[name="tanggal"]').value;
        const today = new Date().toISOString().slice(0, 10);
        const isToday = tgl === today;
        document.querySelectorAll('[data-sudah="1"]').forEach(function(row) {
            row.querySelectorAll('input').forEach(function(input) {
                if (isToday) {
                    input.disabled = true;
                    if (input.value === 'hadir' || input.type === 'text') {
                        input.checked = input.value === 'hadir';
                    }
                } else {
                    input.disabled = false;
                }
            });
        });
        if (!isToday) {
            document.querySelectorAll('[data-sudah="1"] input[value="hadir"]').forEach(function(r) {
                r.checked = false;
            });
            document.querySelectorAll('tr:not([data-sudah="1"]) input[value="hadir"]').forEach(function(r) {
                r.checked = true;
            });
        }
    }

    document.querySelector('input[name="tanggal"]').addEventListener('change', aturDisabled);
    aturDisabled();

    @if(old('class_id'))
        tampilkanSiswa('{{ old('class_id') }}');
    @endif
    </script>
</x-app-layout>
