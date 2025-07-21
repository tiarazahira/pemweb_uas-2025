<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bunga extends Model
{
        protected $table = 'Bungas';

        protected $fillable = [
            'nama_bunga',
            'jenis_bunga',
            'stok',
            'harga_satuan',
            'deskripsi',
            'image',
        ];
    
        protected $casts = [
            'stok' => 'integer',
            'harga_satuan' => 'float',
        ];
}
