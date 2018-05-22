<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    //

    protected $table = 'balance';

    protected $fillable = [
        'load_balance',
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

    public function user()
    {
    	return $this->belongsTo('App\User', 'id');	
    }
}
