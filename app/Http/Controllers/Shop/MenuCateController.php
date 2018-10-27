<?php

namespace App\Http\Controllers\Shop;

use App\Models\MenuCate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuCateController extends BaseController{

    # 菜品分类首页
    public function index(){
        // 得到当前登录对象
        $user = Auth::user();
        $shop = $user->shop;
        $sID = $shop[0]->id;
        //dd($sID);
        $cates=DB::table("menu_cates")->where("shop_id",$sID)->get();
            return view("shop.menucate.index",compact("cates"));


    }
}
