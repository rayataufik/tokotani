<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterStore extends Model
{
    use HasFactory;

    protected $table = 'stores';

    protected $guarded = ['id'];
}
