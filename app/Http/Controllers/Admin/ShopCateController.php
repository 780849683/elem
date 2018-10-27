<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShopCate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShopCateController extends BaseController
{
    # 商铺分类
    public function index(){
         //得到所有
        $cates = ShopCate::all();
        //显示视图
        return view("admin.shopcate.index",compact("cates"));
    }

    #  添加分类
    public function add(Request $request){
        //判断提交方式
        if ($request->isMethod("post")){
             // 表单验证
            $data = $this->validate($request,[
               'name'=> "required | max:6 |min:2"
            ]);
            if (ShopCate::create($data)){
                return redirect()->route("admin.shopcate.index")->with("success","添加成功");
            }
        }
        return view("admin.shopcate.add");
    }

    # 编辑分类
    public function edit(Request $request,$id){
        //判断提交方式
        if ($request->isMethod("post")){

        }
        // 显示视图
        return view("admin.shopcate.edit");
    }

    # 状态
    public function shangxian($id){
        // 找到当前对象
        $cate = ShopCate::findOrfail($id);
        //dd($shop);
        $cate -> status = 1;
        $cate -> save();
        return back()->with("success", "以切换");
    }
    public function xiaxian($id){
        // 找到当前对象
        $cate = ShopCate::findOrfail($id);
        //dd($shop);
        $cate -> status = 0;
        $cate -> save();
        return back()->with("success", "以切换");
    }

    # 删除分类
    public function del($id){
        //找到当前对象
        $cate = ShopCate::find($id);
        //dd($cate->id);
        if (DB::table("shops")->where("cate_id",$cate->id)->first()){
            return back()->with("danger","分类中有店铺不能删除");
        }else{
            $cate->delete();
            return redirect()->route("admin.shopcate.index")->with("success","删除成功");
        }
    }
}
