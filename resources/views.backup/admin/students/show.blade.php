<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800">Detail Siswa</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            <div class="card p-6 mb-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">NIS</p>
                        <p class="font-medium">{{ $student->nis }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Nama</p>
                        <p class="font-medium">{{ $student->nama }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium">{{ $student->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Kelas</p>
                        <p class="font-medium">{{ $student->kelas?->nama_kelas ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jenis Kelamin</p>
                        <p class="font-medium">{{ $student->jenis_kelamin === 'Laki-laki' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p class="font-medium">{{ $student->alamat ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="card p-6">
                <h3 class="font-bold mb-3">Riwayat Absensi</h3>
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kelas</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($student->attendanceDetails->sortByDesc(fn($d) => $d->attendance->tanggal) as $detail)
                            <tr>
                                <td>{{ $detail->attendance->tanggal }}</td>
                                <td>{{ $detail->attendance->kelas?->nama_kelas ?? '-' }}</td>
                                <td class="capitalize">{{ $detail->status }}</td>
                                <td>{{ $detail->keterangan ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center">Belum ada data absensi</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.students.index') }}" class="btn btn-ghost">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
