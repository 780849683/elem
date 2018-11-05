<?php

namespace App\Http\Controllers\Api;

use App\Models\Addres;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddresController extends BaseController
{
    # 地址列表
    public function index(Request $request){
        // 得到当前用户对象
        $member =  Member::find($request->get('user_id'));
        //dd($member->id);
        $address = Addres::where("member_id",$member->id)->get();
        return $address;
    }

    # 添加地址
    public function add(Request $request){
         // 判断提交方式
        if ($request->isMethod("post")){
            $this->validate($request,[
                'tel' => [
                    'required',
                    'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/',
                    'unique:members'
                ]
            ]);
            //2. 接收数据
            $data=$request->post();
            //得到当前用户id
            $member =  Member::find($request->get('user_id'));
            //3. 设置用户ID
            $data['member_id'] =$member->id;
            Addres::create($data);
            $d = [
                'status' => "true",
                "message"=> "添加成功",
            ];
            return $d;
        }else{
            $d = [
                'status' => "false",
                "message"=> "地址或联系方式填写错误",
            ];
            return $d;
        }
    }

    # 修改回显
    public function look(Request $request){
        $address=Addres::find($request->get('id'));
        //dd($member);
        return $address;
    }

    # 修改地址
    public function edit(Request $request){
        // 得到id;
          $address = Addres::find($request->get('id'));
          //dd($address->id);
        // 判定 提交方式
        if ($request -> isMethod("POST")){
            // 接收数据
            $data = $request->post();
            //dd($img);
            //数据入库
            if ($address -> update($data)){
               $d = [
                   "status"=> "true",
                    "message"=> "修改成功",
               ];
               return $d;
            }
        }
    }



}
