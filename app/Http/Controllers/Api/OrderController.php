<?php

namespace App\Http\Controllers\Api;

use App\Models\Addres;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Shop;

use EasyWeChat\Foundation\Application;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mrgoon\AliSms\AliSms;

class OrderController extends BaseController
{
    public function add(Request $request)
    {
        // 查出收货地址
        $address = Addres::find($request->post('address_id'));
        //dd($address->detail_address);
        // 判断地址是否有误
        if ($address === null) {
            return [
                'status' => "false",
                'message' => "地址有误",
            ];
        }
        // 用户id
        $member = Member::find($request->post('user_id'));
        // dd($member->id);
        // 购物车
        $carts = Cart::where("member_id", $member->id)->get();
        //dd($carts);
        // 找出购物车第一条商品的id  通过商品id找shop_id
        $shopId = Menu::find($carts[0]->goodsList)->shop_id;
        $data['member_id'] = $member->id;
        $data['shop_id'] = $shopId;
        //dd($data['shop_id']);

        # 订单号生成
        $data['order_code'] = date("ymdHis", time() + 8 * 60 * 60) . rand(1000, 9999);
        //dd($data['order_code']);
        # 地址
        $data['address_id'] = $address->id;
        $data['provence'] = $address->provence;
        //dd($data['provence']);
        $data['city'] = $address->city;
        $data['county'] = $address->area;
        $data['tel'] = $address->tel;
        $data['name'] = $address->name;
        $data['detail_address'] = $address->detail_address;
        //dd($data['detail_address']);

        # 总价
        $total = 0;
        foreach ($carts as $k => $cart) {
            $good = Menu::where("id", $cart->goodsList)->first();
            //dd($good);
            //算总价
            $total += $cart->goodsCount * $good->goods_price;
        }
        $data['total'] = $total;
        //dd( $data['order_price']);

        # 状态 等待支付
        $data['status'] = 0;

        # 事务
        //启动事务
        DB::beginTransaction();
        try {
            // 订单入库
            $order = Order::create($data);
            //dd($order);
            // 订单商品
            foreach ($carts as $k=>$cart){
                // 得到当前菜品
                $menu = Menu::find($cart->goodsList);
                // 判断库存是否充足
                if ($cart->goodsCount > $menu->stock){
                    // 抛出异常
                    throw new \Exception($menu->goods_name."库存不足");
                }
                // 减去库存
                $menu->stock = $menu->stock - $cart->goodsCount;
                // 保存
                $menu->save();

                OrderDetail::insert([
                    'order_id'=>$order->id,
                    'goods_id'=>$cart->goodsList,
                    'amount'=>$cart->goodsCount,
                    'goods_name'=>$menu->goods_name,
                    'goods_img'=>$menu->goods_img,
                    'goods_price'=>$menu->goods_price,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'shop_id' =>$order->shop_id,
                ]);
            }
            // 清空购物车
            Cart::where("member_id", $member->id)->delete();
            // 提交事务
            DB::commit();
        }catch (\Exception $exception){
            //回滚
            DB::rollBack();
            return [
                "status" => "false",
                "message" => $exception->getMessage(),
            ];
        }
        //dd($order);
        return [
            "status" => "true",
            "message" => "添加成功",
            "order_id" => $order->id
        ];
    }

    # 订单详情
    public function detail(Request $request){
        // 找到订单id
        $order = Order::find($request->get('id'));
//        dd($order);
        $data['id'] = $order->id;
        $data['order_code'] = $order->order_code;
        $data['order_birth_time'] = (string)$order->created_at;
        $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "已完成"];
        $data['order_status'] = $arr[$order->order_status];
        $data['shop_id'] = $order->shop_id;
        //dd($data['shop_id']);
        $data['shop_name'] = $order->shop->name;
          //dd($data['shop_name']);
        $data['shop_img'] = $order->shop->img;
        $data['order_price'] = $order->total;
        $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
        $data['good_list'] = $order->orderDetail;

        return $data;

    }
