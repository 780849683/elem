<?php

namespace App\Http\Controllers\Shop;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderDetailController extends BaseController
{
    public function day(){
        $user = Auth::user();
        //dd($user->id);
        $shop = Shop::where("user_id",$user->id)->first();
        //dd($shop->id);
        $orders = DB::table('orders')
            ->where("shop_id",$shop->id)
        //->whereIn('order_status', [1, 2, 3]);
             ->get();
        $ods = OrderDetail::where("order_id",$orders->id)->get();

    }
}
