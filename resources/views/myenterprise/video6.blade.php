@extends("layouts.ucenter")
@section("content")
    <script type="text/javascript">
        jQuery.browser={};(function(){jQuery.browser.msie=false; jQuery.browser.version=0;if(navigator.userAgent.match(/MSIE ([0-9]+)./)){ jQuery.browser.msie=true;jQuery.browser.version=RegExp.$1;}})();
    </script>
    <div class="main">
        <!-- 专家视频咨询 / start -->
        <h3 class="main-top">专家视频咨询</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step works-step">
                    <span class="green-circle">1</span>会议申请<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">2</span>会议审核<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">5</span>会议管理<span class="card-step-cap">&gt;</span>
                    <span class="gray-circle">6</span>完成
                </div>
                <div class="uct-video-manage">
                    <div class="video-manage-top">
                        @foreach($datas as $data)
                            <div class="vid-man-top-lt vid-man-top-main">
                                <div class="vid-man-top-con">
                                    <p class="vid-man-top-cat"><span class="light-color">分类：</span>{{$data->domain1.'/'.$data->domain2}}</p>
                                    @foreach($comperes as $compere)
                                    <p class="vid-man-top-cat"><span class="light-color">金额：</span>{{$compere->money}}</p>
                                    @endforeach
                                    <p class="vid-man-top-cat"><span class="light-color">开始时间：</span>{{$data->starttime}}</p>
                                    <p class="vid-man-top-cat"><span class="light-color">结束时间：</span>{{$data->endtime}}</p>
                                    <span class="light-color">描述：</span>
                                    <div class="vid-man-top-desc">{{$data->brief}}</div>
                                </div>
                                </div>

                                <div class="vid-man-top-rt vid-man-top-main">
                                    <div class="vid-man-top-con">
                                        <div class="emcee">
                                            <span class="light-color emcee-cap">主持人：</span>
                                            @foreach($comperes as $compere)
                                                <span class="emceer-pers"><img src="httP://sw2025.com{{$compere->avatar}}" class="vid-new-ava">{{$compere->nickname}}</span>
                                            @endforeach
                                        </div>
                                        <div class="emcee-bottom">
                                            <span class="light-color emcee-cap emcee-bot-cap">成员：</span>
                                            <div class="emcee-members">
                                                @foreach($selExperts as $selExpert)
                                                <span class="emceer-pers"><img src="httP://sw2025.com{{$selExpert->showimage}}" class="vid-new-ava">{{$selExpert->expertname}}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                    <div class="video-manage-frame">

                    </div>
                    <div class="video-chats">
                        <div class="chat-room-tit">
                            web开发讨论组
                        </div>
                        <div class="chat-room">
                            <span class="chat-room-time">-----08:34-----</span>
                            <div class="chat-room-other">
                                <img src="{{asset('img/avatar1.jpg')}}" class="chat-room-other-img" />
                                <div class="chat-room-other-con">
                                    <a href="javascript:;" class="chat-room-other-name">徐二黑</a>
                                    <div class="chat-room-other-desc">
                                        1234567890
                                    </div>
                                </div>
                            </div>
                            <span class="chat-room-time">-----08:34-----</span>
                            <div class="chat-room-launch"><span class="chat-room-commu">胖大海发起视频通话失败</span></div>
                            <div class="chat-room-me">
                                <img src="{{asset('img/avatar1.jpg')}}" class="chat-room-me-img" />
                                <div class="chat-room-me-con">
                                    <a href="javascript:;" class="chat-room-me-name">牛二犇</a>
                                    <div class="chat-room-me-desc">二傻子</div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-room-write">
                            <textarea name="saytext" class="chat-room-txt" id="saytext"></textarea>
                            <div class="facebox clearfix">
                                <span class="chat-face"><i class="iconfont icon-weibiaoti-_fuzhi-"></i></span>
                                <span class="chat-file"><input type="file" class="file-input" /><i class="iconfont icon-wenjianjia"></i></span>
                                <span class="chat-sheying"><i class="iconfont icon-sheyingji"></i></span>
                                <button class="chat-fasong">发送</button>
                            </div>
                        </div>
                        <div class="chat-room-btn">
                            <button class="test-btn" type="button">完成</button>
                            <button class="test-btn unusual-btn" type="button">异常</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 公共footer / end -->
    <script type="text/javascript">
                $(function(){
                    $('.chat-face').qqFace({
                        id : 'facebox',
                        assign:'saytext',
                        path:'http://sw2025.com/arclist/' //表情存放的路径
                    });
                    $(".chat-fasong").click(function(){
                        var str = $("#saytext").val();
                        $(".chat-room-me-desc").html(replace_em(str));
                        $("#saytext").val('');
                    });

                })
        function replace_em(str){
            str = str.replace(/\</g,'&lt;');
            str = str.replace(/\>/g,'&gt;');
            str = str.replace(/\n/g,'<br/>');
            str = str.replace(/\[em_([0-9]*)\]/g,'<img src="{{asset('arclist/$1.gif')}}" border="0" />');
            return str;
        }

    </script>
@endsection

