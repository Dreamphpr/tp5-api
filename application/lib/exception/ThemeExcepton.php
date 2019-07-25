<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/25
 * Time: 9:35
 */

namespace app\lib\exception;


class ThemeExcepton extends BaseException
{
    public $code = 404;
    public $errorCode = 30000;
    public $msg = "指定的主题不存在，请检查主题ID";
}