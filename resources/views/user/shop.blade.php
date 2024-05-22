@extends('layout.stage')

<div>
    <div class="navbar-icon">
        <img src="{{ asset('images/Logo-Polinema.png') }}" alt="logo" class="logo">
    </div>
    <div class="navbar-btn">
        <a href="/home" class="btn-nav">Dashboard</a>
        <a href="/list-book" class="btn-nav">Book List</a>
        <a href="/viewCart" class="btn-nav">Cart</a>
        <a href="/viewBorrow" class="btn-nav">Return Book</a>
        <a href="/bukus" class="btn-nav">Add Book</a>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn-out">Logout</button>
        </form>
    </div>
</div>

<div class="dashboard">
    <div class="container-dashboard">
        <div class="list-barang">
            <div class="label-shop">
                List Buku
            </div>
            <div class="product">
                <table class="table table-bordered">
                    <tr>
                        <th>ID Buku</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penerbit</th>
                        <th>Pengarang</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th width="170px">Action</th>
                    </tr>
                    @foreach ($bukus as $Buku)
                        <tr>

                            <td>{{ $Buku->id_buku }}</td>
                            <td>{{ $Buku->judul }}</td>
                            <td>{{ $Buku->kategori->nama_kategori }}</td>
                            <td>{{ $Buku->penerbit }}</td>
                            <td>{{ $Buku->pengarang }}</td>
                            <td>{{ $Buku->jumlah }}</td>
                            <td>{{ $Buku->status }}</td>
                            <td>
                                <form action="{{ route('bukus.destroy', $Buku->id_buku) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('showData', $Buku->id_buku) }}">Show</a>
                                    <a class="btn btn-warning" href="{{ route('storeToCart', $Buku->id_buku) }}">Pilih</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
