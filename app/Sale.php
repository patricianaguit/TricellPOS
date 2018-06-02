<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $primaryKey = 'id';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'customer_id', 'id');
    }

    public function salesdetails()
    {
        return $this->hasOne('App\Sales_details','sales_id', 'id');  
    }

    public function discount()
    {
        return $this->hasOne('App\Discount','id', 'discount_id');  
    }
}
