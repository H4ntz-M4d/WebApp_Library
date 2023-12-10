@extends('bukus.layout')

@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Tambah Buku
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('bukus.store') }}" id="myForm">
                        @csrf
                        <div class="form-group">
                            <label for="id_buku">ID Buku</label>
                            <input type="text" name="id_buku" class="form-control" id="id_buku" aria-describedby="id_buku">
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="judul" name="judul" class="form-control" id="judul"
                                aria-describedby="judul">
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="kategori" name="kategori" class="form-control" id="kategori"
                                aria-describedby="password">
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="penerbit" name="penerbit" class="form-control" id="penerbit"
                                aria-describedby="penerbit">
                        </div>
                        <div class="form-group">
                            <label for="pengarang">Pengarang</label>
                            <input type="pengarang" name="pengarang" class="form-control" id="pengarang"
                                aria-describedby="pengarang">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="jumlah" name="jumlah" class="form-control" id="jumlah"
                                aria-describedby="jumlah">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="status" name="status" class="form-control" id="status"
                                aria-describedby="status">
                        </div>
                        <div class="form-group">
                            <label for="kelas">Tahun Terbit</label>
                            <select class="form-control" name="kelas">
                                @foreach($kelas as $kls)
                                    <option value="{{ $kls->id }}">{{ $kls->nama_kelas}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
