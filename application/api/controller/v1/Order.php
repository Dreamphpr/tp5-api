<?php
/**
 * Author: Luoaotian
 * Date: 2019/7/30
 * Time: 10:37
 */

namespace app\api\controller\v1;

use app\api\model\Order as OrderModel;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\OrderPlace;
use app\api\validate\PagingParameter;
use app\lib\exception\OrderException;
use think\Controller;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;
class Order extends Controller
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder'],
        'checkPrimaryScope' => ['only' => 'getSummaryByUser'],
        'checkPrimaryScope' => ['only' => 'getDetail']
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

    public function getDetail($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $orderDetail = OrderModel::get($id);
        if(!$orderDetail){
            throw new OrderException();
        }
        return $orderDetail->hidden(['prepay_id']);
    }
    public function getSummaryByUser($page=1,$size=15)
    {
        (new PagingParameter())->goCheck();
        $uid = TokenService::getCurrentUid();
        $pagingOrder = OrderModel::getSummaryByUser($uid,$page,$size);
        if($pagingOrder->isEmpty()){
            return [
                'data' => [],
                'current_page' => $pagingOrder->getCurrentPage()

            ];
        }

        $data = $pagingOrder->hidden(['snap_items','snap_address','prepay_id'])->toArray();


        return [
            'data' => $data,
            'current_page' => $pagingOrder->getCurrentPage()
        ];

    }
}