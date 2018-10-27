<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends BaseController
{
    # 菜品首页
    public function index(){
       // 得到当前登录对象
        $user = Auth::user();
//        $uid = Auth::user()->;

        $shop = $user->shop;
        $sID = $shop[0]->id;
//        dd($sID);
//        $cates = DB::select("select * from menu_cates");
//        dd($cates[0]->id);
//        $cates = MenuCate::all();
//        dd($cates);
        //dd(DB::table("menus")->where("shop_id",$sID)->get());
//        \$menus  = Menu::all();
         $menus=Menu::where("shop_id",$sID)->get();
//        $cates=DB::table("menu_cates")->where("shop_id",$sID)->get();
      //dd($menus);
        //dd($menus->menucate);

        return view("shop.menu.index",compact("menus"));
    }
}
