
 */@extends("shop.layouts.main")
@section("title","修改店铺")

@section("content")
    <div class="box box-primary">
    {{-- <div class="box-header with-border">
         <h3 class="box-title">Quick Example</h3>
     </div>--}}
    <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="box-body">

                <div class="form-group">
                    <label for="name">店铺名称：</label>
                    <input type="text" name="name" class="form-control" value="{{$shop->name }}">
                </div>
                <div class="form-group">
                    <label>店铺分类：</label>
                    <select name="cate_id" class="form-control">

                        @foreach($cates as $cate)
                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                        @endforeach
                    </select>
                </div>

                {{--<div class="form-group">--}}
                {{--<label for="logo" class="col-sm-2 control-label">店铺图片</label>--}}
                {{--<div class="col-sm-2">--}}
                {{----}}
                {{--<input type="file" name="logo" size="35">--}}

                {{--</div>--}}
                {{--</div>--}}

                <div class="form-group">
                    <label for="start_send">店铺图片：</label>
                    <input type="file" name="img" class="form-control" size="35" >
                </div>

                <div class="form-group">
                    <label for="start_send">起送金额：</label>
                    <input type="number" name="start_send" class="form-control" value="{{$shop->start_send}}">
                </div>


                <div class="form-group">
                    <label for="send_cost">配送费：</label>
                    <input type="number" name="send_cost" class="form-control" value="{{$shop->send_cost}}">
                </div>

                <div class="form-group">
                    <label for="notice">店铺公告：</label>
                    <textarea name="notice" class="form-control">{{$shop->notice}}</textarea>
                </div>
                <div class="form-group">
                    <label for="discount">优惠信息：</label>
                    <textarea name="discount" class="form-control">{{$shop->discount}}</textarea>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="brand" value="1" @if($shop->brand) checked @endif> 品牌连锁店
                        </label>


                        <label>
                            <input type="checkbox" name="time" value="1" @if($shop->time) checked @endif> 准时送达
                        </label>

                        <label>
                            <input type="checkbox" name="fengniao" value="1" @if(old('fengniao')==1) checked @endif> 蜂鸟配送
                        </label>

                        <label>
                            <input type="checkbox" name="bao" value="1" @if(old('bao')==1) checked @endif> 保
                        </label>

                        <label>
                            <input type="checkbox" name="piao" value="1" @if(old('piao')==1) checked @endif> 票
                        </label>

                        <label>
                            <input type="checkbox" name="zhun" value="1" @if(old('zhun')==1) checked @endif> 准
                        </label>
                    </div>
                </div>

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">编辑</button>
            </div>
        </form>
    </div>

@endsection