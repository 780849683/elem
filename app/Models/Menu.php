<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticateable;

class Menu extends Authenticateable
{


    public function shop(){
        return $this->belongsTo(Shop::class,"shop_id");
    }
    public function menu_cate()
    {
        return $this->belongsTo(MenuCate::class,"cate_id");
        //return $this->belongsTo(MenuCate::class,"cate_id");

    }

    public $timestamps = false;
    protected $fillable=["cate_id","goods_name","rating","goods_price","shop_id","description","month_sales","rating_count","month_sale","ranting_count","tips","satisfy_count","satisfy_rate","status"];
}
