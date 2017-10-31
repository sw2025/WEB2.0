@extends("layouts.ucenter4")
@section("content")
    <!-- 公共header / end -->
    <script src="{{asset('./FileUpload/js/vendor/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('./FileUpload/js/jquery.fileupload.js')}}"></script>
    <script src="{{asset('./FileUpload/js/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('./FileUpload/js/jquery.fileupload-process.js')}}"></script>
    <script src="{{asset('./FileUpload/js/jquery.fileupload-validate.js')}}"></script>
            <div class="main">
                <!-- 专家认证3 / start -->
                <h3 class="main-top">专家认证</h3>
                <div class="ucenter-con">
                    <div class="main-right">
                        <div class="card-step">
                            <span class="gray-circle">1</span>资料提交<span class="card-step-cap">&gt;</span>
                            <span class="gray-circle">2</span>资料审核<span class="card-step-cap">&gt;</span>
                            <span class="green-circle">3</span>认证成功
                        </div>
                        <div class="expert-certy">
                            <div class="expert-certy-state success-state">
                                <i class="iconfont icon-chenggong"></i>
                                <span class="publish-need-blue">
                                    <em>认证成功</em>AUTHENTICATION SUCCESS
                                </span>
                            </div>
                            <div class="datas datas-audit">
                                <div class="datas-lt">
                                    <div class="datas-lt-enter">
                                        <div class="datas-sel zindex1">
                                            <span class="datas-sel-cap">专家分类</span><a href="javascript:;" class="datas-sel-def verify-default">{{$data->category}}</a>

                                        </div>
                                        <div class="datas-sel">
                                            <span class="datas-sel-cap">名称</span>
                                            <input class="datas-sel-name" readonly="readonly" type="text" value="{{$data->expertname}}" style="color:#666;margin-left:50px;"/>
                                        </div>
                                        <div class="datas-sel zindex2" style="overflow:hidden;">
                                            <span class="datas-sel-cap">擅长领域</span><a href="javascript:;" class="datas-sel-def verify-default">
                                                @if($data->domain1=='找资金')
                                                    投融资
                                                @elseif($data->domain1=='找技术')
                                                    科研技术
                                                @elseif($data->domain1=='定战略')
                                                    战略管理
                                                @else
                                                    市场资源
                                                @endif
                                                -{{join('/',explode(',',$data->domain2))}}/</a>

                                        </div>
                                        <div class="datas-sel zindex3">
                                            <span class="datas-sel-cap">地区</span><a href="javascript:;" class="datas-sel-def verify-default">{{$data->address}}</a>

                                        </div>
                                    </div>
                                    <div class="datas-upload-box clearfix">
                                        <div class="datas-upload-lt">
                                            <img src="{{env('ImagePath').$data->licenceimage}}" class="photo1" />
                                            
                                        </div>
                                        <div class="datas-upload-rt">
                                            <img src="{{env('ImagePath').$data->showimage}}" class="photo1" />
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="datas-rt htxt1">
                                    <textarea placeholder="请输入专家描述" readonly="readonly" cols="30" rows="10">{{$data->brief}}</textarea>
                                </div>
                            </div>
                            <div class="bottom-btn">
                                <button class="test-btn submit-audit" type="button">重新认证</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 专家认证3 / end -->
<script>

</script>
    <!-- 公共footer / end -->
@endsection