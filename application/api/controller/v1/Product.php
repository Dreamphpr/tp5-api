<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/25
 * Time: 10:59
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\api\validate\IDMustBePositiveInt;

class Product
{
    public function getRecent($count=15)
    {
        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);

        if (!$products ) {
            throw new MissException([
                'msg' => '请求product不存在',
                'errorCode' => 40000
            ]);
        }
        return $products;
    }

    public function getAllInCategory($id)
    {
        (new IDMustBePositiveInt())->goCheck();

        $products = ProductModel::getProductByCategoryID($id);

        if (!$products ) {
            throw new MissException([
                'msg' => '请求product不存在',
                'errorCode' => 40000
            ]);
        }
        return $products;

    }

    public function getOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();

        $product = ProductModel::getProductDetail($id);

        if(!$product){

        }
        return $product;
    }
}