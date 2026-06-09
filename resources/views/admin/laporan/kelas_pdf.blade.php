<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Absensi Kelas</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2, h4 { margin: 0 0 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 5px; text-align: left; }
        th { background: #f0f0f0; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Absensi Kelas</h2>
    <p><strong>Kelas:</strong> {{ $class->nama_kelas }}</p>
    @if($activeYear)
        <p><strong>Tahun Ajaran:</strong> {{ $activeYear->year }} ({{ ucfirst($activeYear->semester) }})</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Hadir</th>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Alfa</th>
                <th>Terlambat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekap as $r)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $r['nis'] }}</td>
                    <td>{{ $r['nama'] }}</td>
                    <td class="text-center">{{ $r['hadir'] }}</td>
                    <td class="text-center">{{ $r['sakit'] }}</td>
                    <td class="text-center">{{ $r['izin'] }}</td>
                    <td class="text-center">{{ $r['alfa'] }}</td>
                    <td class="text-center">{{ $r['terlambat'] }}</td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center">Tidak ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
