<?php
/**
 * Author: Luoaotian
 * Date: 2019/7/26
 * Time: 14:04
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $errorCode = 10000;
    public $msg = "Token过期或无效Token";
}