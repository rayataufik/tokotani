<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $guarded = ['id'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function transaction()
    {
        return $this->belongsToMany(Transaction::class, 'orders', 'transaction_id', 'product_id')->withTimestamps();
    }
}
