<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/17
 * Time: 9:25
 */

namespace app\api\validate;

use think\exception\ErrorException;
use think\Request;
use think\Validate;

class BaseVlidate extends Validate
{
    public function goCheck()
    {
        //获取http传入参数
        //对参数校验
        $request = Request::instance();
        $params = $request->param();
        $result = $this->check($params);
        if (!$result){
            $erron = $this->error();
            throw new ErrorException($erron);
        }
        else{
            return true;
        }
    }
}