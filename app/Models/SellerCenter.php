<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerCenter extends Model
{
    use HasFactory;
    protected $table = 'stores';

    protected $guarded = ['id'];
}
