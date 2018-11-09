<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EventController extends BaseController
{
    public function index(){
        //$events = Event::paginate(10);
        $events = Event::all();
        // dd($events);
        foreach ($events as $k=>$v){
            $cu = DB::table("event_users")->where("event_id",$v->id)->count("user_id");
            //dd($cu);
        }

        return view("shop.event.index",compact("events","cu"));
    }

   /* # 查看
    public function look($id){
        $event = Event::find($id);

        return view("shop.event.look",compact("event"));
    }*/
}
