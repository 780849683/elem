<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Member;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends BaseController
{
    public function add(Request $request)
    {
        $member = Member::find($request->get('user_id'));
        //清空当前用户购物车
        Cart::where("member_id", $member->id)->delete();
        //dd($member);
        //接收参数
        //$data = $request->post();
        $goods = $request->post('goodsList');
        $counts = $request->post('goodsCount');

        foreach ($goods as $k => $v) {
            $data = [
                'member_id' => $member->id,
                'goodsList' => $v,//商品id
                'goodsCount' => $counts[$k],
            ];
            Cart::create($data);
        }
        $d = [
            'status' => "true",
            'message' => "添加成功"
        ];
        return $d;
    }

    # 购物列表
    public function index(Request $request){
        // 得到当前用户
        $userId = $request ->get('user_id');
        //dd($userId);
        //声明一个数组
        $goodsList = [];
        //声明总价
        $totalCost = 0;
        // 当前用户的购物车
         $carts = Cart::where("member_id",$userId)->get();
         foreach ($carts as $k=>$cart){
            $good = Menu::where("id", $cart->goodsList)->first(['id as goods_id','goods_name','goods_img','goods_price']);
           // dd($good);
             $good->amount = $cart->goodsCount;
             //算总价
             $totalCost += $good->amount * $good->goods_price;
             //dd($totalCost);
             $goodsList[] = $good;
         }
        return [
            'goods_list' => $goodsList,
           'totalCost' => $totalCost
        ];
    }
}
