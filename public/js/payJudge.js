/**
 * Created by admin on 2018/3/7.
 */
function callPingPay(data){
    $.ajax({
        url:"/charge",
        data:data,
        dateType:"json",
        type:"POST",
        success:function(res){
            var charge =JSON.parse(res);

            console.log(charge);
            $('#code').empty();
            if(charge.credential.wx_pub_qr){
                var qrcode = new QRCode('code', {
                    text: charge.credential.wx_pub_qr,
                    width: 200,
                    height: 200,
                    colorDark : '#000000',
                    colorLight : '#ffffff',
                    correctLevel : QRCode.CorrectLevel.H
                });
                console.log(qrcode);
                if(data.channel=="wx_pub_qr"){
                    $('.poplayer').show();
                    $('.layer-pop').show();
                    $(".weixinTips").show();
                }
                return;
            }

            pingpp.createPayment(charge, function(result, err){
                console.log(result);
                console.log(err.msg);
                console.log(err.extra);
                if (result == "success") {
                    // 只有微信公众账号 wx_pub 支付成功的结果会在这里返回，其他的支付结果都会跳转到 extra 中对应的 URL。
                    layer.alert('支付成功');
                } else if (result == "fail") {
                    // charge 不正确或者微信公众账号支付失败时会在此处返回
                } else if (result == "cancel") {
                    // 微信公众账号支付取消支付
                }
            });
        }
    })

}