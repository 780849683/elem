@extends("admin.layouts.main_admin")
@section("title","编辑活动")
@section("content")

    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}

        <div class="form-group">
            <label class="col-sm-2 control-label">活动名称</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" value="{{$event->title}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">活动详情</label>
            <div class="col-sm-10">
                <!-- 编辑器容器 -->
                <script id="container" name="content" type="text/plain"> {{$event->content}}</script>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">开始时间</label>
            <div class="col-sm-10">
                <input type="datetime-local" name="start_time" class="form-control">  {{$event->start_time}}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">结束时间</label>
            <div class="col-sm-10">
                <input type="datetime-local" name="end_time" class="form-control"> {{$event->end_time}}
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">开奖时间</label>
            <div class="col-sm-10">
                <input type="datetime-local" name="prize_time" class="form-control"> {{$event->prize_time}}
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">人数限制</label>
            <div class="col-sm-10">
                <input type="text" name="num" class="form-control" value="{{$event->num}}">
            </div>
        </div>

     {{--   <div class="form-group">
            <label class="col-sm-2 control-label">是否开奖</label>
            <div class="col-sm-10">
                <select name="is_prize" class="form-control"  >
                    <option value="1">是</option>
                    <option value="0">否</option>
                </select>
            </div>
        </div>--}}


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">编辑</button>
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