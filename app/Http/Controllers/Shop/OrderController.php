<?php

namespace App\Http\Controllers\Shop;

use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    // 订单首页
    public function index(){
        //当前登录用户的店铺id
        $user = Auth::user();
        //dd($user->id);
        $shop = Shop::where("user_id",$user->id)->first();
        //dd($shop->id);
        $ord = DB::table('orders')
            ->where("shop_id",$shop->id);
            //->whereIn('order_status', [1, 2, 3]);
           // ->get();
        //dd($ord);
        $orders=$ord->paginate(4);
        return view("shop.order.index",compact("orders"));
    }
    # 查看
    public function look(Request $request,$id){
        // 当前订单id
        $order = Order::find($id);
        //dd($order->id);
        $orderDetails = OrderDetail::where("order_id",$order->id)->get();
       //dd($orderDetail[0]->goods_name);
        return view("shop.order.look",compact("order","orderDetails"));
    }

    #删除
    public function del(Request $request,$id){
        // 当前订单id
        $order = Order::find($id);
        //dd($order->id);
        if (DB::table('order_details')->where('order_id',$order->id)->delete()){
            $order->delete();

        }
        return back()->with("success", "删除成功");

    }

    # 发货
    public function send(Request $request,$id){
           // 当前订单id
        $order = Order::find($id);
        //dd($order);
        $order -> order_status = 2;
        $order -> save();
        return back()->with("success", "成功发货");

    }

    # 取消
    public function no(Request $request,$id){
        // 当前订单id
        $order = Order::find($id);
        //dd($order);
        $order -> order_status = -1;
        $order -> save();
        return back()->with("success", "取消订单");

    }

    # 确认
    public function ok(Request $request,$id){
        // 当前订单id
        $order = Order::find($id);
        //dd($order);
        $order -> order_status = 3;
        $order -> save();
        return back()->with("success", "成功发货");
    }

    # 订单统计  每天 Day
    public function day(){
      // 当前店铺 id
        $shopId = Auth::user()->shop->id;
        //dd($shopId);

        $orders = Order::where("shop_id",$shopId)
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d')as date,COUNT(*) as nums,SUM(total) as money"))
            ->groupBy('date')
            ->get();

        # 总金额
        $mm = DB::table('orders')
            ->select(DB::raw('SUM(total) as m'))
            ->get();
//        dd($mm[0]->m);
        # 总数量
        $cc = DB::table('orders')
            ->select(DB::raw('COUNT(*) as num'))
            ->get();
        //dd($cc);
       return view("shop.order.day",compact("orders","mm","cc"));
    }

    # 月订单量
    public function mouth(){
        // 当前店铺 id
        $shopId = Auth::user()->shop->id;
        //dd($shopId);

        $orders = Order::where("shop_id",$shopId)
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m')as date,COUNT(*) as nums,SUM(total) as money"))
            ->groupBy('date')
            ->get();
        //dd($orders);

        # 总金额
        $mm = DB::table('orders')
            ->select(DB::raw('SUM(total) as m'))
            ->get();
//        dd($mm[0]->m);
        # 总数量
        $cc = DB::table('orders')
            ->select(DB::raw('COUNT(*) as num'))
            ->get();
        //dd($cc);
        return view("shop.order.day",compact("orders","mm","cc"));
    }

    # 菜 日销
    public function mday(){
        //当前登录用户的店铺id
            $shopId = Auth::user()->shop->id;
            //dd($shopId);

        $orderdetails = OrderDetail::where("shop_id",$shopId)
           // ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m')as date,COUNT(*) as nums,SUM(total) as money"))
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m')as date,COUNT(goods_name) as name,SUM(amount) as sl"))
            ->groupBy('name')
            ->get();
        return view("shop.order.mday",compact("orderdetails"));
    }

}
