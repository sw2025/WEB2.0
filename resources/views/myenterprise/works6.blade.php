@extends("layouts.works")
@section("content")
    <script src="{{asset('./FileUpload/js/vendor/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('./FileUpload/js/jquery.fileupload.js')}}"></script>
    <script src="{{asset('./FileUpload/js/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('./FileUpload/js/jquery.fileupload-process.js')}}"></script>
    <script src="{{asset('./FileUpload/js/jquery.fileupload-validate.js')}}"></script>
<div class="main">
    <!-- 企业办事服务 / start -->
    <h3 class="main-top">企业办事服务</h3>
    <div class="ucenter-con">
        <div class="main-right">
            <div class="card-step works-step">
                <span class="green-circle">1</span>办事申请<span class="card-step-cap">&gt;</span>
                <span class="green-circle">2</span>办事审核<span class="card-step-cap">&gt;</span>
                <span class="green-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
                <span class="green-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
                <span class="green-circle">5</span>办事管理<span class="card-step-cap">&gt;</span>
                <span class="gray-circle">6</span>完成
            </div>
            <div class="uct-video-manage">
                <div class="video-manage-top">
                    <div class="vid-man-top-lt vid-man-top-main">
                        <div class="vid-man-top-con">
                            <p class="vid-man-top-cat"><span class="light-color">分类：</span>{{$datas->domain1}} / {{$datas->domain2}}</p>
                            <span class="mywork-det-tit"><em class="light-color">金额：</em>￥3000</span>
                            <span class="light-color">描述：</span>
                            <div class="vid-man-top-desc">{{mb_strcut($datas->brief,0,250,'utf-8')}}...</div>
                        </div>
                    </div>
                    <div class="vid-man-top-rt vid-man-top-main">
                        <div class="vid-man-top-con">
                            <div class="emcee">
                                <span class="light-color emcee-cap">主持人：</span>
                                <span class="emceer-pers"><i class="iconfont icon-gerenzhongxin"></i>{{$datas->enterprisename}}</span>
                            </div>
                            <div class="emcee-bottom">
                                <span class="light-color emcee-cap emcee-bot-cap">专家：</span>
                                <div class="emcee-members">
                                    <span class="emceer-pers"><i class="iconfont icon-gerenzhongxin"></i>{{$info->expertname}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="works-manage">
                    @foreach($configinfo as $v)
                        @if($v->ppid == 7)
                            <div class="works-last @if((empty($lastpid->pid) && $v->ppid == 1) || (!empty($lastpid->pid) && $lastpid->state == 2 && $v->ppid-1 == $lastpid->pid)  || (!empty($lastpid->pid) && $lastpid->pid == $v->ppid && $v->state != 2)) execute @endif  works-manage-step">
                                <h2 class="handle-affair-tit">{{$v->ppid}}.{{$v->processname}}</h2>
                                <p class="handle-affair-desc">{{$v->processdescription}}</p>
                                <div class="datum-manage">
                                    <a href="javascript:;" class="datum-btn datum-add" style="display:block">新增日程</a>
                                </div>
                                <ul class="add-works-task">
                                    <li>
                                        <textarea class="works-task-desc" readonly="readonly">正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户</textarea>
                                        <span class="task-state task-ing">进行中</span>
                                        <div class="task-dispose">
                                            <span class="task-icon-finish task-icon" title="完成"><i class="iconfont icon-xuanzhong"></i></span>
                                            <span class="task-icon-delete task-icon" title="删除"><i class="iconfont icon-chahao"></i></span>
                                        </div>
                                    </li>
                                    <li>
                                        <textarea class="works-task-desc" readonly="readonly">正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户正确填写微信支付向你的银行账户中汇入的确认金额的数目，以验证账户</textarea>
                                        <span class="task-state task-finished">已完成</span>
                                        <div class="task-dispose">
                                            <span class="task-icon-finish task-icon" title="完成"><i class="iconfont icon-xuanzhong"></i></span>
                                            <span class="task-icon-delete task-icon" title="删除"><i class="iconfont icon-chahao"></i></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <div class="works-first @if((empty($lastpid->pid) && $v->ppid == 1) || (!empty($lastpid->pid) && $lastpid->state == 2 && $v->ppid-1 == $lastpid->pid)  || (!empty($lastpid->pid) && $lastpid->pid == $v->ppid && $v->state != 2)) execute @endif works-manage-step">
                                <h2 class="handle-affair-tit">{{$v->ppid}}.{{$v->processname}}</h2>
                                <p class="handle-affair-desc">{{$v->processdescription}}</p>
                                <div class="handle-up">
                                <span class="handle-up-btn basic-span change-btn fileinput-button">
                                    <form>
                                        <input type="hidden" name="eventid" value='{{$eventId}}'>
                                        <input type="hidden" name="startuserid" value='@if($v->starttype) {{$info->userid}} @else {{$datas->userid}} @endif '>
                                        <input type="hidden" name="acceptuserid" value='@if($v->starttype) {{$datas->userid}} @else {{$info->userid}} @endif '>
                                        <span>上传文件</span>
                                        <input class="fileupload1" type="file" name="files" multiple="" index="{{$v->ppid}}"/>
                                    </form>
                                </span>
                                    <span><a href="{{url($v->documenturl)}}" target="_blank" class="eventa1">{{$v->docname or ''}}</a><a href="@if(!empty($v->downurl)) /download?path={{$v->downurl}} " style="border: 1px solid #aaa;border-radius: 5px;margin-left: 10px;@endif"   class="eventa2"  >@if(!empty($v->downurl))&nbsp;下载&nbsp;@endif</a></span>
                                    @if(!empty($v->oldpath))
                                    <span>
                                        <span>&ensp;&ensp;&ensp;历史上传：</span>
                                        @foreach($v->oldpath as $kk => $vv)
                                            <a href="/download?path={{$vv}}">{{$kk}}</a> |
                                        @endforeach
                                    </span>
                                    @endif
                                </div>
                                <div class="datum-manage">
                                    <a href="javascript:;" class="datum-btn datum-confirm" index="{{$v->epid}}" eventid="{{$eventId}}" pid="{{$v->pid}}">确认资料</a>
                                    <a href="javascript:;" class="datum-btn datum-change" index="{{$v->epid}}" eventid="{{$eventId}}">修改意见</a>
                                    <a href="javascript:;" class="datum-btn datum-history" index="{{$v->epid}}" page="@if(!empty($remark[$v->epid])) {{$remark[$v->epid][0]->lastpage()}} @endif">历史意见<span class="history-counts">{{$remark[$v->epid][1] or 0}}</span></a>
                                </div>
                                <!-- 历史意见/start -->
                                @if(!empty($remark) && key_exists($v->epid,$remark) && $remark[$v->epid][1])
                                <div class="history-opinion">
                                        <ul class="opinion-list">
                                            @foreach($remark[$v->epid][0] as $msg)
                                                @if($msg->epid == $v->epid)
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
                                            <span class="page-sum">共<strong class="allPage">{{$remark[$v->epid][0]->lastpage()}}</strong>页</span>
                                        </div>
                                </div>
                                @endif
                                <!-- 历史意见/end -->
                            </div>
                        @endif

                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>
<!-- 公共footer / end -->
<script type="text/javascript">
    $(function(){

        /*$('.fileupload1').fileupload({
            dataType: 'json',
            maxFileSize: 5 * 1024 * 1024,
            maxNumberOfFiles : 1,
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    // console.log(file.name);
                    $('.fileupload1').attr('index',file.name);
                    $('#event1 a').html(file.name);
                });
            }
        });*/

        $('.fileupload1').on('change', function(e){
            //$('#upload-avatar').html('正在上传...');
            var spanobj = $(this).parent().parent().siblings('span');
            var formobj = $(this).parent();
            var divobj = formobj.parent().parent().parent();
            var formData = new FormData(formobj[0]);
            var indexpid = $(this).attr('index');
            console.log(divobj.hasClass('execute'));
            if(divobj.hasClass('execute')){
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
                            spanobj.children('.eventa1').html(data.name);
                            spanobj.children('.eventa1').attr('href','/'+data.path);
                            spanobj.children('.eventa2').html(' 下载 ');
                            spanobj.children('.eventa2').attr('href','/download?path='+data.downpath);
                            $('.datum-confirm').attr('index',data.epid);
                            $('.datum-change').attr('index',data.epid);
                        }

                    },
                    error: function (returndata) {
                        return 0;
                    }
                });
            } else {
                return false;
            }

        });


        // 点击历史意见
        $('.datum-history').on('click', function(event) {
            var epid = $(this).attr('index');
            var page = $(this).attr('page');
            var pageobj = $(this).parent().siblings('.history-opinion');
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
                    if(epid != ''){
                        $.post('{{url('truedocument')}}',{'epid':epid,'eventid':eventid,'pid':pid},function (data) {
                            if(data.icon == 2){
                                layer.msg(data.error,{'icon':2});
                            } else {
                                layer.msg(data.msg,{'icon':1,'time':1500});
                                $that.parent().parent().removeClass('execute');
                                layer.close(index);
                                $that.unbind('click');
                                $that.siblings('.datum-change').unbind('click');
                                $that.closest('.works-manage-step').next().addClass('execute');
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
            if($that.closest('.works-manage-step').hasClass('execute')){
                if(!$that.attr('index')){
                    layer.msg('请先上传资料');
                    return false;
                }
                stopPropagation(e);
                $('.cover').fadeIn();
                $('.cover-pop').children('textarea').attr('epid', $that.attr('index'));
                $('.cover-pop').children('textarea').attr('eventid', $that.attr('eventid'));

            }
        });
        $(document).click(function(e) {
            stopPropagation(e);
            $('.cover').fadeOut();
        });
        $('.cover-pop').click(function(e) {
            stopPropagation(e);
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
        $('.cover-cancel').click(function(event) {
            $(this).closest('.cover').fadeOut();
        });
        // 新增任务
        $('.datum-add').click(function() {
            if($(this).closest('.works-manage-step').hasClass('execute')){
                var tag = '<li><textarea class="works-task-desc"></textarea><div class="task-dispose"><span class="task-icon-delete task-icon" title="删除"><i class="iconfont icon-chahao"></i></span></div><button class="confirm-task-btn" type="button">确定</button></li>'
                $('.add-works-task').append(tag);
            }
        });

        // 鼠标滑过li
        $('.add-works-task').on('mouseover mouseout', 'li', function() {
            if($(this).closest('.works-manage-step').hasClass('execute')){
                $(this).children('.task-dispose').stop().fadeToggle(200);
            }
        });
        // 点击完成
        $('.add-works-task').on('click', '.task-icon-finish', function() {
            var $state = $(this).closest('li').find('.task-state');
            if(!$state.hasClass('task-finished')){
                layer.confirm('确定该日程已完成吗？', {
                    title:false,
                    btn: ['确认','取消'] //按钮
                }, function(index){
                    layer.close(index);
                    $state.html('已完成').addClass('task-finished');
                })
            }
        });
        // 点击删除
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
    })
</script>
@endsection