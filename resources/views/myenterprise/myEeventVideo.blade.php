@extends("layouts.ucenter4")
@section("content")
    <link rel="stylesheet" href="{{asset('im/css/base.css')}}"/>
    <link rel="stylesheet" href="{{asset('im/css/animate.css')}}"/>
    <link rel="stylesheet" href="{{asset('im/css/jquery-ui.css')}}"/>
    <link rel="stylesheet" href="{{asset('im/css/contextMenu/jquery.contextMenu.css')}}"/>
    <link rel="stylesheet" href="{{asset('im/css/minAlert.css')}}"/>
    <link rel="stylesheet" href="{{asset('im/css/main.css')}}"/>
    <link rel="stylesheet" href="{{asset('im/css/uiKit.css')}}"/>
    <link rel="stylesheet" href="{{asset('im/css/CEmojiEngine.css')}}"/>
    <link rel="stylesheet" href="{{asset('im/css/rangeslider.css')}}"/>
    <script type="text/javascript">
        jQuery.browser={};(function(){jQuery.browser.msie=false; jQuery.browser.version=0;if(navigator.userAgent.match(/MSIE ([0-9]+)./)){ jQuery.browser.msie=true;jQuery.browser.version=RegExp.$1;}})();
    </script>
    <div class="ucenter-con">
        <input type="hidden" id="eventVideo" value="{{$eventId}}">
        <div class="main-right v-step-box">
            <div class="card-step works-step">
                <span class="green-circle">1</span>办事申请<span class="card-step-cap">&gt;</span>
                <span class="green-circle">2</span>邀请专家<span class="card-step-cap">&gt;</span>
                <span class="green-circle">3</span>专家响应<span class="card-step-cap">&gt;</span>
                <span class="green-circle">4</span>办事管理<span class="card-step-cap">&gt;</span>
                <span class="gray-circle">5</span>完成
            </div>
            <div class="uct-video-manage">
                <div class="wrapper box-sizing">
                    <div class="content">
                        <div class="right-panel hide  radius5px" id="rightPanel">	<!-- 聊天面板 -->
                            <div class="chat-box show-netcall-box" id="chatBox">
                                <div class="title" id="chatTitle">
                                    <img src="" width="56" height="56" class="radius-circle img" id="headImg"/>
                                    <span id="nickName"></span>
                                    <div class="cloudMsg tc radius4px" data-record-id="" id="cloudMsg"><i class="icon icon-team-info"></i><p>云记录</p></div>
                                    {{--  <div class="team-info hide tc radius4px" data-team-id="" id="teamInfo"><i class="icon icon-team-info"></i><p>资料</p></div>--}}
                                </div>
                                <div class="netcall-box" id="netcallBox">
                                    <div class="netcall-mask hide">
                                        <div class="netcallTip"></div>
                                    </div>
                                    <div class="top hide">
                                        <span class="transferAudioAndVideo switchToAudio" id="switchToAudio">切换音频</span>
                                        <span class="transferAudioAndVideo switchToVideo" id="switchToVideo">切换视频</span>
                                        <span class="fullScreenIcon toggleFullScreenButton" id="toggleFullScreenButton" title="切换全屏">&nbsp;</span>
                                    </div>
                                    <!-- p2p呼叫界面 -->
                                    <div class="netcall-calling-box hide">
                                        <img  alt="用户头像" class="avatar" >
                                        <div class="nick"></div>
                                        <div class="tip">等待对方接听...</div>
                                        <div class="op">
                                            <button id="callingHangupButton" class="netcall-button red">挂断</button>
                                        </div>
                                    </div>
                                    <!-- p2p视频界面 -->
                                    <div class="netcall-show-video hide">
                                        <div class="netcall-video-left">
                                            <div class="netcall-video-remote bigView">
                                                <div class="message" ></div>
                                                <span class="switchViewPositionButton"></span>
                                            </div>
                                        </div>
                                        <div class="netcall-video-right">
                                            <div class="netcall-video-local smallView">
                                                <div class="message"></div>
                                                <span class="switchViewPositionButton"></span>
                                            </div>
                                            <div class="operation">
                                                <div class="control">
                                                    <div class="microphone control-item">
                                                        <div class="slider hide">
                                                            <div class="txt">10</div>
                                                            <input class="microSliderInput" id="microSliderInput1" type="range" min="0" max="10" step="1" value="10" data-orientation="vertical">
                                                        </div>
                                                        <span class="icon-micro"></span>
                                                    </div>
                                                    <div class="volume control-item">
                                                        <div class="slider hide">
                                                            <div class="txt">10</div>
                                                            <input class="volumeSliderInput" id="volumeSliderInput1" type="range" min="0" max="10" step="1" value="10" data-orientation="vertical">
                                                        </div>
                                                        <span class="icon-volume"></span>
                                                    </div>
                                                    <div class="camera control-item">
                                                        <span class="icon-camera"></span>
                                                    </div>
                                                </div>
                                                <div class="op">
                                                    <button class="hangupButton netcall-button red">挂断</button>
                                                </div>
                                                <div class="tip">00 : 00</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- p2p音频界面 -->
                                    <div class="netcall-show-audio hide">
                                        <img  alt="用户头像" class="avatar">
                                        <div class="nick">test</div>
                                        <div class="tip">00 : 00</div>
                                        <div class="control">
                                            <div class="microphone control-item " >
                                                <div class="slider hide">
                                                    <div class="txt">10</div>
                                                    <input class="microSliderInput" id="microSliderInput" type="range" min="0" max="10" step="1" value="10" data-orientation="vertical">
                                                </div>
                                                <span class="icon-micro"></span>
                                            </div>
                                            <div class="volume control-item" >
                                                <div class="slider hide">
                                                    <div class="txt">10</div>
                                                    <input class="microSliderInput" id="volumeSliderInput" type="range" min="0" max="10" step="1" value="10" data-orientation="vertical">
                                                </div>
                                                <span class="icon-volume"></span>
                                            </div>
                                        </div>
                                        <div class="op">
                                            <button class="hangupButton netcall-button red">挂断</button>
                                        </div>

                                    </div>
                                    <!-- 多人音视频互动界面 -->
                                    <div class="netcall-meeting-box hide" id="netcallMeetingBox"></div>
                                    <!-- 被叫界面 -->
                                    <div class="netcall-becalling-box hide">
                                        <img  alt="用户头像" class="avatar">
                                        <div class="nick"></div>
                                        <p id="becallingText" class="tip"></p>
                                        <div class="op">
                                            <div class="normal">
                                                <div class="checking-tip">检查插件中...<span class="netcall-icon-checking"></span></div>
                                                <button class="netcall-button blue beCallingAcceptButton" id="beCallingAcceptButton">
                                                    <span class="txt">接听</span>
                                                    <span class="netcall-icon-checking"></span>
                                                </button>
                                                <button class="netcall-button red beCallingRejectButton" id="beCallingRejectButton">
                                                    拒绝
                                                </button>
                                            </div>
                                            <div class="exception">
                                                <button class="netcall-button blue" id="downloadAgentButton">下载音视频插件</button><br/>
                                                <button class="netcall-button red beCallingRejectButton" >拒绝</button>
                                                <div class="exception-tip">拒绝调用插件申请会导致无法唤起插件,需重启浏览器</div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="dialogs hide">
                                    </div>
                                </div >
                                <div class="chat-content box-sizing" id="chatContent"> <!-- 聊天记录 -->
                                </div>
                                {{--  <div class="u-chat-notice">您已退出</div>--}}
                                {{--  <div class="chat-mask"></div>--}}
                                <div class="chat-editor box-sizing" id="chatEditor" data-disabled="1">
                                    <div id="emojiTag" class="m-emojiTag"></div>
                                    <a class="chat-btn u-emoji" id="showEmoji"></a>
                                    <span class="chat-btn msg-type" id="chooseFileBtn">
                                        <a class="icon icon-file" data-type="file"></a>
                                    </span>
                                    <a class="chat-btn u-netcall-audio-link" id="showNetcallAudioLink">&nbsp;</a>
                                    <a class="chat-btn u-netcall-video-link" id="showNetcallVideoLink">&nbsp;</a>
                                    <textarea id="messageText" class="chat-btn msg-input box-sizing radius5px p2p" rows="1" autofocus="autofocus" maxlength="500"></textarea>
                                    <a class="btn-send radius5px" id="sendBtn">发送</a>
                                    <form action="#" id="uploadForm">
                                        <input multiple="multiple" type="file" name="file" id="uploadFile" class="hide"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 群资料 -->
                    <div class="team-info-container hide" id="teamInfoContainer"></div>
                    <!-- 云记录 -->
                    <div class="cloud-msg-container hide" id="cloudMsgContainer"></div>
                    <!-- 弹框 -->
                    <div class="dialog-team-container radius5px hide" id="dialogTeamContainer"></div>
                    <!-- 技术方案弹框 -->
                    <div class="dialog-team-container radius5px hide" id="dialogCallMethod"></div>
                    <div class="chat-room-btns">
                        <button type="button" class="chat-room-btn unusual-btn">返回</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script src="{{asset('im/3rd/NIM_Web_SDK_v4.0.0.js')}}"></script>
    <script src="{{asset('im/3rd/NIM_Web_Netcall_v4.0.0.js')}}"></script>
    <script src="{{asset('im/3rd/NIM_Web_WebRTC_v4.1.0.js')}}"></script>
    {{-- <script src="{{asset('im/3rd/jquery-1.11.3.min.js')}}"></script>--}}
    {{-- <script src="{{asset('im/3rd/platform.js')}}"></script>--}}
    <script src="{{asset('im/3rd/rtcSupport.js')}}"></script>
    <script src="{{asset('im/js/3rd/jquery-ui.min.js')}}"></script>
    <script src="{{asset('im/3rd/rangeslider.min.js')}}"></script>
    <!-- 右键菜单-->
    <script src="{{asset('im/js/3rd/contextMenu/jquery.ui.position.js')}}"></script>
    <script src="{{asset('im/js/3rd/contextMenu/jquery.contextMenu.js')}}"></script>

    <script src="{{asset('im/js/config.js')}}"></script>
    <script src="{{asset('im/js/emoji.js')}}"></script>
    <script src="{{asset('im/js/util.js?v=2')}}"></script>
    <script src="{{asset('im/js/cache.js?v=2')}}"></script>
    <script src="{{asset('im/js/link.js')}}"></script>
    <script src="{{asset('im/js/ui.js?v=2')}}"></script>
    <script src="{{asset('im/js/widget/uiKit.js?v=2')}}"></script>
    <script src="{{asset('im/js/widget/minAlert.js')}}"></script>
    <script src="{{asset('im/js/module/base.js')}}"></script>
    <script src="{{asset('im/js/module/message.js')}}"></script>
    <script src="{{asset('im/js/module/sysMsg.js')}}"></script>
    <script src="{{asset('im/js/module/personCard.js')}}"></script>
    <script src="{{asset('im/js/module/session.js')}}"></script>
    <script src="{{asset('im/js/module/friend.js')}}"></script>

    <script src="{{asset('im/js/module/team.js')}}"></script>
    <script src="{{asset('im/js/module/dialog_team.js')}}"></script>
    <script src="{{asset('im/js/module/cloudMsg.js')}}"></script>
    <script src="{{asset('im/js/module/notification.js')}}"></script>
    <script src="{{asset('im/js/module/netcall.js')}}"></script>
    <script src="{{asset('im/js/module/netcall_meeting.js')}}"></script>
    <script src="{{asset('im/js/module/netcall_ui.js')}}"></script>
    <script src="{{asset('im/js/module/dialog_call_method.js')}}"></script>
    <script src="{{asset('im/js/main.js?v=2')}}"></script>
    <script>
        $(".unusual-btn").on('click',function(){
            window.history.back()
        })
        $("#netcallMeetingBox").on("click",".hangupButton",function(){
            var eventVideoTime=$(this).parent().next().text();
            var eventId=$("#eventVideo").val();
            $.ajax({
                url:"{{url('reduceTime')}}",
                data:{"eventId":eventId,"eventVideoTime":eventVideoTime},
                dateType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=="error"){
                        layer.confirm('您该次办事的免费视频的时间已经用完', {
                            btn: ['确认']
                        }, function(){
                            layer.closeAll('dialog');
                            window.history.back()
                        })
                    }
                }
            })
        })
        var time=setInterval(function(){
            var timeLong=$("#netcallMeetingBox").find(".tip:last").text();
            var eventId=$("#eventVideo").val();
            $.ajax({
                url:"{{url('compareTime')}}",
                data:{"eventId":eventId,"timeLong":timeLong},
                dateType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=="error"){
                        $("#netcallMeetingBox").find('.hangupButton').trigger('click');
                        clearInterval(time);
                    }
                }
            })
            },300000);
    </script>
@endsection