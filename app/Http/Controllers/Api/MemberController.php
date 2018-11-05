<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class MemberController extends BaseController
{

    #  注册
    public function reg(Request $request){
        // 1. 验证提交方式
        $data = $request->post();
        //  1.1 创建一个验证规则、
        $validate = Validator::make($data,[
            'username' => 'required|unique:members',
            'sms' => 'required|integer|min:1000|max:999999',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/',
                'unique:members'
        ],
            ]);
        //验证 如果有错
        if ($validate->fails()) {

            //返回错误
            return [
                'status' => "false",
                //获取错误信息
                "message" => $validate->errors()->first()
            ];

        }
        //  dd($data);
        // 2. 获取验证码
        $sm = Redis::get("tel_".$data["tel"]);
        //dd($sm);
        // 3.验证验证码是否正确
        if ($sm == $data['sms']){
            $data['password'] = bcrypt($data['password']);
            Member::create($data);
             $d= [
                 "status" =>true,
                 "message" => "注册成功",
                 ];
        }else{
            $d = [
                "status" =>false,
                "message" => "注册失败",
            ];
        }
         return $d;
    }

    #  短信验证
    public function sms(Request $request){
          // 接收参数
        $tel = $request->get('tel');
        //随机生成验证码
        $code = mt_rand(1000,9999);
        // 吧验证码存起来  redis/文件缓存
        // 怎么存？
        /*Redis::set("tel_".$tel,$code);
        Redis::expire("tel_".$tel,5);*/
        Redis::setex("tel_".$tel,60*5,$code);
        // 验证码发手机
        // TODO
        $config = [
            'access_key' => "LTAIO7sTwdwlGIzJ",//appID
            'access_secret' => "zMroqjLKuMFFNBe4bifNJ6bUvE0zf4",// appKey
            'sign_name' => "技术分享",// 签名
        ];

        $sms = new AliSms();
        //$response = $sms->sendSms('phone number', 'tempplate code', ['name'=> 'value in your template'], $config);
        $response = $sms->sendSms($tel, 'SMS_149422353', ['code'=> $code], $config);// 'code' 是模板里的 $code 是上面是生成的
        // 5. 返回
        if ($response){
            $data = [
                "status" =>true,
                "message" => "获取短信验证码成功".$code,
            ];
        }else{
            $data = [
                "status" =>false,
                "message" => "获取验证码失败",
            ];
        }


         return $data;
    }

    #登录
    public function login(Request $request){
        // 1. 接收用户名和密码
         $name= $request->post("name");
         $password= $request->post("password");
          //dd($name,$password);
          $members = Member::where("username",$name)->first();
          //dd($members);
        // 2. 判断用户  验证输入的旧密码是否相同
           if ($members && Hash::check($password,$members->password)){
               $data = [
                   "status"=>"true",
                    "message"=>"登录成功",
                    "user_id"=>$members->id,
                    "username"=>$members->username,
               ];
              // dd($data);
           }else{
               $data = [
                   "status"=>"false",
                   "message"=>"登录失败",
               ];
           }
           return $data;
    }

    # 忘记密码
    public function forget(Request $request)
    {
        // 接收方式
        $data = $request->post();
        $tel = $data['tel'];
        //dd($tel);
        // $members = DB::table("members")->where("tel",$tel)->first();
        $sm = Redis::get("tel_" . $data["tel"]);
        //dd($sm);
        // 3.验证验证码是否正确
        if ($sm == $data['sms']) {
            $data['password'] = bcrypt($data['password']);
            Member::where('tel',$tel)->update(['password'=>$data['password']]);
            $dd = [
                "status"=>"true",
                "message"=>"密码重置成功",
            ];
        }
             return $dd;

    }

    # 修改密码
    public function change(Request $request){
        $data = $request->post();
        $id=$data["id"];
        //dd($id);
        $member=Member::where("id",$id)->first();
        if ( Hash::check($data["oldPassword"],$member->password)) {
            $data["newPassword"] = bcrypt($data["newPassword"]);
            Member::where("id",$id)->update(['password'=>$data['newPassword']]);
              $d = [
                  "status"=> "true",
                  "message"=> "修改成功",
             ];
      }else{
              $d = [
                  "status"=> "false",
                  "message"=> "旧密码错误",
                  ];
      }
        return $d;
    }

     # 用户详情
    public function detail(Request $request){
     $member=Member::find($request->get('user_id'));
            $d = [
                'jifen' => $member->jifen,
                'money' => $member->money
            ];
            return $d;
        }

}
