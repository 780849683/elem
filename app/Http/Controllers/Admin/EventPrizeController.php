<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventPrizeController extends BaseController
{
    #  奖品首页
    public function index(){
        // 找到所有奖品
        $eventPrizes = EventPrize::all();

        // 跳转首页
        return view("admin.eventprize.index",compact("eventPrizes"));
    }

    # 添加
    public function add(Request $request){
        //判断提交方法
        if ($request->isMethod("post")){
            $data = $this->validate($request,[
                'name' => "required | unique:event_prizes",
                'description'=>"required",
                'event_id'=>"required"
            ]);
            $data['user_id'] = 0;
            EventPrize::create($data);
            return redirect()->route('admin.eventprize.index')->with('success',"添加成功");
        }

        $events = Event::all();
        // 跳转添加页面
        return view("admin.eventprize.add",compact("events"));
    }
}
