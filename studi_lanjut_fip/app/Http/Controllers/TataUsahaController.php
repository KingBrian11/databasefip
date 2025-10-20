<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TataUsaha;
use Illuminate\Support\Facades\DB;

class TataUsahaController extends Controller
{
    /**
     * Tampilkan daftar semua pegawai TU.
     */
    public function index(Request $request)
{
    $pegawai = TataUsaha::orderBy('staf', 'asc') // urut berdasarkan unit kerja
        ->orderByRaw("
            CASE 
                WHEN golongan LIKE 'IV/%' THEN 1
                WHEN golongan LIKE 'III/%' THEN 2
                WHEN golongan LIKE 'II/%' THEN 3
                WHEN golongan LIKE 'I/%' THEN 4
                ELSE 5
            END
        ") // urut golongan dari tertinggi ke terendah
        ->paginate(10);
    // Buat query dasar
    $query = TataUsaha::query();

    // 🔍 Filter Nama (jika diisi)
    if ($request->filled('nama')) {
        $query->where('nama', 'like', '%' . $request->nama . '%');
    }

    // 🔍 Filter Staf (jika diisi)
    if ($request->filled('staf')) {
        $query->where('staf', $request->staf);
    }

    // 🔢 Urutkan berdasarkan nama dan paginasi
    $pegawai = $query->orderBy('nama', 'asc')->paginate(13);

    // 🔁 Ambil daftar staf unik (buat dropdown filter)
    $stafList = TataUsaha::select('staf')
        ->whereNotNull('staf')
        ->distinct()
        ->pluck('staf')
        ->toArray();

    // ⚡ Jika permintaan dari AJAX (filter tanpa reload)
    if ($request->ajax()) {
        return view('tata_usaha.partials.table', compact('pegawai'))->render();
    }

    // 📄 Tampilkan ke view utama
    return view('tata_usaha.index', compact('pegawai', 'stafList'));
}

public function search(Request $request)
{
    $query = $request->query('query');

    if (!$query) {
        return response()->json([]);
    }

    $tu = \App\Models\TataUsaha::where('nama', 'like', "%{$query}%")
        ->orWhere('nip', 'like', "%{$query}%")
        ->take(10)
        ->get(['nama', 'nip', 'golongan', 'staf']); // pakai 'staf' bukan 'jurusan'

    return response()->json($tu);
}


    /**
     * Tampilkan form tambah data TU.
     */
    public function create()
    {
        return view('tata_usaha.create');
    }

    /**
     * Simpan data TU baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:tata_usaha,nip',
            'golongan' => 'nullable|string|max:255',
            'staf' => 'nullable|string|max:255',
        ]);

        TataUsaha::create($validated);

        return redirect()
            ->route('tata_usaha.index')
            ->with('success', ' Data pegawai TU berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit untuk data TU tertentu.
     */
    public function edit($id)
    {
        $pegawai = TataUsaha::findOrFail($id);
        return view('tata_usaha.edit', compact('pegawai'));
    }

    /**
     * Perbarui data TU.
     */
    public function update(Request $request, $id)
    {
        $pegawai = TataUsaha::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255|unique:tata_usaha,nip,' . $pegawai->id,
            'golongan' => 'nullable|string|max:255',
            'staf' => 'nullable|string|max:255',
        ]);

        $pegawai->update($validated);

        return redirect()
            ->route('tata_usaha.index')
            ->with('success', ' Data pegawai TU berhasil diperbarui!');
    }

    /**
     * Hapus data TU.
     */
    public function destroy($id)
    {
        $pegawai = TataUsaha::findOrFail($id);
        $pegawai->delete();

        return redirect()
            ->route('tata_usaha.index')
            ->with('success', '🗑️ Data pegawai TU berhasil dihapus!');
    }
}
