<?php

namespace App\Http\Controllers\Admin;
use App\Models\Shop;
use App\Models\ShopCate;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ShopController extends BaseController
{
  # 商铺管理首页
    public function index(Request $request){
        // 获取所有商铺
//        $shops = Shop::all();
        $cates = ShopCate::all();
        $users = User::all();
//        dd($shops,$cates,$users);
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
        return view("admin/shop/index",compact("shops","cates","users","url"));
    }

    # 商铺审核
    public function shenh($id){
        // 找到当前对象
        $shop = Shop::findOrfail($id);
        //dd($shop);
        $shop -> status = 1;
        $shop -> save();
        return back()->with("success", "通过审核");
    }

    # 删除店铺
    public function del($id){
        // 找到当前对象
        $shop = Shop::findOrFail($id);
        //dd($shop->img);
        @unlink($shop->img);
       // Storage::delete($shop->img);//删除原来的图片
        if ($shop -> delete()){
            //Storage::delete($shop->img);//删除原来的图片
            session()->flash("success","删除成功");
            return redirect() -> route("admin.shop.index");
        }
    }

    public function xiaxian($id){
        // 找到当前对象
        $cate = Shop::findOrfail($id);
        //dd($shop);
        $cate -> status = 0;
        $cate -> save();
        return back()->with("success", "以切换");
    }
}
