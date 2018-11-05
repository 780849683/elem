<?php

namespace App\Http\Controllers\Api;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MenuCate;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage;
class ShopController extends BaseController
{
   public function index(Request $request){
       $keyword = \request()->get("keyword");
       //得到所有店铺 设置状态为1
       if ($keyword != null){
            $shops = Shop::where("status", 1)->where("name","like",'%'.$keyword.'%')->get();
       }else{
           $shops = Shop::where("status", 1)->get();
       }
       if ($keyword != null){
           $m = Menu::where("goods_name","like","%{$keyword}%")->get();
       }else{
           $shops = Shop::where("status", 1)->get();
       }
       //  dump($shops->toArray());
       //追加 距离 和时间
       foreach ($shops as $k => $v) {
           //$shops[$k]->shop_img=Storage::url($v->shop_img);
           $shops[$k]->shop_name = $v->name;
           $shops[$k]->shop_img = env("ALIYUN_OSS_URL") . $v->img;
           $shops[$k]->shop_rating = "4.".rand(0,9);
           $shops[$k]->shop_code = "4.".rand(0,9);
           $shops[$k]->foods_code = "4.".rand(0,9);
           $shops[$k]->high_or_low = true;
           $shops[$k]->h_l_percent = 30;
           $shops[$k]->on_time = $v->time;
           $shops[$k]->distance = rand(1000, 5000);
           $shops[$k]->estimate_time = ceil($shops[$k]['distance'] / rand(100, 150));
           $shops[$k]->discount = rand(1000, 5000);
           $m =$v->menu;
           foreach ($m as $k1=>$ms){

           }
       }

//        dd($shops->toArray());
       return $shops;
   }
       //显示指定商家
       public function detail()
       {
           $id = \request()->get('id');
           $shop =Shop::find($id);
//        dd($shop->toArray());
           $shop->shop_name = $shop->name;
           $shop->shop_img = env("ALIYUN_OSS_URL") . $shop->img;
//      评价
           $shop->evaluate = [
               [
                   "user_id" => 9527,
                   "username" => "w******c",
                   "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                   "time" => "2018-8-22",
                   "evaluate_code" => 1,
                   "send_time" => 30,
                   "evaluate_details" => "不怎么好吃"],
               ["user_id" => 9528,
                   "username" => "w******m",
                   "user_img" => "http://www.homework.com/images/slider-pic4.jpeg",
                   "time" => "2018-9-22",
                   "evaluate_code" => 4.5,
                   "send_time" => 30,
                   "evaluate_details" => "很好吃"]
           ];
//        当前的分类
           $cates = MenuCate::where("shop_id",$id)->get();
//           $mm = $cates->toArray();
//        dd($cates);
           foreach ($cates as $k=>$cate){
               $cates[$k]->description=$cate->desc;
               $cates[$k]->is_selected=$cate->is_select;
               $goods=$cate->menu;
               foreach ($goods as $k1=>$good){
                   //$goods[$k1]->goods_img=env("ALIYUN_OSS_URL").$good->goods_img;
               }
               $cates[$k]->goods_list=$goods;

           }
           //dd($cates->toArray());
           //用toArray变为数组
           $shop->commodity=$cates;
//        dd($shop->toArray());
           return $shop;
       }


}
