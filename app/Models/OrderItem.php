<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'product_id', 'order_id', 'quantity', 'partial_value', 'unitary_value'
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\OrderItem');
    }

}