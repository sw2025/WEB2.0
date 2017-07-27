@extends("layouts.ucenter")
@section("content")
<div class="main">
            <!-- 我的视频咨询 / start -->
            <h3 class="main-top">我的视频咨询</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="myneed-com-name">
                        XXXXXX公司
                    </div>
                    <div class="uct-video-manage myask-invite">
                        <div class="video-manage-top">
                            <div class="vid-man-top-lt vid-man-top-main">
                                <div class="vid-man-top-con">
                                    <p class="vid-man-top-cat"><span class="light-color">分类：</span>销售类</p>
                                    <p class="vid-man-top-cat"><span class="light-color">金额：</span>￥3000</p>
                                    <p class="vid-man-top-cat"><span class="light-color">时间：</span>2017-01-01 12:00-13:00</p>
                                    <span class="light-color">描述：</span>
                                    <div class="vid-man-top-desc">水电费个好久昆明是的风光好进口法国红酒对方过后更好更换即可对方过后法国红酒刚回家法国会尽快法国红酒对方</div>
                                </div>
                            </div>
                            <div class="vid-man-top-rt vid-man-top-main">
                                <div class="vid-man-top-con">
                                    <div class="emcee">
                                        <span class="light-color emcee-cap">主持人：</span>
                                        <span class="emceer-pers"><i class="iconfont icon-gerenzhongxin"></i>专家一</span>
                                    </div>
                                    <div class="emcee-bottom">
                                        <span class="light-color emcee-cap emcee-bot-cap">成员：</span>
                                        <div class="emcee-members">
                                            <span class="emceer-pers"><i class="iconfont icon-gerenzhongxin"></i>专家一</span>
                                            <span class="emceer-pers"><i class="iconfont icon-gerenzhongxin"></i>专家一</span>
                                            <span class="emceer-pers"><i class="iconfont icon-gerenzhongxin"></i>专家一</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="video-manage-frame">

                        </div>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    $(function(){
        $('.bank-card').keyup(function(){
            var value=$(this).val().replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1 ");
            $(this).val(value)
        })
    })
</script>
@endsection