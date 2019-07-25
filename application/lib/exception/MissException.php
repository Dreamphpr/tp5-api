<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/17
 * Time: 10:39
 */

namespace app\lib\exception;


class MissException extends BaseException
{
    public $code = 404;
    public $msg = '没有找到相应的资源';
    public $errorCode = 10001;
}