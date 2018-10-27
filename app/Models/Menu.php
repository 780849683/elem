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
    protected $fillable=["name","rating","cate_id","price","deser","month_sale","ranting_count","tips","staisfy_count","staisfy_rate","status"];
}
