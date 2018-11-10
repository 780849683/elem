<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop;
use App\Models\ShopCate;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopController extends BaseController
{
    #  申请店铺
    public function add(Request $request){
       /* //判断当前用户是否已有店铺
        if (Auth::user()->shop){
           //dd(Auth::user()->shop);
            return back()->with("danger","已有店铺不能再创建");
        }*/
        //判断是不是POST提交
        if ($request->isMethod("post")) {
            //1. 验证
            $this->validate($request, [
                'cate_id' => 'required|integer',
                'name' => 'required|max:100|unique:shops',
              //'img' => 'required|image',
                'start_send' => 'required|numeric',
                'send_cost' => 'required|numeric',
                'notice' => 'string',
                'discount' => 'string',
            ]);
            //2. 接收数据
            $data=$request->post();
            //2.1 设置店铺的状态为0 未审核
            $data['status'] = 0;
            //2.2 设置用户ID
            $data['user_id'] = Auth::user()->id;
            //2.3 处理图片
            //$data['img']=$request->file("img")->store("shop_cate");
               //var_dump($data);
               //exit;
               //dd($data);
            //3. 添加数据
            Shop::create($data);

            //添加成功
            session()->flash('success', '添加成功等待平台审核');
            //注销
            Auth::logout();
            //跳转至添加页面
            return redirect()->route("shop.user.login");
        }
        //得到所有商家分类w
        $cates = ShopCate::all();
        //$cates = Shop_cate::where("status", 1)->get();
        //显示视图并赋值
        return view("shop.shop.add", compact('cates'));

    }

    #显示个人商铺
    public function index(){
        // 找到当前登录用户ID
        $userId=Auth::user()->id;
        $shops = Shop::where("user_id",$userId)->get();
        $cates = ShopCate::all();
        $users  = User::find($userId);
       // 查出当前对象有没有店铺
        if (DB::table("shops")->where('user_id',Auth::user()->id)->get()->isEmpty()){
            //dd(Auth::user()->name);
            // 没店铺申请店铺
            return redirect()->intended(route("shop.shop.add"))->with("success", "您还没有店铺，请申请店铺");
        }
        //显示视图
        return view("shop.shop.index",compact("shops","cates","users"));
    }


    #编辑店铺信息
    public function edit(Request $request,$id){
        // 找id
        $shop = Shop::find($id);
        // 判定 提交方式
        if ($request -> isMethod("POST")){
            // 接收数据
            $data = $request->post();
             //dd($data);
            // 图片处理
            $img =$request->file("img");
            if ($img){
                //@unlink($shop["img"]);
                Storage::delete($shop->img);//删除原来的图片
               // $data['img'] = $img->store("shop_cate");
            }
           //dd($img);
            //数据入库
            if ($shop -> update($data)){
              //  return redirect()->route("good.index")->with("success","修改成功");
            //}else{
                return redirect()->intended(route("shop.shop.index"))->with("success", "修改成功");
            }
        }
        // 获取商铺分类信息
        $cates = ShopCate::all();
        //dd($shop);
        // 跳转视图
        return view("shop.shop.edit",compact("shop","cates"));
    }


    # 创建 webuploader 图片上传方法
    public function upload(Request $request){
        //处理上传
        //dd($request->file("file"));
        $file=$request->file("file");
        if ($file){
            //上传
            $url=$file->store("shop");
            /// var_dump($url);
            //得到真实地址  加 http的址
            //$url=Storage::url($url);
            $data['url']=$url;
            return $data;
            ///var_dump($url);
        }
    }


}
