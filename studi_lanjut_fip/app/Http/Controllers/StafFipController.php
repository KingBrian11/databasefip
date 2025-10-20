<?php

namespace App\Http\Controllers;

use App\Models\StafFip;
use App\Models\AnggotaStafFip;
use Illuminate\Http\Request;

class StafFipController extends Controller
{
    public function index()
    {
        $jabatan = StafFip::all();
        return view('staf_fip.index', compact('jabatan'));
    }

    public function show($id)
    {
        $jabatan = StafFip::with('anggota')->findOrFail($id);
        return view('staf_fip.show', compact('jabatan'));
    }

    public function create()
    {
        return view('staf_fip.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|string|max:255',
            'nama.*' => 'nullable|string|max:255',
        ]);

        $staf = StafFip::create(['jabatan' => $request->jabatan]);

        if ($request->has('nama')) {
            foreach ($request->nama as $nama) {
                if ($nama) {
                    AnggotaStafFip::create([
                        'staf_fip_id' => $staf->id,
                        'nama' => $nama,
                    ]);
                }
            }
        }

        return redirect()->route('staf_fip.index')->with('success', 'Jabatan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jabatan = StafFip::with('anggota')->findOrFail($id);
        return view('staf_fip.edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $jabatan = StafFip::findOrFail($id);
        $jabatan->update(['jabatan' => $request->jabatan]);

        // Hapus staf lama, masukkan ulang
        AnggotaStafFip::where('staf_fip_id', $id)->delete();
        if ($request->has('nama')) {
            foreach ($request->nama as $nama) {
                if ($nama) {
                    AnggotaStafFip::create([
                        'staf_fip_id' => $id,
                        'nama' => $nama,
                    ]);
                }
            }
        }

        return redirect()->route('staf_fip.show', $id)->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jabatan = StafFip::findOrFail($id);
        $jabatan->delete();
        return redirect()->route('staf_fip.index')->with('success', 'Data jabatan dihapus.');
    }
}
