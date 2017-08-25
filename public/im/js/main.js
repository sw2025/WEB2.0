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
            //setCookie('uid',res['accid'].toLocaleLowerCase());
            $.cookie("uid",res['accid'].toLocaleLowerCase(),{expires:2,path:'/',domain:'sw2025.com'});
            //自己的appkey就不用加密了
            // setCookie('sdktoken',pwd);
            //setCookie('sdktoken',res['imtoken']);
            $.cookie("sdktoken",res['imtoken'].toLocaleLowerCase(),{expires:2,path:'/',domain:'sw2025.com'});
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
var consultId=$("#consult").val();
$.ajax({
    url:"http://sw2025.com/getTeamId",
    data:{"consultId":consultId},
    dataType:"json",
    type:"POST",
    success:function(res){
        if(res['code']=="success"){
            yunXin.openChatBox(res['tid'],"team");
        }
    }
})
/*
yunXin.openChatBox("98094216","team");
*/


