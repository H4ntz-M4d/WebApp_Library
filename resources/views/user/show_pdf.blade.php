<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body{
            margin: 0%;
            justify-content: center;
            align-items: center;
            font-family: Arial, Helvetica, sans-serif;
            background-color: white;
            display: flex;
            flex-direction: column;
            height: 100vh;
            width: 50rem;
        }

        .label-struk{
            font-weight: bold;
            font-size: 20px;
            margin-bottom: 10px;
        }
        .form-user{
            margin-right: 2rem;
        }

        .form-user ul{
            list-style-type: none;
        }

        .form-user ul li{
            margin: 15px 0px 15px 0px;
        }

        .table-buku {
            border-collapse: collapse;
            border: 1px solid black;
            width: 38rem;
        }

        th, td{
            border: 1px solid black;
            padding: 5px;
        }

        .cap{
            margin-top: 20rem;
            display: flex;
            justify-content: space-between;
        }
        .table-stempel{
            width: 38rem;
        }
        .stempel{
            border: none;
        }
    </style>

    <title>Document PDF</title>
</head>
<body>
    <div class="frame">
        <div class="label-struk">
            <Label>Struk Peminjaman</Label>
        </div>
        <div class="form-user">
            <ul>
                @if ($peminjaman->first())
                    <li><b>Nama : </b>{{ $peminjaman->first()->nama }}</li>
                    <li><b>No. Telp : </b>{{ $peminjaman->first()->no_Telp }}</li>
                    <li><b>Tanggal peminjaman : </b>{{ $peminjaman->first()->tanggal_peminjaman }}</li>
                    <li><b>Tanggal Pengembalian : </b>{{ $peminjaman->first()->tanggal_pengembalian }}</li>
                @endif
            </ul>
        </div>
        <div class="list-buku">
            <table class="table-buku">
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Penerbit</th>
                    <th>Pengarang</th>
                    <th>Jumlah</th>
                </tr>
                @foreach ($peminjaman as $pinjam)
                    <tr>
                        <td>{{ $pinjam->buku->judul }}</td>
                        <td>{{ $pinjam->buku->kategori->nama_kategori }}</td>
                        <td>{{ $pinjam->buku->penerbit }}</td>
                        <td>{{ $pinjam->buku->pengarang }}</td>
                        <td>{{ $pinjam->jumlah }}</td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="cap">
            <table class="table-stempel">
                <tr>
                    <th class="stempel">Cap Peminjaman</th>
                    <th class="stempel">Cap Pengembalian</th>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
