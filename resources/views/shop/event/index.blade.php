@extends("shop.layouts.main")

@section("title","商户首页")

@section("content")
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>名称</th>
            <th>详情</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖时间</th>
            <th>已报名/总人数</th>
            <th>是否开奖</th>
            <th>查看详情</th>
        </tr>
        <?php $arr = [ 0 => "未开奖", 1 => "已开奖"];?>
        @foreach($events as $event)
            <tr>
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>{{$event->content}}</td>
                <td>{{$event->start_time}}</td>
                <td>{{$event->end_time}}</td>
                <td>{{$event->prize_time}}</td>
                <td>{{$event->users->count()}}/{{$event->num}}</td>
                <td><?php echo $arr[$event->is_prize]?></td>
                <td>
                    <a href="{{route("shop.eventuser.baom",$event->id)}}" class="btn btn-info" >查看</a>
                    @if(\DB::table("event_users")->where("event_id",$event->id)->where("user_id",Auth::user()->id)->first())
                        <a href="" class="btn btn-success" >已报名</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

@endsection