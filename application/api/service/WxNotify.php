<?php
/**
 * Author: Luoaotian
 * Date: 2019/8/1
 * Time: 16:34
 */

namespace app\api\service;

use app\api\model\Order as OrderModel;
use app\api\model\Product;
use app\api\service\Order as OrderService;
use app\lib\enum\OrderStatusEnum;
use think\Db;
use think\Exception;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay',EXTEND_PATH,'.Api.php');
class WxNotify extends \WxPayNotify
{
    public function NotifyProcess($data, &$msg)
    {
        if ($data['result_code'] == 'SUCCESS'){
            $orderNO = $data['out_tarde_no'];
            Db::startTrans();
            try{
                $order = OrderModel::where('order_no',$orderNO)->lock(true)->find();
                if ($order->status == OrderStatusEnum::UNPAID){
                    $service = new OrderService();
                    $stockStatus = $service->checkOrderStock($order->id);
                    if($stockStatus['pass']){
                        $this->updateOrderStatus($order->id,true);
                        $this->reduceStock($stockStatus);
                    }
                    else{
                        $this->updateOrderStatus($order->id,false);
                    }
                }
                Db::commit();
                return true;
            }
            catch (Exception $ex){
                Db::rollback();
                Log::error($ex);
                return false;
            }
        }
        else{
            return true;
        }
    }

    private function updateOrderStatus($orderID,$success)
    {
        $status = $success ? OrderStatusEnum::PAID : OrderStatusEnum::PAID_BUT_OUT_OF;
        OrderModel::where('id',$orderID)->update(['status'=> $status]);
    }

    private function reduceStock($stockStatus)
    {
        foreach ($stockStatus['pStatusArray'] as $singlePStatus){
            Product::where('id',$singlePStatus['id'])->setDec('stock',$singlePStatus['count']);
        }
    }
}