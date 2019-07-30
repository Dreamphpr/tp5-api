<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/25
 * Time: 16:46
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{
    public function getToken($code='')
    {
        (new TokenGet())->goCheck();

        $UserToken = new UserToken();

        $token = $UserToken->get($code);
        return [
            'token' => $token
        ];

    }
}