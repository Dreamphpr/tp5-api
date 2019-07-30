<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/25
 * Time: 14:38
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;

class Category
{
    public function getAllCategories()
    {
        $categories = CategoryModel::all([],'img');
        if(!$categories){
            throw new MissException([
                'msg' => '请求分类不存在',
                'errorCode' => 40000
            ]);
        }
        return $categories;
    }
}