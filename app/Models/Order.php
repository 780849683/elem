<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
//    public $timestamps = false;
    protected $fillable=["detail_address","shop_id","member_id","order_code","order_status","address_id","name","tel","provence","city","county","total","address","created_at","updated_at"];

    public function member(){
        return $this->belongsTo(Member::class,"member_id");
    }
    public function shop(){
        return $this->belongsTo(Shop::class,"shop_id");
    }

    public function orderDetail(){
        return $this->hasMany(OrderDetail::class,"order_id");
    }

//   static public $statusText = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "已完成"];
    /**
     * 读取器
     * @return mixed
     * order_status
     */
// public function getOrderStatusAttribute()
//    {
//        $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "完成"];
//        return $arr[$this->status];
//    }
//    public function getOrderStatusAttribute()
//    {
//        // $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "完成"];
//        return self::$statusText[$this->status];//-1 0 1 2 3
//    }


}
