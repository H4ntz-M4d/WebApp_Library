@extends('layout.stage')

<div class="sidebar">
    <div class="navbar-icon-shop">
        <img src="{{ asset('images/Logo-Polinema.png') }}" alt="logo" class="logo">
    </div>
    <div class="navbar-btn-shop">
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
    <div class="container-dashboard-shop content">
        <div class="list-barang-shop">
            <div class="label-shop-cart">
                List Cart
            </div>
            <div class="product">

                <style>
                    table .table-custom {
                        font-size: 12px;
                    }
                </style>

                <table class="table table-bordered table-custom">
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penerbit</th>
                        <th>Pengarang</th>
                        <th>Jumlah</th>
                        <th width="200px">Action</th>
                    </tr>
                    @foreach ($pembelian as $beli)
                        <tr>
                            <td>{{ $beli->buku->judul }}</td>
                            <td>{{ $beli->buku->kategori->nama_kategori }}</td>
                            <td>{{ $beli->buku->penerbit }}</td>
                            <td>{{ $beli->buku->pengarang }}</td>
                            <td>{{ $beli->jumlah }}</td>
                            <td>
                                <div class="btn-action">

                                    <form action="{{ route('increaseQuantity', $beli->id) }}" method="POST">
                                        @csrf
                                        <button class="btn-form btn btn-danger" type="submit">+</button>
                                    </form>
                                    <form action="{{ route('decreaseQuantity', $beli->id) }}" method="POST">
                                        @csrf
                                        <button class="btn-form btn btn-danger" type="submit">-</button>
                                    </form>
                                    <form action="{{ route('delete', $beli->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-form btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <form class="formCart" action="{{ route('pinjam-buku') }}" method="POST">
                @csrf
                <div class="form-group mt-3">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" aria-describedby="nama">
                </div>
                <div class="form-group">
                    <label for="no_Telp">No. Telp</label>
                    <input type="text" name="no_Telp" class="form-control" id="no_Telp" aria-describedby="no_Telp">
                </div>
                <div class="form-group">
                    <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                    <input type="datetime-local" name="tanggal_pengembalian" class="form-control" id="tanggal_pengembalian" aria-describedby="tanggal-pengembalian">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Pinjam</button>
            </form>

        </div>
    </div>
</div>

