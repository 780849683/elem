@extends("shop.layouts.main")

@section("title","菜品首页")

@section("content")




    <div  class="col-md-2">
    <a href="{{route("shop.menu.add")}}" class="btn btn-info">添加</a>
    </div>
    <div  class="col-md-2">
    <a href="{{route("shop.order.mday")}}" class="btn btn-info">日销量</a>
    <a href="" class="btn btn-info">月销量</a>
    </div>
    <div class="col-md-8">
    <form class="form-inline pull-right" method="get">
    <div class="form-group">
    <select name="cate_id" class="form-control" >
    <option value="">请选择分类</option>
    @foreach($cates as $cate)
    <option value="{{$cate->id}}">{{$cate->name}}</option>
    @endforeach
    </select>
    {{--</div>
    <div class="form-group">
    <input type="text" class="form-control"  placeholder="最低价" size="5" name="minPrice" value="{{old("minPrice")}}" >
    </div>
    -
    <div class="form-group">
    <input type="text" class="form-control"  placeholder="最高价" size="5" name="maxPrice" value="{{old("maxPrice")}}">
    </div>--}}
    <div class="form-group">
    <input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get("keyword")}}">
    </div>
    <button type="submit" class="btn btn-primary">搜索</button>
    </form>
    </div>
    </div>



    <table class="table" >
        <tr >
            <th>Id</th>
            <th>商品图片</th>
            <th>菜名</th>
            <th>状态</th>
            <th>价格</th>
            <th>类别</th>
            <th>月销量</th>
            <th>描述</th>
            <th>提示信息</th>
            <th>评分</th>
            <th>评分数量</th>
            <th>满意度数量</th>
            <th>满意度评分</th>

        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{$menu->id}}</td>
                <td><img src="{{$menu->goods_img}}?x-oss-process=image/resize,m_fill,w_80,h_80"></td>
                <td>{{$menu->goods_name}}</td>
                <td>{{$menu->status}}</td>
                <td>{{$menu->goods_price}}</td>
                <td>
                    {{$menu->menu_cate->name}}
                    {{--{{}}--}}
                </td>
                <td>{{$menu->month_sales}}</td>
                <td>{{$menu->description}}</td>
                <td>{{$menu->tips}}</td>
                <td>{{$menu->rating}}</td>
                <td>{{$menu->rating_count}}</td>
                <td>{{$menu->satisfy_count}}</td>
                <td>{{$menu->satisfy_rate}}</td>
                <td>
                    <a href="{{route('shop.menu.edit',$menu->id)}}" class="btn btn-success glyphicon glyphicon-pencil"></a>
                    {{--<a href="{{route('good.look',$good->id)}}" class="btn btn-warning glyphicon glyphicon-eye-open"></a>--}}
                    <a href="{{route('shop.menu.del',$menu->id)}}" class="btn btn-danger glyphicon glyphicon-trash"></a>

                </td>
            </tr>
        @endforeach
    </table>
    {{--分页--}}
    {{--{{$menus->appends(array("cate_id"=>$cateId,"keyword"=>$keyword))->links()}}--}}
    {{$menus->appends($url)->links()}}

@endsection