<?php
/**
 * Author: Luoaotian
 * Date: 2019/7/29
 * Time: 14:55
 */

namespace app\lib\exception;


class UserException extends BaseException
{
    public $code = 404;
    public $errorCode = 60000;
    public $msg = "用户不存在";
}