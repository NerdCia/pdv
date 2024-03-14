<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['payment_method', 'id_user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function sale_products() {
        return $this->hasMany(SaleProduct::class, 'id_sale', 'id');
    }
}
