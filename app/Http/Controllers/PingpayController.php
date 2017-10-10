<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/9
 * Time: 14:42
 */
//文件名 pingxx_my_model.php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

require_once('../vendor/pingpp-php/init.php');

define('APP_ID', "app_0Oyfn5SOevHO1qnX");   //配置应用id

define('APP_KEY', "sk_test_8uTifL8KmvDGqTiHKG5ebvzL");  //配置应用秘钥(test)
//define('APP_KEY', "sk_live_e1uzr1vX5uPG8OebnD0qLGOC");  //配置应用秘钥(live)
class PingpayController extends Controller
{
    private $channel_supported = array(  //支持的支付渠道
        'alipay', 'wx', 'alipay_wap', 'alipay_pc_direct'
    );

    //创建charge对象
    public function create_charge($channel, $amount, $order_no, $extra=array(), $description='', $subject ='', $body=''){
        /*----检查参数格式----*/
        if (!in_array($channel, $this->channel_supported)){
            return array(
                'code' => 0,
                'data' => array(
                    'error_message' => 'channel "'.$channel.'" has not been supported yet'
                )
            );
        }
        if ( $amount<=0 ){
            return array(
                'code' => 0,
                'data' => array(
                    'error_message' => 'amount format invalid'
                )
            );
        }
        if (!preg_match('/^[0-9a-zA-Z]+$/',$order_no)){
            return array(
                'code' => 0,
                'data' => array(
                    'error_message' => 'order_no can`t contain special characters'
                )
            );
        }

        /*----调用下单api----*/
        \Pingpp\Pingpp::setApiKey(APP_KEY);// 设置 API Key
        \Pingpp\Pingpp::setPrivateKeyPath('../vendor/pingpp-php/private_key.pem');
        try {
            $charge = \Pingpp\Charge::create(
                array(
                    //请求参数字段规则，请参考 API 文档：https://www.pingxx.com/api#api-c-new
                    'subject'   => $subject ? $subject : 'Your Subject',
                    'body'      => $body ? $body : 'Your Body',
                    'amount'    => $amount,//订单总金额, 人民币单位：分（如订单总金额为 1 元，此处请填 100）
                    'order_no'  => $order_no,// 推荐使用 8-20 位，要求数字或字母，不允许其他字符
                    'currency'  => 'cny',
                    'extra'     => $extra,
                    'channel'   => $channel,// 支付使用的第三方支付渠道取值，请参考：https://www.pingxx.com/api#api-c-new
                    'client_ip' => \Request::ip(),// 发起支付请求客户端的 IP 地址，格式为 IPV4，如: 127.0.0.1
                    'app'       => array('id' => APP_ID),
                    'description' => $description
                )
            );
        } catch (\Pingpp\Error\Base $e) {
            // 捕获报错信息
            if ($e->getHttpStatus() != NULL) {
                $data = array(
                    'code' => 0,
                    'data' => array(
                        'error_message' => $e->getHttpBody()
                    )
                );
            } else {
                $data = array(
                    'code' => 0,
                    'data' => array(
                        'error_message' => $e->getMessage()
                    )
                );
            }
            return $data;
        }
        return array(
            'code' => 1,
            'data' => array(
                'charge' => json_decode($charge, true)
            )
        );
    }

    public function initPay(Request $request)
    {
        $data = $request->input();
        if(empty($data['code']) && $data['channel'] == 'alipay_pc_direct'){
            $order_no = date('YmdHis') . (microtime(true) % 1) * 1000 . mt_rand(0, 9999).uniqid();
            $extra = [
                'success_url' => 'http://www.sw2025.com/pingsuccess',
            ];
            $result = $this->create_charge($data['channel'], $data['amount'], $order_no, $extra, $description='', $data['subject'], $data['body']);
            return $result;
        } elseif(empty($data['code']) && $data['channel'] == 'wx_pub_qr'){

        }
//        $data = $request->input();
//
//        \Pingpp\Pingpp::setApiKey('sk_live_e1uzr1vX5uPG8OebnD0qLGOC');
//        \Pingpp\Pingpp::setPrivateKeyPath('../vendor/pingpp-php/private_key.pem');
//        $arr =  array(
//            'order_no'  => '2312553123',
//            'app'       => array('id' => 'app_0Oyfn5SOevHO1qnX'),
//            'channel'   => $data['type'],
//            'amount'    => $data['number'],
//            'client_ip' => '127.0.0.1',
//            'currency'  => 'cny',
//            'subject'   => '升维网办事费用',
//            'body'      => 'Your Body',
//        );
//        if($data['type'] == 'wx_pub_qr'){
//            $arr['extra'] = array('product_id' => 'myproid');
//
//        } elseif($data['type'] == 'alipay_pc_direct'){
//            $arr['extra'] = array('success_url' => 'http://www.sw2025.com/pingsuccess');
//        }
//        $ch = \Pingpp\Charge::create($arr);
//        if($data['type'] == 'wx_pub_qr'){
//            /**
//             * google api 二维码生成【QRcode可以存储最多4296个字母数字类型的任意文本，具体可以查看二维码数据格式】
//             * @param string $chl 二维码包含的信息，可以是数字、字符、二进制信息、汉字。
//            不能混合数据类型，数据必须经过UTF-8 URL-encoded
//             * @param int $widhtHeight 生成二维码的尺寸设置
//             * @param string $EC_level 可选纠错级别，QR码支持四个等级纠错，用来恢复丢失的、读错的、模糊的、数据。
//             * L-默认：可以识别已损失的7%的数据
//             * M-可以识别已损失15%的数据
//             * Q-可以识别已损失25%的数据
//             * H-可以识别已损失30%的数据
//             * @param int $margin 生成的二维码离图片边框的距离
//             */
//            $chl=$ch->credential['wx_pub_qr'];
//            $margin='0';
//            $EC_level='L';
//            $widhtHeight ='150';
//            $chl = urlencode($chl);
//            return array('charge' => '<img src="http://chart.apis.google.com/chart?chs='.$widhtHeight.'x'.$widhtHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.'&chl='.$chl.'" alt="QR code" widhtHeight="'.$widhtHeight.'" widhtHeight="'.$widhtHeight.'"/>');
//        }
//        return  array('charge' => json_decode($ch, true));

    }

