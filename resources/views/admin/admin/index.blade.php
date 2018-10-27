@extends("admin.layouts.main")
@section("title","管理员列表")
@section("content")

    <a href="/admin/reg" class="btn btn-primary">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>名称</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
                <td>
                <a href="/admin/edit/{id}" class="btn btn-info" >编辑</a>
                <a href="{{route('admin.shop.del',$shop->id)}}" class="btn btn-danger" onclick="return confirm('删除会一并删除用户,确认吗？')">删除</a>
                @if($shop->status===0)
                <a href="{{route('admin.shop.changeStatus',$shop->id)}}" class="btn btn-success">通审</a>
                @endif
                </td>
            </tr>
        @endforeach
    </table>

@endsection