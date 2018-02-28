@extends("layouts.ucenter4")
@section("content")
    <link rel="stylesheet" type="text/css" href="{{asset('css/standard.css')}}" />

    <!-- 公共header / start -->
            <div class="main">
                <h3 class="main-top">收费标准</h3>
                <!-- 收费标准 / start -->
                <div class="ucenter-con">
                    <div class="main-right">
                        <p class="introduce" style="position: absolute;right:360px;top:100px;display:none">点击按钮改变状态，保存即可完成</p>
                        <div class="recharge-sum standards">
                            @if($islinemeet==0)
                                <span class="recharge-opt others">
                                    线下约谈<input type="text" placeholder="请输入金额" value="{{$linefee}}" readonly="readonly" disabled="disabled" id="ismoney" class="recharge-inp-sum">&nbsp;&nbsp;元/分钟
                                </span>
                                    <button id="line" style="width:80px;height:30px;background:orangered;" type="button">已关闭</button>

                             @else
                                <span class="recharge-opt others focus">
                            线下约谈<input type="text" placeholder="请输入金额" value="{{$linefee}}" readonly="" id="ismoney" class="recharge-inp-sum">&nbsp;&nbsp;元/分钟
                                </span>
                                   <button id="line" style="width:80px;height:30px;background:green;" type="button">已开启</button>
                            @endif


                            <br/><br/><br/>
                            @if($isonlinemeet==0)
                            <span class="recharge-opt others">
                                {{--<input class="rad-inp" checked="true" type="radio" id="rad4" name="money">
                                <label for="rad4" class="recharge-radio"><span></span></label>--}}线上约谈<input type="text" value="{{$fee}}" placeholder="请输入金额"readonly="readonly" disabled="disabled" id="money" class="recharge-inp-sum">&nbsp;&nbsp;元/分钟
                            </span>

                                <button  id="on-line" style="width:80px;height:30px;background:orangered;" type="button">已关闭</button>

                            @else
                                <span class="recharge-opt focus others">
                                    线上约谈<input type="text" value="{{$fee}}"  readonly="" id="money" class="recharge-inp-sum">&nbsp;&nbsp;元/分钟
                                <button  id="on-line" style="width:80px;height:30px;background:green;" type="button">已开启</button>
                                </span>
                            @endif

                        </div>
                            <div class="uct-works-tips standard-intro">
                                说明：该收费标准是以每分钟多少金额来进行收费定价，在参与视频咨询后会把相应的金额打入到余额中。
                            </div>
                            <div class="recharge-btn-box">
                                <button class="test-btn recharge-submit" id="submit" type="button">保存</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 收费标准 / end -->
    <!-- 公共footer / end -->
    <script>


        $("#line").mouseover(function(){
            $(".introduce").css('display','block');
        });
        $("#on-line").mouseout(function(){
            $(".introduce").css('display','none');

        });
        $("#on-line").mouseover(function(){
            $(".introduce").css('display','block');
        });
        $("#line").mouseout(function(){
            $(".introduce").css('display','none');

        });
        $('#line').click(function () {
            var html = $('#line').html();
            var islinemeetmoney = {{$linefee}};
            if(html=='已开启'){
                $('#line').html('已关闭');
                $('#ismoney').attr('disabled','disabled');
                $("#line").css('background','orangered');
                $('#ismoney').val(islinemeetmoney);

            }
            if(html=='已关闭'){
                $('#line').html('已开启');
                $("#ismoney").attr("disabled",false);
                $("#line").css('background','green');
            }
        })

        $('#on-line').click(function (){
            var html = $('#on-line').html();
            var isonlinemeetmoney = {{$fee}};
            if(html=='已开启'){
                $('#on-line').html('已关闭');
                $('#money').attr('disabled','disabled');
                $("#on-line").css('background','orangered');
                $('#money').val(isonlinemeetmoney);
            }
            if(html=='已关闭'){
                $('#on-line').html('已开启');
                $("#money").attr("disabled",false);
                $("#on-line").css('background','green');
            }
        })

        $(function(){
            $('#submit').click(function () {
                var linefee = $('#ismoney').val();
                var fee = $('#money').val();
                var islinemeethtml = $('#line').html();
                var isonlinemeethtml = $('#on-line').html();
                if(islinemeethtml=='已开启'){
                    var islinemeet = 1;
                }else{
                    var islinemeet = 0;
                }
                if(isonlinemeethtml=='已关闭'){
                    var isonlinemeet = 0;
                }else{
                    var isonlinemeet = 1;
                }

                if(linefee == {{$linefee}} && fee=={{$fee}} && islinemeet=={{$islinemeet}} && isonlinemeet=={{$isonlinemeet}}){
                    layer.msg('收费标准相同无需修改');
                    return false;
                }
                $('#submit').attr('disabled','disabled');
                $.ajax({
                    url:"{{asset('/uct_standard')}}",
                    data:{'linefee':linefee,'islinemeet':islinemeet,'fee':fee,'isonlinemeet':isonlinemeet},
                    dataType:"json",
                    type:"POST",
                    success:function(data){
                        if (data.icon == 1){
                            layer.msg(data.msg,{'time':1000,'icon':data.icon},function () {
                                window.location = '{{asset('/uct_standard')}}';
                            });
                        } else {
                            layer.msg(data.msg,{'time':1000,'icon':data.icon});
                            //window.location = '{{asset('/uct_standard')}}';
                        }
                    }
                })
            })
        });
    </script>
@endsection