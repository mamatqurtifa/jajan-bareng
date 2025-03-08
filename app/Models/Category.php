<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // Atribut yang bisa diisi secara massal
        
    ];

    public function products()
    {
        return $this->hasMany(Product::class); // Satu kategori memiliki banyak produk
    }
}