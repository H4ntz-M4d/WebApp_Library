<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{

    public function index()
    {
        return view('user.index');
    }

    // Cart Shopping

    public function listBook()
    {
        $bukus = Buku::with('kategori')->get();
        $paginate = Buku::orderBy('id_buku', 'desc')->paginate(3);
        return view('user.shop', ['bukus' => $bukus, 'paginate'=>$paginate]);
    }

    public function cart($id_buku){
        $Buku = Buku::with('kategori')->where('id_buku',$id_buku)->first();
    }

    public function storeToCart(Request $request)
    {
        // Cari buku berdasarkan id
        $buku = Buku::find($request->id_buku);

        // Cek jika stok buku cukup
        if ($buku->jumlah < 1) {
            return redirect()->back()->with('error', 'Stok buku habis');
        }

        // Buat pembelian baru
        $peminjaman = new Peminjaman;
        $peminjaman->id_buku = $request->id_buku; // asumsikan Anda mengirimkan id buku dalam request
        $peminjaman->id_user = Auth::id(); // mendapatkan id user yang sedang login
        $peminjaman->jumlah = 1; // asumsikan Anda mengirimkan jumlah dalam request

        // Simpan peminjaman dan kurangi stok buku
        if ($peminjaman->save()) {
            $buku->jumlah -= 1;
            $buku->save();

            return redirect()->back()->with(['success' => 'Buku berhasil ditambahkan ke keranjang']);
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan buku ke keranjang');
        }
    }


    public function show($id_buku)
    {
        //menampilkan detail data dengan menemukan id buku
        $Buku = Buku::with('kategori')->where('id_buku',$id_buku)->first();
        return view('user.show', ['Buku' => $Buku]);
    }

    // Cart Menu

    public function viewCart()
    {
        $pembelian = Peminjaman::with('buku.kategori')->get();
        return view('user.borrow', compact('pembelian'));
    }

    public function viewBorrow()
    {
        $pengembalian = Pengembalian::with('buku.kategori')->get();
        return view('user.return', compact('pengembalian'));
    }

    public function cetak_view(){
        $pembelian = Peminjaman::with('buku.kategori')->get();
        return view('user.payment_pdf', compact('pembelian'));
    }


    public function increaseQuantity($id)
    {
        $pembelian = Peminjaman::find($id);
        $buku = Buku::find($pembelian->id_buku); // Asumsikan Anda memiliki field buku_id di tabel pembelian untuk menghubungkannya dengan buku

        if ($buku->jumlah > 0) { // Periksa apakah stok tersedia
            $pembelian->jumlah++;
            $pembelian->save();

            $buku->jumlah--; // Kurangi stok buku
            $buku->save();
        } else {
            return redirect()->with('barang kosong');
        }

        return redirect()->back();
    }

    public function decreaseQuantity($id)
    {
        $pembelian = Peminjaman::find($id);
        $buku = Buku::find($pembelian->id_buku);

        if ($pembelian->jumlah > 0) {
            $pembelian->jumlah--;
            $pembelian->save();

            $buku->jumlah++; // Kembalikan stok buku
            $buku->save();
        }

        return redirect()->back();
    }

    public function pinjamBuku(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_Telp' => 'required',
            'tanggal_pengembalian' => 'required',
        ]);

        // Dapatkan semua pembelian pengguna
        $peminjaman = Peminjaman::where('id_user', Auth::id())->get();

        foreach ($peminjaman as $beli) {
            if ($beli->jumlah >= 1) {
                $pinjam = Pengembalian::create([
                    'nama' => $request->nama,
                    'no_Telp' => $request->no_Telp,
                    'id_buku' => $beli->id_buku,
                    'id_user' => $beli->id_user = Auth::id(),
                    'jumlah' => $beli->jumlah,
                    'tanggal_pengembalian' => $request->tanggal_pengembalian,
                ]);
                // Update the jumlah of buku in pembelian table after pinjam
                $beli->update(['jumlah' => ($beli->jumlah - 1)]);
                $beli->delete();
            }
        }

        return redirect()->back()->with('success', 'Buku berhasil dipinjam');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $pengembalian = Pengembalian::where('nama', 'like', "%$searchTerm%")->get();

        return view('user.return', compact('pengembalian'));
    }

    public function showPdf($nama){
        $peminjaman = Pengembalian::with('buku.kategori')->where('nama', $nama)->get();
        return view('user.show_pdf', compact('peminjaman'));
    }

    public function cetak_pdf($nama){
        $peminjaman = Pengembalian::where('nama', $nama)->get();

        $pdf = PDF::loadView('user.show_pdf', ['peminjaman' => $peminjaman]);
        return $pdf->download('laporan-peminjaman-'. $nama .'.pdf');
    }

    public function detailPeminjam($nama){
        $peminjaman = Pengembalian::with('buku.kategori')->where('nama', $nama)->get();
    }


    public function destroy($id)
    {
        // Temukan pembelian
        $pembelian = Peminjaman::find($id);

        // Temukan buku yang sesuai
        $buku = Buku::find($pembelian->id_buku);

        // Tambahkan jumlah buku yang dibeli kembali ke stok
        $buku->jumlah += $pembelian->jumlah;

        // Simpan perubahan pada buku
        $buku->save();

        // Hapus pembelian
        $pembelian->delete();

        return redirect()->back()->with('success', 'Buku Berhasil Dihapus');
    }

    public function returnBook($id)
    {
        // Temukan pembelian
        $pengembalian = Pengembalian::find($id);

        // Temukan buku yang sesuai
        $buku = Buku::find($pengembalian->id_buku);

        // Tambahkan jumlah buku yang dibeli kembali ke stok
        $buku->jumlah += $pengembalian->jumlah;

        // Simpan perubahan pada buku
        $buku->save();

        // Hapus pengembalian
        $pengembalian->delete();

        return redirect()->back()->with('success', 'Buku Berhasil Dihapus');
    }

}
