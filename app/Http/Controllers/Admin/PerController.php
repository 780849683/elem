<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
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
        //声明一个数组来装路由名字
        $urls = [];
        // 得到所有路由
        $routes = Route::getRoutes();
        //循环得到单个路由
        foreach ($routes as $route){
            // 命名空间要是后台的
            if (isset($route->action["namespace"]) && $route->action["namespace"]=="App\Http\Controllers\Admin"){
                //取别名存到$urls
                $urls[] =$route->action['as'];
            }
        }
        // 取出数据库中已经存在的
        $pers = Permission::pluck("name")->toArray();
        //dd($pers);
        // 去掉已经存在的
        $urls = array_diff($urls,$pers);
        if ($request->isMethod("post")){
            $data=$request->post();
            $data['guard_name']="admin";
            Permission::create($data);
        }
        return view("admin.per.add",compact("urls"));
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
            //跳转并提示
            return redirect()->route('admin.per.index')->with('success', '编辑' . $pers->intro . "成功");
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
