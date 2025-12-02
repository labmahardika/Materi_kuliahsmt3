<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        // Ambil semua data mahasiswa
        $mahasiswas = Mahasiswa::all();

        // Kirim data ke view
        return view('mahasiswa.index', compact('mahasiswas'));
    }
    public function create()
    {
        return view('mahasiswa.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim',
            'nama' => 'required',
            'jurusan' => 'required',
        ]);


        Mahasiswa::create($request->all());


        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan.');
    }
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }


    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'jurusan' => 'required',
        ]);


        $mahasiswa->update($request->all());


        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil diupdate');
    }


    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();


        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil dihapus');
    }


}
