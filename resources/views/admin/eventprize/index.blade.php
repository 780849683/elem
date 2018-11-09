@extends("admin.layouts.main_admin")
@section("title","奖品首页")
@section("content")
    <a href="{{route("admin.eventprize.add")}}" class="btn btn-primary">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>名称</th>
            <th>详情</th>
            <th>所属活动</th>
            <th>操作</th>
        </tr>
        @foreach($eventPrizes as $eventPrize)
            <tr>
                <td>{{$eventPrize->id}}</td>
                <td>{{$eventPrize->name}}</td>
                <td>{!! $eventPrize->description!!}</td>
                <td>{{str_replace(['[',']','"'],'',json_encode(\App\Models\Event::where('id',$eventPrize->event_id)->pluck('title'),JSON_UNESCAPED_UNICODE)) }}</td>

              {{--  <td>
                    @if($even->pid == 0)
                        {{"无"}}
                    @else
                        {{str_replace(['[',']','"'],'',json_encode(\App\Models\Nav::where('id',$even->pid)->pluck('name'),JSON_UNESCAPED_UNICODE)) }}
                    @endif
                </td>
                <td>{{str_replace(['[',']','"'],'',json_encode($role->permissions()->pluck('intro'),JSON_UNESCAPED_UNICODE)) }}</td>
                --}}
       <td>
                  {{--  <a href="{{route("admin.event.edit",$event->id)}}" class="btn btn-info" style="margin-left: 30px" >编辑</a>
                    <a href="{{route("admin.event.look",$event->id)}}" class="btn btn-warning" >查看已报名商户</a>
                    @if($event->is_prize===0)
                        <a href="{{route("admin.event.cj",$event->id)}}" class="btn btn-danger" >抽奖</a>
                        @endif--}}

                </td>
            </tr>
        @endforeach
    </table>
    {{--{{$events->links()}}--}}

@endsection