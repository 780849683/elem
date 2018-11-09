<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{route("shop.shop.index")}}" class="navbar-brand" style="color: coral" ><?php $user = Auth::user();$shop = $user->shop;echo $shop->name?></a>
            </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="">关于我们 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">帮助</a></li>
                <li><a href="{{route("shop.event.index")}}">平台活动</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">店铺管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("shop.menucate.index")}}">菜品分类管理</a></li>
                        <li><a href="{{route("shop.menu.index")}}">菜品管理</a></li>
                        <li><a href="{{route("shop.activ.index")}}">店铺活动</a></li>
                        <li><a href="{{route("shop.order.index")}}">订单管理</a></li>
                        {{--<li><a href="">日订单量</a><a href="">月订单量</a></li>--}}

                        {{--<li><a href="#">Something else here</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">One more separated link</a></li>--}}
                    </ul>
                </li>
            </ul>
            {{--<form class="navbar-form navbar-left">--}}
                {{--<div class="form-group">--}}
                    {{--<input type="text" class="form-control" placeholder="Search">--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-default">Submit</button>--}}
            {{--</form>--}}
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="">修改密码</a></li>   {{--{{route("shop.user.edit")}}--}}
                            <li><a href="">注销...</a></li>    {{--{{ route("shop.user.logout")}--}}
                        </ul>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>