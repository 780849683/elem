@extends("admin.layouts.main_admin")
@section("title","权限管理")
@section("content")
    <a href="{{route("admin.per.add")}}" class="btn btn-primary">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>权限Id</th>
            <th>名称</th>
            <th>说明</th>
            <th>操作</th>
        </tr>
        @foreach($pers as $per)
            <tr>
                <td>{{$per->id}}</td>
                <td>{{$per->name}}</td>
                <td>{{$per->intro}}</td>
                <td>
                   <a href="{{route("admin.per.edit",$per->id)}}" class="btn btn-info" >编辑</a>
                   <a href="{{route("admin.per.del",$per->id)}}" class="btn btn-danger" >删除</a>
                  {{--   <a href="{{route('admin.shop.del',$shop->id)}}" class="btn btn-danger" onclick="return confirm('删除会一并删除用户,确认吗？')">删除</a>
                    @if($shop->status===0)
                        <a href="{{route('admin.shop.changeStatus',$shop->id)}}" class="btn btn-success">通审</a>
                    @endif--}}
                </td>
            </tr>
        @endforeach
    </table>

@endsection