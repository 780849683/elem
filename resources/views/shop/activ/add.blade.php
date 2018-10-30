@extends("admin.layouts.main_login")
@section("title","添加活动")
@section("content")
    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">活动名称</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">活动详情</label>
            <div class="col-sm-10">
                <input type="text" name="content" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">开始时间</label>
            <div class="col-sm-10">
                <input type="text" name="start_time" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">结束时间</label>
            <div class="col-sm-10">
                <input type="text" name="end_time" class="form-control">
            </div>
        </div>
        {{--<div class="form-group">
            <label class="col-sm-2 control-label">类别</label>
            <div class="col-sm-10">
                <input type="text" name="password" class="form-control">
            </div>
        </div>--}}
        {{--<div class="form-group">--}}
        {{--<label class="col-sm-2 control-label">Email</label>--}}
        {{--<div class="col-sm-10">--}}
        {{--<input type="text" name="email" class="form-control">--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">添加</button>
            </div>
        </div>
    </form>
@endsection

@section("uedit")

    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection