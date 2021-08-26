<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    const UNPAID = 0;
    const PAID = 1;

    protected $table = 'shop';

    protected $fillable = [
        'user_id',
	    'product_id',
       	'status',
    ];
}
