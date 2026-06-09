<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">Riwayat Absensi</h2>
            <div class="flex gap-2">
                <a href="{{ route('guru.attendances.rekap.pdf', request()->all()) }}"
                   class="btn btn-danger text-sm">
                    ⬇ Rekap PDF
                </a>
                <a href="{{ route('guru.attendances.create') }}"
                   class="btn btn-primary">
                    + Input Absensi
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            @if(session('success'))
            <div class="card p-4 border-green-400 dark:border-green-700 text-green-800 dark:text-green-300 mb-4">
                {{ session('success') }}
            </div>
            @endif

            {{-- Filter --}}
            <form method="GET" class="card p-4 mb-4 grid grid-cols-1 md:grid-cols-4 gap-3 items-end">
                <div>
                    <label class="input-label">Kelas</label>
                    <select name="class_id" class="input text-sm" onchange="this.form.submit()">
                        <option value="">Semua Kelas</option>
                        @foreach($classes as $kelas)
                        <option value="{{ $kelas->id }}"
                            {{ request('class_id') == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="input-label">Mulai Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                           class="input text-sm" onchange="this.form.submit()">
                </div>
                <div>
                    <label class="input-label">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                           class="input text-sm" onchange="this.form.submit()">
                </div>
                <div class="flex gap-2">
                    @if(request()->anyFilled(['class_id', 'start_date', 'end_date']))
                    <a href="{{ route('guru.attendances.index') }}"
                       class="btn btn-secondary text-center flex-1">
                        Reset Filter
                    </a>
                    @else
                    <div class="px-4 py-2 text-sm text-gray-400 italic text-center flex-1">
                        Pilih filter untuk menyaring data
                    </div>
                    @endif
                </div>
            </form>

<div class="card">
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kelas</th>
                                <th>Guru</th>
                                <th class="text-center">Hadir</th>
                                <th class="text-center">Alfa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $absensi)
                            @php
                                $hadir = $absensi->details->where('status','hadir')->count();
                                $alfa  = $absensi->details->where('status','alfa')->count();
                            @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d/m/Y') }}</td>
                                <td class="font-medium">{{ $absensi->kelas->nama_kelas ?? '-' }}</td>
                                <td>{{ $absensi->guru->nama ?? '-' }}</td>
                                <td class="text-center text-green-600 dark:text-green-400 font-bold">{{ $hadir }}</td>
                                <td class="text-center text-red-600 dark:text-red-400 font-bold">{{ $alfa }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('guru.attendances.show', $absensi) }}"
                                           class="btn btn-ghost text-xs">Detail</a>
                                        <a href="{{ route('guru.attendances.edit', $absensi) }}"
                                           class="btn btn-ghost text-xs">Edit</a>
                                        @if($absensi->tanggal === now()->toDateString())
                                        <form method="POST"
                                            action="{{ route('guru.attendances.destroy', $absensi) }}"
                                            onsubmit="return confirm('Hapus data absensi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger text-xs">
                                                Hapus
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    Belum ada data absensi
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
