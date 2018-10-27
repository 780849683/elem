<?php

namespace App\Http\Controllers\Shop;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    # 商户注册
    public function reg(Request $request){
        // 判断提交方式
        if ($request->isMethod("post")){
            //验证
            $data = $this->validate($request,[
                "name" => "required | unique:users",
                "password" => "required | confirmed",
                "email" => "required | unique:users"
            ]);
            //加密
            $data["password"] = bcrypt($data["password"]);
            // 提交
            if (User::create($data)){
                return redirect("user/login")->with("success","注册成功请登录");
            }
        }
        //显示页面
        return view("shop.user.reg");
    }

    #  商户登录
    public function login(Request $request)
    {
        // 判断提交方式
        if ($request->isMethod("post")) {
            // 表单验证
            $data = $this->validate($request, [
                'name' => "required",
                'password' => "required",
            ]);
            // dd($data);
            //验证账号密码
            if (Auth::attempt($data)) {
                if (DB::table("shops")->where('user_id',Auth::user()->id)->get()->isEmpty()){
                      //dd(Auth::user()->name);
                      return redirect()->intended(route("shop.shop.add"))->with("success", "您还没有店铺，请申请店铺");
                  }else{
                    $user = Auth::user();
                    $shop = $user->shop;
                        if ($shop){
                            // -1 禁用  0 审核  1 有
                            switch ($shop[0]['status']){
                                case -1:// 禁用
                                    Auth::logout();
                                    return back()->withInput()->with("danger","店铺已禁用");
                                    break;
                                case 0://未审核
                                    Auth::logout();
                                    return back()->withInput()->with("danger","店铺还在审核中");
                                    break;
                                case  1:
                                    return redirect()->route("shop.shop.index")->with("success","登录成功");
                            }
                        }
                  }
            }else{
                return back()->withInput()->with("danger","用户名或密码错误");
            }
        }

        return view("shop.user.login");
    }


}
