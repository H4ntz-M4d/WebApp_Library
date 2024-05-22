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
            <div class="label-shop-cart">
                List Sedang Dipinjam
            </div>
            <form class="search" action="{{ route('search') }}" method="GET">
                <input class="form-control" type="text" name="search" placeholder="Cari Peminjam...">
                <button class="btn btn-info" type="submit">Cari</button>
            </form>
            <div class="product">
                <table class="table table-bordered">
                    <tr>
                        <th>Peminjam</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Pengarang</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pengembalian</th>
                        <th width="200px">Action</th>
                    </tr>
                    @foreach ($pengembalian as $diPinjam)
                        <tr>
                            <td>{{ $diPinjam->nama }}</td>
                            <td>{{ $diPinjam->buku->judul }}</td>
                            <td>{{ $diPinjam->buku->kategori->nama_kategori }}</td>
                            <td>{{ $diPinjam->buku->pengarang }}</td>
                            <td>{{ $diPinjam->jumlah }}</td>
                            <td>{{ $diPinjam->tanggal_pengembalian }}</td>
                            <td>
                                <form action="{{ route('return', $diPinjam->id) }}" method="POST">
                                    <a class="btn btn-danger" href="{{ route('cetak_pdf', $diPinjam->nama) }}">Cetak</a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-info" type="submit">Return</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
