<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable= ['order_id','total','status','user_id'];


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
