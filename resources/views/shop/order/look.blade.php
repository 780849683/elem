@extends("shop.layouts.main")

@section("title","订单查看")

@section("content")
    <style>
        th{
            width: 100px;
        }
    </style>
<table class="table table-bordered">
    <tr>
        <th>订单编号</th>
        <td>{{$order->order_code}}</td>
    </tr>
    <tr>
        <th>创建时间</th>
        <td>{{$order->created_at}}</td>
    </tr>
    <tr>
        <th>菜品</th>
        <td> @foreach($orderDetails as $orderDetail)
           < {{$orderDetail->goods_name}} X {{$orderDetail->amount}}>
            @endforeach
        </td>
    </tr>
    <tr>
        <th>金额</th>
        <td>{{$order->total}}</td>
    </tr>
    <tr>
        <th>收货人</th>
        <td>{{$order->name}}</td>
    </tr>
    <tr>
        <th>电话</th>
        <td>{{$order->tel}}</td>
    </tr>
    <tr>
        <th>地址</th>
        <td>{{$order->provence}}{{$order->city}}{{$order->county}}{{$order->detail_address}}</td>
    </tr>
    <tr>
        <th>状态</th>
        <?php $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "完成"];?>
        <td><?php echo $arr[$order->order_status]?></td>
    </tr>
</table>
    {{--<a href="JavaScript:history.back(-1)">点击返回</a>--}}
    <INPUT onclick="history.go(-1)" type="button" value="返回" style="background:red ; color:white; height: 45px;width: 90px;font-size: 20px;border-radius: 20px">
@endsection