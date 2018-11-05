<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
//    public $timestamps = false;
    protected $fillable=["shop_id","order_id","goods_id","amount","goods_name","goods_img","goods_price","created_at","updated_at"];

    public function order(){
        return $this->belongsTo(Order::class,"order_id");
    }


}
