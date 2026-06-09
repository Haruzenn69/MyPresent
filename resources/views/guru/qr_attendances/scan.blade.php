<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR - {{ $attendance->kelas->nama_kelas }}</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif; background:var(--md-sys-color-surface,#f5f5f5); min-height:100vh; display:flex; align-items:center; }
        .admin-card { background:white; border-radius:20px; border:1px solid var(--card-border,#0D9488); box-shadow:0 4px 24px var(--card-glow,rgba(13,148,136,0.15)); }
    </style>
</head>
<body>
    <div style="max-width:600px;margin:0 auto;padding:20px;width:100%;">
        <div class="admin-card" style="--card-border:#0D9488;--card-glow:rgba(13,148,136,0.15);padding:32px;text-align:center;">
            <h4 style="font-size:20px;font-weight:700;color:var(--md-sys-color-on-surface,#1a1a2e);margin-bottom:4px;">Absensi {{ $attendance->kelas->nama_kelas }}</h4>
            <p style="font-size:13px;color:var(--md-sys-color-on-surface-variant,#64748b);margin-bottom:16px;">{{ $attendance->tanggal->format('Y-m-d') }} — {{ $attendance->created_at->format('H:i') }}</p>
            @if($expired)
                <div class="admin-card" style="--card-border:#F59E0B;--card-glow:rgba(245,158,11,0.15);margin-bottom:16px;padding:12px 16px;font-size:13px;color:var(--md-sys-color-on-surface,#1a1a2e);">QR Code ini sudah kedaluwarsa.</div>
            @endif
            <hr style="border:none;border-top:1px solid var(--md-sys-color-outline-variant,#d1d5db);margin:16px 0;">

            <div id="successMessage" class="admin-card" style="--card-border:#10B981;--card-glow:rgba(16,185,129,0.15);margin-bottom:16px;padding:12px 16px;display:none;font-size:14px;color:var(--md-sys-color-on-surface,#1a1a2e);"></div>
            <div id="errorMessage" class="admin-card" style="--card-border:#EF4444;--card-glow:rgba(239,68,68,0.15);margin-bottom:16px;padding:12px 16px;display:none;font-size:14px;color:var(--md-sys-color-on-surface,#1a1a2e);"></div>

            <form id="scanForm" style="{{ $expired ? 'display:none;' : '' }}">
                @csrf
                <div style="margin-bottom:16px;text-align:left;">
                    <label style="font-size:12px;font-weight:500;color:var(--md-sys-color-on-surface-variant,#64748b);margin-bottom:4px;display:block;">Masukkan NIS Anda</label>
                    <input type="text" id="studentNis" style="border-radius:10px;border:1px solid var(--md-sys-color-outline-variant,#d1d5db);background:white;color:var(--md-sys-color-on-surface,#1a1a2e);font-size:16px;padding:12px 16px;width:100%;text-align:center;outline:none;" placeholder="NIS" required autofocus>
                </div>
                <button type="submit" style="background:var(--md-sys-color-primary,#0D9488);color:white;border:none;border-radius:20px;padding:12px 24px;font-size:15px;font-weight:600;width:100%;cursor:pointer;">Absen Sekarang</button>
            </form>

            <hr style="border:none;border-top:1px solid var(--md-sys-color-outline-variant,#d1d5db);margin:16px 0;">

            <div style="text-align:left;">
                <h6 style="font-size:14px;font-weight:600;color:var(--md-sys-color-on-surface,#1a1a2e);margin-bottom:8px;">Siswa yang sudah absen:</h6>
                <ul style="list-style:none;padding:0;margin:0;" id="scannedList">
                    @foreach($attendance->details as $d)
                        <li style="display:flex;justify-content:space-between;padding:10px 14px;border-bottom:1px solid var(--md-sys-color-outline-variant,#d1d5db);font-size:13px;">
                            <span style="color:var(--md-sys-color-on-surface,#1a1a2e);">{{ $d->student->nama }}</span>
                            <small style="color:var(--md-sys-color-on-surface-variant,#64748b);">{{ $d->created_at->format('H:i') }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('scanForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const nis = document.getElementById('studentNis').value.trim();
            const successEl = document.getElementById('successMessage');
            const errorEl = document.getElementById('errorMessage');

            successEl.style.display = 'none';
            errorEl.style.display = 'none';

            fetch('{{ route("guru.qr-attendances.scan-student", $attendance->qr_code_token) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ student_nis: nis })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    successEl.textContent = data.message + ' - ' + data.student.nama;
                    successEl.style.display = 'flex';
                    const li = document.createElement('li');
                    li.style.cssText = 'display:flex;justify-content:space-between;padding:10px 14px;border-bottom:1px solid var(--md-sys-color-outline-variant,#d1d5db);font-size:13px;';
                    li.innerHTML = `<span style="color:var(--md-sys-color-on-surface,#1a1a2e);">${data.student.nama}</span><small style="color:var(--md-sys-color-on-surface-variant,#64748b);">${new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'})}</small>`;
                    document.getElementById('scannedList').appendChild(li);
                    document.getElementById('studentNis').value = '';
                    document.getElementById('studentNis').focus();
                }
            })
            .catch(err => {
                errorEl.textContent = 'Gagal absen. Periksa NIS Anda.';
                errorEl.style.display = 'flex';
            });
        });
    </script>
</body>
</html>
