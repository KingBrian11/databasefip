<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped table-sm align-middle">
        <thead>
            <tr>
                <th style="width:40px;">No</th>
                <th style="max-width:20px;">Nama</th>
                <th style="min-width:150px;">NIP</th>
                <th style="width:90px;">Golongan / Pangkat</th>
                <th style="width:90px;">Jabatan</th>
                <th style="min-width:240px;">Program Studi</th>
                <th style="width:90px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dosen as $index => $d)
                <tr>
                    <td class="text-center">{{ $dosen->firstItem() + $index }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->nip }}</td>
                    <td>{{ $d->golongan }}</td>
                    <td>{{ $d->jabatan }}</td>
                    <td>{{ $d->jurusan }}</td>
                    <td class="text-center">
                        <a href="{{ route('dosen.edit', $d->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('dosen.destroy', $d->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus data ini?')" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted small">
                        <i class="bi bi-info-circle"></i> Tidak ada data ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
{{-- Pagination --}}
@if ($dosen->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
        {{-- Info jumlah data --}}
        <div class="small text-muted mb-2 mb-md-0">
            Menampilkan data ke 
            <strong>{{ $dosen->firstItem() }}</strong> 
            sampai 
            <strong>{{ $dosen->lastItem() }}</strong> 
            dari total 
            <strong>{{ $dosen->total() }}</strong> 
            data
        </div>

        {{-- Navigasi pagination --}}
        <nav>
            <ul class="pagination pagination-sm mb-0">
                {{-- Tombol Sebelumnya --}}
                @if ($dosen->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" 
                           href="{{ $dosen->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                @endif

                {{-- Nomor Halaman --}}
                @foreach ($dosen->getUrlRange(1, $dosen->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $dosen->currentPage() ? 'active' : '' }}">
                        <a class="page-link" 
                           href="{{ $url . '&' . http_build_query(request()->except('page')) }}">
                           {{ $page }}
                        </a>
                    </li>
                @endforeach

                {{-- Tombol Berikutnya --}}
                @if ($dosen->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" 
                           href="{{ $dosen->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}">
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
