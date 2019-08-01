<?php
/**
 * Author: Luoaotian
 * Date: 2019/7/26
 * Time: 10:52
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token
{
    //生成token
    public static function generateToken()
    {
        $randChars = getRandChar(32);
        $timestamp = $_SERVER['REQUEST_TIME'];
        $salt = config('secure.token_salt');

        return md5($randChars.$timestamp.$salt);

    }

    //获取token里的值
    public static function getCurrentTokenVar($key)
    {
        $token = Request::instance()->header('token');
        $vars = Cache::get($token);
        if(!$vars){
            throw new TokenException();
        }
        else{
            if(!is_array($vars)){
                $vars  = json_decode($vars,true);
            }
            if(array_key_exists($key,$vars)){
                return $vars[$key];
            }
            else{
                throw new Exception('获取的Token变量并不存在');
            }
        }
    }

    //获取token里的uid
    public static function getCurrentUid()
    {
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }

    //用户或管理员访问权限
    public static function needPrimaryScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if($scope){
            if($scope >= ScopeEnum::User){
                return true;
            }
            else{
                throw new ForbiddenException();
            }
        }
        else{
            throw new TokenException();
        }
    }

    //只有用户访问权限
    public function needExclusiveScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if($scope){
            if($scope == ScopeEnum::User){
                return true;
            }
            else{
                throw new ForbiddenException();
            }
        }
        else{
            throw new TokenException();
        }

    }

    //
    public static function isValidOperate($checkUID)
    {
        if(!$checkUID){
            throw new Exception('检查UID时必须传入一个被检查的UID');
        }
        $uid = self::getCurrentUid();
        if($uid == $checkUID){
            return true;
        }
        return false;
    }
}