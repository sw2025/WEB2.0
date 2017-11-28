/**
 * Created by admin on 2017/11/8.
 */

var urlpath = window.location.pathname;
var urlarr = ['/login','/register'];
function createNotification (type){
    //判断浏览器是否支持桌面通知
    //console.log($.inArray(urlpath,urlarr) === -1);
    if($.inArray(urlpath,urlarr) !== -1){
        return false;
    }
    if (window.Notification) {
        var notification = window.Notification;

        if (notification.permission == "granted") {
            //创建通知
            realTimeGetInfo(type);
        }
        //判断许可状态
        else if (notification.permission == "default") {
            /*
             如果用户从未设置过此网站的桌面提醒状态(可能是第一次访问这个网站，或者以前允许过，但是在通知-例外中删除掉了)，则调用requestPermission方法，让用户选择是否允许桌面提醒
             */
            notification.requestPermission(function(permission) {
                //在回掉函数中判断用户的选择,在这里不用为“拒绝”选项编写代码，因为既然拒绝，就什么都不做了，也不用为默认状态编写代码，因为既然已经弹出让用户选择的选项了，就没有所谓的默认状态了。所以只需要处理用户允许的状态就可以了
                if (notification.permission == "granted") {
                    //创建通知
                    realTimeGetInfo(type);
                } else if (notification.permission == "denied"){
                    layer.alert('您拒绝了窗口通知将关闭升维网的智能即时推送功能,如需打开请在浏览器设置-内容设置-通知-允许升维网的通知');
                }
            });
        }
    } else {
        //layer.msg('您的浏览器不支持窗口通知，请更换浏览器');
    }
}

function realTimeGetInfo(type){
    if($.cookie('userId')){
        var timeout;
        var mynotify = null;
        timeout = window.setInterval(function () {
            $.post('/realTimeGetInfo',{'type':type},function (data) {
                for(var i in data){
                    //console.log(data[i]);
                    dealAllStatus(data[i],timeout,mynotify);
                }
            });
        },60000);
    }
}

function dealAllStatus(data,timeout,mynotify){
    if(data.code == 100 && !$.cookie('isnotice')){
        mynotify = new Notification("升维网提示", {
            body: data.msg,
            icon: './img/swnotice.jpg',
            data:123,
            silent:true,
        });
        mynotify.onclick = function() {
            mynotify.close();
            window.location.href=data.url;
        }
        window.clearInterval(timeout);
    } else if(data.code == 102 && $.cookie('isnotice')){
        mynotify = new Notification("升维网提示", {
            body: data.msg,
            icon: './img/swnotice.jpg',
            data:123,
            silent:true,
        });
        mynotify.onclick = function() {
            mynotify.close();
            layer.confirm('请选择企业认证还是专家认证', {
                btn: ['企业认证','专家认证'], //按钮
                skin:'layui-layer-molv'
            }, function(){
                window.location.href=data.url1;
            }, function(){
                window.location.href=data.url2;
            });
        }
        window.clearInterval(timeout);
    } else if(data.code == 201 || data.code == 202 || data.code == 200 || data.code == 300 || data.code == 301 || data.code == 302){
        mynotify = new Notification("升维网提示", {
            body: data.msg,
            icon: './img/swnotice.jpg',
            data:123,
            silent:true,
            tag:data.code,
        });
        mynotify.onclick = function() {
            mynotify.close();
            if(data.code == 201 || data.code == 200 || data.code == 300 || data.code == 301){
                $.post('/dealLookAction',{'ids':data.data.ids,'type':data.data.type,'look':data.data.look},function (res) {
                    if(res == 'success'){
                        window.location.href=data.url;
                        return false;
                    } else {
                        layer.msg('处理失败');
                    }
                });
            } else {
                window.location.href=data.url;
            }


        }
    }
    if(mynotify != null){
        mynotify.onshow = function() {
            var Music = new Audio("./8407.mp3");
            Music.play();
        }
        mynotify.onclose = function() {
            //可以在这里做一些有意义的事情，比如记录显示通知的次数
            $.cookie("isnotice",true,{path:'/',domain:'sw2025.com'});
        }
    }

}



