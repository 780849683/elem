<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventUserController extends BaseController
{
    # 报名
    public function baom(Request $request,$id){
        $event = Event::findOrfail($id);
        //dd($event->id);
        //dd(Auth::user()->id);
        // 判断提交方式
        if ($request->isMethod("post")) {
            //2. 接收数据
            $data=$request->post();
            //3. 设置用户ID
            $data['user_id'] = Auth::user()->id;
            $data['event_id'] = $event->id;
            // 添加数据
            //$eu = EventUser::where("user_id",Auth::user()->id)->get();
            $eu = \DB::table("event_users")->where("event_id",$event->id)->where("user_id",Auth::user()->id)->first();
            //dd($eu);
                if($eu ){
                    return back()->withInput()->with("danger","您已报名，不能重复报名");
                }else{
                    EventUser::create($data);
                    return redirect()->route("shop.event.index")->with("success", "报名成功");
                }
            }
        //$events = Event::paginate(10);
        // dd($events);
            $cu = \DB::table("event_users")->where("event_id",$event->id)->count("user_id");
            //  dd($cu);
        return view("shop.eventuser.baom",compact("event","cu"));

    }
}
