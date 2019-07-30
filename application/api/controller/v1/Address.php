<?php
/**
 * Author: Luoaotian
 * Date: 2019/7/26
 * Time: 15:32
 */

namespace app\api\controller\v1;


use app\api\model\User as UserModel;
use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use think\Controller;

class Address extends Controller
{
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
    ];

    public function checkPrimaryScope()
    {
        $scope = TokenService::getCurrentTokenVar('scope');
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
    public function createOrUpdateAddress()
    {
        $validata = new AddressNew();

        $validata->goCheck();

        $uid = TokenService::getCurrentUid();

        $user = UserModel::get($uid);

        if(!$user){
            throw new UserException();
        }

        $dataArray = $validata->getDataByRule(input('post.'));

        $userAdress = $user->address;

        if(!$userAdress){
            $user->address()->save($dataArray);
        }
        else{
            $user->address->save($dataArray);
        }
        return json(new SuccessMessage(),201);
    }
}