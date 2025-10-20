<?php

namespace App\Http\Controllers;

use App\Models\StudiLanjut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Dosen; // ✅ tambahkan ini

class StudiLanjutController extends Controller
{
    /**
     * Tampilkan semua data studi lanjut.
     */
    public function index(Request $request)
{
    $query = StudiLanjut::query();

    // 🔍 Filter Nama
    if ($request->filled('nama')) {
        $query->where('nama', 'like', '%' . $request->nama . '%');
    }

    // 🔍 Filter Jenis Studi
    if ($request->filled('jenis_studi')) {
        $query->where('jenis_studi', $request->jenis_studi);
    }

    // 🔍 Filter Status
    if ($request->filled('status_studi')) {
        $query->where('status_studi', $request->status_studi);
    }

    if ($request->filled('lokasi')) {
        $query->where('lokasi', $request->lokasi);
    }

    // Filter Jenjang
    if ($request->filled('jenjang')) {
        $query->where('jenjang', $request->jenjang);
    }

    

    // 🔍 Filter Periode (awal & akhir)
    if ($request->filled('periode_awal') && $request->filled('periode_akhir')) {
        $query->whereBetween('periode_awal', [$request->periode_awal, $request->periode_akhir]);
    }

    // Urutkan berdasarkan nama & pagination
    $items = $query->orderBy('nama')->paginate(13);

    // Biar filter tetap ada di URL pagination
    $items->appends($request->all());

    return view('studi_lanjut.index', compact('items'));
}

    /**
     * Simpan data baru.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'nip' => 'nullable|string',
        'golongan' => 'nullable|string',
        'unit_kerja' => 'nullable|string',  // ganti dari program_studi
        'bidang_studi' => 'nullable|string|max:255', // jika ada
        'jenis_studi' => 'nullable|string|max:255',
        'jenjang' => 'nullable|string|max:255',
        'status_studi' => 'nullable|string|max:255',
        'lokasi' => 'nullable|string|max:255',
        'tempat_studi' => 'nullable|string|max:255',
        'periode_awal' => 'nullable|date',
        'periode_akhir' => 'nullable|date',
        'tugas_belajar_sk_exist' => 'nullable|boolean',
        'tugas_belajar_sk_nomor' => 'nullable|string|max:255',
        'tugas_belajar_sk_path' => 'nullable|string|max:255', // jika ada file path
        'izin_belajar_exist' => 'nullable|boolean',
        'izin_belajar_nomor' => 'nullable|string|max:255',
        'izin_belajar_path' => 'nullable|string|max:255', // jika ada file path
        'sumber_biaya' => 'nullable|string|max:255',
        'progress' => 'nullable|string|max:255',
        'progress_november_2024' => 'nullable|string|max:255',
    ]);

    // Simpan ke database
    StudiLanjut::create([
        'nama' => $validated['nama'],
        'nip' => $validated['nip'] ?? null,
        'golongan' => $validated['golongan'] ?? null,
        'unit_kerja' => $validated['unit_kerja'] ?? null,
        'bidang_studi' => $validated['bidang_studi'] ?? null,
        'jenis_studi' => $validated['jenis_studi'] ?? null,
        'jenjang' => $validated['jenjang'] ?? null,
        'status_studi' => $validated['status_studi'] ?? null,
        'lokasi' => $validated['lokasi'] ?? null,
        'tempat_studi' => $validated['tempat_studi'] ?? null,
        'periode_awal' => $validated['periode_awal'] ?? null,
        'periode_akhir' => $validated['periode_akhir'] ?? null,
        'tugas_belajar_sk_exist' => $validated['tugas_belajar_sk_exist'] ?? null,
        'tugas_belajar_sk_nomor' => $validated['tugas_belajar_sk_nomor'] ?? null,
        'tugas_belajar_sk_path' => $validated['tugas_belajar_sk_path'] ?? null,
        'izin_belajar_exist' => $validated['izin_belajar_exist'] ?? null,
        'izin_belajar_nomor' => $validated['izin_belajar_nomor'] ?? null,
        'izin_belajar_path' => $validated['izin_belajar_path'] ?? null,
        'sumber_biaya' => $validated['sumber_biaya'] ?? null,
        'progress' => $validated['progress'] ?? null,
        'progress_november_2024' => $validated['progress_november_2024'] ?? null,
    ]);

    return redirect()->route('studi_lanjut.index')->with('success', 'Data berhasil disimpan!');
}

public function create()
{
    return view('studi_lanjut.create');
}

public function searchDosen(Request $request)
    {
        // Ambil parameter dari JavaScript: ?query=...
        $query = $request->get('query');

        if (!$query || strlen($query) < 2) {
            return response()->json([]); // jangan query kalau input terlalu pendek
        }

        // Ambil data dosen yang sesuai
        $dosen = Dosen::where('nama', 'like', "%{$query}%")
            ->select('nama', 'nip', 'golongan', 'jurusan') // ubah 'jurusan' ke 'unit_kerja' jika kolomnya begitu
            ->limit(10)
            ->get();

        return response()->json($dosen);
    }

    /**
     * Tampilkan detail data.
     */
    public function show(StudiLanjut $studiLanjut)
    {
        return view('studi_lanjut.show', ['item' => $studiLanjut]);
    }

