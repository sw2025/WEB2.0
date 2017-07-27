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
                    <div class="mywork-det">
                        <span class="myask-detail-need"><em class="light-color myask-detail-cap">需求分类：</em>销售类</span>
                        <span class="myask-detail-time"><em class="light-color">时间：</em>2017-01-01 12:00-13:00</span>
                        <div class="mywork-det-txt">
                            <div class="mywork-det-desc">
                                <em class="light-color">描述：</em>
                                <p class="mywork-det-desc-para">水电费个好久昆明是的风光好进口法国红酒对方过后更好更换即可对方过后法国红酒刚回家法国会尽快法国红酒对方过后风格好久法国红酒法规和你们更好更好费个好久昆明是的风光好进口法国红酒对方过后更好更换即可对方过后法国红酒刚回家法法规进口法国红酒对方过后更好更换即可对方回家法法规</p>
                            </div>
                        </div>
                        <div class="respond-btn-box">
                            <!-- 状态按钮根据实际状态只展示一个 -->
                            <button type="button" class="unrespond respond-btn">响应</button>
                            <button type="button" class="responded respond-btn">已响应</button>
                            <span class="respond-tips">请等待企业邀请，未获企业邀请</span>
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