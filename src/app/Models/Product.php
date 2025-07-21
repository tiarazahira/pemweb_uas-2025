<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
        protected $table = 'products';

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
