<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/16
 * Time: 16:48
 */

namespace app\api\validate;

class IDMustBePositiveInt extends BaseVlidate
{
    protected $rule = [
        'id' => 'require|isPositiveInteger',
    ];
}