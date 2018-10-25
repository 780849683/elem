<?php

namespace App\Http\Controllers\Shop;

use App\Models\shop;
use App\Models\shop_cate;
use App\Models\user;
use App\Http\Controllers\Shop_cate\ShopcateController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function Sodium\compare;

class ShopController extends Controller
{
    public function index(){
              $shops = shop::all();
             $shop_cates = shop_cate::all();
              $users  = user::all();
            return view("shop.index",compact("shops","shop_cates","users"));
    }
}
