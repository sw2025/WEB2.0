/**
 * 主要业务逻辑相关
 */
$userId=$.cookie("userId");
$.ajax({
    url:"http://sw2025.com/getAccid",
    data:{"userId":$userId},
    dateType:"json",
    type:"POST",
    async:false,
    success:function(res){
        if(res['code']=="success"){
            setCookie('uid',res['accid'].toLocaleLowerCase());
            //自己的appkey就不用加密了
            // setCookie('sdktoken',pwd);
            setCookie('sdktoken',res['imtoken']);
        }else{
            window.location.href="http://sw2025.com/login";
        }
    }
})
var userUID = readCookie("uid")
/**
 * 实例化
 * @see module/base/js
 */
var yunXin = new YX(userUID)
yunXin.openChatBox("98094216","team");


