<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kelas;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        $bukus = Buku::with('kelas')->get();
        $paginate = Buku::orderBy('id_buku', 'desc')->paginate(3);
        return view('index', ['bukus' => $bukus, 'paginate'=>$paginate]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('create',['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'id_buku' => 'required',
            'judul' => 'required',
            'kategori' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'jumlah' => 'required',
            'status' => 'required',
            'kelas' => 'required',
            ]);

            $buku = new Buku;
            $buku->id_buku = $request->get('id_buku');
            $buku->judul = $request->get('judul');
            $buku->kategori = $request->get('kategori');
            $buku->penerbit = $request->get('penerbit');
            $buku->pengarang = $request->get('pengarang');
            $buku->jumlah = $request->get('jumlah');
            $buku->status = $request->get('status');

            $kelas = new Kelas;
            $kelas->id = $request->get('kelas');

            //fungsi eloquent untuk menambah data
            $buku->kelas()->associate($kelas);
            $buku->save();

            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            return redirect()->route('bukus.index')
            ->with('success', 'Buku Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_buku)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Buku = Buku::with('kelas')->where('id_buku',$id_buku)->first();
        return view('detail', ['Buku' => $Buku]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_buku)
    {
        $Buku = Buku::with('kelas')->where('id_buku',$id_buku)->first();
        $kelas = Kelas::all();
        return view('edit', compact('Buku', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_buku)
    {
        //melakukan validasi data
        $request->validate([
            'id_buku' => 'required',
            'judul' => 'required',
            'kategori' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'jumlah' => 'required',
            'status' => 'required',
            'kelas' => 'required',
            ]);

            $buku = Buku::with('kelas')->where('id_buku',$id_buku)->first();
            $buku->id_buku = $request->get('id_buku');
            $buku->judul = $request->get('judul');
            $buku->kategori = $request->get('kategori');

            $kelas = new Kelas;
            $kelas->id = $request->get('kelas');

            //fungsi eloquent untuk menambah data
            $buku->kelas()->associate($kelas);
            $buku->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
            return redirect()->route('bukus.index')
            ->with('success', 'Buku Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_buku)
    {
        Buku::find($id_buku)->delete();
        return redirect()->route('bukus.index')-> with('success', 'Buku Berhasil Dihapus');
    }
}
