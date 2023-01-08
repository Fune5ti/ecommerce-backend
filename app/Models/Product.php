<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    protected $fillable = [
        'id',
        'name',
        'description',
        'keyword',
        'price',
        'image',
        'material',
        'department',
        'suplier',
        'hasDiscount',
        'suplier_id',
        'discount'
    ];

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class);
    }
}
