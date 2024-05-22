@extends('bukus.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="row justify-content-center align-items-center mt-3">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        </div>
        <div class="row justify-content-center align-items-center mt-5">
            <h2>Struk Pembelian</h2>
        </div>
            <p><b>Nama</b>: {{ $mahasiswa->Nama }}</p>
            <p><b>NIM</b>: {{ $mahasiswa->Nim }}</p>
            <p><b>Kelas</b>: {{ $mahasiswa->kelas->nama_kelas }}</p>

            <table class="table table-bordered">
                <tr>
                    <th>Matakuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Nilai</th>
                </tr>
                @if (is_array($mahasiswa->matakuliah) || is_object($mahasiswa->matakuliah))
                    @foreach ($mahasiswa->matakuliah as $matkul)
                        <tr>
                            <td>{{ $matkul->nama_matkul }}</td>
                            <td>{{ $matkul->sks }}</td>
                            <td>{{ $matkul->semester }}</td>
                            <td>{{ $matkul->pivot->nilai }}</td>
                        </tr>
                    @endforeach

                @endif
            </table>
    </div>
</div>

@endsection
