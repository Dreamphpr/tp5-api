<?php
/**
 * Author: Luoaotian
 * Date: 2019/7/30
 * Time: 10:37
 */

namespace app\api\controller\v1;

use app\api\validate\OrderPlace;
use think\Controller;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;
class Order extends Controller
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder']
    ];

    public function placeOrder()
    {
        (new OrderPlace())->goCheck();
        $products = input('post.products/a');
        $uid = TokenService::getCurrentUid();
        $order = new OrderService();
        $status = $order->place($uid,$products);
        return $status;
    }
}