    public function pingSuccess(Request $request)
    {

        dd($request->input());
    }

    //查询charge对象
    public function check_charge($id){
        /*----调用查询api----*/
        \Pingpp\Pingpp::setApiKey(APP_KEY);// 设置 API Key
        try {
            $charge = \Pingpp\Charge::retrieve($id);
            return array(
                'code' => 1,
                'data' => array(
                    'charge' => $charge
                )
            );
        } catch (\Pingpp\Error\Base $e) {
            // 捕获报错信息
            if ($e->getHttpStatus() != NULL) {
                $data = array(
                    'code' => 0,
                    'data' => array(
                        'error_message' => $e->getHttpBody()
                    )
                );
            } else {
                $data = array(
                    'code' => 0,
                    'data' => array(
                        'error_message' => $e->getMessage()
                    )
                );
            }
            return $data;
        }
    }

    //Webhooks回调
    public function Webhooks(){
        \Pingpp\Pingpp::setApiKey(APP_KEY);// 设置 API Key
        $row_data = file_get_contents('php://input');

        //从头信息获取签名
        $headers = \Pingpp\Util\Util::getRequestHeaders();
        $signature = isset($headers['X-Pingplusplus-Signature']) ? $headers['X-Pingplusplus-Signature'] : NULL;

        //验证签名
        $pub_key_path =  "../vendor/pingpp-php/webhook_public_key.pem"; //Ping++ 公钥
        $pub_key_contents = file_get_contents($pub_key_path);
        $verify_result = openssl_verify($row_data, base64_decode($signature), $pub_key_contents, 'sha256');

        if (!$verify_result){
            return array(
                'code' => 0,
                'data' => array(
                    'error_message' => 'signature verify fail',
                    'event' => $row_data
                ),
            );
        } else{
            return array(
                'code' => 1,
                'data' => array(
                    'event' => $row_data
                ),
            );
        }
    }

    //批量转账
    public function Batch_transfer($batch_no, $description, $recipients){
        /*----检查参数格式----*/
        if (is_array($recipients) && !empty($recipients)){
            $amount = 0;
            $recipient_array = array();
            foreach ($recipients as $item){
                if (isset($item['account']) && $item['account'] && isset($item['amount']) && $item['amount'] && isset($item['name']) && $item['name']){
                    $recipient_array[] = $item;
                    $amount += $item['amount'];
                }
            }
        } else{
            return array(
                'code' => 0,
                'data' => 'invalid $recipients'
            );
        }

        \Pingpp\Pingpp::setApiKey(APP_KEY);// 设置 API Key
        \Pingpp\Pingpp::setPrivateKeyPath( __DIR__ . "/certs/your_rsa_private_key.pem");
        try {
            $batch_transfer = \Pingpp\Batch_transfer::create(
                array(
                    'batch_no'  => $batch_no,
                    'channel'   => 'alipay',
                    'app'       => APP_ID,
                    'amount'    => $amount,//订单总金额, 人民币单位：分（如订单总金额为 1 元，此处请填 100）
                    'currency'  => 'cny',
                    'description' => $description,
                    'type' => 'b2c',
                    'recipients' => $recipient_array,
                )
            );
            return array(
                'code' => 1,
                'data' => array(
                    'batch_transfer' => $batch_transfer
                )
            );

        } catch (\Pingpp\Error\Base $e) {
            // 捕获报错信息
            if ($e->getHttpStatus() != NULL) {
                $data = array(
                    'code' => 0,
                    'data' => array(
                        'error_message' => $e->getHttpBody()
                    )
                );
            } else {
                $data = array(
                    'code' => 0,
                    'data' => array(
                        'error_message' => $e->getMessage()
                    )
                );
            }
            return $data;
        }
    }
}



