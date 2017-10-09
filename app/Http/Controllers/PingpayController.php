<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/10/9
 * Time: 14:42
 */


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PingpayController extends Controller
{
    public function initPay(Request $request)
    {
        $data = $request->input();
        require_once('../vendor/pingpp-php/init.php');
        \Pingpp\Pingpp::setApiKey('sk_live_e1uzr1vX5uPG8OebnD0qLGOC');
        \Pingpp\Pingpp::setPrivateKeyPath('../vendor/pingpp-php/private_key.pem');
        $arr =  array(
            'order_no'  => '2312553123',
            'app'       => array('id' => 'app_0Oyfn5SOevHO1qnX'),
            'channel'   => $data['type'],
            'amount'    => $data['number'],
            'client_ip' => '127.0.0.1',
            'currency'  => 'cny',
            'subject'   => '升维网办事费用',
            'body'      => 'Your Body',
        );
        if($data['type'] == 'wx_pub_qr'){
            $arr['extra'] = array('product_id' => 'myproid');

        } elseif($data['type'] == 'alipay_pc_direct'){
            $arr['extra'] = array('success_url' => 'http://www.sw2025.com/pingsuccess');
        }
        $ch = \Pingpp\Charge::create($arr);
        if($data['type'] == 'wx_pub_qr'){
            /**
             * google api 二维码生成【QRcode可以存储最多4296个字母数字类型的任意文本，具体可以查看二维码数据格式】
             * @param string $chl 二维码包含的信息，可以是数字、字符、二进制信息、汉字。
            不能混合数据类型，数据必须经过UTF-8 URL-encoded
             * @param int $widhtHeight 生成二维码的尺寸设置
             * @param string $EC_level 可选纠错级别，QR码支持四个等级纠错，用来恢复丢失的、读错的、模糊的、数据。
             * L-默认：可以识别已损失的7%的数据
             * M-可以识别已损失15%的数据
             * Q-可以识别已损失25%的数据
             * H-可以识别已损失30%的数据
             * @param int $margin 生成的二维码离图片边框的距离
             */
            $chl=$ch->credential['wx_pub_qr'];
            $margin='0';
            $EC_level='L';
            $widhtHeight ='150';
            $chl = urlencode($chl);
            return array('charge' => '<img src="http://chart.apis.google.com/chart?chs='.$widhtHeight.'x'.$widhtHeight.'&cht=qr&chld='.$EC_level.'|'.$margin.'&chl='.$chl.'" alt="QR code" widhtHeight="'.$widhtHeight.'" widhtHeight="'.$widhtHeight.'"/>');
        }
        return  array('charge' => json_decode($ch, true));

    }

    public function pingSuccess(Request $request)
    {

        dd($request->input());
    }
}
