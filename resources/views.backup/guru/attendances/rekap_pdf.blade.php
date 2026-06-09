<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Absensi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; }
        h2 { text-align: center; margin-bottom: 2px; }
        p.sub { text-align: center; margin: 2px 0; }
        hr { margin: 8px 0; }
        h3 { margin: 16px 0 4px; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        th { background: #e5e7eb; padding: 6px 8px; border: 1px solid #d1d5db; text-align: left; }
        td { padding: 6px 8px; border: 1px solid #d1d5db; }
        .badge-hadir { color: green; }
        .badge-sakit { color: orange; }
        .badge-izin  { color: blue; }
        .badge-alfa  { color: red; }
        .summary { font-size: 10px; color: #555; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <h2>SMK NEGERI 11 BANDUNG</h2>
    <p class="sub">REKAP ABSENSI SISWA</p>
    <p class="sub">Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    <hr>

    @forelse($attendances as $absensi)
    <h3>
        📅 {{ \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y') }}
        — Kelas {{ $absensi->kelas->nama_kelas ?? '-' }}
        (Guru: {{ $absensi->guru->nama ?? '-' }})
    </h3>
    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="30%">Nama Siswa</th>
                <th width="15%">NIS</th>
                <th width="12%">Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi->details as $i => $detail)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $detail->student->nama }}</td>
                <td>{{ $detail->student->nis }}</td>
                <td class="badge-{{ $detail->status }}">{{ ucfirst($detail->status) }}</td>
                <td>{{ $detail->keterangan ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @php
        $h = $absensi->details->where('status','hadir')->count();
        $s = $absensi->details->where('status','sakit')->count();
        $i = $absensi->details->where('status','izin')->count();
        $a = $absensi->details->where('status','alfa')->count();
    @endphp
    <p class="summary">Hadir: <b>{{ $h }}</b> | Sakit: <b>{{ $s }}</b> | Izin: <b>{{ $i }}</b> | Alfa: <b>{{ $a }}</b></p>
    @unless($loop->last)<div class="page-break"></div>@endunless
    @empty
    <p style="text-align:center;color:#888">Tidak ada data absensi</p>
    @endforelse
</body>
</html>
