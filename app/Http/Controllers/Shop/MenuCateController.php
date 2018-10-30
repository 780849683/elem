<?php

namespace App\Http\Controllers\Shop;

use App\Models\MenuCate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuCateController extends BaseController{

    # 菜品分类首页
    public function index(Request $request){
     /*  // 得到当前登录对象
        $user = Auth::user();
        //得到当前对象的店铺
        $shop = $user->shop;
        //得到当前店铺的Id
        $sID = $shop->id;
        //dd($sID);
        //得到当前店铺中的菜品
        $cates=DB::table("menu_cates")->where("shop_id",$sID)->get();*/
        $url=$request->query();
        //收缩所有数据
        $cateId = $request->get("cate_id");
        $keyword = $request->get("keyword");
        // 得到所有 并有分页
        // $query = Menu::orderBy("id");
        $query=MenuCate::where("shop_id",Auth::user()->shop->id);//只能用这种方法调用belangsTO
        if ($keyword !==null){
            $query->where("name","like","%{$keyword}%");
        }
        if ($cateId !== null ){
            $query ->where("id",$cateId);
        }
        $cates=$query->paginate(2);
        //$cates = MenuCate::where("shop_id",Auth::user()->shop->id)->get();
        // 跳转视图
        return view("shop.menucate.index",compact("cates","url"));
    }

    #添加菜品分类
    public function add(Request $request)
    {
        // 判断提交方式
        if ($request->isMethod("post")) {
            // 表单验证
            $this->validate($request, [
                'name' => "required | min:2 |unique:menu_cates"
            ]);
            //2. 接收数据
            $data=$request->post();
            //3. 设置用户ID
            $data['shop_id'] = Auth::user()->shop->id;
            // 添加数据
            MenuCate::create($data);

            return redirect()->route("shop.menucate.index")->with("success", "添加成功");

        }
        return view("shop.menucate.add");
    }

    # 菜品编辑
    public function edit(Request $request,$id){
         // 找到当前对象id
        $mcate = MenuCate::find($id);
        // 判断提交方式
        if ($request->isMethod("post")){
            // 表单验证
            $this->validate($request,[
                'name' => "required | min:2 |unique:menu_cates"
            ]);
            //2. 接收数据
            $data=$request->post();
            // 数据府库
            if ($mcate->update($data)){
                return redirect()->intended(route("shop.menucate.index"))->with("success", "修改成功");
            }
        }
        return view("shop.menucate.edit",compact("mcate"));
    }

    #  删除分类
    public function del($id){
        //找到当前对象
        $mcate = MenuCate::find($id);
        //dd($cate->id);
        if (DB::table("menus")->where("cate_id",$mcate->id)->first()){
            return back()->with("danger","分类中有菜不能删除");
        }else{
            $mcate->delete();
            return redirect()->route("shop.menucate.index")->with("success","删除成功");
        }
    }


}
