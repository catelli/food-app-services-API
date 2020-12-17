<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model 
{
   
    protected $table = "addresses";

    protected $fillable = [ 'zip_code' , 'street', 'district', 'number', 'complement', 'state', 'city' ];


    public $timestamps = false;

    protected $hidden = ['id', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
