<?php

namespace App\Models;

use App\Http\Controllers\Shop_cate\ShopcateController;
use App\Http\Controllers\User\UserController;
use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    public function user()
    {
        return $this->belongsTo(user::class, "user_id");
    }

   public function shop_cate(){
        return $this->belongsTo(shop_cate::class,"cate_id");
   }

    public $timestamps = false;
    protected $fillable=["name","remember_token","img","brand","time","fengniao","bao","piao","start_send","send_cost","notice","discount","status","cate_id","rating","user_id"];
}