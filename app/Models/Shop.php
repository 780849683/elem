<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function user(){
        return $this->belongsTo(User::class,"user_id");
    }

    public function shopCate(){
        return $this->belongsTo(ShopCate::class,"cate_id");
    }

    public $timestamps = false;
    protected $fillable=["name","remember_token","img","brand","time","fengniao","bao","piao","start_send","send_cost","notice","discount","status","cate_id","rating","user_id"];

}
