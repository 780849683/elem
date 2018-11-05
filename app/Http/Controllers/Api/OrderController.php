<?php

namespace App\Http\Controllers\Api;

use App\Models\Addres;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    public function add(Request $request)
    {
        // 查出收货地址
        $address = Addres::find($request->post('address_id'));
        //dd($address->detail_address);
        // 判断地址是否有误
        if ($address === null) {
            return [
                'status' => "false",
                'message' => "地址有误",
            ];
        }
        // 用户id
        $member = Member::find($request->post('user_id'));
        // dd($member->id);
        // 购物车
        $carts = Cart::where("member_id", $member->id)->get();
        //dd($carts);
        // 找出购物车第一条商品的id  通过商品id找shop_id
        $shopId = Menu::find($carts[0]->goodsList)->shop_id;
        $data['member_id'] = $member->id;
        $data['shop_id'] = $shopId;
        //dd($data['shop_id']);

        # 订单号生成
        $data['order_code'] = date("ymdHis", time() + 8 * 60 * 60) . rand(1000, 9999);
        //dd($data['order_code']);
        # 地址
        $data['address_id'] = $address->id;
        $data['provence'] = $address->provence;
        //dd($data['provence']);
        $data['city'] = $address->city;
        $data['county'] = $address->area;
        $data['tel'] = $address->tel;
        $data['name'] = $address->name;
        $data['detail_address'] = $address->detail_address;
        //dd($data['detail_address']);

        # 总价
        $total = 0;
        foreach ($carts as $k => $cart) {
            $good = Menu::where("id", $cart->goodsList)->first();
            //dd($good);
            //算总价
            $total += $cart->goodsCount * $good->goods_price;
        }
        $data['total'] = $total;
        //dd( $data['order_price']);

        # 状态 等待支付
        $data['status'] = 0;

        # 事务
        //启动事务
        DB::beginTransaction();
        try {
            // 订单入库
            $order = Order::create($data);
            //dd($order);
            // 订单商品
            foreach ($carts as $k=>$cart){
                // 得到当前菜品
                $menu = Menu::find($cart->goodsList);
                // 判断库存是否充足
                if ($cart->goodsCount > $menu->stock){
                    // 抛出异常
                    throw new \Exception($menu->goods_name."库存不足");
                }
                // 减去库存
                $menu->stock = $menu->stock - $cart->goodsCount;
                // 保存
                $menu->save();

                OrderDetail::insert([
                    'order_id'=>$order->id,
                    'goods_id'=>$cart->goodsList,
                    'amount'=>$cart->goodsCount,
                    'goods_name'=>$menu->goods_name,
                    'goods_img'=>$menu->goods_img,
                    'goods_price'=>$menu->goods_price,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'shop_id' =>$order->shop_id,
                ]);
            }
            // 清空购物车
            Cart::where("member_id", $member->id)->delete();
            // 提交事务
            DB::commit();
        }catch (\Exception $exception){
            //回滚
            DB::rollBack();
            return [
                "status" => "false",
                "message" => $exception->getMessage(),
            ];
        }
        //dd($order);
        return [
            "status" => "true",
            "message" => "添加成功",
            "order_id" => $order->id
        ];
    }

    # 订单详情
    public function detail(Request $request){
        // 找到订单id
        $order = Order::find($request->get('id'));
//        dd($order);
        $data['id'] = $order->id;
        $data['order_code'] = $order->order_code;
        $data['order_birth_time'] = (string)$order->created_at;
        $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "已完成"];
        $data['order_status'] = $arr[$order->order_status];
        $data['shop_id'] = $order->shop_id;
        //dd($data['shop_id']);
        $data['shop_name'] = $order->shop->name;
          //dd($data['shop_name']);
        $data['shop_img'] = $order->shop->img;
        $data['order_price'] = $order->total;
        $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
        $data['good_list'] = $order->orderDetail;

        return $data;

    }
/*    public function index(Request $request)
    {
        $userId = $request->post('user_id');
        $orders =Order::where("member_id",$userId)->get();
        $datas =[];
        foreach ($orders as $order){
            $data['id'] = $order->id;
            $data['order_code'] = $order->order_code;
            $data['order_birth_time'] = (string)$order->created_at;
            $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "已完成"];
            $data['order_status'] = $arr[$order->order_status];
            $data['shop_id'] = (string)$order->shop_id;
            $data['shop_name'] = $order->shop->name;
            $data['shop_img'] = $order->shop->img;
            $data['order_price'] = $order->total;
            $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
            $data['goods_list'] = $order->orderDetail;
            $datas[] = $data;
        }
        return $datas;
    }*/
    # 订单列表
    public function index(Request $request){
        // 当前用户下的order
        $orders = Order::where("member_id",$request->input("user_id"))->get();
        //dd($orders->toArray());
        $d = [];
        foreach ($orders as $order){
            $data['id'] = $order->id;
            $data['order_code'] = $order->order_code;
            $data['order_birth_time'] = (string)$order->created_at;
            $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "已完成"];
            $data['order_status'] = $arr[$order->order_status];
            $data['shop_id'] = $order->shop_id;
            //dd($data['shop_id']);
            $data['shop_name'] = $order->shop->name;
            //dd($data['shop_name']);
            $data['shop_img'] = env("ALIYUN_OSS_URL") .$order->shop->img;
            //dd($data['shop_img']);
            $data['goods_list'] = $order->orderDetail;
            //dd($data['good_list']->toArray());
            $data['order_price'] = $order->total;
            $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;

            $d[] = $data;
            //dd($d);
        }
        return $d;
    }

    # 订单支付
    public function pay(Request $request){
        // 得到当前订单id
        $order = Order::find($request->get('id'));
        //dd($order->total);
        $member = Member::find($order->member_id);
        //$money = $order->member->money;
//       dd($member->toArray());
        //判断钱够不够
        if ($order->total > $member->money){
            return [
              'status' => 'false',
                'message'=> "余额不足请充值",
            ];
        }
        DB::transaction(function () use ($member,$order){
            // 否则扣钱
            $member->money = $member->money - $order->total;
            //dd($member->money );
            $member->save();
            // 更改订单状态
            $order->order_status = 1;
            $order->save();

        });
        return [
          'status' => 'true',
          'message'=>"支付成功"
        ];


    }

}
