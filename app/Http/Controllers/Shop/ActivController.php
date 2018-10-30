<?php

namespace App\Http\Controllers\Shop;

use App\Models\Activ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MenuCate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ActivController extends BaseController
{
    #  活动首页
    public function index(){
        $acts =Activ::where("shop_id",Auth::user()->shop->id)->get();
        // 跳转视图
        return view("shop.activ.index",compact("acts"));
    }

    #  添加活动
    public function add(Request $request){
        // 判断提交方式
        if ($request->isMethod("post")) {
            // 表单验证
            $this->validate($request, [
                'title' => "required | min:3 |unique:activs | max:8",
                'content' => "required",
            ]);
            //2. 接收数据
            $data=$request->post();
            //3. 设置用户ID
            $data['shop_id'] = Auth::user()->shop->id;
            // 添加数据
            Activ::create($data);

            return redirect()->route("shop.activ.index")->with("success", "添加成功");

        }
        return view("shop.activ.add");
    }

    #  编辑活动
    public function edit(Request $request,$id){

    }

    #  删除活动
    public function del(Request $request,$id){

    }
}
