<?php

namespace App\Http\Controllers\Admin;
use App\Models\Shop;
use App\Models\ShopCate;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends BaseController
{
  # 商铺管理首页
    public function index(){
        // 获取所有商铺
        $shops = Shop::all();
        $cates = ShopCate::all();
        $users = User::all();
//        dd($shops,$cates,$users);
        //  跳转视图
        return view("admin/shop/index",compact("shops","cates","users"));
    }
}
