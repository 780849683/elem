<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends BaseController
{
    # 菜品首页
    public function index(Request $request){
      /* // 得到当前登录对象
        $user = Auth::user();
        //得到当前对象的店铺
        $shop = $user->shop;
        //得到当前店铺的Id
        $sID = $shop->id;
        //得到当前店铺中的菜
        $menus=Menu::where("shop_id",$sID)->get();//只能用这种方法调用belangsTO*/
        $url=$request->query();
        //收缩所有数据
        $cateId = $request->get("cate_id");
        $keyword = $request->get("keyword");
        // 得到所有 并有分页
       // $query = Menu::orderBy("id");
        $query=Menu::where("shop_id",Auth::user()->shop->id);//只能用这种方法调用belangsTO
        if ($keyword !==null){
            $query->where("goods_name","like","%{$keyword}%");
        }
        if ($cateId !== null ){
            $query ->where("cate_id",$cateId);
        }
        $menus=$query->paginate(2);
        $cates=MenuCate::where("shop_id",Auth::user()->shop->id)->get();
        //跳转视图
        return view("shop.menu.index",compact("menus","cates","url"));
    }

    #  添加菜
    public function add(Request $request){
        // 判断提交方式
        if ($request->isMethod("post")) {
            // 表单验证
            $this->validate($request, [
                'goods_name' => "required | min:2 |unique:menu_cates",
                'status' => "required |max: 1 |min:1",
                'goods_price' => "required",
                'description' => "required",
                'tips' => "required",
            ]);
            //2. 接收数据
            $data=$request->post();
            //3. 设置用户ID
            $data['shop_id'] = Auth::user()->shop->id;
            //dd( $data['shop_id']);
            // 添加数据
            Menu::create($data);

            return redirect()->route("shop.menu.index")->with("success", "添加成功");

        }
        $cates = MenuCate::where("shop_id", Auth::user()->shop->id)->get();
        return view("shop.menu.add",compact("cates"));

    }

    #  编辑菜
    public function edit(Request $request,$id){
        // 找到当前对象id
        $menu = Menu::find($id);
        // 判断提交方式
        if ($request->isMethod("post")){
            // 表单验证
            $this->validate($request,[
                'goods_name' => "required | min:2 |unique:menu_cates",
                'status' => "required |max: 1 |min:1",
                'goods_price' => "required",
                'description' => "required",
                'tips' => "required",
            ]);
            //2. 接收数据
            $data=$request->post();
            // 数据府库
            if ($menu->update($data)){
                return redirect()->intended(route("shop.menu.index"))->with("success", "修改成功");
            }
        }
        $cates = MenuCate::where("shop_id", Auth::user()->shop->id)->get();
        return view("shop.menu.edit",compact("cates","menu"));

    }

    #  删除菜
    public function del(Request $request,$id){
        //找到当前对象
        $menu = Menu::find($id);
        //dd($cate->id);
         Storage::delete($menu->img);//删除原来的图片
            $menu->delete();
            return redirect()->route("shop.menu.index")->with("success","删除成功");


    }


    # 创建 webuploader 图片上传方法
    public function upload(Request $request){
        //处理上传
        //dd($request->file("file"));
        $file=$request->file("file");
        if ($file){
            //上传
            $url=$file->store("menu");
            /// var_dump($url);
            //得到真实地址  加 http的址
            //$url=Storage::url($url);
            $data['url']=$url;
            return $data;
            ///var_dump($url);
        }
    }
}