/*    public function index(Request $request)
    {
        $userId = $request->post('user_id');
        $orders =Order::where("member_id",$userId)->get();
        $datas =[];
        foreach ($orders as $order){
            $data['id'] = $order->id;
            $data['order_code'] = $order->order_code;
            $data['order_birth_time'] = (string)$order->created_at;
            $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "已完成"];
            $data['order_status'] = $arr[$order->order_status];
            $data['shop_id'] = (string)$order->shop_id;
            $data['shop_name'] = $order->shop->name;
            $data['shop_img'] = $order->shop->img;
            $data['order_price'] = $order->total;
            $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
            $data['goods_list'] = $order->orderDetail;
            $datas[] = $data;
        }
        return $datas;
    }*/
    # 订单列表
    public function index(Request $request){
        // 当前用户下的order
        $orders = Order::where("member_id",$request->input("user_id"))->get();
        //dd($orders->toArray());
        $d = [];
        foreach ($orders as $order){
            $data['id'] = $order->id;
            $data['order_code'] = $order->order_code;
            $data['order_birth_time'] = (string)$order->created_at;
            $arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "已完成"];
            $data['order_status'] = $arr[$order->order_status];
            $data['shop_id'] = $order->shop_id;
            //dd($data['shop_id']);
            $data['shop_name'] = $order->shop->name;
            //dd($data['shop_name']);
            $data['shop_img'] = env("ALIYUN_OSS_URL") .$order->shop->img;
            //dd($data['shop_img']);
            $data['goods_list'] = $order->orderDetail;
            //dd($data['good_list']->toArray());
            $data['order_price'] = $order->total;
            $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;

            $d[] = $data;
            //dd($d);
        }
        return $d;
    }

    # 订单支付
    public function pay(Request $request){
        // 得到当前订单id
        $order = Order::find($request->get('id'));
        //dd($order->total);
        //dd($order->order_code);
        $member = Member::find($order->member_id);
        $shop = Shop::find($order->shop_id);
        //dd($shop->user->email);
        //$money = $order->member->money;
       //dd($member->toArray());
        //dd($member->tel);
        //判断钱够不够
        if ($order->total > $member->money){
            return [
              'status' => 'false',
                'message'=> "余额不足请充值",
            ];
        }
        DB::transaction(function () use ($member,$order){
            // 否则扣钱
            $member->money = $member->money - $order->total;
            //dd($member->money );
            $member->save();
            // 更改订单状态
            $order->order_status = 1;
            $order->save();
        });


        $orderCode = $order->order_code;//订单号
        //dd($orderCode);
        $tole = $order->total;//金额
        $name = $order->name;//收货人
        $tel = $order->tel;//电话
        $address = $order->provence . $order->city . $order->area . $order->detail_address;//地址
        //dd($address);
        $to = $shop->user->email;//收件人
        $subject = '新订单通知';//邮件标题
        \Illuminate\Support\Facades\Mail::send(
            'email.order',
            compact("orderCode","tole","name","tel","address"),
            function ($message) use($to, $subject) {
                $message->to($to)->subject($subject);
            });

        $tel = $member->tel;
        //dd($tel);
        $stel = $order->tel;
        $name = $order ->name;
        $config = [
            'access_key' => "LTAI5ccKNuSmXG1z",//appID
            'access_secret' => "K4udFHYu1sSkJ9SZsLCvWIOIy5fwAB",// appKey
            'sign_name' => "别闹好好学",// 签名
        ];

        $sms = new AliSms();
        //$response = $sms->sendSms('phone number', 'tempplate code', ['name'=> 'value in your template'], $config);
        $response = $sms->sendSms($tel, 'SMS_150575498', ['consignee'=> $name,'number'=>$stel], $config);// 'code' 是模板里的 $code 是上面是生成的
        //dd($response);

        if ($response){
            return [
                'status' => 'true',
                'message'=>"支付成功"
            ];
        }

    }

    # 微信支付
    public function wxPay(){

        //订单ID
        $id = \request()->get("id");
//把订单找出来
        $orderModel = Order::find($id);
        //0.配置
        $options = config("wechat");
        //dd($options);
        $app = new Application($options);

        $payment = $app->payment;
        //1.生成订单
        $attributes = [
            'trade_type' => 'NATIVE', // JSAPI，NATIVE，APP...
            'body' => '猪猪点餐平台支付',
            'detail' => '猪猪点餐平台支付~~',
            'out_trade_no' => $orderModel->order_code,
            'total_fee' => $orderModel->total * 100, // 单位：分
            'notify_url' => 'http://www.yg6666.cn/api/order/ok', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            // 'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];

        $order = new \EasyWeChat\Payment\Order($attributes);

        //2. 统计下单

        $result = $payment->prepare($order);
        //   dd($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS') {
            //2.1 拿到预支付链接
            $codeUrl = $result->code_url;


            $qrCode = new QrCode($codeUrl);

            $qrCode->setSize(250);//大小
// Set advanced options
            $qrCode
                ->setMargin(10)//外边框
                ->setEncoding('UTF-8')//编码
                ->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH)//容错级别
                ->setForegroundColor(['r' => 99, 'g' => 100, 'b' => 255])//码颜色
                ->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255])//背景色
                ->setLabel('微信扫码支付', 16, public_path("fonts/msyh.ttc"), LabelAlignment::CENTER)
                ->setLogoPath(public_path("images/zz.png"))//LOGO
                ->setLogoWidth(80);//LOGO大小

// Directly output the QR code
            header('Content-Type: ' . $qrCode->getContentType());//响应类型
            exit($qrCode->writeString());


        } else {
            return $result;
        }
    }


    # 微信异步t通知
    public function ok()
    {
        //0.配置
        $options = config("wechat");
        //dd($options);
        $app = new Application($options);
        //1.回调
        $response = $app->payment->handleNotify(function ($notify, $successful) {
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            // $order = 查询订单($notify->out_trade_no);
            $order=Order::where("order_code",$notify->out_trade_no)->first();

            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status==1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }

            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                //$order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 1;
            }

            $order->save(); // 保存订单

            return true; // 返回处理完成
        });

        return $response;
    }

    # 订单状态
    public function status(){
            $id = \request()->get("id");

            $order = Order::find($id);

            return $order;

        }


}
