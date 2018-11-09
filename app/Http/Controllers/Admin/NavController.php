<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class NavController extends BaseController
{
    public function index(){
        //所有菜单
        $navs = Nav::paginate(10);
//        $navs = Nav::all();

        return view("admin.nav.index",compact("navs"));
    }

   /* public function add(Request $request){
        $navs = Nav::all();
        if ($request->isMethod("post")){
            // 接收参数 并处理数据
            $data = $this -> validate($request,[
                'name' => "required | unique:navs",
                'url'=>"required | unique:navs",
                'pid'=>"required",
            ]);

        }
        return view("admin.nav.add",compact("navs"));
    }*/


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
        $navs = Nav::pluck("url")->toArray();
        //dd($navs);
        // 去掉已经存在的
        $urls = array_diff($urls,$navs);
        if ($request->isMethod("post")){
            $data = $this -> validate($request,[
                'name' => "required | unique:navs",
                'url'=>"unique:navs",
                'pid'=>"required",
            ]);
            Nav::create($data);
            return redirect()->route('admin.nav.index')->with('success',"添加成功");
        }
        $navs =Nav::all();
        //dd($navs);
        return view("admin.nav.add",compact("navs","urls"));
    }



}
