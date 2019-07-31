<?php
/**
 * Author: Luoaotian
 * Date: 2019/7/31
 * Time: 14:55
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;

class Pay extends BaseController
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'getPreOrder']
    ];

    //生成微信支付预订单
    public function getPreOrder($id='')
    {
        (new IDMustBePositiveInt())->goCheck();

    }
}