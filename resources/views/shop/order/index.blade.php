@extends("shop.layouts.main")

@section("title","订单管理")

@section("content")


{{--
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
            --}}{{--<div class="form-group">
            <input type="text" class="form-control"  placeholder="最低价" size="5" name="minPrice" value="{{old("minPrice")}}" >
            </div>
            -
            <div class="form-group">
            <input type="text" class="form-control"  placeholder="最高价" size="5" name="maxPrice" value="{{old("maxPrice")}}">
            </div>--}}{{--
            <div class="form-group">
                <input type="text" class="form-control"  placeholder="请输入名称" name="keyword" value="{{request()->get("keyword")}}">
            </div>
            <button type="submit" class="btn btn-primary">搜索</button>
        </form>
    </div>
    </div>--}}
<a href="{{route('shop.order.day')}}" class="btn btn-info">日订单量</a>
<a href="{{route('shop.order.mouth')}}" class="btn btn-info">月订单量</a>

    <table class="table" >
        <tr >
            <th>订单编号</th>
            <th>创建时间</th>
            <th>订单金额</th>
            <th>收货人</th>
            <th>收货电话</th>
            <th>配送地址</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        <?php $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "完成"];?>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->order_code}}</td>
                <td>{{$order->created_at}}</td>
                <td>{{$order->total}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->tel}}</td>
                <td>{{$order->provence}}{{$order->city}}{{$order->county}}{{$order->detail_address}}</td>
                <td><?php echo $arr[$order->order_status]?></td>
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
                    <a href="{{route('shop.order.look',$order->id)}}" class="btn btn-warning">查看</a>
                    @if($order->order_status===1 or $order->order_status===0 )
                        <a href="{{route('shop.order.no',$order->id)}}" class="btn btn-warning">取消</a>
                    @endif
                    @if($order->order_status===1)
                        <a href="{{route('shop.order.send',$order->id)}}" class="btn btn btn-danger">发货</a>
                    @endif
                        @if($order->order_status===2)
                            <a href="{{route('shop.order.ok',$order->id)}}" class="btn btn-info">待确认</a>
                        @endif
                        @if($order->order_status===3)
                            <a href="" class="btn btn-success">完成订单</a>
                        @endif
                    @if($order->order_status=== -1)
                        <a href="{{route('shop.order.del',$order->id)}}" class="btn btn-danger">删除</a>
                    @endif
                    {{--<a href="{{route('good.look',$good->id)}}" class="btn btn-warning glyphicon glyphicon-eye-open"></a>--}}
                    {{--<a href="{{route('shop.menucate.del',$cate->id)}}" class="btn btn-danger glyphicon glyphicon-trash"></a>--}}

                </td>
            </tr>
        @endforeach
    </table>
    {{--分页--}}
    {{--{{$goods->appends(array("class_id"=>$classId,"minPrice"=>$minPrice,"maxPrice"=>$maxPrice,"keyword"=>$keyword))->links()}}--}}
  {{--{{$cates->appends($url)->links()}}--}}
    {{$orders->links()}}
@endsection