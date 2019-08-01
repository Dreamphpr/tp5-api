<?php
/**
 * Author: Luoaotian
 * Date: 2019/7/30
 * Time: 14:41
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;

class OrderPlace extends BaseVlidate
{
    protected $rule = [
        'products' => 'checkProducts'
    ];

    protected $singleRule = [
        'product_id' => 'require|isPositiveInteger',
        'count' => 'require|isPositiveInteger',
    ];
    protected function checkProducts($values)
    {
        if(!is_array($values)){
            throw new ParameterException([
               'msg' => '商品参数不正确'
            ]);
        }
        if(empty($values)){
            throw new ParameterException([
                'msg' => '商品列表不能为空'
            ]);
        }

        foreach ($values as $value){
            $this->checkProduct($value);
        }

        return true;

    }

    protected function checkProduct($value)
    {
        $validate = new BaseVlidate($this->singleRule);
        $result = $validate->check($value);
        if(!$result){
            throw new ParameterException([
               'msg' => '商品列表参数错误'
            ]);
        }
    }
}