    /**
     * Tampilkan form edit.
     */
    public function edit(StudiLanjut $studiLanjut)
    {
        return view('studi_lanjut.edit', ['item' => $studiLanjut]);
    }

    /**
     * Update data.
     */
    public function update(Request $request, StudiLanjut $studiLanjut)
{
    $data = $request->validate([
        'nama' => 'required|string|max:255',
        'nip' => 'nullable|string|max:30',
        'golongan' => 'nullable|string|max:20',
        'unit_kerja' => 'nullable|string|max:255',
        'bidang_studi' => 'nullable|string|max:255',
        'jenis_studi' => 'nullable|string|max:255',
        'jenjang' => 'nullable|string|max:100',
        'status_studi' => 'nullable|string|max:100',
        'lokasi' => ['nullable', Rule::in(['Dalam Negeri', 'Luar Negeri'])],
        'tempat_studi' => 'nullable|string|max:255',
        'periode_awal' => 'nullable|date',
        'periode_akhir' => 'nullable|date|after_or_equal:periode_awal',
        'tugas_belajar_sk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'izin_belajar' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        'tugas_belajar_sk_nomor' => 'nullable|string|max:255',
        'izin_belajar_nomor' => 'nullable|string|max:255',
        'sumber_biaya' => 'nullable|string|max:255',
        'progress' => 'nullable|string|max:255',
        'progress_november_2024' => 'nullable|string|max:255',
    ]);

        // Handle file SK Tugas Belajar
        if ($request->hasFile('tugas_belajar_sk')) {
            if ($studiLanjut->tugas_belajar_sk_path) {
                Storage::delete($studiLanjut->tugas_belajar_sk_path);
            }
            $path = $request->file('tugas_belajar_sk')->store('public/studi_files');
            $data['tugas_belajar_sk_path'] = $path;
            $data['tugas_belajar_sk_exist'] = true;
        } elseif ($request->input('remove_tugas_belajar_sk')) {
            if ($studiLanjut->tugas_belajar_sk_path) {
                Storage::delete($studiLanjut->tugas_belajar_sk_path);
            }
            $data['tugas_belajar_sk_path'] = null;
            $data['tugas_belajar_sk_exist'] = false;
        }

        // Handle file SK Izin Belajar
        if ($request->hasFile('izin_belajar')) {
            if ($studiLanjut->izin_belajar_path) {
                Storage::delete($studiLanjut->izin_belajar_path);
            }
            $path = $request->file('izin_belajar')->store('public/studi_files');
            $data['izin_belajar_path'] = $path;
            $data['izin_belajar_exist'] = true;
        } elseif ($request->input('remove_izin_belajar')) {
            if ($studiLanjut->izin_belajar_path) {
                Storage::delete($studiLanjut->izin_belajar_path);
            }
            $data['izin_belajar_path'] = null;
            $data['izin_belajar_exist'] = false;
        }

        $studiLanjut->update($data);

        return redirect()->route('studi_lanjut.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Hapus data.
     */
    public function destroy(StudiLanjut $studiLanjut)
    {
        if ($studiLanjut->tugas_belajar_sk_path) {
            Storage::delete($studiLanjut->tugas_belajar_sk_path);
        }
        if ($studiLanjut->izin_belajar_path) {
            Storage::delete($studiLanjut->izin_belajar_path);
        }

        $studiLanjut->delete();
        return redirect()->route('studi_lanjut.index')->with('success', 'Data berhasil dihapus.');
    }

    

    /**
     * Download file (helper).
     */
    public function download($id, $type)
    {
        $item = StudiLanjut::findOrFail($id);

        if ($type === 'tugas' && $item->tugas_belajar_sk_path) {
            return response()->download(storage_path('app/'.$item->tugas_belajar_sk_path));
        }

        if ($type === 'izin' && $item->izin_belajar_path) {
            return response()->download(storage_path('app/'.$item->izin_belajar_path));
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
    public function calendar()
{
    $periodeStudi = StudiLanjut::select('nama', 'periode_akhir')->get();

    $events = $periodeStudi->map(function($item) {
    return [
        'title' => $item->nama,
        'start' => \Carbon\Carbon::parse($item->periode_akhir)->format('Y-m-d'),
        'color' => $item->status_studi === 'Selesai' ? 'green' : 'orange',
    ];
});


    return view('studi_lanjut.calendar', ['events' => $events]);
}
public function downloadSurat($id)
{
    $item = StudiLanjut::findOrFail($id);

    $pdf = Pdf::loadView('studi_lanjut.show_pdf', compact('item'))
        ->setPaper('A4', 'portrait');

    return $pdf->download('Surat_Studi_Lanjut_'.$item->nama.'.pdf');
}

public function byJurusan($slug)
{
    $namaJurusan = ucwords(str_replace('-', ' ', $slug));

    $items = DosenStudiLanjut::where('jurusan', $namaJurusan)->paginate(10);

    return view('studi_lanjut.index', compact('items', 'namaJurusan'));
}

}
