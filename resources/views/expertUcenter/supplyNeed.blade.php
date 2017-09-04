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


                       <textarea   name="" id="content" class="publish-need-txt" cols="30" rows="10" minlength="30" maxlength="500"  placeholder="请输入需求描述30-500字">@if(!empty($info)) {{$info->brief}} @endif</textarea>
                    </div>
                    <div><button class="test-btn publish-submit" type="button">提交</button></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
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
                var content = $('#content').val();
                var domain =  $('.publ-need-sel-def').text();
                if(content == '' || domain == '请选择'){
                    layer.msg('请填写完整的需求描述');
                    return false;
                }
                if(content.length <= 30 || content.length >= 500){
                    layer.msg('请输入30-500字的需求描述');
                    return false;
                }
                $.post('{{url('uct_myneed/addNeed')}}',{'content':content,'domain':domain,'needid':$('#refuseid').val()},function (data) {
                    if (data.icon == 1){
                        layer.msg(data.msg,{'time':2000,'icon':data.icon},function () {
                            window.location = '{{url('uct_myneed/examineNeed')}}';
                        });
                    } else {
                        layer.msg(data.msg,{'time':2000,'icon':data.icon});
                    }
                });
            });

        })
    </script>
@endsection