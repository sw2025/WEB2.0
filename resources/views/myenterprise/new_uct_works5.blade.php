@extends("layouts.ucenter")
@section("content")
    {{--<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    <script src="{{asset('./js/jqueryform.js')}}"></script>
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
    <link rel="stylesheet" type="text/css" href="{{asset('css/works.css')}}" />
    <link rel="stylesheet" href="{{asset('css/videoconsult.css')}}">


            <!-- 侧边栏公共部分/end -->

                <!-- 企业办事服务 / start -->
                <div class="ucenter-con">
                    <div class="main-right v-step-box">
                        <div class="card-step works-step">
                            <span class="green-circle">1</span>办事申请<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">2</span>邀请专家<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">3</span>专家响应<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">4</span>办事管理<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">5</span>完成
                        </div>
                        <input type="hidden" id="eventVideo" value="{{$datas->eventid}}" >
                        <div class="uct-video-manage">
                            <div class="video-manage-top">
                                <div class="vid-man-top-lt vid-man-top-main">
                                    <div class="vid-man-top-con">
                                        <p class="vid-man-top-cat"><span class="light-color">分类：</span>{{$datas->domain1}} / {{$datas->domain2}}</p>
                                        <span class="light-color">描述：</span>
                                        <div class="vid-man-top-desc">{{mb_strcut($datas->brief,0,350,'utf-8')}}...</div>
                                        <p class="hidenbrief" style="display:none;">{{$datas->brief}}</p>
                                        <p style="float: right;"><a href="javascript:;" class="showmore">查看更多</a></p>
                                    </div>
                                </div>
                                <div class="vid-man-top-rt vid-man-top-main">
                                    <div class="vid-man-top-con">
                                        <div class="persons-lt">
                                            <div class="emcee">
                                                <span class="light-color emcee-cap">我：</span>
                                                <span class="emceer-pers" title="企业名字"><img src="{{env('ImagePath').$datas->showimage}}" />{{$datas->enterprisename}}</span>
                                            </div>
                                            <div class="emcee-bottom">
                                                <span class="light-color emcee-cap emcee-bot-cap">专家：</span>
                                                <div class="emcee-members">
                                                    <span class="emceer-pers" title="专家名字"><img src="{{env('ImagePath').$info->showimage}}" />{{$info->expertname}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="camera-comunicate">
                                            <span class="camera"><img src="{{asset('img/camera.png')}}" /></span>
                                            <a href="javascript:;" class="video-comu" id="videoLink">视频沟通</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="works-manage">
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
                                                    <a class="chat-btn u-netcall-video-link" id="showNetcallVideoLink" >&nbsp;</a>
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

                                    </div>
                                </div>
                            </div>


                            <div class="works-manage">
                                <div class="works-last works-manage-step">
                                    <h2 class="handle-affair-tit">日程管理</h2>
                                    <p class="handle-affair-desc">日程管理有助于督促双方按照计划进行融资，提高工作效率</p>
                                    <a href="javascript:;" class="datum-btn datum-add" style="display:block" epid="0"  pid="0"> <i class="iconfont icon-bianji"></i>新增日程</a>
                                    <ul class="add-works-task">
                                        @foreach($task as $t)
                                            <li>
                                                <textarea class="works-task-desc" readonly="readonly">{{$t->taskname}}</textarea>
                                                @if($t->state)
                                                    <span class="task-state task-finished">已完成</span>
                                                @else
                                                    <span class="task-state task-ing">进行中</span>
                                                @endif
                                                <div class="task-dispose">
                                                    <span class="task-icon-finish task-icon" etid="{{$t->etid}}" title="完成"></span>
                                                    <span class="task-icon-delete task-icon" etid="{{$t->etid}}" title="删除"></span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="new-btns-box">
                                <a href="javascript:;" class="datum-btn" id="stop" style="width: 115px;background: #f10;">终止合作</a>
                                <button class="stop red-finish" id="finish" type="button">完成</button>
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
                        $("#showNetcallVideoLink").hide();
                        $("#videoLink").hide();
                        clearInterval(time);
                    }
                }
            })
        },300000);
    </script>
    <script type="text/javascript">
        $(function () {

            $("#myupload").ajaxForm({
                dataType:'json',
                beforeSend:function(){
                    if($('#uploadfilename').text().trim() == ''){layer.msg('请选择文件后上传',{'icon':5}); return false;}
                    $(".progress").show();
                },
                uploadProgress:function(event,position,total,percentComplete){
                    var percentVal = percentComplete + '%';
                    $(".progress-bar").width(percentComplete + '%');
                    $(".progress-bar").html(percentVal);
                    $(".sr-only").html(percentComplete + '%');
                },
                success:function(data){
                    $(".progress-bar").width('0%');
                    $(".progress-bar").html('0%');
                    $(".sr-only").html('0%');
                    if(data.icon == 2){
                        $(".progress").hide();
                        layer.alert(data.error);
                        return false;
                    } else {
                        layer.msg(data.msg,function () {
                            location.href = window.location.href;
                        });

                    }

                },
                error:function(){
                    layer.alert("图片上传失败");
                }

            });
            $(".progress").hide();
        });

    </script>


        <script type="text/javascript">
            $(function(){
                $("#Pagination").pagination("15");
                // 新增任务
                $('.datum-add').click(function() {
                    /*var tag = '<li><textarea class="works-task-desc"></textarea><div class="task-dispose"><span class="task-icon-delete task-icon" title="删除"></span></div><button class="confirm-task-btn" type="button">确定</button></li>'
                     $('.add-works-task').append(tag);*/
                    var thisobj = $(this);
                    var tag = '<li><textarea class="works-task-desc"></textarea><div class="task-dispose"><span class="task-icon-delete task-icon" title="删除"></span></div><button class="confirm-task-btn" type="button" onclick="submittask(this)">确定</button></li>'
                        $('.add-works-task').append(tag);
                });

                // 鼠标滑过li
                $('.add-works-task').on('mouseover mouseout', 'li', function() {
                    $(this).children('.task-dispose').stop().fadeToggle(200);
                });

                // 点击完成
                $('.add-works-task').on('click', '.task-icon-finish', function() {
                    var thisobj = $(this);
                    var $state = $(this).closest('li').find('.task-state');
                    if(!$state.hasClass('task-finished')){
                        layer.confirm('确定该日程已完成吗？', {
                            title:false,
                            btn: ['确认','取消'] //按钮
                        }, function(index){

                            dealtask(thisobj.attr('etid'),1,index,$state);

                        })
                    }
                });
                /*// 点击删除
                $('.add-works-task').on('click', '.task-icon-delete', function() {
                    var $li = $(this).closest('li');
                    layer.confirm('确定删除该日程吗？', {
                        title:false,
                        btn: ['确认','取消'] //按钮
                    }, function(index){
                        layer.close(index);
                        $li.remove();
                    })
                })
*/
                // 点击删除
                $('.add-works-task').on('click', '.task-icon-delete', function() {
                    var thisobj = $(this);
                    var $li = $(this).closest('li');
                    layer.confirm('确定删除该日程吗？', {
                        title:false,
                        btn: ['确认','取消'] //按钮
                    }, function(index){
                        if(thisobj.attr('etid') == ' ' || thisobj.attr('etid') == null){
                            layer.close(index);
                            $li.remove();
                            return false;
                        } else {
                            dealtask(thisobj.attr('etid'),2,index,$li);
                        }

                    })
                })




            })

            $('#finish').on('click',function () {
                layer.confirm('确认要完成办事么？', {
                    title:false,
                    btn: ['确认','取消']
                }, function(index){
                    var eventid =  {{$eventId}};
                    $.post('{{url('stopevent')}}',{'eventid':eventid,'action':1},function (data) {
                        if(data.icon == 2){
                            layer.msg(data.msg,{'icon':2});
                        } else {
                            layer.msg(data.msg,{'icon':1,'time':1500},function () {
                                window.location = window.location.href;
                            });
                        }
                    });

                })
            });

            /**
             * 处理日志完成或者删除
             * @param id
             * @param state
             * @param obj1
             * @param obj2
             */
            function dealtask(id,state,obj1,obj2){
                var eventid = {{$eventId}};
                $.post('{{url('submittask')}}',{'eventid':eventid,'etid':id,'state':state},function (data) {
                    if(data.icon == 2){
                        layer.msg(data.error,{'icon':2});
                    } else {
                        if(state == 1){
                            layer.msg(data.msg,{'icon':1,'time':1000},function () {
                                layer.close(obj1);
                                obj2.html('已完成').addClass('task-finished');
                            });
                        } else {
                            layer.msg(data.msg,{'icon':1,'time':1000},function () {
                                layer.close(obj1);
                                obj2.remove();
                            });
                        }

                    }
                });
            }

            /**
             * 提交新建的日志
             * @param obj
             */
            function submittask(obj) {
                var textobj = $(obj).siblings('textarea');
                var eventid = {{$eventId}};
                $(obj).attr('disabled',true);
                if(textobj.val() != ''){
                    $.post('{{url('submittask')}}',{'eventid':eventid,'taskname':textobj.val(),'state':0},function (data) {
                        if(data.icon == 2){
                            layer.msg(data.error,{'icon':2},function () {
                                $(obj).attr('disabled',false);
                            });
                        } else {
                            layer.msg(data.msg,{'icon':1},function () {
                                $(obj).remove();
                                window.location = window.location.href;
                            });
                        }
                    });
                } else {
                    layer.msg('请填写日程');
                }
            }
        </script>


    <script type="text/javascript">

        $(function(){


            layer.config({
                extend: '/extend/layer.ext.js'
            });


            $('#stop').on('click',function () {
                layer.prompt({title: '请输入终止合作原因', formType: 2}, function(pass, index){
                    if(pass == ''){
                        layer.msg('请输入原因',{'time':1000});
                        return false;
                    }
                    var eventid =  {{$eventId}};
                    var laststep = {{$stmpstate->step}};
                    $.post('{{url('stopevent')}}',{'eventid':eventid,'action':0,'msg':pass,'laststep':laststep},function (data) {
                        if(data.icon == 2){
                            layer.msg(data.msg,{'icon':2});
                        } else {
                            layer.msg(data.msg,{'icon':1,'time':1500},function () {
                                window.location = '{{url('/uct_works')}}';
                            });
                        }
                    });
                    //layer.close(index);
                });

            });

        })
        var content = $('.hidenbrief').html();
        $('.showmore').on('click',function () {
            layer.open({
                type: 1,
                title: '办事详情页',
                skin: 'layui-layer-rim', //加上边框
                area: ['950px', '350px'], //宽高
                maxmin: true, //开启最大化最小化按钮
                content: '<textarea style="padding:20px;line-height: 29px;width:900px;height:250px;border:none">'+content+'</textarea>',
            });
           /* layer.open({
                type: 2,
                title: '很多时候，我们想最大化看，比如像这个页面。',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['893px', '600px'],
                content: '//fly.layui.com/'
            });*/
        });
       /* $("#eventVideo").on("click",function(){
            $eventId=$("#eventId").val();
            window.location.href="/uct_works/eventVideo/"+$eventId;
           // return false;
            $.ajax({
                url:"{{url('getEventVideoTime')}}",
                data:{"eventId":$eventId},
                dateType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=='error'){
                        layer.confirm('您该次办事的免费视频的时间已经用完', {
                            btn: ['确认']
                        }, function(){
                            layer.closeAll('dialog');
                        })
                    }else{
                        window.location.href="/uct_works/eventVideo/"+$eventId;
                    }
                }
            })
        })*/

    </script>
    <!-- 修改意见/end -->

@endsection