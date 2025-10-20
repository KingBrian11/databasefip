<div class="table-responsive shadow-sm rounded"> 
    <table class="table table-fixed table-bordered table-striped table-hover table-sm align-middle mb-0">

        <thead class="table-dark text-center">
            <tr>
                
                <th style="width:40px;">No</th>
                <th style="min-width:300px;" class="text-start">Nama</th>
                <th style="min-width:150px;">NIP</th>
                <th style="width:90px;">Golongan / Pangkat</th>
                <th style="min-width:240px;">Staf / Bagian</th>
                <th style="width:90px;">Aksi</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse ($pegawai as $key => $p)
                <tr>
                    <td class="text-center">{{ $pegawai->firstItem() + $key }}</td>
                    <td class="text-start">{{ $p->nama }}</td>
                    <td class="text-center">{{ $p->nip ?: '-' }}</td>
                    <td class="text-center">{{ $p->golongan ?: '-' }}</td>
                    <td class="text-center">{{ $p->staf ?: '-' }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('tata_usaha.edit', $p->id) }}" class="btn btn-warning btn-sm px-2 py-1" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('tata_usaha.destroy', $p->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm px-2 py-1" onclick="return confirm('Yakin hapus data ini?')" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-3">
                        <i class="bi bi-info-circle"></i> Belum ada data pegawai.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination + Info Jumlah Data --}}
@if ($pegawai->hasPages())
<div class="d-flex justify-content-between align-items-center flex-wrap mt-3 px-2">
    {{-- Info jumlah data --}}
    <div class="text-muted small mb-2 mb-md-0">
        Menampilkan 
        <strong>{{ $pegawai->firstItem() ?? 0 }}</strong> – 
        <strong>{{ $pegawai->lastItem() ?? 0 }}</strong> 
        dari <strong>{{ $pegawai->total() }}</strong> data
    </div>

    {{-- Navigasi pagination --}}
    <nav>
        <ul class="pagination pagination-sm mb-0">
            {{-- Tombol Sebelumnya --}}
            @if ($pegawai->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $pegawai->previousPageUrl() }}">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Nomor Halaman --}}
            @foreach ($pegawai->getUrlRange(1, $pegawai->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $pegawai->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Tombol Berikutnya --}}
            @if ($pegawai->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $pegawai->nextPageUrl() }}">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link"><i class="bi bi-chevron-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
</div>
@endif
