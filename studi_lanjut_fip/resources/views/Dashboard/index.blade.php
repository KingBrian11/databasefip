@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="p-4 mb-4 bg-light rounded shadow-sm d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <img src="{{ auth()->user()?->profile_photo ? asset(auth()->user()->profile_photo) : 'https://via.placeholder.com/80' }}" 
                 class="rounded-circle me-3" style="width:80px; height:80px; object-fit:cover;" alt="Profile">
            <div>
                <h4 class="mb-1">Halo, {{ optional(auth()->user())->name ?? 'Tamu' }}</h4>
                <small class="text-muted">
                    {{ ucfirst(optional(auth()->user())->role) ?? 'Tamu' }} |
                    Login terakhir {{ optional(auth()->user())->last_login ?? 'beberapa saat lalu' }}
                </small>
            </div>
        </div>
        <a href="{{ route('settings') }}" class="btn btn-outline-secondary fw-semibold">Kelola Profil</a>
    </div>

    {{-- Statistik Utama --}}
<div class="row g-3 mb-4">
    @php
        $stats = [
            ['title' => 'Total Dosen', 'value' => $totalDosen, 'icon' => 'people-fill', 'color' => 'text-primary'],
            ['title' => 'Total Staf Tata Usaha', 'value' => $jumlahTataUsaha, 'icon' => 'person-workspace', 'color' => 'text-success'],
            ['title' => 'Total Staf Prodi', 'value' => $jumlahStafProdi, 'icon' => 'person-gear', 'color' => 'text-info'],
            ['title' => 'Total Studi Lanjut', 'value' => $studiLanjut, 'icon' => 'mortarboard-fill', 'color' => 'text-info'],
        ];
    @endphp

    @foreach($stats as $stat)
        <div class="col-md-3 col-6">
            <div class="card bg-body-tertiary shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-{{ $stat['icon'] }} fs-1 me-3 {{ $stat['color'] }}"></i>
                    <div>
                        <p class="text-muted mb-1 fw-semibold small">{{ $stat['title'] }}</p>
                        <h4 class="fw-bold mb-0 {{ $stat['color'] }}">{{ $stat['value'] ?? 0 }}</h4>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


    {{-- Grafik --}}
    <div class="row g-4 mb-5">
        <div class="col-md-8">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header bg-primary text-white fw-bold text-center py-2">
                    Tren Jumlah Dosen Lanjut Studi per Tahun
                </div>
                <div class="card-body">
                    <canvas id="trenChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header bg-success text-white fw-bold text-center py-2">
                    Komposisi Dosen
                </div>
                <div class="card-body">
                    <canvas id="pieChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Studi Dalam & Luar Negeri --}}
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 bg-body-tertiary h-100">
                <div class="card-header fw-bold text-secondary d-flex align-items-center">
                    <i class="bi bi-geo-alt-fill fs-4 text-primary me-2"></i> Studi Lanjut Dalam Negeri
                </div>
                <div class="card-body">
                    <h3 class="fw-semibold text-primary">{{ $jumlahDalam }}</h3>
                    <p class="text-muted small">Jumlah dosen studi lanjut di dalam negeri</p>
                    <ul class="list-unstyled small">
                        <li><i class="bi bi-person-check-fill text-success me-2"></i> Aktif: {{ $statusDalam['aktif'] ?? 0 }}</li>
                        <li><i class="bi bi-person-badge-fill text-secondary me-2"></i> Lulus: {{ $statusDalam['lulus'] ?? 0 }}</li>
                        <li><i class="bi bi-person-x-fill text-warning me-2"></i> Cuti: {{ $statusDalam['cuti'] ?? 0 }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 bg-body-tertiary h-100">
                <div class="card-header fw-bold text-secondary d-flex align-items-center">
                    <i class="bi bi-globe-americas fs-4 text-success me-2"></i> Studi Lanjut Luar Negeri
                </div>
                <div class="card-body">
                    <h3 class="fw-semibold text-success">{{ $jumlahLuar }}</h3>
                    <p class="text-muted small">Jumlah dosen studi lanjut di luar negeri</p>
                    <ul class="list-unstyled small">
                        <li><i class="bi bi-person-check-fill text-success me-2"></i> Aktif: {{ $statusLuar['aktif'] ?? 0 }}</li>
                        <li><i class="bi bi-person-badge-fill text-secondary me-2"></i> Lulus: {{ $statusLuar['lulus'] ?? 0 }}</li>
                        <li><i class="bi bi-person-x-fill text-warning me-2"></i> Cuti: {{ $statusLuar['cuti'] ?? 0 }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Periode Studi --}}
    <div class="card bg-body-tertiary shadow-sm border-0 mb-5">
        <div class="card-header fw-bold d-flex align-items-center text-secondary">
            <i class="bi bi-calendar-event-fill fs-5 text-info me-2"></i> Periode Studi (Tanggal Berakhir)
        </div>
        <div class="card-body p-2" style="max-height: 120px; overflow-y:auto;">
            @if($periodeStudi->isEmpty())
                <p class="text-muted text-center small m-2">Tidak ada data periode studi.</p>
            @else
                <ul class="list-unstyled small mb-0">
                    @foreach($periodeStudi as $periode)
                        <li class="border-bottom py-1">
                            <i class="bi bi-clock text-info me-2"></i>
                            {{ \Carbon\Carbon::parse($periode->periode_akhir)->format('d M Y') }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const tahun = @json($tahun);
const jumlahStudi = @json($jumlahStudi);
const totalDosen = @json($totalDosen);
const lanjutStudi = @json($studiLanjut);

// Line Chart
new Chart(document.getElementById('trenChart'), {
    type: 'line',
    data: {
        labels: tahun,
        datasets: [{
            label: 'Jumlah Dosen Lanjut Studi',
            data: jumlahStudi,
            borderColor: '#007bff',
            backgroundColor: 'rgba(0, 123, 255, 0.1)',
            borderWidth: 2,
            tension: 0.3,
            fill: true
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true } },
        responsive: true,
        maintainAspectRatio: false
    }
});

// Pie Chart
new Chart(document.getElementById('pieChart'), {
    type: 'pie',
    data: {
        labels: ['Lanjut Studi', 'Belum Lanjut'],
        datasets: [{
            data: [lanjutStudi, totalDosen - lanjutStudi],
            backgroundColor: ['#28a745', '#6c757d'],
            borderColor: '#fff',
            borderWidth: 2
        }]
    },
    options: {
        plugins: {
            legend: { position: 'bottom' },
            title: { display: false }
        },
        responsive: true
    }
});
</script>
@endsection
