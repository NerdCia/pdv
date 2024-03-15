<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;

    public function products() {
        return $this->belongsTo(Product::class, 'id_product');
    }

    protected $fillable = [
        'quantity',
        'amount',
        'name_product',
        'expense_product',
        'price_product',
        'id_sale',
        'id_product',
    ];
}
