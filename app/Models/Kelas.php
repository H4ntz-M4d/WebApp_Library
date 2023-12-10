<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class Kelas extends Model
{
    use HasFactory;
    protected $table='kelas';

    public function buku(){
        return $this->hasMany(Buku::class);
    }
}
