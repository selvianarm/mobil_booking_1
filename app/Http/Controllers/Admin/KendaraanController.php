<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::latest()->get();
        return view('admin.kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:100',
            'status' => 'required|in:tersedia,tidak tersedia,rusak',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['jenis', 'status']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kendaraans', 'public');
        }

        Kendaraan::create($data);

        return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil disimpan!');
    }

    public function show($id)
    {
        $kendaraans = Kendaraan::findOrFail($id);
        return view('admin.kendaraan.detail', compact('kendaraans'));
    }

    public function edit($id)
    {
        $kendaraans = Kendaraan::findOrFail($id);
        return view('admin.kendaraan.edit', compact('kendaraans'));
    }

    public function update(Request $request, $id)
    {
        $kendaraans = Kendaraan::findOrFail($id);

        $request->validate([
            'jenis' => 'required|string|max:100',
            'status' => 'required|in:tersedia,tidak tersedia,rusak',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['jenis','status']);

        if ($request->hasFile('foto')) {
            if ($kendaraans->foto) {
                \Storage::disk('public')->delete($kendaraans->foto);
            }
            $data['foto'] = $request->file('foto')->store('kendaraans', 'public');
        }

        $kendaraans->update($data);

        return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kendaraans = Kendaraan::findOrFail($id);
        if ($kendaraans->foto) {
            \Storage::disk('public')->delete($kendaraans->foto);
        }
        $kendaraans->delete();
        return redirect()->route('admin.kendaraan.index')->with('success', 'Data kendaraan berhasil dihapus!');
    }
}
