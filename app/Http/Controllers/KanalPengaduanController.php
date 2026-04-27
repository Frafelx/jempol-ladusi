<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KanalPengaduan;

class KanalPengaduanController extends Controller
{
    public function index()
    {
        $kanals = KanalPengaduan::latest()->get();
        return view('kanal-pengaduan', compact('kanals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kanal_aduan' => 'required|string|max:255',
            'link'        => 'nullable|string|max:255',
            'username'    => 'nullable|string|max:255',
            'password'    => 'nullable|string|max:255',
        ]);

        KanalPengaduan::create($request->all());

        return back()->with('success', 'Data kanal pengaduan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kanal_aduan' => 'required|string|max:255',
            'link'        => 'nullable|string|max:255',
            'username'    => 'nullable|string|max:255',
            'password'    => 'nullable|string|max:255',
        ]);

        $kanal = KanalPengaduan::findOrFail($id);
        $kanal->update($request->all());

        return back()->with('success', 'Data kanal pengaduan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        KanalPengaduan::findOrFail($id)->delete();
        
        return back()->with('success', 'Data kanal pengaduan berhasil dihapus!');
    }
}