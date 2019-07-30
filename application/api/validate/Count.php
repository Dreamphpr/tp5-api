<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/25
 * Time: 14:06
 */

namespace app\api\validate;


class Count extends BaseVlidate
{
    protected $rule =[
        'count' => 'isPositiveInteger|between:1,15'
    ];

    protected $message=[
        'count' => 'count是1-15正整数'
    ];
}