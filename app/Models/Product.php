<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    const INACTIVE = 0;
    const BLOCK = 2;

    protected $table = 'product';

    protected $fillable = [
        'name',
	    'description',
        'price',
        'quantity',
        'img',
        'category_id',
        'user_id'
    ];

}
