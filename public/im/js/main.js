/**
 * 主要业务逻辑相关
 */
$userId=$.cookie("userId");
if($userId==undefined){
    $userId=userid2;
}

$.ajax({
    url:"/getAccid",
    data:{"userId":$userId},
    dateType:"json",
    type:"POST",
    async:false,
    success:function(res){
        if(res['code']=="success"){
            //setCookie('uid',res['accid'].toLocaleLowerCase());
            var date = new Date();
            date.setTime(date.getTime() + (120 * 60 * 1000));
           /* $.cookie("uid",res['accid'].toLocaleLowerCase(),{expires:date,path:'/',domain:'sw2025.com'});
            //自己的appkey就不用加密了
            // setCookie('sdktoken',pwd);
            //setCookie('sdktoken',res['imtoken']);
            $.cookie("sdktoken",res['imtoken'].toLocaleLowerCase(),{expires:date,path:'/',domain:'sw2025.com'});*/
            $.cookie("uid",res['accid'],{expires:date,path:'/',domain:'sw2025.com'});
            $.cookie("uid",res['accid'],{expires:date,path:'/',domain:'swchina.com'});
            //自己的appkey就不用加密了
            // setCookie('sdktoken',pwd);
            //setCookie('sdktoken',res['imtoken']);
            $.cookie("sdktoken",res['imtoken'],{expires:date,path:'/',domain:'sw2025.com'});
            $.cookie("sdktoken",res['imtoken'],{expires:date,path:'/',domain:'swchina.com'});
        }else{
            window.location.href="/login";
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
var eventId=$("#eventVideo").val();
var meetid=$("#meetid").val();
consultId=(typeof(consultId)!='undefined')?consultId:"";
eventId=(typeof(eventId)!='undefined')?eventId:"";
meetid=(typeof(meetid)!='undefined')?meetid:"";
$.ajax({
    url:"/getTeamId",
    data:{"consultId":consultId,"eventId":eventId,'meetid':meetid},
    dataType:"json",
    type:"POST",
    success:function(res){
        if(res['code']=="success"){
            console.log(res+'-------------------------------');
            yunXin.openChatBox(res['tid'],"team");
        }
    }
})
/*
yunXin.openChatBox("98094216","team");
*/


