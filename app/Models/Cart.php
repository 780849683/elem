<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = false;
    protected $fillable=["goodsList","goodsCount","member_id"];

    public function shop(){
        return $this->belongsTo(Shop::class,"shop_id");
    }


}
