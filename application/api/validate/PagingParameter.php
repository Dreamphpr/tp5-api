<?php
/**
 * Author: Luoaotian
 * Date: 2019/8/2
 * Time: 14:39
 */

namespace app\api\validate;


class PagingParameter extends BaseVlidate
{
    protected $rule = [
        'page' => 'isPositiveInteger',
        'size' => 'isPositiveInteger'
    ];

    protected $message = [
        'page' => '分页参数必须是正整数',
        'size' => '分页参数必须是正整数'
    ];
}