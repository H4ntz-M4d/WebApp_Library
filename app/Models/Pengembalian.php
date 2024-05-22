<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalian';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nama',
        'no_Telp',
        'id_buku',
        'id_user',
        'jumlah',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
}
