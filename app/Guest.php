<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = 'guests';

    public function sale()
    {
        return $this->hasMany('App\Sales','guest_id', 'id');
    }
}
