@extends('bukus.layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Detail Buku
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>ID Buku: </b>{{ $Buku->id_buku }}</li>
                        <li class="list-group-item"><b>Judul: </b>{{ $Buku->judul }}</li>
                        <li class="list-group-item"><b>Kategori: </b>{{ $Buku->kategori }}</li>
                        <li class="list-group-item"><b>Penerbit: </b>{{ $Buku->penerbit }}</li>
                        <li class="list-group-item"><b>Pengarang: </b>{{ $Buku->pengarang }}</li>
                        <li class="list-group-item"><b>Jumlah: </b>{{ $Buku->jumlah }}</li>
                        <li class="list-group-item"><b>Status: </b>{{ $Buku->status }}</li>
                        <li class="list-group-item"><b>Tahun Terbit: </b>{{ $Buku->kelas->nama_kelas }}</li>
                    </ul>
                </div>
                <a class="btn btn-success mt-3" href="{{ route('bukus.index') }}">Kembali</a>
            </div>
        </div>
    </div>
@endsection
