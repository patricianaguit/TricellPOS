<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    //
    protected $table = 'balance';
    protected $primaryKey = 'id';

    public function user()
    {
    	return $this->belongsTo('App\User', 'id');	
    }
}
