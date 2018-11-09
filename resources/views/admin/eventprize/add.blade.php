@extends("admin.layouts.main_admin")
@section("title","添加奖品")
@section("content")

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}

        <div class="form-group">
            <label class="col-sm-2 control-label">所属活动</label>
            <div class="col-sm-10">
                <select name="event_id" class="form-control"  >
                    <option value="0">++++选择活动++++</option>
                    @foreach($events as $event)
                    <option value="{{$event->id}}" >{{$event->title}}</option>
                        @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">奖品名称</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" >
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">奖品详情</label>
            <div class="col-sm-10">
                <!-- 编辑器容器 -->
                <script id="container" name="description" type="text/plain"></script>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>

       {{-- <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <INPUT onclick="history.go(-1)" type="button" value="返回" style="background:red ; color:white; height: 35px;width: 45px;font-size: 15px;border-radius: 20px">
            </div>
        </div>--}}
        {{--<INPUT onclick="history.go(-1)" type="button" value="返回" style="background:red ; color:white; height: 45px;width: 90px;font-size: 20px;border-radius: 20px">--}}
    </form>
@endsection

@section("js")
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection