<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends BaseController
{

    # 首页
    public function index(){
        // 找到当前管理员
        //$admin = \Auth::guard("admin")->user();
        //dd($admin);
         $roles = Role::all();
        return view("admin.role.index",compact("roles"));

    }

    # 添加角色
    public function add(Request $request){
        //判定提交方式
        if ($request->isMethod("post")){
            // 接收参数 并处理数据
            $data = $this -> validate($request,[
                'name' => "required | unique:roles",
            ]);
            $pers=$request->post('pers');
            // 添加角色
            $role = Role::create([
                "name" => $request->post("name"),
                "guard_name" => "admin",
            ]);
            // 给角色同步权限
            if ($pers){
                $role->syncPermissions($pers);
            }
        }
        // 找到所有权限
        $pers = Permission::all();
        //dd($pers);
        return view("admin.role.add",compact("pers"));
    }

    # 编辑角色
    public function edit(Request $request,$id){
      //找到当前id
        $roles =Role::find($id);
        //dd($roles);
        //判定提交方式
        if ($request->isMethod("post")){
            // 接收参数 并处理数据
            /* $this -> validate($request,[
                'name' => "required | unique:roles",
            ]);*/
            $pers=$request->post('pers');
            // 添加角色
           $roles->update([
                "name" => $request->post("name"),
                "guard_name" => "admin",
            ]);
            // 给角色同步权限
            if ($pers){
                $roles->syncPermissions($pers);
            }
           /* //还给给角色添加权限 $role->syncPermissions(['权限名1','权限名2']);
            $role->syncPermissions($request->post('per'));*/

            //跳转并提示
            return redirect()->route('admin.role.index')->with('success', '编辑' . $roles->name . "成功");
        }
        // 找到所有权限
        $pers = Permission::all();
        //dd($pers);
        return view("admin.role.edit",compact("pers","roles"));
    }

    # 删除角色
    public function del($id){
        $roles = Role::find($id);
        $roles->delete();
        return back()->with("success","删除成功");
    }



}
