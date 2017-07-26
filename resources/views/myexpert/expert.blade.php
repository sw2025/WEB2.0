@extends("layouts.ucenter")
@section("content")
<div class="main">
            <!-- 发布需求 / start -->
            <h3 class="main-top">专家认证</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="card-step">
                        <span class="green-circle">1</span>资料提交<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">2</span>资料审核<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">3</span>认证成功
                    </div>
                    <div class="expert-certy">
                        <div class="expert-certy-state">
                            <i class="iconfont icon-tijiaoziliao"></i>
                                <span class="expert-certy-blue">
                                    <em>资料提交</em>THE DATA SUBMITTED
                                </span>
                        </div>
                        <div class="datas">
                            <div class="datas-lt">
                                <div class="datas-lt-enter">
                                    <div class="datas-sel zindex1">
                                        <span class="datas-sel-cap">专家分类</span><a href="javascript:;" id="category" class="datas-sel-def">个人</a>
                                        <ul class="datas-list">
                                            <li>个人</li>
                                            <li>机构</li>
                                        </ul>
                                    </div>
                                    <div class="datas-sel">
                                        <span class="datas-sel-cap">输入姓名</span>
                                        <input class="datas-sel-name" type="text" placeholder="" />
                                    </div>
                                    <div class="datas-sel zindex1">
                                        <span class="datas-sel-cap">所在行业</span><a href="javascript:;" id="industry" class="datas-sel-def">不限</a>
                                        <ul class="datas-list">
                                            <li>不限</li>
                                            <li>IT|通信|电子|互联网</li>
                                            <li>金融业</li>
                                            <li>房地产|建筑业</li>
                                            <li>商业服务</li>
                                            <li>贸易|批发|零售|租赁业</li>
                                            <li>文体教育|工艺美术</li>
                                            <li>生产|加工|制造</li>
                                            <li>交通|运输|物流|仓储</li>
                                            <li>服务业</li>
                                            <li>文化|传媒|娱乐|体育</li>
                                            <li>能源|矿产|环保</li>
                                            <li>政府|非盈利机构</li>
                                            <li>农|林|牧|渔|其他</li>
                                        </ul>
                                    </div>
                                    <div class="datas-sel zindex2">
                                        <span class="datas-sel-cap">地区</span><a href="javascript:;" id="address" class="datas-sel-def">不限</a>
                                        <ul class="datas-list">
                                            <li>全国</li>
                                            <li>北京市</li>
                                            <li>上海市</li>
                                            <li>天津市</li>
                                            <li>重庆市</li>
                                            <li>河北省</li>
                                            <li>山西省</li>
                                            <li>内蒙古</li>
                                            <li>辽宁省</li>
                                            <li>吉林省</li>
                                            <li>黑龙江省</li>
                                            <li>江苏省</li>
                                            <li>浙江省</li>
                                            <li>安徽省</li>
                                            <li>福建省</li>
                                            <li>江西省</li>
                                            <li>山东省</li>
                                            <li>河南省</li>
                                            <li>湖北省</li>
                                            <li>湖南省</li>
                                            <li>广东省</li>
                                            <li>广西省</li>
                                            <li>海南省</li>
                                            <li>四川省</li>
                                            <li>贵州省</li>
                                            <li>云南省</li>
                                            <li>西藏</li>
                                            <li>陕西省</li>
                                            <li>甘肃省</li>
                                            <li>青海省</li>
                                            <li>宁夏</li>
                                            <li>新疆</li>
                                            <li>台湾省</li>
                                            <li>香港</li>
                                            <li>澳门</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="datas-upload-box clearfix">
                                    <div class="datas-upload-lt">
                                        <img src="img/photo1.jpg" class="photo1" />
                                        <div class="photo-upload">
                                            <div class="photo-btn-box fileinput-button">
                                                <span class="photo-btn-tip">上传营业执照</span>
                                                <input id="photo1" type="file" name="files[]"  data-url="{{asset('upload')}}" multiple="" accept="image/png, image/gif, image/jpg, image/jpeg">
                                            </div>
                                            <p class="datas-lt-explain">营业执照仅做认证用，不用做其它用途</p>
                                        </div>
                                    </div>
                                    <div class="datas-upload-rt">
                                        <img src="img/photo2.jpg" class="photo1" />
                                        <div class="photo-upload">
                                            <div class="photo-btn-box fileinput-button">
                                                <span class="photo-btn-tip">上传宣传照片</span>
                                                <input id="photo2" type="file" name="files[]" data-url="{{asset('upload')}}" multiple="" accept="image/png, image/gif, image/jpg, image/jpeg">
                                            </div>
                                            <p class="datas-lt-explain">宣传照片用于展示企业，请选择企业Logo或展现企业风采的照片</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="datas-rt">
                                <textarea placeholder="请输入专家描述" id="brief" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="bottom-btn"><button class="test-btn submit-audit" type="button">提交审核</button></div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
    $(function(){
        $('.datas-sel-def').click(function() {
            $(this).next('ul').stop().slideToggle();
            $(this).parent().siblings().children('ul').hide();
        });
        $('.datas-list li').click(function() {
            var publishHtml = $(this).html();
            $(this).parent().prev('.datas-sel-def').html(publishHtml);
            $(this).parent().hide();
        });

        $('')

    })


 /*   $(function () {
        var token = $.cookie('token');
        $('#photo2').fileupload({
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
    });*/



    $(function () {
        $('.submit-audit').click(function(){
            $('.submit-audit').attr('disabled','disabled');
            var category=$('#category').html();
            var name=$('.datas-sel-name').val();
            var industry=$('#industry').html();
            var address=$('#address').html();
            var photo1=$('#photo1').val();
            var photo2=$('#photo2').val();
            var brief=$('#brief').val();

            if(name=='' || photo1==''){
                return false;
            }

            $.ajax({
                url:"{{asset('/uct_expertData')}}",
                data:{"category":category,"name":name,"industry":industry,"address":address,"photo1":photo1,"photo2":photo2,"brief":brief},
                dataType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=="success"){
                        window.location.href="{{asset('/uct_expert')}}";
                    }else{
                        alert("审核失败");
                        window.location.href="{{asset('/uct_expert')}}";
                    }
                }
            })

        });
    })
</script>

@endsection