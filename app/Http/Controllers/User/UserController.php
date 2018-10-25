<?php

namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Models\user;
class UserController extends BaseController
{
    //商户注册
    public function add(Request $request){
        // 判断post
        if ($request -> isMethod("POST")){
            // 验证 如果没有通过 自动回到上一页
            $this -> validate($request,[
                "name" => "required | max:6 | min:3 | unique",
                "password" => "required",

                "email" => "required"
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
            return redirect()-> route("shop.index")-> with("success","成功添加ojbk");

        }
        //显示视图
        return view("user.add");
    }

       //商户登录
    public function login(){

    }


}
