<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Buku as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

    class Buku extends Model //Definisi Model
{
    protected $table="buku"; // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswas
    public $timestamps= false;
    protected $primaryKey = 'id_buku'; // Memanggil isi DB Dengan primarykey
    /**
     * The attributes that are mass assignable.
     *
     *
     */
    protected $fillable = [
    'id_buku',
    'judul',
    'kategori',
    'penerbit',
    'pengarang',
    'jumlah',
    'status',
    'kelas_id',
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
};
