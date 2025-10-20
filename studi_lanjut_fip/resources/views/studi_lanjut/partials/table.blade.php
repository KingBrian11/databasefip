<div class="card-body p-3">
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
                        <td class="text-center">{{ $items->firstItem() + $index }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jenis_studi }}</td>
                        <td>{{ $item->jenjang }}</td>
                        <td>
                            <span class="badge 
                                @if($item->status_studi == 'Aktif') bg-primary
                                @elseif($item->status_studi == 'Lulus') bg-success
                                @elseif($item->status_studi == 'Cuti') bg-warning
                                @else bg-secondary @endif">
                                {{ $item->status_studi }}
                            </span>
                        </td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->tempat_studi }}</td>
                        <td class="text-center">
                            <a href="{{ route('studi_lanjut.show', $item->id) }}" class="btn btn-info btn-sm" title="Lihat">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('studi_lanjut.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('studi_lanjut.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted small">
                            <i class="bi bi-info-circle"></i> Tidak ada data ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($items->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-2 small flex-wrap">
            <div class="text-muted mb-2 mb-md-0">
                Menampilkan <strong>{{ $items->firstItem() }}</strong> - <strong>{{ $items->lastItem() }}</strong> 
                dari total <strong>{{ $items->total() }}</strong> data
            </div>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    @if ($items->onFirstPage())
                        <li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-left"></i></span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $items->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}"><i class="bi bi-chevron-left"></i></a></li>
                    @endif

                    @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $items->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url . '&' . http_build_query(request()->except('page')) }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    @if ($items->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $items->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}"><i class="bi bi-chevron-right"></i></a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-right"></i></span></li>
                    @endif
                </ul>
            </nav>
        </div>
    @endif
</div>
