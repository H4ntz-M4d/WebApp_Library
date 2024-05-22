@extends('layout.stage')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Detail Buku
                </div>
                <form action="/articles" method="post">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li>
                            <img width="150px" src="{{ asset('storage/' . $Buku->featured_image) }}" alt="Image" class="img-thumbnail">
                        </li>
                        <li class="list-group-item"><b>ID Buku: </b>{{ $Buku->id_buku }}</li>
                        <li class="list-group-item"><b>Judul: </b>{{ $Buku->judul }}</li>
                        <li class="list-group-item"><b>Kategori: </b>{{ $Buku->kategori->nama_kategori }}</li>
                        <li class="list-group-item"><b>Penerbit: </b>{{ $Buku->penerbit }}</li>
                        <li class="list-group-item"><b>Pengarang: </b>{{ $Buku->pengarang }}</li>
                        <li class="list-group-item"><b>Stok: </b>{{ $Buku->jumlah }}</li>
                        <li class="list-group-item"><b>Status: </b>{{ $Buku->status }}</li>
                    </ul>
                </div>
                </form>
                <a class="btn btn-success mt-3" href="/list-book">Kembali</a>
            </div>
        </div>
    </div>
@endsection
