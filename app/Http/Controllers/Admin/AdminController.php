<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function PHPSTORM_META\elementType;

class AdminController extends BaseController
{

    # 添加管理员
    public function reg(Request $request){
        // 判断提交方式
        if ($request -> isMethod("post")){
            // 表单验证
            $data = $this -> validate($request,[
                'name' => "required | unique:admins",
                'password' => "required",
            ]);
            //dd($data);
            //$data=$request->post(); 添加不用这个
            // 加密
            $data["password"]=bcrypt($data["password"]);
            if(Admin::create($data))
            {
                return redirect("admin/login")->with("success","注册成功请登录");
            }
        }
        return view("admin.admin.reg");
    }


    # 管理员登录：
    public function login(Request $request){
        // 判断是否 post 提交
        if ($request -> isMethod("post")){
            // 验证
            $data = $this -> validate($request,[
                'name' => "required",
                'password' => "required",
            ]);
            // 验证账号密码
            if (Auth::guard("admin") -> attempt($data)){
                return redirect()->route("admin.shop.index")->with("success","登录成功");
            }else{
                return redirect()->back()->withInput()->with("danger","账号或密码错误");
            }
        }
        return view("admin.admin.login");
    }

    # 管理员列表
    public function index(){
        //获取所有
        $admins = Admin::all();
        //跳转视图
        return view("admin.admin.index",compact("admins"));
    }

    # 编辑管理员
    public function edit(Request $request){
        //得到当前用户对象
        $admin = Auth::guard('admin')->user();
       // dd($admin);
        // 判断提交方式
       if ($request ->isMethod("post")){

            // 表单验证
            $this->validate($request,[
                'old_password' => 'required',
                'password' => 'required|confirmed'
            ]);
            $oldPassword = $request ->post('old_password');
            // 判断旧密码是否正确
            if (Hash::check($oldPassword,$admin->password)){
                // 旧密码正确 设置新密码
                $admin->password = Hash::make($request->post("password"));
                // 保存
                $admin ->save();
                //跳转
                return redirect()->route('admin.admin.login')->with("success","修改成功");
            }
            // 旧密码不正确
            return back()->with("danger","旧密码错误");
        }
        return view("admin.admin.edit",compact("admin"));

    }

    # 退出登录
    public function logout()
    {
        //注销
        Auth::guard('admin')->logout();
        //跳转并设置成功提示
        return redirect()->route("admin.admin.login")->with("success", "成功退出");
    }

}
