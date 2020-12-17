<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'image', 'description', 'stock', 'price', 'active', 'category_id'
    ];

    protected $hidden = [
        "created_at", "updated_at",
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
