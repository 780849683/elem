
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

               {{-- <div class="form-group">
                    <label for="start_send">店铺图片：</label>
                    <input type="file" name="img" class="form-control" size="35" >
                </div>--}}

                <div class="form-group">
                    <label>图片</label>

                    <input type="text" name="img" value="{{$shop->img}}" id="logo">
                    <!--dom结构部分-->
                    <div id="uploader-demo">
                        <!--用来存放item-->
                        <div id="fileList" class="uploader-list"></div>
                        <div id="filePicker">选择图片</div>
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
                            <input type="checkbox" name="brand" value="1"  @if($shop->brand) checked @endif> 品牌连锁店
                        </label>


                        <label>
                            <input type="checkbox" name="time" value="1" @if($shop->time) checked @endif> 准时送达
                        </label>

                        <label>
                            <input type="checkbox" name="fengniao" value="1" @if($shop->fengniao)==1) checked @endif> 蜂鸟配送
                        </label>

                        <label>
                            <input type="checkbox" name="bao" value="0" @if($shop->bao == 1) checked @endif> 保
                        </label>

                        <label>
                            <input type="checkbox" name="piao" value="1"  @if($shop->piao) checked @endif> 票
                        </label>



                        {{--<label>
                            <input type="checkbox" name="zhun" value="1" @if($shop->zhun) checked @endif> 准
                        </label>--}}
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

 @section("js")
     <script>
         // 图片上传demo
         jQuery(function () {
             var $ = jQuery,
                 $list = $('#fileList'),
                 // 优化retina, 在retina下这个值是2
                 ratio = window.devicePixelRatio || 1,

                 // 缩略图大小
                 thumbnailWidth = 100 * ratio,
                 thumbnailHeight = 100 * ratio,

                 // Web Uploader实例
                 uploader;

             // 初始化Web Uploader
             uploader = WebUploader.create({

                 // 自动上传。
                 auto: true,

                 formData: {
                     // 这里的token是外部生成的长期有效的，如果把token写死，是可以上传的。
                     _token:'{{csrf_token()}}'
                 },


                 // swf文件路径
                 swf: '/webuploader/Uploader.swf',

                 // 文件接收服务端。
                 server: '{{route("shop.shop.upload")}}',

                 // 选择文件的按钮。可选。
                 // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                 pick: '#filePicker',

                 // 只允许选择文件，可选。
                 accept: {
                     title: 'Images',
                     extensions: 'gif,jpg,jpeg,bmp,png',
                     mimeTypes: 'image/*'
                 }
             });

             // 当有文件添加进来的时候
             uploader.on('fileQueued', function (file) {
                 var $li = $(
                     '<div id="' + file.id + '" class="file-item thumbnail">' +
                     '<img>' +
                     '<div class="info">' + file.name + '</div>' +
                     '</div>'
                     ),
                     $img = $li.find('img');

                 $list.html($li);

                 // 创建缩略图
                 uploader.makeThumb(file, function (error, src) {
                     if (error) {
                         $img.replaceWith('<span>不能预览</span>');
                         return;
                     }

                     $img.attr('src', src);
                 }, thumbnailWidth, thumbnailHeight);
             });

             // 文件上传过程中创建进度条实时显示。
             uploader.on('uploadProgress', function (file, percentage) {
                 var $li = $('#' + file.id),
                     $percent = $li.find('.progress span');

                 // 避免重复创建
                 if (!$percent.length) {
                     $percent = $('<p class="progress"><span></span></p>')
                         .appendTo($li)
                         .find('span');
                 }

                 $percent.css('width', percentage * 100 + '%');
             });

             // 文件上传成功，给item添加成功class, 用样式标记上传成功。
             uploader.on('uploadSuccess', function (file,data) {
                 $('#' + file.id).addClass('upload-state-done');
                 console.dir(data);
                 $("#logo").val(data.url);
             });

             // 文件上传失败，现实上传出错。
             uploader.on('uploadError', function (file) {
                 var $li = $('#' + file.id),
                     $error = $li.find('div.error');

                 // 避免重复创建
                 if (!$error.length) {
                     $error = $('<div class="error"></div>').appendTo($li);
                 }

                 $error.text('上传失败');
             });

             // 完成上传完了，成功或者失败，先删除进度条。
             uploader.on('uploadComplete', function (file) {
                 $('#' + file.id).find('.progress').remove();
             });
         });
     </script>
 @stop