<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-900 dark:text-white">Input Absensi</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            <form method="POST" action="{{ route('guru.attendances.store') }}" id="formAbsensi">
                @csrf

                @if($errors->any())
                <div class="card p-4 border-red-400 dark:border-red-700 text-red-800 dark:text-red-300 mb-4">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                {{-- Pilih Kelas & Tanggal --}}
                <div class="card p-6 mb-4">
                    <div class="mb-4">
                        <label class="input-label">Kelas</label>
                        <select name="class_id" id="class_id"
                            class="input"
                            onchange="tampilkanSiswa(this.value)">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($classes as $kelas)
                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="input-label">Tanggal</label>
                        <input type="date" name="tanggal"
                            value="{{ old('tanggal', date('Y-m-d')) }}"
                            max="{{ date('Y-m-d') }}"
                            class="input">
                    </div>
                </div>

                {{-- Daftar Siswa per Kelas --}}
                @foreach($classes as $kelas)
                <div id="kelas-{{ $kelas->id }}" class="hidden card p-6 mb-4">
                    <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Siswa Kelas {{ $kelas->nama_kelas }}</h3>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th class="text-center">Hadir</th>
                                    <th class="text-center">Sakit</th>
                                    <th class="text-center">Izin</th>
                                    <th class="text-center">Alfa</th>
                                    <th class="text-center">Telat</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kelas->students as $student)
                                <tr>
                                    <td class="font-medium">{{ $student->nama }}</td>
                                    @foreach(['hadir','sakit','izin','alfa','terlambat'] as $status)
                                    <td class="text-center">
                                        <input type="radio"
                                            class="absensi-input kelas-input-{{ $kelas->id }}"
                                            name="absensi[{{ $student->id }}][status]"
                                            value="{{ $status }}"
                                            {{ $status === 'hadir' ? 'checked' : '' }}
                                            disabled>
                                    </td>
                                    @endforeach
                                    <td>
                                        <input type="text"
                                            class="kelas-input-{{ $kelas->id }} input text-xs"
                                            name="absensi[{{ $student->id }}][keterangan]"
                                            placeholder="Opsional"
                                            disabled>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach

                <button type="submit"
                    class="btn btn-primary">
                    Simpan Absensi
                </button>
            </form>
        </div>
    </div>

    <script>
        function tampilkanSiswa(kelasId) {
            // Sembunyikan semua panel & disable semua input
            document.querySelectorAll('[id^="kelas-"]').forEach(el => {
                el.classList.add('hidden');
            });
            document.querySelectorAll('.absensi-input, [class*="kelas-input-"]').forEach(el => {
                el.disabled = true;
            });

            // Tampilkan panel kelas terpilih & enable inputnya
            if (kelasId) {
                const panel = document.getElementById('kelas-' + kelasId);
                if (panel) {
                    panel.classList.remove('hidden');
                    panel.querySelectorAll('input').forEach(el => {
                        el.disabled = false;
                    });
                }
            }
        }
    </script>
</x-app-layout>
