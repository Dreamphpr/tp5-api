<?php
/**
 * Author: Luoaotian
 * Date: 2019/7/26
 * Time: 9:46
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
    public $code = 400;
    public $errorCode = 10000;
    public $msg = "微信接口错误";
}