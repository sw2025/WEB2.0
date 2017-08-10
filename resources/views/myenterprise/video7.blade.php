@extends("layouts.ucenter")
@section("content")
    <script type="text/javascript" src="{{asset('js/jquery.raty.min.js')}}"></script>
    <div class="main">
        <!-- 企业办事服务 / start -->
        <h3 class="main-top">专家视频咨询</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="card-step works-step">
                    <span class="green-circle">1</span>咨询申请<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">2</span>咨询审核<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">3</span>邀请专家<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">4</span>专家响应<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">5</span>咨询管理<span class="card-step-cap">&gt;</span>
                    <span class="green-circle">6</span>完成
                </div>
                <input type="hidden" id="consult" name="consult" value="{{$consultId}}">
                <div class="publish-need uct-works-final">
                    <div class="expert-certy-state">
                        <i class="iconfont icon-chenggong"></i>
                                <span class="expert-certy-blue">
                                    <em>完成</em>COMPLETE
                                </span>
                    </div>
                    @foreach($selExperts as $selExpert)
                        <div class="rate">
                            <div class="rate-exp">
                                <div class="rate-exp-icon">
                                    <img src="http://sw2025.com{{$selExpert->showimage}}" class="new-add-img">
                                    <span class="new-add-exp-name">{{$selExpert->expertname}}</span>
                                </div>
                                <div id="{{$selExpert->expertid}}" class="rating"></div>
                                <a href="javascript:;" class="rate-btn">评价</a>
                                @if(!empty($selExpert->comment))
                                    <div class="rate-box" style="display: block">
                                        <input type="text" class="rate-inp" value="{{$selExpert->comment}}" />
                                        <button type="button" index="{{$selExpert->expertid}}" class="rate-confirm-btn" style="display: none">确定</button>
                                    </div>
                                @else
                                    <div class="rate-box">
                                        <input type="text" class="rate-inp" />
                                        <button type="button" index="{{$selExpert->expertid}}" class="rate-confirm-btn">确定</button>
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endforeach
                    <div class="uct-works-con">
                        <button class="test-btn rate-star-btn" type="button">确认</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $('.rate-btn').click(function() {
                $(this).next('.rate-box').toggleClass('dib');
            });

            $(".rate-confirm-btn").on("click",function(){
                var content=$(this).prev().val();
                var expertId= $(this).attr("index");
                var consultId=$("#consult").val();
                $.ajax({
                    url:"{{asset('toVideoExpertContent')}}",
                    data:{"content":content,"expertId":expertId,"consultId":consultId},
                    dateType:"json",
                    type:"POST",
                    success:function(res){
                        if(res['code']=="success"){
                            layer.msg("评论成功")
                            $(".rate-confirm-btn").hide();
                        }else{
                            layer.confirm('评论失败', {
                                btn: ['确定'] //按钮
                            });
                            return false;
                        }
                    }

                })
            })
                    @foreach($selExperts as $selExpert)
                    @if(!empty($selExpert->score))
            var scores=parseInt("{{$selExpert->score}}");
            $("#{{$selExpert->expertid}}").raty({
                starOff: '{{asset('img/staroff.png')}}',
                starOn : '{{asset('img/staron.png')}}',
                starHalf:'{{asset('img/starhalf.png')}}',
                width:211,
                readOnly:true,
                score:scores
            });
            @else
                $('#{{$selExpert->expertid}}').raty({
                starOff: '{{asset('img/staroff.png')}}',
                starOn : '{{asset('img/staron.png')}}',
                starHalf:'{{asset('img/starhalf.png')}}',
                half: false,
                width:211,
                click: function(score) {
                    var id=$(this).attr('id')
                    consultId=$("#consult").val();
                    $.ajax({
                        url:"{{asset('toVideoExpertMsg')}}",
                        data:{"consultId":consultId,"expertId":id,"score":score},
                        dateType:"json",
                        type:"POST",
                        success:function(res){}
                    })
                }
            });
            @endif
            @endforeach
        })
    </script>
@endsection
