(function() {
    // 配置
    var envir = 'online';
    var configMap = {
        test: {
            appkey: '65e9275fc2be3dc8930a59a3d52fa163',
            url:'https://apptest.netease.im'
        },
        
        pre:{
    		appkey: '65e9275fc2be3dc8930a59a3d52fa163',
    		url:'http://preapp.netease.im:8184'
        },
        online: {
           appkey: '65e9275fc2be3dc8930a59a3d52fa163',
           url:'https://app.netease.im'
        }
    };
    window.CONFIG = configMap[envir];
    // 是否开启订阅服务
    window.CONFIG.openSubscription = true
}())