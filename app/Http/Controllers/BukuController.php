<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        $bukus = Buku::with('kategori')->get();
        $paginate = Buku::orderBy('id_buku', 'desc')->paginate(3);
        return view('index', ['bukus' => $bukus, 'paginate'=>$paginate]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('create',['kategori' => $kategori]);
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
            ]);

            $buku = new Buku;
            $buku->id_buku = $request->get('id_buku');
            $buku->judul = $request->get('judul');
            $buku->penerbit = $request->get('penerbit');
            $buku->pengarang = $request->get('pengarang');
            $buku->jumlah = $request->get('jumlah');
            $buku->status = $request->get('status');
            $buku->featured_image = $request->file('featured_image')->store('images','public');


            $kategori = new Kategori;
            $kategori->id = $request->get('kategori');

            //fungsi eloquent untuk menambah data dengan relasi belongTo
            $buku->kategori()->associate($kategori);
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
        $Buku = Buku::with('kategori')->where('id_buku',$id_buku)->first();
        return view('detail', ['Buku' => $Buku]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_buku)
    {
        $Buku = Buku::with('kategori')->where('id_buku',$id_buku)->first();
        $kategori = Kategori::all();
        return view('edit', compact('Buku', 'kategori'));
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
            ]);

            $buku = Buku::with('kategori')->where('id_buku',$id_buku)->first();
            $buku->id_buku = $request->get('id_buku');
            $buku->judul = $request->get('judul');
            $buku->penerbit = $request->get('penerbit');
            $buku->pengarang = $request->get('pengarang');
            $buku->jumlah = $request->get('jumlah');
            $buku->status = $request->get('status');


            // Menghapus gambar lama jika ada
            if ($buku->featured_image && Storage::exists('public/' . $buku->featured_image)) {
                Storage::delete('public/' . $buku->featured_image);
            }
            // Menyimpan gambar yang baru diunggah
            $buku->featured_image = $request->file('featured_image')->store('images', 'public');



            $kategori = new Kategori;
            $kategori->id = $request->get('kategori');

            //fungsi eloquent untuk menambah data
            $buku->kategori()->associate($kategori);
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
