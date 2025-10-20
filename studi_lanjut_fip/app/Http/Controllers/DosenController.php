<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $jurusan = [
            'Administrasi Pendidikan',
            'Bimbingan dan Konseling',
            'Pendidikan Khusus',
            'Pendidikan Masyarakat',
            'Psikologi',
            'Perpustakaan dan Sains Informasi',
            'Teknologi Pendidikan dan Pengembangan Kurikulum',
            'Pedagogik',
            'Pendidikan Guru Pendidikan Anak Usia Dini',
            'Pendidikan Guru Sekolah Dasar'
        ];

        $query = Dosen::query();

        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        if ($request->filled('jurusan')) {
            $query->where('jurusan', $request->jurusan);
        }

        // Pagination 20 per halaman
        $dosen = $query->orderBy('nama', 'asc')->paginate(13);

        if ($request->ajax()) {
            return view('dosen.partials.table', compact('dosen'))->render();
        }

        return view('dosen.index', compact('dosen', 'jurusan'));
    }


    public function show($jurusan)
    {
        $dosen = Dosen::where('jurusan', $jurusan)->get();
        return view('dosen.show', compact('dosen', 'jurusan'));
    }

    public function search(Request $request)
{
    $query = $request->query('query');

    if (!$query) {
        return response()->json([]);
    }

    $dosen = \App\Models\Dosen::where('nama', 'like', "%{$query}%")
        ->orWhere('nip', 'like', "%{$query}%")
        ->take(10)
        ->get(['nama', 'nip', 'golongan', 'jurusan',]); // pakai 'jurusan'

    return response()->json($dosen);
}




    public function create()
    {
        $jurusan = [
            'Administrasi Pendidikan',
            'Bimbingan dan Konseling',
            'Pendidikan Khusus',
            'Pendidikan Masyarakat',
            'Psikologi',
            'Perpustakaan dan Sains Informasi',
            'Teknologi Pendidikan dan Pengembangan Kurikulum',
            'Pedagogik',
            'Pendidikan Guru Pendidikan Anak Usia Dini',
            'Pendidikan Guru Sekolah Dasar'
        ];
        return view('dosen.create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:100',
            'golongan' => 'required|string|max:50',
            'jurusan' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:100',
        ]);

        Dosen::create($request->all());

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        $jurusan = [
            'Administrasi Pendidikan',
            'Bimbingan dan Konseling',
            'Pendidikan Khusus',
            'Pendidikan Masyarakat',
            'Psikologi',
            'Perpustakaan dan Sains Informasi',
            'Teknologi Pendidikan dan Pengembangan Kurikulum',
            'Pedagogik',
            'Pendidikan Guru Pendidikan Anak Usia Dini',
            'Pendidikan Guru Sekolah Dasar'
        ];
        return view('dosen.edit', compact('dosen', 'jurusan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:100',
            'golongan' => 'required|string|max:50',
            'jabatan' => 'nullable|string|max:100',
            'jurusan' => 'required|string|max:255',
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->update($request->all());

        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus!');
    }
}
