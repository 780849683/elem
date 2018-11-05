@extends("admin.layouts.main_admin")
@section("title","角色管理")
@section("content")
    <a href="{{route("admin.role.add")}}" class="btn btn-primary">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>角色Id</th>
            <th>名称</th>
            <th>权限</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{str_replace(['[',']','"'],'',json_encode($role->permissions()->pluck('intro'),JSON_UNESCAPED_UNICODE)) }}</td>
                <td>
                  <a href="{{route("admin.role.edit",$role->id)}}" class="btn btn-info" >编辑</a>
                  <a href="{{route("admin.role.del",$role->id)}}" class="btn btn-danger" >删除</a>
                    {{--  <a href="{{route('admin.shop.del',$shop->id)}}" class="btn btn-danger" onclick="return confirm('删除会一并删除用户,确认吗？')">删除</a>
                    @if($shop->status===0)
                        <a href="{{route('admin.shop.changeStatus',$shop->id)}}" class="btn btn-success">通审</a>
                    @endif--}}
                </td>
            </tr>
        @endforeach
    </table>

@endsection