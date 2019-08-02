<?php
/**
 * Author: Luoaotian
 * Date: 2019/7/30
 * Time: 15:35
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $errorCode = 80000;
    public $msg = "订单不存在，请检查ID";
}