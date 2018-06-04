<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reload_sale extends Model
{
    protected $table = 'reload_sales';

    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'member_id', 'amount_due', 'amount_paid', 'change_amount'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'member_id', 'id');
    }
}
