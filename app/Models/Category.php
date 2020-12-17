<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'image', 'seller_id'
    ];

    protected $hidden = [
        "email_verified_at", "remember_token", "created_at", "updated_at",
    ];

    public function seller()
    {
        return $this->belongsTo('App\Models\Seller');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function subCategory()
    {
        return $this->hasMany('App\Models\SubCategory');
    }

}
