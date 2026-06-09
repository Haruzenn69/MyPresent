<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Import Data Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <a href="{{ route('admin.users.index') }}" class="btn btn-ghost">
                    &larr; Kembali ke Daftar Akun
                </a>
            </div>

            <div class="card">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if($errors->any())
                    <div class="card p-4 border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 mb-6">
                        <p class="font-bold">Beberapa baris gagal diimpor:</p>
                        <ul class="list-disc ml-5 mt-2 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        {{-- Panduan --}}
                        <div>
                            <h3 class="font-bold text-lg mb-4">Panduan Format CSV</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                Pastikan file CSV Anda mengikuti urutan kolom berikut (tanpa judul kolom di baris pertama juga boleh, tapi controller saya skip baris pertama):
                            </p>
                            <div class="card p-4 text-xs font-mono">
                                NIS, Nama, Email, JK, Kelas, Alamat
                            </div>
                            <ul class="mt-4 text-sm text-gray-600 space-y-2">
                                <li><strong>NIS:</strong> Nomor Induk Siswa (unik).</li>
                                <li><strong>Nama:</strong> Nama lengkap siswa.</li>
                                <li><strong>Email:</strong> Digunakan untuk login akun.</li>
                                <li><strong>JK:</strong> Isi 'L' untuk Laki-laki atau 'P' untuk Perempuan.</li>
                                <li><strong>Kelas:</strong> Harus sesuai dengan nama kelas yang ada di sistem (misal: 'X-RPL').</li>
                                <li><strong>Alamat:</strong> Opsional.</li>
                            </ul>
                            <p class="mt-6 text-xs text-gray-500 italic">
                                * Password akun siswa otomatis diset sama dengan NIS mereka.
                            </p>
                        </div>

                        {{-- Form Upload --}}
                        <div>
                            <h3 class="font-bold text-lg mb-4">Upload File</h3>
                            <form action="{{ route('admin.students.import.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label class="input-label">Pilih File CSV</label>
                                    <input type="file" name="file" accept=".csv" required
                                        class="input w-full">
                                </div>
<button type="submit" class="btn btn-primary w-full">
                                Mulai Impor Data
                            </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
