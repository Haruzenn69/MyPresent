<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Absensi {{ $attendance->tanggal }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 4px; }
        p { text-align: center; margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th { background: #e5e7eb; padding: 8px; border: 1px solid #d1d5db; text-align: left; }
        td { padding: 8px; border: 1px solid #d1d5db; }
        .hadir { color: green; }
        .sakit { color: orange; }
        .izin  { color: blue; }
        .alfa  { color: red; }
        .footer { margin-top: 40px; text-align: right; }
    </style>
</head>
<body>

    <h2>SMK NEGERI 11 BANDUNG</h2>
    <p>LAPORAN ABSENSI SISWA</p>
    <hr>

    <p><strong>Kelas:</strong> {{ $attendance->kelas->nama_kelas ?? '-' }}</p>
    <p><strong>Tanggal:</strong> 
        {{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }}
    </p>
    <p><strong>Guru:</strong> {{ $attendance->guru->nama ?? '-' }}</p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Nama Siswa</th>
                <th width="10%">NIS</th>
                <th width="15%">Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendance->details as $i => $detail)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $detail->student->nama }}</td>
                <td>{{ $detail->student->nis }}</td>
                <td class="{{ $detail->status }}">
                    {{ ucfirst($detail->status) }}
                </td>
                <td>{{ $detail->keterangan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @php
        $hadir = $attendance->details->where('status','hadir')->count();
        $sakit = $attendance->details->where('status','sakit')->count();
        $izin  = $attendance->details->where('status','izin')->count();
        $alfa  = $attendance->details->where('status','alfa')->count();
    @endphp

    <table style="margin-top:12px; width:auto;">
        <tr>
            <td style="padding:4px 12px;">Hadir: <strong>{{ $hadir }}</strong></td>
            <td style="padding:4px 12px;">Sakit: <strong>{{ $sakit }}</strong></td>
            <td style="padding:4px 12px;">Izin: <strong>{{ $izin }}</strong></td>
            <td style="padding:4px 12px;">Alfa: <strong>{{ $alfa }}</strong></td>
        </tr>
    </table>

    <div class="footer">
        <p>Bandung, {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        <br><br><br>
        <p>{{ $attendance->guru->nama ?? 'Guru' }}</p>
        <p>NIP. {{ $attendance->guru->nip ?? '-' }}</p>
    </div>

</body>
</html>
