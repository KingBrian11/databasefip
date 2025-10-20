<?php

namespace App\Http\Controllers;

use App\Models\StafProdi;
use Illuminate\Http\Request;

class StafProdiController extends Controller
{
    public function index()
    {
        $programStudi = StafProdi::select('program_studi')->distinct()->get();
        return view('staf_prodi.index', compact('programStudi'));
    }

    public function show($program_studi)
    {
        $staf = StafProdi::where('program_studi', $program_studi)->get();
        return view('staf_prodi.show', compact('staf', 'program_studi'));
    }

    public function create()
    {
        return view('staf_prodi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_studi' => 'required|string',
            'nama' => 'required|string',
            'jabatan' => 'nullable|string',
            'nip' => 'nullable|string',
        ]);

        StafProdi::create($request->all());
        return redirect()->route('staf_prodi.index')->with('success', 'Staf berhasil ditambahkan');
    }

    public function edit($id)
    {
        $staf = StafProdi::findOrFail($id);
        return view('staf_prodi.edit', compact('staf'));
    }

    public function update(Request $request, $id)
    {
        $staf = StafProdi::findOrFail($id);
        $staf->update($request->all());
        return redirect()->route('staf_prodi.index')->with('success', 'Data staf berhasil diperbarui');
    }

    public function destroy($id)
    {
        StafProdi::findOrFail($id)->delete();
        return redirect()->route('staf_prodi.index')->with('success', 'Data staf berhasil dihapus');
    }
}
