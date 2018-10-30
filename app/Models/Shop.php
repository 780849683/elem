<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticateable;


class Shop extends Authenticateable
{
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }

    public function shopCate(){
        return $this->belongsTo(ShopCate::class,"cate_id");
    }

    public function menu(){
        return $this->hasMany(Menu::class,"shop_id");
    }

    public function menucte(){
        return $this->hasMany(MenuCate::class,"shop_id");
    }
    public function activ(){
        return $this->hasMany(Activ::class,"shop_id");
    }

    public $timestamps = false;
    protected $fillable=["name","remember_token","img","brand","time","fengniao","bao","piao","start_send","send_cost","notice","discount","status","cate_id","rating","user_id"];

}
