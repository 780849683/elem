<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\ShopCate;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class UserController extends BaseController
{
   # 商户首页
    public function index(Request $request){
        //$shops = Shop::all();
        $cates = ShopCate::all();
        $users = User::all();

        $url=$request->query();
        //收缩所有数据
        $cateId = $request->get("cate_id");
        $keyword = $request->get("keyword");

        $query = Shop::orderBy("id");
        if ($keyword !==null){
            $query->where("name","like","%{$keyword}%");
        }
        if ($cateId !== null ) {
            $query->where("cate_id", $cateId);
        }
        $shops = $query->paginate(1);
        //  跳转视图
        return view("admin.user.index",compact("shops","cates","users","url"));
    }

    # 商户删除{

    public function del($id){
       $shop = DB::select("select * from shops ");
       //删除本地图片
        @unlink($shop[0]->img);
      DB::transaction(function () use ($id){
         // 1.删除用户
          User::findOrFail($id)->delete();
          //  删除对应的店铺
          Shop::where("user_id",$id)->delete();

      });


        return back()->with("success","删除成功");
    }
}
