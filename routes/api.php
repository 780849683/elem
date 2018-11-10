<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

#---- region 商  家  ----#
# 商家列表
Route::get("shop/index","Api\ShopController@index");
#指定商家
Route::get("shop/detail","Api\ShopController@detail");
#注册
Route::any("member/reg","Api\MemberController@reg");
#验证码
Route::get("member/sms","Api\MemberController@sms");
# 登录
Route::any("member/login","Api\MemberController@login");
# 忘记密码
Route::any("member/forget","Api\MemberController@forget");
#  修改密码
Route::any("member/change","Api\MemberController@change");
#  用户详情
Route::any("member/detail","Api\MemberController@detail");
# endregion

#---- region 地址  ----#
#  添加地址
Route::post("addres/add","Api\AddresController@add");
#  地址列表
Route::any("addres/index","Api\AddresController@index");
#  修改回显
Route::any("addres/look","Api\AddresController@look");
#  修改地址
Route::any("addres/edit","Api\AddresController@edit");
# endregion

#---- region 购物车----#
# 添加购物车
Route::any("cart/add","Api\CartController@add");
# 购物列表
Route::any("cart/index","Api\CartController@index");
#  endregion

#---- region 订单----#
#  生成订单
Route::any("order/add","Api\OrderController@add");
#  订单列表
Route::any("order/index","Api\OrderController@index");
#  订单详情
Route::any("order/detail","Api\OrderController@detail");
#  订单支付
Route::any("order/pay","Api\OrderController@pay");
#  微信支付
Route::any("order/wxPay","Api\OrderController@wxPay");
#  订单状态
Route::any("order/status","Api\OrderController@status");
#  异步通知
Route::post("order/ok","Api\OrderController@ok");

#  endregion