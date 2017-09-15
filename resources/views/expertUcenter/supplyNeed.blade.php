 @extends("layouts.ucenter4")
@section("content")
    <div class="main">
        <!-- 发布需求 / start -->
        <h3 class="main-top">发布需求</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step">
                    <span class="green-circle">1</span>提交需求
                </div>
                <div class="publish-need">
                    @if(!empty($info))
                        <input type="hidden" id="refuseid" value="{{$info->needid}}">
                        <p class="wrong-reason" style="text-align:left;width:350px;margin:0 auto;padding-top:30px;"><span style="color: #e3643d">拒绝原因：</span><span style="color: #e3643d">{{$info->error}}</span></p>
                    @endif
                    <div class="publish-need-sel">
                        <span class="publ-need-sel-cap">需求分类</span><a href="javascript:;" class="publ-need-sel-def">@if(!empty($info)) {{$info->domain1}}/{{$info->domain2}} @else 请选择 @endif</a>
                        <ul class="publish-need-list">
                            @foreach($cate as $v)
                                @if($v->level == 1)
                                    <li>
                                        <a href="javascript:;">{{$v->domainname}}</a>
                                        <ul class="publ-sub-list">
                                            @foreach($cate as $small)
                                                @if($small->parentid == $v->domainid && $small->level == 2)
                                                    <li>{{$small->domainname}}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                        </ul>
                    </div>
                    <div>
                        <textarea   name="" id="content" class="publish-need-txt new-txt" cols="30" rows="10" minlength="30" maxlength="500"  placeholder="请输入需求描述30-500字">@if(!empty($info)) {{$info->brief}} @endif</textarea>
                        <button class="test-btn publish-submit" type="button">提交</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .layer_notice {
            float: left;
            overflow: hidden;
            background: #5FB878;
            padding: 10px;
        }
        .layer_notice a {
            color: #fff;
        }
    </style>
    <ul class="layer_notice" style="display: none;">
        <li><a>近期，网监部门查敏感类信息比较严格，所以需求中多加了一些类似“共产党”等政治性文字的敏感词语类或其它敏感词汇信息需要验证，请您按照文明规范填写需求。</a></li>
        <li><a>感谢您的合作</a></li>
        <li><a style="margin-left: 80%;">升维网</a></li>
    </ul>


    <script type="text/javascript">
        $(function(){
            layer.open({
                type: 1,
                shade: false,
                title: '尊敬的用户您好', //不显示标题
                content: $('.layer_notice'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
                cancel: function(){
                    layer.msg('感谢您的配合，请文明书写', {time: 1000, icon:6});
                }
            });


            $('.publ-need-sel-def').click(function() {
                $(this).next('ul').stop().slideToggle();
            });
            $('.publish-need-list li').hover(function() {
                $(this).children('ul').stop().show();
            }, function() {
                $(this).children('ul').stop().hide();
            });

            $('.publ-sub-list li').click(function() {
                var publishHtml = $(this).html();
                var parentHtml = $(this).parent().siblings('a').text();
                $('.publ-need-sel-def').html(parentHtml+'/'+publishHtml);
                $('.publish-need-list').hide();
            });

            $('.publish-submit').on('click',function () {
                $obj =  $(this);
                $obj.attr('disabled',true);
                var content = $('#content').val();
                var domain =  $('.publ-need-sel-def').text();
                if(content == '' || domain == '请选择'){
                    $obj.attr('disabled',false);
                    layer.msg('请填写完整的需求描述');
                    return false;
                }
                if(content.length <= 30 || content.length >= 500){
                    $obj.attr('disabled',false);
                    layer.msg('请输入30-500字的需求描述');
                    return false;
                }
                $.post('{{url('uct_myneed/addNeed')}}',{'role':'专家','content':content,'domain':domain,'needid':$('#refuseid').val()},function (data) {
                    if (data.icon == 1){
                        layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                            window.location = '{{url('myneed')}}';
                        });
                    } else {
                        //$obj.attr('disabled',false);
                        layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                            if(typeof(data.needid)=="undefined"){
                                window.location = window.location.href;
                            } else {
                                window.location = '{{url('myneed/supplyNeed')}}'+'/'+data.needid;
                            }
                        });
                    }
                });
            });

        })
    </script>
@endsection