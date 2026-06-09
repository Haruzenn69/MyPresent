<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-900 dark:text-white">Edit Kelas</h2>
            <a href="{{ route('admin.classes.index') }}"
               class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 text-sm">← Kembali</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 space-y-6">

            @if(session('success'))
            <div class="card p-4 border-green-400 dark:border-green-700 text-green-800 dark:text-green-300">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="card p-4 border-red-400 text-red-700">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            {{-- Form Edit Kelas --}}
            <div class="card p-6">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Info Kelas</h3>
                <form method="POST" action="{{ route('admin.classes.update', $class) }}">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4">
                        <div>
                            <x-input-label for="nama_kelas" value="Nama Kelas" />
                            <x-text-input id="nama_kelas" name="nama_kelas" type="text"
                                class="mt-1 w-full"
                                value="{{ old('nama_kelas', $class->nama_kelas) }}"
                                required />
                            <x-input-error :messages="$errors->get('nama_kelas')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="wali_kelas" value="Wali Kelas" />
                            <select id="wali_kelas" name="wali_kelas"
                                class="input w-full">
                                <option value="">Tanpa wali kelas</option>
                                @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ old('wali_kelas', $class->wali_kelas) == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->nama }}
                                </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('wali_kelas')" class="mt-2" />
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="btn btn-primary">Perbarui Kelas</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Tambah Siswa ke Kelas --}}
            <div class="card p-6">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Tambah Siswa ke Kelas</h3>
                <form method="POST"
                    action="{{ route('admin.classes.addStudent', $class) }}"
                    class="flex gap-3">
                    @csrf
                    <select name="student_id"
                        class="input flex-1 text-sm">
                        <option value="">-- Pilih Siswa --</option>
                        @foreach($availableStudents as $student)
                        <option value="{{ $student->id }}">
                            {{ $student->nama }} ({{ $student->nis }})
                            @if($student->kelas_id)
                                — dari {{ $student->kelas->nama_kelas ?? '' }}
                            @else
                                — belum ada kelas
                            @endif
                        </option>
                        @endforeach
                    </select>
                    <button type="submit"
                        class="btn btn-primary">
                        + Tambah
                    </button>
                </form>
            </div>

            {{-- Daftar Siswa di Kelas --}}
            <div class="card p-6">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">
                    Siswa di Kelas ({{ $class->students->count() }})
                </h3>

                @if($class->students->isEmpty())
                <p class="text-gray-400 text-sm">Belum ada siswa di kelas ini.</p>
                @else
                <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($class->students as $student)
                                <tr>
                                    <td>{{ $student->nis }}</td>
                                    <td class="font-medium">{{ $student->nama }}</td>
                                    <td class="text-gray-600 dark:text-gray-400">{{ $student->jenis_kelamin }}</td>
                                    <td class="text-center">
                                        <form method="POST"
                                            action="{{ route('admin.classes.removeStudent', [$class, $student]) }}"
                                            onsubmit="return confirm('Keluarkan siswa ini dari kelas?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger text-xs">
                                                Keluarkan
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
