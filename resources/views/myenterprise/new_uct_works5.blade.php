@extends("layouts.ucenter")
@section("content")
    {{--<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">--}}
    <script src="{{}}"></script>
    <style>
        .btnclass{
            padding-right: 1px;
            border: 1px solid #aaa;
            border-radius: 5px;
            margin-left: 1px
        }

        #template{
            line-height:25px;
            margin-top:3px;
        }
        #template p{
            font-weight:bold;
        }
        #template span{
            padding-left:20px;
        }
        #uploadfilename{
            font-size: 15px;
            border: 2px solid #000;
            padding: 2px 5px;
            border-radius: 5px;
            background: #ddd;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('css/works.css')}}" />

         @if($stmpstate->step == 1 && $isfirstevent)
            <script>
                var cookie = $.cookie('isnewpeople') ? $.cookie('isnewpeople'):0;
                if (cookie == '' || cookie == NaN || cookie == undefined){
                    layer.confirm('经系统检测您是首次进行办事,是否进行引导介绍操作？', {
                        btn: ['介绍功能','不再显示'] //按钮
                    }, function(index){
                        layer.close(index);
                        layer.tips('<font size=5>1.</font> 点击下方图标是文件上传,根据上方的步骤提示上传相关的资料', '.handle-up', {
                            tipsMore: true,
                            time:80000,
                            tips: [1, '#666'],
                            anim: 4,
                            closeBtn:2
                        });
                        layer.tips('<font size=5>2(1).</font>上传完资料后可以在这里进行留言告诉专家资料上传完毕或者询问专家意见', '.datum-change', {
                            area: ['320px', '55px'],
                            tipsMore: true,
                            time:80000,
                            tips: [3, '#666'] ,
                            anim: 4,
                            closeBtn:2
                        });
                        layer.tips('<font size=5>2(2).</font>一般来说第一步是由专家确认资料所以这边按钮没有显示出来，专家确认后就到了下一步办事', '.datum-change', {
                            area: ['320px', '55px'],
                            tipsMore: true,
                            time:80000,
                            tips: [4, '#666'] ,
                            anim: 4,
                            closeBtn:2
                        });
                        layer.tips('<font size=5>3.</font>专家和您的提交的意见反馈点击这个按钮就会在下方显示出来', '.datum-history', {
                            area: ['320px', '55px'],
                            tipsMore: true,
                            time:80000,
                            tips: [3, '#666'],
                            anim: 4,
                            closeBtn:2
                        });
                        layer.tips('<font size=5>4.</font>如果您有很多相关的向专家咨询的问题请点击这里可以与专家进行视频沟通，同时也可以实时的进行文字即时通讯', '.video-comu', {
                            area: ['320px', '70px'],
                            tipsMore: true,
                            time:80000,
                            anim: 4,
                            tips: [1, '#666'],
                            closeBtn:2
                        });
                        layer.tips('<font size=5>5.</font>如果您中途对办事有特殊情况可以中止办事系统会根据您的操作步骤决定退款费用', '#stop', {
                            tipsMore: true,
                            time:80000,
                            anim: 4,
                            tips: [1, '#666'],
                            closeBtn:2
                        });
                        layer.tips('<font size=5>6.</font>这里显示的是办事的进度情况鼠标移动到每个点上有简要介绍，点击相应的按钮会跳转到原来相对应的进度以便于查看.', '.vprog1', {
                            area: ['520px', '65px'],
                            tipsMore: true,
                            time:80000,
                            anim: 4,
                            tips: [3, '#666'],
                            closeBtn:2
                        });

                    }, function(){
                        $.cookie('isnewpeople','123');
                    });
                }

            </script>
        @endif
        <script>
            var eventid = {{$eventId}};
            var epid = '{{$lastpid->epid or null}}';
            var state = '{{$configinfo[$lastpid->step-1]->state}}';
        @if($lastpid->step != 4 && empty($_GET['step']))
            @if(!$configinfo[$lastpid->step-1]->starttype && $datas->userid == session('userId'))

                    geteventnewstate = function () {
                $.post('{{url('ifeventtrue')}}',{'eventid':eventid,'epid':epid,'state':state},function (data) {
                    if(data.icon == 3){}else if(data.icon == 2){
                        layer.msg(data.msg,{'time':1000},function () {
                            window.location = '/';
                        });
                    } else if(data.icon == 1){
                        clearInterval(tinterval);
                        layer.alert(data.msg,function () {
                            window.location = window.location.href;
                        });
                    } else {
                        console.log(data);
                    }
                });
            }
            var tinterval=setInterval(geteventnewstate,5000);
            @else
            var url = '{{$configinfo[$lastpid->step-1]->documenturl}}';
                    geteventnewstate2 = function () {
                $.post('{{url('ifeventupload')}}',{'eventid':eventid,'epid':epid,'state':state,'url':url},function (data) {
                    if(data.icon == 3){}else if(data.icon == 2){
                        layer.msg(data.msg,{'time':1000},function () {
                            window.location = '/';
                        });
                    } else if(data.icon == 1){
                        clearInterval(tinterval2);
                        layer.alert(data.msg,function () {
                            window.location = window.location.href;
                        });
                    } else {
                        console.log(data);
                    }
                });
            }
            var tinterval2=setInterval(geteventnewstate2,5000);

            @endif
        @endif




        </script>
            <!-- 侧边栏公共部分/end -->

                <!-- 企业办事服务 / start -->
                <div class="ucenter-con">
                    <div class="main-right v-step-box">
                        <div class="card-step works-step">
                            <span class="green-circle">1</span>办事申请<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">2</span>办事审核<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">5</span>办事管理<span class="card-step-cap">&gt;</span>
                            <span class="gray-circle">6</span>完成
                        </div>
                        <input type="hidden" id="eventId" value="{{$datas->eventid}}" >
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
                                                <span class="light-color emcee-cap">企业：</span>
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
                                            <a href="javascript:;" class="video-comu" id="eventVideo">视频沟通</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="works-manage">
                                @if($lastpid->step != count($configinfo))
                                <div class="works-first execute works-manage-step">
                                    <div class="w-f-top">
                                        <h2 class="handle-affair-tit" style="font-size: 20px;">{{$lastpid->step}}.{{$configinfo[$lastpid->step-1]->processname}}</h2>
                                        <p class="handle-affair-desc">{{$configinfo[$lastpid->step-1]->processdescription}}</p>
                                        <p style="margin-top: 10px;font-size: 16px;font-weight: bold;">提交材料包括：<p>
                                        {!! $configinfo[$lastpid->step-1]->Template !!}
                                        <a href="javascript:;" class="datum-btn datum-history" index="{{$lastpid->epid or null}}" page="@if(!empty($lastpid->epid) && !empty($remark[$lastpid->epid])) {{$remark[$lastpid->epid][0]->lastpage()}} @endif"><i class="iconfont icon-yijianfankui"></i>查看历史意见<span class="history-counts">@if(!empty($lastpid->epid)){{$remark[$lastpid->epid][1] or 0}} @else 0 @endif</span></a>
                                    </div>
                                    <div class="upload-box">
                                        <div class="u-b-left clearfix">
                                            <form id='myupload' action='{{url('uct_works/upload',$configinfo[$lastpid->step-1]->ppid)}}' method='post'>
                                            <div class="handle-up">
                                                <span class="handle-up-btn basic-span change-btn fileinput-button" style="margin-bottom:10px;">

                                                        <input type="hidden" name="eventid" value='{{$eventId}}' enctype='multipart/form-data'>
                                                        <input type="hidden" name="startuserid" value='@if($info->userid == session('userId')) {{$info->userid}} @else {{$datas->userid}} @endif '>
                                                        <input type="hidden" name="acceptuserid" value='@if($info->userid == session('userId')) {{$datas->userid}} @else {{$info->userid}} @endif '>
                                                        <span>选择文件</span>
                                                        <input class="fileupload1"  type="file" name="files" multiple="" index="{{$configinfo[$lastpid->step-1]->ppid}}" @if(!empty($_GET['step']) || $configinfo[$lastpid->step-1]->starttype) disabled @endif/>

                                                </span>
                                                <span id="uploadfilename" ></span>
                                                <input type="submit"  class="btn btn-success" value="@if($configinfo[$lastpid->step-1]->starttype) 等待专家上传 @else 开始上传 @endif" @if($configinfo[$lastpid->step-1]->starttype) disabled @endif onmouseover="this.style.cursor='pointer'" style="margin: 5px 5px;width: 100px;height: 28px;border-radius: 5px;background: #004981;color: #fff;">

                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%;border: 1px solid #fff;max-width:220px;background: #004981;color: #fff;border-radius: 5px;" >
                                                        <span class="sr-only">0% Complete</span>
                                                    </div>
                                                </div>
                                                <br />
                                                <span>
                                                    <a href="/showfile?path={{$configinfo[$lastpid->step-1]->documenturl}}" target="_blank" class="eventa1">{{$configinfo[$lastpid->step-1]->docname or ''}}</a>
                                                    <a href="@if(!empty($configinfo[$lastpid->step-1]->downurl)) /download?path={{$configinfo[$lastpid->step-1]->downurl}} " index="{{$configinfo[$lastpid->step-1]->downurl}}" style="padding-right: 2px;border: 1px solid #aaa;border-radius: 5px;margin-left: 10px;@endif"   class="eventa2"  >@if(!empty($configinfo[$lastpid->step-1]->downurl))&nbsp;下载&nbsp;@endif</a>
                                                </span>

                                                <br />
                                                <span class="lssc @if(!empty($configinfo[$lastpid->step-1]->oldpath)) haveclass @endif" >
                                                     @if(!empty($configinfo[$lastpid->step-1]->oldpath))
                                                        <span>历史上传：</span>
                                                        @foreach($configinfo[$lastpid->step-1]->oldpath as $kk => $vv)
                                                            <span>
                                                            <a href="/download?path={{$vv[1]}}" title="{{$vv[2]}}修改">{{$vv[0]}}</a>
                                                            @if(!$configinfo[$lastpid->step-1]->starttype && $datas->userid == session('userId'))
                                                            <a href="javascript:;" index="/deletedownload?path={{$vv[1]}}&&eid={{$eventId}}"  class="btnclass" >&nbsp;删除&nbsp;</a>
                                                            @endif
                                                                <span style="color:#000;font-size: 18px;font-weight: bold;margin:0 5px;">|</span>
                                                                </span>
                                                        @endforeach
                                                    @endif
                                                </span>

                                            </div>

                                            </form>
                                            <div class="handle-cap">选择基本资料后上传文件<br />文件格式限制： word  excel  pdf ppt txt</div>

                                        </div>
                                        <div class="datum-manage">
                                            <a href="javascript:;" class="datum-btn datum-change" index="{{$lastpid->epid or 0}}" eventid=" {{$eventId}}">修改意见</a>
                                            @if($configinfo[$lastpid->step-1]->starttype && $datas->userid == session('userId'))
                                                <a href="javascript:;" id="truelib" class="datum-btn datum-confirm" index="{{$lastpid->epid or 0}}" eventid="{{$eventId}}" pid="{{$configinfo[$lastpid->step-1]->ppid}}" style="display: none;background: #004981;">企业确认上传资料</a>
                                            @else
                                                <a href="javascript:;" id="truelib" class="datum-btn" onclick="layer.alert('请您等待专家确认资料进入下一步')" style="width:60px;display: none;background: #004981;">继续</a>
                                            @endif
                                            <a href="javascript:;" class="datum-btn" style="width: 140px;background: #004981;" onclick="$('#stop').show(1000);$('#truelib').show(1000);$(this).hide(1000);">是否继续参与办事</a>
                                            <a href="javascript:;" class="datum-btn" id="stop" style="width: 60px;background: #f10;display: none;">终止合作</a>
                                        </div>
                                        <div class="v-manage-link-rate">
                                            @foreach($configinfo as $k => $v)
                                                <a href="@if(!empty($v->epid) && $v->state == 2) {{url('uct_works/detail',$eventId).'?step='.$v->epid}} @else {{url('uct_works/detail',$eventId)}} @endif"><span class="vprogress vprog{{$k+1}} @if((!empty($stmpstate->step) || $k == 0) && (!empty($stmpstate->step) && $stmpstate->step >= $k+1)) vping @endif" title="{{$v->processname}}"></span></a>
                                            @endforeach
                                            {{--<span class="vprogress vprog2" title="专家提交资料目录"></span>
                                            <span class="vprogress vprog3" title="企业提交办事资料"></span>
                                            <span class="vprogress vprog4" title="专家提交办事初步方案"></span>
                                            <span class="vprogress vprog5" title="企业提交合作框架"></span>
                                            <span class="vprogress vprog6" title="专家提交办事实施方案"></span>
                                            <span class="vprogress vprog7" title="日程管理"></span>--}}
                                        </div>
                                    </div>
                                    @if(!empty($remark) && !empty($lastpid->epid) && key_exists($lastpid->epid,$remark) && $remark[$lastpid->epid][1])
                                    <!-- 历史意见/start -->
                                    <div class="history-opinion">
                                        <ul class="opinion-list">
                                            @foreach($remark[$lastpid->epid][0] as $msg)
                                                @if($msg->epid == $lastpid->epid)
                                                    <li class="opinion-item">
                                                        <p class="opinion-item-desc">
                                                            <span style="font-size: 15px;color: #000;">{{$msg->adduser}}:</span>{{$msg->content}}
                                                        </p>
                                                        <span class="opinion-item-time">{{$msg->addtime}}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="pages myinfo-page">
                                            <div id="Pagination"></div>
                                            <span class="page-sum">共<strong class="allPage">{{$remark[$lastpid->epid][0]->lastpage()}}</strong>页</span>
                                        </div>
                                    </div>

                                    @endif
                                    <!-- 历史意见/end -->
                                </div>

                                @else
                                    <div class="works-manage">
                                        <div class="works-last works-manage-step">
                                            <h2 class="handle-affair-tit">{{$lastpid->step}}.{{$configinfo[$lastpid->step-1]->processname}}</h2>
                                            <p class="handle-affair-desc">{{$configinfo[$lastpid->step-1]->processdescription}}</p>
                                            <a href="javascript:;" class="datum-btn datum-add" style="display:block" epid="{{$configinfo[$lastpid->step-1]->epid}}"  pid="{{$configinfo[$lastpid->step-1]->ppid}}"> <i class="iconfont icon-bianji"></i>新增日程</a>
                                            <input type="hidden" id="startuserid" name="startuserid" value='@if($configinfo[$lastpid->step-1]->starttype) {{$info->userid}} @else {{$datas->userid}} @endif '>
                                            <input type="hidden" id="acceptuserid" name="acceptuserid" value='@if($configinfo[$lastpid->step-1]->starttype) {{$datas->userid}} @else {{$info->userid}} @endif '>
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
                                            <div class="v-manage-link-rate">
                                                @foreach($configinfo as $k => $v)
                                                    <a href="@if(!empty($v->epid && $v->state == 2)) {{url('uct_works/detail',$eventId).'?step='.$v->epid}} @else {{url('uct_works/detail',$eventId)}} @endif"><span class="vprogress vprog{{$k+1}} @if((!empty($stmpstate->step) || $k == 0) && ($stmpstate->step >= $k+1)) vping @endif" title="{{$v->processname}}"></span></a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if($lastpid->step == count($configinfo))
                            <div class="works-f-s">
                                <button class="stop red-finish" id="finish" type="button">完成</button>
                            </div>
                        @else
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 企业办事服务 / end -->
    <!-- 修改意见/start -->
    <div class="cover">
        <div class="cover-pop">
            <textarea name="" id="" cols="30" rows="10" class="opinion-txt"></textarea>
            <button type="button" class="test-btn cover-confirm">确定</button>
            <button type="button" class="test-btn cover-cancel">取消</button>
        </div>
    </div>

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

    @if($lastpid->step == count($configinfo))

        <script type="text/javascript">
            $(function(){
                $("#Pagination").pagination("15");
                // 新增任务
                $('.datum-add').click(function() {
                    /*var tag = '<li><textarea class="works-task-desc"></textarea><div class="task-dispose"><span class="task-icon-delete task-icon" title="删除"></span></div><button class="confirm-task-btn" type="button">确定</button></li>'
                     $('.add-works-task').append(tag);*/
                    var thisobj = $(this);
                    var epid = $(this).attr('epid');
                    var eventid = {{$eventId}};
                    var pid = $(this).attr('pid');
                    if(epid == ''){
                        $.post('{{url('addeventtask')}}',{'pid':pid,'eventid':eventid,'startuserid':$('#startuserid').val(),'acceptuserid':$('#acceptuserid').val()},function (data) {
                            if(data){
                                epid = data;
                                thisobj.attr('epid',data);
                                var tag = '<li><textarea class="works-task-desc" epid="'+epid+'"></textarea><div class="task-dispose"><span class="task-icon-delete task-icon" title="删除"></span></div><button class="confirm-task-btn" type="button" onclick="submittask(this)">确定</button></li>'
                                $('.add-works-task').append(tag);
                            }
                        });
                    } else {
                        var tag = '<li><textarea class="works-task-desc" epid="'+epid+'"></textarea><div class="task-dispose"><span class="task-icon-delete task-icon" title="删除"></span></div><button class="confirm-task-btn" type="button" onclick="submittask(this)">确定</button></li>'
                        $('.add-works-task').append(tag);
                    }
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
                var epid = textobj.attr('epid');
                var eventid = {{$eventId}};
                $(obj).attr('disabled',true);
                if(epid != 0 && textobj.val() != ''){
                    $.post('{{url('submittask')}}',{'eventid':eventid,'epid':epid,'taskname':textobj.val(),'state':0},function (data) {
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

    @endif

    <script type="text/javascript">

        $(function(){
           /* $("#Pagination").pagination("15");*/
            // 点击历史意见
            /*$('.datum-history').on('click', function(event) {
                $(this).closest('.works-manage-step').children('.history-opinion').stop().slideToggle();
            });
*/
            // 点击历史意见
            $('.datum-history').on('click', function(event) {
                var epid = $(this).attr('index');
                var page = $(this).attr('page');
                var pageobj = $(this).parent().parent().siblings('.history-opinion');
                var contobj = pageobj.children('ul');

                pageobj.children().children('#Pagination').pagination(page,{'callback':function (page_index, jq) {
                    var current = parseInt(page_index)+1;
                    $.get('{{url('uct_works/detail',$eventId)}}?page='+current,{'epid':epid},function (data) {
                        var ee = data.data;
                        contobj.html('');
                        var str = '';
                        for(var i=0;i<ee.length;i++){
                            str += ' <li class="opinion-item"><p class="opinion-item-desc">';
                            str +='<span style="font-size: 15px;color: #000;">'+ee[i].adduser+':</span>'+ee[i].content+' </p>';
                            str +='<span class="opinion-item-time">'+ee[i].addtime+'</span>';
                            str +='</li>';
                        }
                        contobj.html(str);

                    });
                    return false;
                }});

                //$("#Pagination").pagination("15");
                $(this).closest('.works-manage-step').children('.history-opinion').stop().slideToggle();
            });

            function getFileName(path) {
                var pos1 = path.lastIndexOf('/');
                var pos2 = path.lastIndexOf('\\');
                var pos = Math.max(pos1, pos2);
                if (pos < 0) {
                    return path;
                }
                else {
                    return path.substring(pos + 1);
                }
            }

            $('.fileupload1').on('change', function(e){
                    var str = $(this).val();
                    var filesize = $(this)[0].files[0].size;
                    var fileName = getFileName(str);
                    var fileExt = str.substring(str.lastIndexOf('.') + 1);
                if(filesize > 1024*1024*2){
                    layer.msg('文件大小不能超过2M',{'time':3000,'icon':5});
                    return false;
                }
                if (fileExt != "doc" && fileExt != "pdf" && fileExt != "txt" && fileExt != "docx" && fileExt != "ppt" && fileExt != "excel"&& fileExt != "pptx"&& fileExt != "wps") {
                    layer.msg('文件格式不正确',{'time':3000,'icon':5});
                    return false;
                }
                 $('#uploadfilename').text(fileName);
                    layer.msg('添加文件成功，请点击上传按钮进行上传',{'time':3000});
                //$('#upload-avatar').html('正在上传...');
                /*var thisobj = $(this);
                var spanobj = $(this).parent().parent().siblings('span');
                var formobj = $(this).parent();
                var divobj = formobj.parent().parent().parent();
                var formData = new FormData(formobj[0]);
                var indexpid = $(this).attr('index');
                if({{$_GET['step'] or 0}}){
                   return false;
                }
                    $.ajax({
                        url: '{{url('uct_works/upload')}}'+'/'+indexpid ,
                        type: 'POST',
                        data: formData,
                        async: false,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if(data.icon == 2){
                                layer.msg(data.error,{'icon':data.icon});
                            } else {
                                layer.msg(data.msg,{'icon':1},function ()　{
                                    window.location = window.location.href;
                                    return false;
                                });
                                var str = '<a href="'+spanobj.children('.eventa2').attr('href')+'">'+spanobj.children('.eventa1').html()+'</a>' +
                                        '<a href="javascript:;" index="/deletedownload?path='+spanobj.children('.eventa2').attr('index')+'&&eid={{$eventId}}"  class="btnclass" >&nbsp;删除&nbsp;</a>';
                                if($('.lssc').hasClass('haveclass') &&  spanobj.children('.eventa1').html().trim() != ''){
                                    $('.lssc').append(str);
                                } else if(!$('.lssc').hasClass('haveclass') && spanobj.children('.eventa1').html().trim() != '') {
                                    $('.lssc').append('<span>&ensp;&ensp;&ensp;历史上传：</span>'+str);
                                }
                                spanobj.children('.eventa1').html(data.name);
                                spanobj.children('.eventa1').attr('href','{{env('ImagePath')}}'+data.path);
                                spanobj.children('.eventa2').html(' 下载 ');
                                spanobj.children('.eventa2').css({'border':'1px solid #aaa','borderRadius':'5px','marginLeft':'10px','paddingRight':'2px'});
                                spanobj.children('.eventa2').attr('href','/download?path='+data.downpath);

                                $('.datum-confirm').attr('index',data.epid);
                                $('.datum-change').attr('index',data.epid);
                                thisobj.val('');

                                $('.btnclass').on('click',function () {
                                    var path = $(this).attr('index');
                                    $.get(path,function (data) {
                                        if(data.icon == 2){
                                            layer.msg(data.msg,{'icon':2});
                                        } else {
                                            layer.msg(data.msg,{'icon':1},function(){
                                                window.location = window.location.href;
                                            });
                                        }
                                    });
                                    return false;
                                });
                            }

                        },
                        error: function (returndata) {
                            return 0;
                        }
                    });*/


            });

            $('.btnclass').on('click',function () {
                var path = $(this).attr('index');
                $.get(path,function (data) {
                    if(data.icon == 2){
                        layer.msg(data.msg,{'icon':2});
                    } else {
                        layer.msg(data.msg,{'icon':1},function(){
                            window.location = window.location.href;
                        });
                    }
                });
                return false;
            });


            // 确定资料
            $('.datum-confirm').bind('click', function(event) {
                var $that = $(this);
                if($that.closest('.works-manage-step').hasClass('execute')){
                    layer.confirm('资料确认无误吗？', {
                        title:false,
                        btn: ['确认','取消']
                    }, function(index){
                        var epid =  $that.attr('index');
                        var pid =  $that.attr('pid');
                        var eventid =  $that.attr('eventid');
                        if(epid != '' && epid != '0'){
                            $.post('{{url('truedocument')}}',{'epid':epid,'eventid':eventid,'pid':pid},function (data) {
                                if(data.icon == 2){
                                    layer.msg(data.error,{'icon':2});
                                } else {
                                    layer.msg(data.msg,{'icon':1,'time':1500},function () {
                                        window.location = window.location.href;
                                    });
                                }
                            });
                        } else {
                            layer.msg('请按照步骤操作',{'icon':2});
                        }


                    })

                }
            });

            // 点击修改意见
            function stopPropagation(e) {
                if (e.stopPropagation)
                    e.stopPropagation();
                else
                    e.cancelBubble = true;
            }
            $('.datum-change').bind('click',function(e) {
                var $that = $(this);
                if($that.attr('index') == '0'){
                    layer.msg('请先上传资料');
                    return false;
                }
                stopPropagation(e);
                $('.cover').fadeIn();
                $('.cover-pop').children('textarea').attr('epid', $that.attr('index'));
                $('.cover-pop').children('textarea').attr('eventid', $that.attr('eventid'));

            });

            $('.cover-confirm').click(function(event) {
                $(this).attr('disabled',true);
                var textarea = $(this).siblings('textarea');
                var content = textarea.val();
                var epid = textarea.attr('epid');
                var eventid = textarea.attr('eventid');
                if(content != ''){
                    $.post('{{url('uct_works/sendremark')}}',{'content':content,'epid':epid,'eventid':eventid},function (data){
                        if(data.icon == 2){
                            layer.msg(data.error,{'icon':2});
                        } else {
                            layer.msg(data.msg,{'icon':1,'time':1500},function () {
                                window.location = window.location.href;
                            });
                        }
                    });
                } else {
                    layer.msg('请输入内容');
                }
            });

            $(document).click(function(e) {
                stopPropagation(e);
                $('.cover').fadeOut();
            });
            $('.cover-pop').click(function(e) {
                stopPropagation(e);
            });
            $('.cover-cancel').click(function(event) {
                $(this).closest('.cover').fadeOut();
            });

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
                /*layer.confirm('确认要终止合作么？', {
                    title:false,
                    btn: ['确认','取消']
                }, function(index){
                    var eventid =  {{$eventId}};
                    $.post('{{url('stopevent')}}',{'eventid':eventid,'action':0},function (data) {
                        if(data.icon == 2){
                            layer.msg(data.msg,{'icon':2});
                        } else {
                            layer.msg(data.msg,{'icon':1,'time':1500},function () {
                                window.location = window.location.href;
                            });
                        }
                    });

                })*/
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
        $("#eventVideo").on("click",function(){
            $eventId=$("#eventId").val();
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
        })

    </script>
    <!-- 修改意见/end -->

@endsection