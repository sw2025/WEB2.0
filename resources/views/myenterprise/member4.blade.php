@extends("layouts.ucenter")
@section("content")
<div class="main">
            <!-- 会员认证4 / start -->
            <h3 class="main-top">会员认证</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="card-step">
                        <span class="green-circle">1</span>资料提交<span class="card-step-cap">&gt;</span>
                        <span class="green-circle">2</span>资料审核<span class="card-step-cap">&gt;</span>
                        <span class="green-circle">3</span>认证成功
                    </div>
                    <div class="expert-certy">
                        <div class="expert-certy-state">
                            <i class="iconfont icon-huiyuanquanyi"></i>
                                <span class="expert-certy-blue">
                                    <em>了解会员权益</em>FOR MEMBERSHIP RIGHTS
                                </span>
                        </div>
                        <div class="datas datas-member-audit clearfix datas-vertical">
                            <div class="datas-lt">
                                <div class="datas-lt-enter">
                                    <div class="datas-sel">
                                        <input class="enterprise-inp" readonly="readonly" type="text" value="{{$data->enterprisename}}" placeholder="请输入企业全称" />
                                    </div>
                                    <div class="datas-sel zindex1">
                                        <span class="datas-sel-cap">企业规模</span><a href="javascript:;" class="datas-sel-def verify-default">{{$data->size}}</a>
                                        <ul class="datas-list">
                                            <li>不限</li>
                                            <li>20人以下</li>
                                            <li>20-99人</li>
                                            <li>100-499人</li>
                                            <li>500-999人</li>
                                            <li>1000-9999人</li>
                                            <li>10000人以上</li>
                                        </ul>
                                    </div>
                                    <div class="datas-sel zindex2">
                                        <span class="datas-sel-cap">所在行业</span><a href="javascript:;" class="datas-sel-def verify-default">{{$data->industry}}</a>
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
                                    <div class="datas-sel zindex3">
                                        <span class="datas-sel-cap">地区</span><a href="javascript:;" class="datas-sel-def verify-default">{{$data->address}}</a>
                                        <ul class="datas-list zone-list">
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
                                            <li>广西</li>
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
                                        <img src="{{env('ImagePath').$data->licenceimage}}" class="photo1" />
                                    </div>
                                    <div class="datas-upload-rt">
                                        <img src="{{env('ImagePath').$data->showimage}}" class="photo1" />
                                    </div>
                                </div>
                                <div class="expert-certy-state success-state">
                                    <i class="iconfont icon-chenggong"></i>
                                        <span class="publish-need-blue">
                                            <em>认证成功</em>AUTHENTICATION SUCCESS
                                        </span>
                                </div>
                            </div>
                            <div class="datas-rt">
                                <textarea placeholder="请输入企业简介（30-500字）" readonly="readonly" cols="30" rows="10">{{$data->brief}}</textarea>
                            </div>
                        </div>
                        <div class="bottom-btn"><button class="test-btn renew-btn" type="button">续费</button></div>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    $(function(){

    })
</script>
@endsection