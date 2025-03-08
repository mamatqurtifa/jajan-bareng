<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'total_price',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class); // Pesanan ini milik satu pelanggan
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity'); // Pesanan bisa memiliki banyak produk
    }
}
