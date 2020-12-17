<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'date', 'code', 'total_value'
    ];


    public function orderItem()
    {
        return $this->hasMany('App\Models\OrderItem');
    }

}