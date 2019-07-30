<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/25
 * Time: 16:48
 */

namespace app\api\validate;


class TokenGet extends BaseVlidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty'
    ];

}