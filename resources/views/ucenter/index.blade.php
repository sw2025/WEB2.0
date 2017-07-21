@extends("layouts.ucenter")
@section("content")
<!-- 公共header / end -->
    <div class="main">
        <h3 class="main-top">基本资料</h3>
        <div class="ucenter-con">
            <div class="main-right">
                <div class="basic-source">
                    <p class="basic-tel basic-row clearfix">
                        <label for="">手机号：</label>
                        <span>132****1234</span>
                        <a href="{{asset('uct_basic/changeTel')}}" class="change-btn">更换</a>
                    </p>
                    <p class="basic-pwd basic-row clearfix">
                        <label for="">密<em></em>码：</label>
                        <span>******</span>
                        <a href="{{asset('uct_basic/changeTel/changePwd')}}" class="change-btn">修改</a>
                    </p>
                    <p class="basic-pet basic-row clearfix">
                        <label for="">昵<em></em>称：</label>
                        <input type="text" class="inpName basic-nickname" value="" />
                    </p>
                    <div class="basic-photo basic-row clearfix">
                        <div class="basic-rect"><img src="img/avatar.jpg" /></div><!-- 上传的图片摆放位置 -->
                        <div class="basic-upload">
                                <span class="basic-span change-btn fileinput-button">
                                    <span>上传</span>
                                    <input id="" type="file" name="files[]" data-url="" multiple="" accept="image/png, image/gif, image/jpg, image/jpeg">
                                </span>
                        </div>
                    </div>
                    <button type="button" class="basic-btn">确定</button>
                </div>
            </div>
        </div>
    </div>

@endsection("content")