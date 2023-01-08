<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchase';

    protected $fillable = [
        'client_name',
        'client_email',
        'client_phone',
        'client_address',
        'client_city',
        'client_zip',
        'client_country',
        'client_cpf',
        'total_price',
        'total_price_wt_discount',
        'total_value_of_discount'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
