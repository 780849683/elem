@extends("admin.layouts.main_login")
@section("title","添加菜品分类")
@section("content")
    <form class="form-horizontal" action="" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <label class="col-sm-2 control-label">类别</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">描述</label>
            <div class="col-sm-10">
                <input type="text" name="desc" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">是否默认分类</label>
            <div class="col-sm-10">
                <input type="text" name="is_select" class="form-control">
            </div>

        </div> <div class="form-group">
            <label class="col-sm-2 control-label">编号</label>
            <div class="col-sm-10">
                <input type="text" name="type_accumulation" class="form-control">
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