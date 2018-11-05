<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PerController extends BaseController
{
    # 首页
    public function index(){
        // 找到当前管理员
        $admin = \Auth::guard("admin")->user();
        //dd($admin);
        $pers = Permission::all();
        return view("admin.per.index",compact("pers"));
    }

    # 添加权限
    public function add(Request $request)
    {

        if ($request->isMethod("post")){
            $data=$request->post();
            $data['guard_name']="admin";
            Permission::create($data);
        }
        return view("admin.per.add");
    }

    # 编辑权限
    public function edit(Request $request,$id){
        // 遭到id
        $pers = Permission::find($id);
        //dd($pers);
        if ($request->isMethod("post")){
            $data=$request->post();
            $data['guard_name']="admin";
            $pers->update($data);
        }
        return view("admin.per.edit",compact("pers"));
    }

    # 删除权限
    public function del($id){
        $pers = Permission::find($id);
        $pers->delete();
        return back()->with("success","删除成功");
    }

}
