<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;

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
