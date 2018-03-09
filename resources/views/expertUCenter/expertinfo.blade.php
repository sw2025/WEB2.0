@extends("layouts.master")
@section("content")

    <link type="text/css" rel="stylesheet" href="{{asset('css/ucenterProView.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/fillIn.css')}}">
    <script type="text/javascript" src="{{asset('js/fill.js')}}"></script>


    <!-- banner -->
<div class="junior-banner">
    <div class="swcontainer">
        <div class="jun-banner-cap">
            <a href="#" class="jun-banner-btn">创业孵化</a>
            <span class="jun-banner-intro">在线提交创业项目</span>
            <p>获得投资人论证评议+反馈，<br>融资之路不再迷茫。</p>
        </div>
    </div>
</div>
<!-- 主体 -->
<div class="swcontainer sw-ucenter">
    <!-- 个人中心左侧 -->
    @include('layouts.expucenter')
    <!-- 个人中心右侧 -->
    <div class="sw-mains">
        <!-- 主体 -->
        <h1 style="font-size: 20px;margin: 0 auto;    width: 70%;">专家认证</h1>
        @if($data->configid == 2)
            <h1 style="margin: 0 auto;width: 70%;color: green;">当前认证状态：审核通过</h1>
        @elseif($data->configid == 3)
            <h1 style="margin: 0 auto;width: 70%;color: #ff1100;">当前认证状态：审核未通过 原因：{{$data->remark}}</h1>
        @endif

        
        <div class="sw-fillin">

            <div class="sw-fill-row">
                <span class="sw-fill-left">大V名称</span>
                <input type="text" class="sw-fill-inp name" placeholder="请输入您的姓名" value="{{$data->expertname or null}}">
            </div>
            <div class="sw-fill-row">
                <span class="sw-fill-left">所在机构</span>
                <input type="text" class="sw-fill-inp organiza" placeholder="请输入您的所在机构" value={{$data->organiza or null}}>
            </div>
            <div class="sw-fill-row">
                <span class="sw-fill-left">所处职位</span>
                <input type="text" class="sw-fill-inp job" placeholder="请输入您的所处职位" value={{$data->job or null}}>
            </div>
            <div class="sw-fill-row">
                <span class="sw-fill-left">工作年限</span>
                <input type="text" class="sw-fill-inp worklife" placeholder="" value={{$data->worklife or null}}>
            </div>
            <div class="sw-fill-row">
                <span class="sw-fill-left">擅长行业</span>
                <div class="sw-fill-select">
                    <a href="javascript:;" class="sw-fill-opt domain">{{$data->domain1 or '请选择'}}</a>
                    <ul class="sw-fill-list">
                        @foreach($cate as $v)
                            <li>{{$v->domainname}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="sw-fill-row">
                <span class="sw-fill-left">所在地区</span>
                <div class="sw-fill-select">
                    <a href="javascript:;" class="sw-fill-opt address">{{$data->address or '请选择'}}</a>
                    <ul class="sw-fill-list">
                        <li>北京</li>
                        <li>上海</li>
                        <li>天津</li>
                        <li>重庆</li>
                        <li>河北</li>
                        <li>山西</li>
                        <li>内蒙古</li>
                        <li>辽宁</li>
                        <li>吉林</li>
                        <li>黑龙江</li>
                        <li>江苏</li>
                        <li>浙江</li>
                        <li>安徽</li>
                        <li>福建</li>
                        <li>江西</li>
                        <li>山东</li>
                        <li>河南</li>
                        <li>湖北</li>
                        <li>湖南</li>
                        <li>广东</li>
                        <li>广西</li>
                        <li>海南</li>
                        <li>四川</li>
                        <li>贵州</li>
                        <li>云南</li>
                        <li>西藏</li>
                        <li>陕西</li>
                        <li>甘肃</li>
                        <li>青海</li>
                        <li>宁夏</li>
                        <li>新疆</li>
                        <li>台湾</li>
                        <li>香港</li>
                        <li>澳门</li>
                    </ul>
                </div>
            </div>
            <div class="sw-fill-row">
                <span class="sw-fill-left">个人简介</span>
                <textarea type="text" style="height: 170px;"  class="sw-fill-textarea brief" placeholder="请输入您的个人简介 1000字以内">{{$data->brief or null}}</textarea>
            </div>
            <div class="sw-fill-row">
                <span class="sw-fill-left">教育背景</span>
                <input type="text" class="sw-fill-inp edubg" placeholder="" value={{$data->edubg or null}}>
            </div>
            <div class="sw-fill-row">
                <span class="sw-fill-left">工作经历</span>
                <textarea type="text"  class="sw-fill-textarea workexperience" placeholder="">{{$data->workexperience or null}}</textarea>
            </div>
            <div class="sw-fill-row sw-row-avatar">
                <form id="formdata">
                <span class="sw-fill-left">头像<br /> <small style="font-size: 11px;">(建议上传144*144或等比例照片)</small></span>
                <div class="sw-fill-right">
                    <div class="sw-upload-ava"><img id="avatar" src="@if(empty($data->showimage)) {{asset('img/avatar.jpg')}} @else @endif {{env('ImagePath').$data->showimage}}" /></div><!-- 上传的图片摆放位置 -->
                    <input type="hidden" id="myAvatar" name="myAvatar" value="/images/15078855261649.jpg">
                    <div class="sw-upload-wrapper">
                    <span class="sw-upload-btn">
                        <span>选&nbsp;&nbsp;&nbsp;择</span>
                        <input class="hide-upbtn" id="fileupload" type="file" name="files[]" data-url="https://www.sw2025.com/upload" multiple=""  @if($data->configid != 1)disabled @endif accept="image/png, image/gif, image/jpg, image/jpeg">
                    </span>
                    </div>

                </div>
                </form>

            </div>

            <p class="sw-btn-wrapper">
                @if($data->configid == 1)
                    <button class="sw-btn-submit" id="submit" type="button">保&nbsp;&nbsp;存</button>
                @elseif($data->configid == 2)
                    <button class="sw-btn-submit" type="button">审核已通过</button>
                @else
                    <button class="sw-btn-submit" type="button">审核未通过</button>
                @endif

            </p>
        </div>
    </div>
</div>
<!-- 底部 -->
    <script>

        $('.hide-upbtn').on('change',function (e) {
            var path =  $(this).val();
            $('#avatar').attr('src',fileComment($(this)[0]));
            $(this).attr('index',path);
            //$(this).text(value2);
        });

        function fileComment(obj) {
            /*获取input=file图片路径*/
            var objUrl = getObjectURL(obj.files[0]);
            if (objUrl) {
                return objUrl;
            }
        }
        //获取上传图片路径2
        function getObjectURL(file) {
            var url = null;
            if (window.createObjectURL != undefined) { // basic
                url = window.createObjectURL(file);
            } else if (window.URL != undefined) { // mozilla(firefox)
                url = window.URL.createObjectURL(file);
            } else if (window.webkitURL != undefined) { // webkit or chrome
                url = window.webkitURL.createObjectURL(file);
            }
            return url;
        }

        $('#submit').on('click',function () {
            var name = $('.name').val();
            var organiza = $('.organiza').val();
            var job = $('.job').val();
            var worklife = $('.worklife').val();
            var domain = $('.domain').text();
            var address = $('.address').text();
            var brief = $('.brief').val();
            var edubg = $('.edubg').val();
            var workexperience = $('.workexperience').val();
            var upload= $('.hide-upbtn').val();    //上传文件

            if(name == '' || organiza == '' || job == '' || address=='' || worklife == '' || brief == '' || edubg == '' || workexperience==''||upload==''){
                layer.alert('请填写完整信息');
                return false;
            }

            if(domain == '请选择'){
                layer.alert('请选择擅长行业');
                return false;
            }

            var fileObj = document.getElementById("fileupload").files[0]; // js 获取文件对象
            var formFile = new FormData();
            formFile.append("expertname", name);
            formFile.append("organiza", organiza);
            formFile.append("domain", domain);
            formFile.append("job", job);
            formFile.append("worklife", worklife);
            formFile.append("address", address);
            formFile.append("brief", brief);
            formFile.append("edubg", edubg);
            formFile.append("workexperience", workexperience);
            formFile.append("file", fileObj); //加入文件对象
            if($.trim(upload)!='1'){
                if (typeof (fileObj) == "undefined" || fileObj.size <= 0) {
                    layer.alert('请选择正确的文件');
                    return false;
                }
            }


            $(this).attr('disabled',true);
            $(this).text('正在提交');
            $.ajax({
                url: "{{url('submitExpertVerify')}}",
                data: formFile,
                type: "Post",
                dataType: "json",
                cache: false,//上传文件无需缓存
                processData: false,//用于对data参数进行序列化处理 这里必须false
                contentType: false, //必须
                success: function (data) {
                    if(data.icon==1){
                        layer.msg(data.msg,{'icon':data.icon,'time':2000},function () {
                            window.location = window.location.href;
                        });
                    } else {
                        if(data.code==3){
                            window.location = "{{url('/login')}}";
                            return false;
                        }
                        layer.msg(data.msg,{'icon':data.icon,'time':2000},function () {
                            window.location = window.location.href;
                        });
                    }
                },
            });
        });
    </script>
@endsection