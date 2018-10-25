<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    //商户注册
    public function add(Request $request){
        // 判断post
        if ($request -> isMethod("POST")){
            // 验证 如果没有通过 自动回到上一页
            $this -> validate($request,[
                "name" => "required | max:6 | min:3 | unique:users",
                "password" => "required | confirmed",
                "email" => "required | unique:users"
            ]);
            // 接收数据
            $data = $request ->post();
            //密码加密
            $data['password'] = bcrypt($data['password']);// 第一种
//             $data=Hash::make($data['password']);  第二种
            //上传图片
//            $data['logo'] = $request->file("logo")->store("admin","image");
            //添加
            user::create($data);
            //跳转
//               session()->flash("success","添加成功");
            return redirect()-> route("user.login")-> with("success","注册成功");

        }
                //显示视图
                return view("user.add");
            }

               //商户登录
            public function login( Request $request){
                //判断是否POST提交
                if ($request->isMethod("post")) {
                    //验证
                    $data= $this->validate($request, [
                        'name' => "required",
                        'password' => "required"
                    ]);
                    //验证账号密码
                    if (Auth::attempt($data)) {
                        // session()->flash("success","登录成功");
                        //登录成功
                        return redirect()->intended(route("shop.add"))->with("success", "登录成功");
                    }else{
                        return back()->with("danger", "密码或用户名错误");
                    }
                }

                return view("user.login");

            }


}
