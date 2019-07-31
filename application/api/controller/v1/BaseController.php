<?php
/**
 * Author: Luoaotian
 * Date: 2019/7/30
 * Time: 14:30
 */

namespace app\api\controller\v1;

use app\api\service\Token as TokenService;
use think\Controller;

class BaseController extends Controller
{
    public function checkPrimaryScope()
    {
        TokenService::needPrimaryScope();

    }

    public function checkExclusiveScope()
    {
        TokenService::needExclusiveScope();

    }

}