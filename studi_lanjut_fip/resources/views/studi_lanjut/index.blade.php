@extends('layouts.app')

@section('title', 'Data Studi Lanjut')

@section('content')
<style>
/* ======== TEMA MODERN HIJAU ======== */
body { background-color: #f8faf9; font-family: "Inter", sans-serif; }
.card { border: none; border-radius: 12px; overflow: hidden; }
.card-body { background: #ffffff; border-radius: 12px; }
.btn-success { background: linear-gradient(90deg, #2ecc71, #27ae60); border: none; box-shadow: 0 2px 4px rgba(46, 204, 113, 0.4); transition: all 0.2s ease-in-out; }
.btn-success:hover { background: linear-gradient(90deg, #27ae60, #219150); transform: scale(1.03); }
.btn-primary { background: #16a34a; border: none; }
.btn-primary:hover { background: #15803d; }
.btn-secondary { background: #9ca3af; border: none; }
.btn-secondary:hover { background: #6b7280; }

/* ======== TABEL ======== */
.table { border-radius: 10px; overflow: hidden; width: 100%; table-layout: fixed; font-size: 0.88rem; }
.table th { background: #16a34a !important; color: white !important; text-transform: uppercase; font-weight: 600; letter-spacing: 0.03em; text-align: center; }
.table td, .table th { text-overflow: ellipsis; white-space: nowrap; overflow: hidden; vertical-align: middle; }
.table th:nth-child(1), .table td:nth-child(1) { width: 5%; text-align:center; } 
.table th:nth-child(2), .table td:nth-child(2) { width: 20%; } 
.table th:nth-child(3), .table td:nth-child(3) { width: 12%; text-align:center; } 
.table th:nth-child(4), .table td:nth-child(4) { width: 10%; text-align:center; } 
.table th:nth-child(5), .table td:nth-child(5) { width: 10%; text-align:center; } 
.table th:nth-child(6), .table td:nth-child(6) { width: 13%; text-align:center; } 
.table th:nth-child(7), .table td:nth-child(7) { width: 20%; } 
.table th:nth-child(8), .table td:nth-child(8) { width: 10%; text-align:center; }
.table-hover tbody tr:hover { background-color: #e8f5e9 !important; }

.btn-sm { width: 32px; height: 32px; border-radius: 6px; padding: 0; }
.btn-info { background-color: #1abc9c; border: none; }
.btn-warning { background-color: #f1c40f; border: none; color: #000; }
.btn-danger { background-color: #e74c3c; border: none; }

.badge { font-size: 0.75rem; padding: 5px 10px; border-radius: 6px; font-weight: 600; }
.badge.bg-primary { background-color: #1e88e5 !important; }
.badge.bg-success { background-color: #2ecc71 !important; }
.badge.bg-warning { background-color: #f1c40f !important; color: #000 !important; }
.badge.bg-secondary { background-color: #95a5a6 !important; }

.page-link { color: #16a34a; border-radius: 6px; }
.page-item.active .page-link { background-color: #16a34a; border-color: #16a34a; }
.page-item.active .page-link {
    background: linear-gradient(90deg, #2ecc71, #27ae60);
    border-radius: 6px;
    border: none;
}

.page-link {
    transition: all 0.2s ease-in-out;
}

.page-link:hover {
    background-color: #e8f5e9;
}

.table-responsive { overflow-x: auto; }
@media (max-width: 992px) { .table th, .table td { font-size: 0.8rem; } }
</style>

<div class="container-fluid">
    <a href="{{ route('studi_lanjut.create') }}" class="btn btn-success btn-sm mb-3">
        <i class="bi bi-plus-circle"></i> 
    </a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show py-2 px-3 small" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(isset($namaJurusan))
        <div class="alert alert-success small py-2">
            <i class="bi bi-bookmark-fill"></i> Data dosen jurusan <strong>{{ $namaJurusan }}</strong>
        </div>
    @endif

    {{-- Filter Form --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body p-3">
            <form method="GET" action="{{ route('studi_lanjut.index') }}" id="filterForm" class="d-flex flex-wrap align-items-center gap-2 w-100">
                <!-- Nama -->
                <div class="flex-fill" style="min-width: 150px; max-width: 250px;">
                    <label class="form-label form-label-sm fw-bold">Nama</label>
                    <input type="text" name="nama" class="form-control form-control-sm" value="{{ request('nama') }}" placeholder="Nama...">
                </div>

                <!-- Jenis Studi -->
                <div class="flex-fill" style="min-width: 140px; max-width: 185px;">
                    <label class="form-label form-label-sm fw-bold">Jenis Studi</label>
                    <select name="jenis_studi" class="form-select form-select-sm auto-submit">
                        <option value="">Semua Jenis</option>
                        <option value="Izin Belajar" {{ request('jenis_studi')=='Izin Belajar'?'selected':'' }}>Izin Belajar</option>
                        <option value="Tugas Belajar" {{ request('jenis_studi')=='Tugas Belajar'?'selected':'' }}>Tugas Belajar</option>
                    </select>
                </div>

                <!-- Status -->
            <div class="flex-fill" style="min-width: 140px; max-width: 185px;">
                <label class="form-label form-label-sm fw-bold">Status</label>
                <select name="status_studi" class="form-select form-select-sm auto-submit">
                    <option value="">Semua Status</option>
                    <option value="Aktif" {{ request('status_studi')=='Aktif'?'selected':'' }}>Aktif</option>
                    <option value="Lulus" {{ request('status_studi')=='Lulus'?'selected':'' }}>Lulus</option>
                    <option value="Cuti" {{ request('status_studi')=='Cuti'?'selected':'' }}>Cuti</option>
                </select>
            </div>

                <!-- Jenjang -->
                <div class="flex-fill" style="min-width: 120px; max-width: 185px;">
                    <label class="form-label form-label-sm fw-bold">Jenjang</label>
                    <select name="jenjang" class="form-select form-select-sm auto-submit">
                        <option value="">Semua Jenjang</option>
                        <option value="S1" {{ request('jenjang')=='S1'?'selected':'' }}>S1</option>
                        <option value="S2" {{ request('jenjang')=='S2'?'selected':'' }}>S2</option>
                        <option value="S3" {{ request('jenjang')=='S3'?'selected':'' }}>S3</option>
                    </select>
                </div>

                <!-- Lokasi -->
                <div class="flex-fill" style="min-width: 140px; max-width: 185px;">
                    <label class="form-label form-label-sm fw-bold">Lokasi</label>
                    <select name="lokasi" class="form-select form-select-sm auto-submit">
                        <option value="">Semua Lokasi</option>
                        <option value="Dalam Negeri" {{ request('lokasi')=='Dalam Negeri'?'selected':'' }}>Dalam Negeri</option>
                        <option value="Luar Negeri" {{ request('lokasi')=='Luar Negeri'?'selected':'' }}>Luar Negeri</option>
                    </select>
                </div>

                <!-- Periode Awal -->
                <div class="flex-fill" style="min-width: 140px; max-width: 185px;">
                    <label class="form-label form-label-sm fw-bold">Periode Awal</label>
                    <input type="date" name="periode_awal" class="form-control form-control-sm auto-submit" value="{{ request('periode_awal') }}">
                </div>

                <!-- Periode Akhir -->
                <div class="flex-fill" style="min-width: 140px; max-width: 185px;">
                    <label class="form-label form-label-sm fw-bold">Periode Akhir</label>
                    <input type="date" name="periode_akhir" class="form-control form-control-sm auto-submit" value="{{ request('periode_akhir') }}">
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card-body p-3" id="tableContainer">
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped table-sm align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Studi</th>
                    <th>Jenjang</th>
                    <th>Status</th>
                    <th>Lokasi</th>
                    <th>Tempat Studi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $index => $item)
                    <tr>
                        <td>{{ $items->firstItem() + $index }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis_studi }}</td>
                        <td>{{ $item->jenjang }}</td>
                        <td>
                            <span class="badge 
                                @if($item->status_studi == 'Aktif') bg-primary
                                @elseif($item->status_studi == 'Lulus') bg-success
                                @elseif($item->status_studi == 'Cuti') bg-warning
                                @else bg-secondary @endif">
                                <i class="bi bi-circle-fill small"></i> {{ $item->status_studi }}
                            </span>
                        </td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->tempat_studi }}</td>
                        <td>
                            <a href="{{ route('studi_lanjut.show', $item->id) }}" class="btn btn-info btn-sm" title="Lihat">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('studi_lanjut.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('studi_lanjut.destroy', $item->id) }}" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Hapus"
                                        onclick="return confirm('Yakin hapus data ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted small">
                            <i class="bi bi-info-circle"></i> Belum ada data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($items->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
        {{-- Info jumlah data --}}
        <div class="small text-muted mb-2 mb-md-0">
            Menampilkan data ke 
            <strong>{{ $items->firstItem() }}</strong> 
            sampai 
            <strong>{{ $items->lastItem() }}</strong> 
            dari total 
            <strong>{{ $items->total() }}</strong> 
            data
        </div>

        {{-- Navigasi pagination --}}
        <nav>
            <ul class="pagination pagination-sm mb-0">
                {{-- Tombol Sebelumnya --}}
                @if ($items->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link bg-light text-muted border-0">
                            <i class="bi bi-chevron-left"></i>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link border-0 text-success" 
                           href="{{ $items->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Nomor Halaman --}}
                @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $items->currentPage() ? 'active' : '' }}">
                        <a class="page-link border-0 {{ $page == $items->currentPage() ? 'bg-success text-white fw-semibold' : 'text-success' }}" 
                           href="{{ $url . '&' . http_build_query(request()->except('page')) }}">
                           {{ $page }}
                        </a>
                    </li>
                @endforeach

                {{-- Tombol Berikutnya --}}
                @if ($items->hasMorePages())
                    <li class="page-item">
                        <a class="page-link border-0 text-success" 
                           href="{{ $items->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link bg-light text-muted border-0">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif

</div>

</div>

<script>
function loadTable(url) {
    fetch(url, {
        headers: { "X-Requested-With": "XMLHttpRequest" }
    })
    .then(res => res.text())
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newTable = doc.querySelector('#tableContainer');
        document.querySelector('#tableContainer').replaceWith(newTable);
        attachEvents(); // reattach events
    });
}

function attachEvents() {
    document.querySelectorAll('.auto-submit').forEach(element => {
        element.onchange = () => loadTable('{{ route('studi_lanjut.index') }}' + '?' + new URLSearchParams(new FormData(document.getElementById('filterForm'))).toString());
    });

    let typingTimer;
    const nameInput = document.querySelector('input[name="nama"]');
    if (nameInput) {
        nameInput.onkeyup = () => {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => {
                loadTable('{{ route('studi_lanjut.index') }}' + '?' + new URLSearchParams(new FormData(document.getElementById('filterForm'))).toString());
            }, 500);
        };
    }

    document.querySelectorAll('.page-link').forEach(link => {
        link.onclick = (e) => {
            e.preventDefault();
            loadTable(link.href);
        };
    });
}

// initial attach
attachEvents();
</script>
@endsection
