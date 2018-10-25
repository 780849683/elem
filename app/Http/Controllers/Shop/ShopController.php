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
use Illuminate\Support\Facades\Auth;

class ShopController extends BaseController
{
    public function index(){
              $shops = shop::all();
             $shop_cates = shop_cate::all();
              $users  = user::all();
            return view("shop.index",compact("shops","shop_cates","users"));
    }

    public function add(Request $request){
            //判断当前用户是否已有店铺
            if (Auth::user()->shop){
                return back()->with("danger","已有店铺不能再创建");
            }
            //判断是不是POST提交
            if ($request->isMethod("post")) {
                //1. 验证
                $this->validate($request, [
                    'cate_id' => 'required|integer',
                    'name' => 'required|max:100|unique:shops',
                    'img' => 'required|image',
                    'start_send' => 'required|numeric',
                    'send_cost' => 'required|numeric',
                    'notice' => 'string',
                    'discount' => 'string',
                ]);
                //2. 接收数据
                $data=$request->post();
                //2.1 设置店铺的状态为0 未审核
                $data['status'] = 0;
                //2.2 设置用户ID
                $data['user_id'] = Auth::user()->id;

                //2.3 处理图片
                $data['img']=$request->file("img")->store("shop_cate","image");
//                var_dump($data);
////                exit;
//                  dd($data);
                //3. 添加数据
                Shop::create($data);

                //添加成功
                session()->flash('success', '添加成功等待平台审核');
                //跳转至添加页面
                return redirect()->route("shop.index");
            }
            //得到所有商家分类w
         $cates = Shop_cate::all();
//            $cates = Shop_cate::where("status", 1)->get();
            //显示视图并赋值
            return view("shop.add", compact('cates'));

        }

}
