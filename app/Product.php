<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    // protected $fillable = [
    //     'load_balance',
    // ];

    protected $primaryKey = 'product_id';
}
