<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EventController extends BaseController
{
    # 首页
    public function index(){
        //$events = Event::paginate(10);
        $events = Event::all();
        //dd($us->name);
        return view("admin.event.index",compact("events"));
    }

    # 查看已报名商户
    public function look($id){
        $event = Event::find($id);
        $eus = EventUser::where("event_id",$event->id)->get();
        $eps = EventPrize::where("event_id",$event->id)->get();
        return view("admin.event.look",compact("eus","eps"));
    }

   /* //活动开奖
    public function open(Request $request,$id){
        //开奖把数据从redis同步过来
        $users=Redis::smembers("event:".$id);
        foreach ($users as $user){
            EventUser::insert([
                "event_id"=>$id,
                "user_id"=>$user
            ]);
        }
        //dd($users);
        //1.通过当前活动ID把已经报名的用户ID取出来
        //  $userIds=DB::table('event_users')->where('event_id',$id)->pluck('user_id')->toArray();
        $userIds=EventUser::where("event_id",$id)->pluck("user_id")->shuffle();
        //dd($userIds);
        //2.打乱$userIds
        // shuffle($userIds);
        // dd($userIds);
        //3.找出当前活动的奖品 并随机打乱
        $prizes=EventPrize::where("event_id",$id)->get()->shuffle();
        //  dd($prizes->toArray());
        //4.操作奖品表
        foreach ($prizes as $k=>$prize){
            //4.1 给奖品的user_id 赋值
            $prize->user_id=$userIds[$k];
            //4.2 保存修改状态
            $prize->save();
        }
        //5.修改当前活动状态
        $event=Event::findOrFail($id);
        $event->is_prize=1;
        $event->save();
        //6.返回
        return redirect()->route('admin.event.index')->with('success','开奖成功');
    }*/

    # 抽奖
    public function cj(Request $request,$id){
        //1.通过当前活动id把已报名的用户id取出来 并打乱
        //$userIds=DB::table('event_users')->where('event_id',$id)->pluck('user_id')->toArray();
          // shuffle($userId);
        $userIds = EventUser::where("event_id",$id)->pluck("user_id")->shuffle();
        //dd($userIds);
        $pp = EventPrize::where("event_id",$id)->first();
        if ($pp == null){
            return back()->with("danger","当前活动没奖品");
        }
        // 2.找出当前活动奖品  并随机打乱
        $prizes = EventPrize::where("event_id",$id)->get()->shuffle();
        //dd($prizes);
        //操作奖品表
        //dd($id);
        foreach ($prizes as $k=>$prize){
                // 给奖品的user_id 赋值
                $prize->user_id = $userIds[$k];
                //保存
                $prize->save();
            }


        // 修改当前活动
        $event = Event::findOrFail($id);
        $event->is_prize = 1;
        $event->save();
        //返回
        return redirect()->route("admin.event.index")->with("success","开奖成功");
    }

    # 添加
    public function add(Request $request){
        //判定提交方式
        if ($request->isMethod("post")){
            //表单验证
            $data = $this->validate($request,[
               'title' => "required | unique:events",
                'content'=>"required",
                'num'=>"required",
                'start_time'=>"required",
                'end_time'=>"required",
                'prize_time'=>"required",
            ]);
            $data['start_time'];
            //dd( $data['start_time']);
            $data['end_time'] ;
            $data['prize_time'] ;
            $data['is_prize'] = 0;
            //添加
            $event = Event::create($data);
            //1.把活动人数添加到redis中 event_num:2====>30
//            Redis::set("event_num:".$event->id,$event->num);
            //跳转
            return redirect()->route('admin.event.index')->with('success',"添加成功");
        }
        //跳转添加页面
        return view("admin.event.add");
    }

    # 编辑
    public function edit(Request $request,$id){
        //找到当前对象
        $event = Event::find($id);
        //判定提交方式
        if ($request->isMethod("post")){
            //表单验证
            $data = $this->validate($request,[
                'title' => "required",
                'content'=>"required",
                'start_time'=>"required",
                'end_time'=>"required",
                'prize_time'=>"required",
                'num'=>"required",
                'is_prize'=>"required",
            ]);
            //添加
            $event->update($data);
            //跳转
            return redirect()->route('admin.event.index')->with('success',"编辑成功");
        }
        //跳转添加页面
        return view("admin.event.edit",compact("event"));
    }

    # 删除
    public function del($id){
        $event = Event::findOrfail($id);
        //dd($event);
         DB::table("event_prizes")->where("event_id",$event->id)->delete();
         DB::table("event_users")->where("event_id",$event->id)->delete();
         $event->delete();

        return redirect()->route('admin.event.index')->with('success',"删除成功");
    }

}
