<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class=" text-white fw-bold">{{ __('Dashboard') }}</h2>
            <span class="badge bg-primary">{{ ucfirst(Auth::user()->role) }}</span>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container-fluid">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h3 class="fw-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p>Kelola aktivitas Anda dari dashboard ini.</p>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-4 g-4 mb-4">
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="avatar bg-primary-subtle p-2 rounded">
                                    <svg style="width:20px;height:20px;" class="text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <span class="badge bg-success">+12%</span>
                            </div>
                            <h4 class="fw-bold">1,234</h4>
                            <p class="text-muted mb-0">Total Siswa</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="avatar bg-success-subtle p-2 rounded">
                                    <svg style="width:20px;height:20px;" class="text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <span class="badge bg-success">+5%</span>
                            </div>
                            <h4 class="fw-bold">98%</h4>
                            <p class="text-muted mb-0">Hadir Hari Ini</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="avatar bg-warning-subtle p-2 rounded">
                                    <svg style="width:20px;height:20px;" class="text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <h4 class="fw-bold">45</h4>
                            <p class="text-muted mb-0">Izin</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="avatar bg-danger-subtle p-2 rounded">
                                    <svg style="width:20px;height:20px;" class="text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <h4 class="fw-bold">12</h4>
                            <p class="text-muted mb-0">Alfa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>