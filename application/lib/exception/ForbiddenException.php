<?php
/**
 * Author: Luoaotian
 * Date: 2019/7/30
 * Time: 10:25
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = 10001;
}