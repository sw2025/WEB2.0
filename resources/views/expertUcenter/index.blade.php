@extends("layouts.ucenter4")
@section("content")
<!-- 公共header / end -->
<script src="{{asset('./FileUpload/js/vendor/jquery.ui.widget.js')}}"></script>
<script src="{{asset('./FileUpload/js/jquery.fileupload.js')}}"></script>
<script src="{{asset('./FileUpload/js/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('./FileUpload/js/jquery.fileupload-process.js')}}"></script>
<script src="{{asset('./FileUpload/js/jquery.fileupload-validate.js')}}"></script>
<h3 class="main-top">基本资料</h3>
    <div class="ucenter-con">
        <div class="main-right">
            <div class="basic-source">
                <p class="basic-tel basic-row clearfix">
                    <label for="">手机号：</label>
                    <span>{{$data->phone}}</span>
                    <a href="{{asset('basic/changeTel')}}" class="change-btn">更换</a>
                </p>
                <p class="basic-pwd basic-row clearfix">
                    <label for="">密<em></em>码：</label>
                    <span>******</span>
                    <a href="{{asset('basic/changePwd')}}" class="change-btn">修改</a>
                </p>
                <p class="basic-pet basic-row clearfix">
                    <label for="">昵<em></em>称：</label>
                    <input type="text" name="nickName" id="nickName" class="inpName basic-nickname" value="{{$data->nickname}}" />
                </p>
                <div class="basic-photo basic-row clearfix">
                    <div class="basic-rect"><img id="avatar" src="{{env('ImagePath').$data->avatar}}" /></div><!-- 上传的图片摆放位置 -->
                    <input type="hidden" id="myAvatar" name="myAvatar" value="{{$data->avatar}}">
                    <div class="basic-upload">
                            <span class="basic-span change-btn fileinput-button">
                                <span>上传头像</span>
                                <input id="fileupload" type="file" name="files[]" data-url="{{asset('upload')}}" multiple="" accept="image/png, image/gif, image/jpg, image/jpeg">
                            </span>
                    </div>
                </div>
                <button type="button" class="basic-btn">保存</button>
            </div>
        </div>
    </div>
<script>
    $(function () {
        var token = $.cookie('token');
        $('#fileupload').fileupload({
            dataType: 'json',
            maxFileSize: 1 * 1024 * 1024,
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    // console.log(file.name);
                    $("#avatar").attr('src','../../swUpload/images/'+file.name).show();
                    $("#myAvatar").val(file.name);
                });
            }
        });
    });
    $(".basic-btn").on("click",function(){
        var that=this;
        $(this).attr('disabled',true);
        $(this).html('正在修改');
        var nickName=$("#nickName").val();
        var myAvatar=$("#myAvatar").val();
        var userId=$.cookie("userId");
        $.ajax({
            url:"{{asset('changeBasics')}}",
            data:{"nickName":nickName,"myAvatar":myAvatar,"userId":userId},
            dataType:"json",
            type:"POST",
            success:function(res){
                $(that).removeAttr('disabled');
                $(that).html('修改');
                if(res['code']=="success"){
                    layer.msg("修改成功")
                }else{
                    layer.msg("修改失败")
                }
            }
        })
    })
</script>

@endsection("content")