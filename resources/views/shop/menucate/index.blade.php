@extends("shop.layouts.main")

@section("title","菜品分类")

@section("content")



    <div  class="col-md-4">
    <a href="{{route("shop.menucate.add")}}" class="btn btn-info">添加</a>
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
    </div>
    {{--<div class="form-group">
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
            <th>分类名称</th>
            <th>描述</th>
            <th>默认分类</th>
            <th>操作</th>
        </tr>
        @foreach($cates as $cate)
            <tr>
                <td>{{$cate->id}}</td>
                <td>{{$cate->name}}</td>
                <td>{{$cate->desc}}</td>
                <td>{{$cate->is_select}}</td>
                {{--<td align="" class="first-cell"><span><img src="/{{$shop->img}}" width="100"  height="50" /></span></td>
                 <td>@if($shop->brand)
                         <i class="glyphicon glyphicon-ok" style="color: green"></i>
                     @else
                         <i class="glyphicon glyphicon-remove" style="color: red"></i>
                     @endif</td>
             {{--<td> @if($shop->time)
                         <i class="glyphicon glyphicon-ok" style="color: green"></i>
                     @else
                         <i class="glyphicon glyphicon-remove" style="color: red"></i>
                     @endif</td>
                 <td> @if($shop->fengniao)
                         <i class="glyphicon glyphicon-ok" style="color: green"></i>
                     @else
                         <i class="glyphicon glyphicon-remove" style="color: red"></i>
                     @endif</td>
                 <td> @if($shop->bao)
                         <i class="glyphicon glyphicon-ok" style="color: green"></i>
                     @else
                         <i class="glyphicon glyphicon-remove" style="color: red"></i>
                     @endif</td>
                 <td> @if($shop->piao)
                         <i class="glyphicon glyphicon-ok" style="color: green"></i>
                     @else
                         <i class="glyphicon glyphicon-remove" style="color: red"></i>
                     @endif</td>

                <td>{{$shop->notice}}</td>
                <td>{{$shop->discount}}</td>
                <td>  @if($shop->status)
                        <i class="glyphicon glyphicon-ok" style="color: green"></i>
                    @else
                        <i class="glyphicon glyphicon-remove" style="color: red"></i>
                    @endif

                </td>
                <td>{{$shop->Shopcate->name}}</td>
                <td>{{$shop->rating}}</td>--}}

                <td>
                    <a href="{{route('shop.menucate.edit',$cate->id)}}" class="btn btn-success glyphicon glyphicon-pencil"></a>
                    {{--<a href="{{route('good.look',$good->id)}}" class="btn btn-warning glyphicon glyphicon-eye-open"></a>--}}
                    <a href="{{route('shop.menucate.del',$cate->id)}}" class="btn btn-danger glyphicon glyphicon-trash"></a>

                </td>
            </tr>
        @endforeach
    </table>
    {{--分页--}}
    {{--{{$goods->appends(array("class_id"=>$classId,"minPrice"=>$minPrice,"maxPrice"=>$maxPrice,"keyword"=>$keyword))->links()}}--}}
    {{--{{ $goods->appends($url)->links() }}--}}
    {{$cates->appends($url)->links()}}
@endsection