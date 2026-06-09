<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Absensi Siswa</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2, h4 { margin: 0 0 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 5px; text-align: left; }
        th { background: #f0f0f0; }
        .text-center { text-align: center; }
        .mt-3 { margin-top: 15px; }
        .mb-3 { margin-bottom: 15px; }
    </style>
</head>
<body>
    <h2>Laporan Absensi Siswa</h2>
    <table class="mb-3">
        <tr><td width="150"><strong>NIS</strong></td><td>{{ $student->nis }}</td></tr>
        <tr><td><strong>Nama</strong></td><td>{{ $student->nama }}</td></tr>
        <tr><td><strong>Kelas</strong></td><td>{{ $student->kelas?->nama_kelas ?? '-' }}</td></tr>
        @if($activeYear)
            <tr><td><strong>Tahun Ajaran</strong></td><td>{{ $activeYear->year }} ({{ ucfirst($activeYear->semester) }})</td></tr>
        @endif
    </table>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($details as $detail)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($detail->attendance->tanggal)->format('Y-m-d') }}</td>
                    <td>{{ ucfirst($detail->status) }}</td>
                    <td>{{ $detail->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Belum ada data absensi.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h4 class="mt-3">Rekapitulasi</h4>
    <table>
        <tr>
            <th>Hadir</th>
            <th>Sakit</th>
            <th>Izin</th>
            <th>Alfa</th>
            <th>Terlambat</th>
            <th>Total</th>
        </tr>
        <tr class="text-center">
            <td>{{ $stats['hadir'] }}</td>
            <td>{{ $stats['sakit'] }}</td>
            <td>{{ $stats['izin'] }}</td>
            <td>{{ $stats['alfa'] }}</td>
            <td>{{ $stats['terlambat'] }}</td>
            <td>{{ array_sum($stats) }}</td>
        </tr>
    </table>
</body>
</html>
