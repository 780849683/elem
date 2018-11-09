@extends("admin.layouts.main_admin")
@section("title","活动首页")
@section("content")
    <a href="{{route("admin.event.add")}}" class="btn btn-primary">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>名称</th>
            <th>详情</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖时间</th>
            <th>已报名人数/总人数</th>
            <th>是否开奖</th>

            <th>操作</th>
        </tr>
        <?php $arr = [ 0 => "未开奖", 1 => "已开奖"];?>
        @foreach($events as $event)
            <tr>
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>{!! $event->content !!}</td>
                <td>{{$event->start_time}}</td>
                <td>{{$event->end_time}}</td>
                <td>{{$event->prize_time}}</td>
                <td>{{$event->users->count()}}/{{$event->num}}</td>
                <td><?php echo $arr[$event->is_prize]?></td>
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
                    <a href="{{route("admin.event.edit",$event->id)}}" class="btn btn-info" style="margin-left: 30px" >编辑</a>
                    <a href="{{route("admin.event.look",$event->id)}}" class="btn btn-warning" >查看</a>
                    @if($event->is_prize===0)
                        <a href="{{route("admin.event.cj",$event->id)}}" class="btn btn-success" >抽奖</a>
                        @endif

                      <a href="{{route('admin.event.del',$event->id)}}" class="btn btn-danger" onclick="return confirm('删除会一并删除奖品,确认吗？')">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{--{{$events->links()}}--}}

@endsection