<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'name',
        'description',
        'image',
        'price',
        'available_date',
        'stock'
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
