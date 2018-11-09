@extends("admin.layouts.main_admin")
@section("title","店铺首页")
@section("content")
    <a href="" class="btn btn-primary">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>名称</th>
            <th>分类</th>
            <th>LOGO</th>
            <th>状态</th>
            <th>用户名</th>
            <th>操作</th>
        </tr>
        <?php $arr = [0 => "已禁用", 1 => "已审核"];?>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->name}}</td>
                <td>{{$shop->shopCate->name}}</td>
                <td><img src="{{env("ALIYUN_OSS_URL").$shop->img}}?x-oss-process=image/resize,m_fill,w_80,h_80"></td>
                <td><?php echo $arr[$shop->status]?></td>
                <td>{{$shop->user->name}}</td>

                <td>
                    @if($shop->status===1)
                        <a href="{{route('admin.shop.xiaxian',$shop->id)}}" class="btn btn-warning ">禁用</a>
                    @endif
                        @if($shop->status===0)
                            <a href="{{route('admin.shop.shenh',$shop->id)}}" class="btn btn-success">审核</a>
                        @endif
                    {{--<a href="{{route('admin.shop.del',$shop->id)}}" class="btn btn-danger" onclick="return confirm('删除会一并删除用户,确认吗？')">删除</a>--}}
                    <a href="{{route('admin.shop.del',$shop->id)}}" class="btn btn-danger" >删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $shops->appends($url)->links() }}
@endsection