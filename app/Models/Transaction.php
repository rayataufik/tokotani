<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'orders', 'transaction_id', 'product_id')->withTimestamps();
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'transaction_id')->with('product.store');
    }
}
