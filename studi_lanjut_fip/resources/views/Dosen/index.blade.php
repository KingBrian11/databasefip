@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
<style>
body {
    background-color: #f8faf9;
    font-family: "Inter", sans-serif;
}
.card {
    border: none;
    border-radius: 12px;
}
.btn-success {
    background: linear-gradient(90deg, #2ecc71, #27ae60);
    border: none;
    box-shadow: 0 2px 4px rgba(46,204,113,0.4);
    transition: all 0.2s;
}
.btn-success:hover {
    background: linear-gradient(90deg, #27ae60, #219150);
    transform: scale(1.03);
}

/* TABLE STYLE */
.table {
    border-radius: 10px;
    overflow: hidden;
    width: 100%;
    table-layout: auto;
    font-size: 0.9rem;
}
.table th {
    background: #16a34a !important;
    color: white !important;
    text-transform: uppercase;
    font-weight: 600;
    text-align: center;
    white-space: nowrap;
}
.table td {
    vertical-align: middle;
    white-space: nowrap;
}
.table-hover tbody tr:hover {
    background-color: #e8f5e9 !important;
}

/* PAGINATION MODERN */
.pagination {
    justify-content: center;
    margin-top: 1rem;
}
.pagination .page-item .page-link {
    border-radius: 8px;
    margin: 0 3px;
    color: #2c3e50;
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    transition: 0.2s;
}
.pagination .page-item .page-link:hover {
    background-color: #2ecc71;
    color: white;
    border-color: #27ae60;
}
.pagination .active .page-link {
    background-color: #27ae60;
    color: white;
    border-color: #27ae60;
}

/* SMOOTH TRANSITION */
#tableContainer {
    transition: opacity 0.25s ease-in-out;
}
</style>

<div class="container-fluid">

    <a href="{{ route('dosen.create') }}" class="btn btn-success btn-sm mb-3">
        <i class="bi bi-plus-circle"></i> Tambah
    </a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show py-2 px-3 small" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-sm" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filter --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body p-3">
            <form id="filterForm" class="d-flex flex-wrap align-items-end gap-2 w-100" onsubmit="return false;">
                <div class="flex-fill" style="min-width: 200px; max-width: 300px;">
                    <label class="form-label form-label-sm fw-bold">Nama</label>
                    <input type="text" 
                           name="nama" 
                           class="form-control form-control-sm" 
                           value="{{ request('nama') }}" 
                           placeholder="Cari nama dosen..." 
                           autocomplete="off">
                </div>
                <div class="flex-fill" style="min-width: 220px; max-width: 260px;">
                    <label class="form-label form-label-sm fw-bold">Jurusan</label>
                    <select name="jurusan" class="form-select form-select-sm auto-submit">
                        <option value="">Semua Jurusan</option>
                        @foreach($jurusan as $j)
                            <option value="{{ $j }}" {{ request('jurusan') == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    {{-- Table + Pagination --}}
    <div id="tableContainer" class="table-transition">
         @include('dosen.partials.table', ['dosen' => $dosen])
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("filterForm");
    const nameInput = form.querySelector('input[name="nama"]');
    const selectInputs = form.querySelectorAll(".auto-submit");
    const tableContainer = document.querySelector("#tableContainer");
    let typingTimer;

    // Bikin URL dinamis sesuai filter
    function buildUrl(extra = "") {
        const params = new URLSearchParams(new FormData(form));
        return `{{ route('dosen.index') }}?${params.toString()}${extra}`;
    }

    // Load tabel via AJAX
    function loadTable(url) {
        tableContainer.style.opacity = "0.5";
        fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
            .then(res => res.text())
            .then(html => {
                tableContainer.innerHTML = html;
                attachPagination(); // reattach pagination
                tableContainer.style.opacity = "1";
            })
            .catch(err => console.error("Fetch error:", err));
    }

    // Re-attach pagination link event
    function attachPagination() {
        document.querySelectorAll(".pagination a").forEach(link => {
            link.addEventListener("click", e => {
                e.preventDefault();
                const url = link.getAttribute("href");
                if (url) loadTable(url);
            });
        });
    }

    // Filter realtime nama
    nameInput.addEventListener("keyup", () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => loadTable(buildUrl()), 400);
    });

    nameInput.addEventListener("keydown", e => {
        if (e.key === "Enter") e.preventDefault();
    });

    // Filter dropdown auto-load
    selectInputs.forEach(sel => {
        sel.addEventListener("change", () => loadTable(buildUrl()));
    });

    attachPagination();
});
</script>
@endsection
