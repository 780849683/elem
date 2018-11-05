<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function PHPSTORM_META\elementType;
use Spatie\Permission\Models\Role;

class AdminController extends BaseController
{

    # 注册
    public function reg(Request $request){
        // 判断提交方式
        if ($request -> isMethod("post")){
            // 表单验证
            $data = $this -> validate($request,[
                'name' => "required | unique:admins",
                'password' => "required | regex:[[0-9]+]",
            ]);
            //dd($data);
            //$data=$request->post(); 添加不用这个
            // 加密
            $data["password"]=bcrypt($data["password"]);
            //家保安
            $data['guard_name'] = "admin";
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

    # 改密
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


    # 管理员列表
    public function index(){
        //获取所有
        $admins = Admin::all();
        //dd($roles);
        //跳转视图
        return view("admin.admin.index",compact("admins"));
    }


    # 添加
    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
           $this -> validate($request,[
                'name' => "required | unique:admins",
            ]);
            // dd($request->post('per'));
            //接收参数
            $data = $request->post();
            $data['password'] = bcrypt($data['password']);
            //创建用户
            $admin = Admin::create($data);
            //给用户添加角色 同步角色
            $admin->syncRoles($request->post('role'));
            //通过用户找出所有角色
            // $admin->roles();
            //跳转并提示
            return redirect()->route('admin.admin.index')->with('success', '创建' . $admin->name . "成功");
        }

        //得到所有角色
        $roles=Role::all();
        return view('admin.admin.add',compact("roles"));
    }

   # 编辑
    public function edit2(Request $request,$id){
        // 找到id
        $admins = Admin::find($id);
        //得到所有角色
        $roles=Role::all();
        //dd($roles);
        if ($request->isMethod('post')) {
            // dd($request->post('per'));
            //接收参数
            $data = $request->post();
            $data['password'] = bcrypt($data['password']);
            //创建用户
            $admins ->update($data);
            //给用户添加角色 同步角色
            $admins->syncRoles($request->post('role'));
            //通过用户找出所有角色
            // $admin->roles();
            //跳转并提示
            return redirect()->route('admin.admin.index')->with('success', '修改' . $admins->name . "成功");
        }

        return view('admin.admin.edit2',compact("roles","admins"));

    }

    # 删除
    public function del(Request $request,$id){
        $admin = Admin::find($id);
        $admin->delete();
        return back()->with("success","删除成功");
    }






}
