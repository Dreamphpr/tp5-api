<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/24
 * Time: 16:29
 */

namespace app\api\validate;


class IDCollection extends BaseVlidate
{
    protected $rule = [
        'ids' => 'require|checkIDs'
    ];

    protected $message = [
        'ids' => 'ids参数必须是以逗号分隔的多个正整数'
    ];
}