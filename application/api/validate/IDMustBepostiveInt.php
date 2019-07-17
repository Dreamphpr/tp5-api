<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/16
 * Time: 16:48
 */

namespace app\api\validate;

class IDMustBepostiveInt extends BaseVlidate
{
    protected $rule =[
        'id' => 'require|isPostiveIntager'
    ];

    protected function isPostiveIntager($value,$rule='',$data='',$field='')
    {
        if (is_numeric($value) && is_int($value + 0) && is_int($value + 0) >0) {
            return true;
        }
        else{
            return $field.'必须是正整数';
        }
    }
}