@extends('bukus.layout')

@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center align-items-center" >
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Edit Buku
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
                    <form method="post" action="{{ route('bukus.update', $Buku->id_buku) }}" id="myForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="id_buku">ID Buku</label>
                            <input type="text" name="id_buku" class="form-control" id="id_buku"
                                value="{{ $Buku->id_buku }}" aria-describedby="id_buku">
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" class="form-control" id="judul"
                                value="{{ $Buku->judul }}" aria-describedby="judul">
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" name="kategori">
                                @foreach ($kategori as $ktg)
                                    <option value="{{ $ktg->id }}"
                                        {{ $Buku->kategori_id == $ktg->id ? 'selected' : '' }}>{{ $ktg->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="penerbit">Penerbit</label>
                            <input type="penerbit" name="penerbit" class="form-control" id="penerbit"
                                value="{{ $Buku->penerbit }}" aria-describedby="penerbit">
                        </div>
                        <div class="form-group">
                            <label for="pengarang">Pengarang</label>
                            <input type="pengarang" name="pengarang" class="form-control" id="pengarang"
                                value="{{ $Buku->pengarang }}" aria-describedby="pengarang">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">jumlah</label>
                            <input type="jumlah" name="jumlah" class="form-control" id="jumlah"
                                value="{{ $Buku->jumlah }}" aria-describedby="jumlah">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="status" name="status" class="form-control" id="status"
                                value="{{ $Buku->status }}" aria-describedby="status">
                        </div>
                        <div class="form-group">
                            <label for="featured_image">Feature Image</label>
                            <input type="file" class="form-control" required="required" name="featured_image"
                                value="{{ $Buku->featured_image }}">
                            <img width="150px" src="{{ asset('storage/' . $Buku->featured_image) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
