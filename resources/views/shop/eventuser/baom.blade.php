@extends("shop.layouts.main")

@section("title","活动详情")

@section("content")

    <style>
        td {
            width: 200px;
        }
        th {
            width: 15px;
        }

    </style>

    <table class="table table-bordered">
        <tr>
            <th>活动名称</th>
            <td>{{$event->title}}</td>
        </tr>

        <tr>
            <th>活动详情</th>
            <td>{{$event->content}}</td>
        </tr>

        <tr>
            <th>报名开始时间</th>
            <td>{{$event->start_time}}</td>
        </tr>

        <tr>
            <th>报名结束时间</th>
            <td>{{$event->end_time}}</td>
        </tr>

        <tr>
            <th>开奖时间</th>
            <td>{{$event->prize_time}}</td>
        </tr>

        <tr>
            <th>人数限制</th>
            <td>{{$event->num}}</td>
        </tr>

        <tr>
            <th>已报名人数</th>
            <td>{{$cu}}</td>
        </tr>
        <?php $arr = [ 0 => "未开奖", 1 => "已开奖"];?>
        <tr>
            <th>是否开奖</th>
            <td><?php echo $arr[$event->is_prize]?></td>
        </tr>
    </table>
    <form class="form-horizontal" action="" method="post" style="float: left">
        {{csrf_field()}}
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                @if(!\DB::table("event_users")->where("event_id",$event->id)->where("user_id",Auth::user()->id)->first())
                <button type="submit" class="btn btn-success">报名</button>
                    @endif

            </div>
        </div>
    </form>

    <a href="{{route("shop.event.index")}}" class="btn btn-warning" style="margin-left: 100px">返回</a>
@endsection