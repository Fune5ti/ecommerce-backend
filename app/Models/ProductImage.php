<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    // set table name
    protected $table = 'images';
    protected $fillable = [
        'product_id',
        'path'
    ];
    protected $visible = ['path'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
