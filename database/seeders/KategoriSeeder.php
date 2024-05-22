<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table=[
            ['nama_kategori'=>'Komik'],
            ['nama_kategori'=>'Novel'],
            ['nama_kategori'=>'History'],
            ['nama_kategori'=>'Biografi'],
            ['nama_kategori'=>'Kamus'],
            ['nama_kategori'=>'Ensiklopedia'],
            ['nama_kategori'=>'Majalah'],
        ];

        DB::table('kategori')->insert($table);
    }
}
