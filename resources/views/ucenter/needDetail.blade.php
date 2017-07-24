@extends("layouts.ucenter")
@section("content")
    <script type="text/javascript" src="{{asset('js/reply.js')}}"></script>

    <div class="main">
            <!-- 我的需求 / start -->
            <h3 class="main-top">我的需求</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="myneed-com-name">
                        超级优秀的公司
                    </div>
                    <div class="myneeds">
                        <div class="myneed-con">
                            <span class="myneed-type">需求大类：销售类</span>
                            <span class="myneed-type">需求小类：销售类</span>
                            <span class="myneed-time">发布时间：<em>2017-07-21</em></span>
                            <div class="myneed-set"><button class="myneed-set-btn">设为已解决</button><span class="myneed-tips">提示：设为已解决后将不再展示</span></div>
                            <div class="myneed-icon">
                                <a href="javascript:;" class="collect"><i class="iconfont icon-likeo"></i>120</a>
                                <a href="javascript:;" class="visitor"><i class="iconfont icon-yanjing"></i>120</a>
                            </div>
                            <div class="myneed-desc">
                                <span class="myneed-desc-tit">需求描述</span>
                                <div class="myneed-desc-para">这次展览由广岛南京大屠杀展主办委员会和南京民间抗日战争博物馆等单位共同主办。展览的50块展板的文字和图片，全部由南京民间抗日战争博物馆提供，日本友好人士将其翻译成日文，又走访一批日本老兵作为证言附在后面。南京市民和平之旅代表团这次还带来了5组13件实物现场展出，包括日本兵中岛良藏给家人写的9封信件。由于中岛良藏在战争中死去，这些信件在日本战败后由其他日本兵带回日本，其中记录了他亲眼看到3万中国人在江边被杀害的情景。另外还有一面日本兵毛受作三记录其当时随部队侵华整个过程的日本旗，上面有攻入南京城的记录。</div>
                            </div>
                        </div>
                        <div class="message-list">
                            <div class="details-abs-tit">
                                <div class="details-graph forth"><span class="square"></span></div>
                                <span class="details-tit-cap forth-cap">留言列表</span>
                            </div>
                            <div class="all-replys">
                                <div class="mes-list-box clearfix">
                                    <div class="floor-host">
                                        <img src="{{asset('img/avatar1.jpg')}}" class="floor-host-ava" />
                                        <div class="floor-host-desc">
                                            <a href="javascript:;" class="floor-host-name">李道山</a><span class="floor-host-time">2017-7-8  17：25</span>
                                            <span class="floor-host-words">你好</span>
                                        </div>
                                    </div>
                                    <div class="message-reply-show">
                                        <a href="javascript:;" class="look-reply">查看回复（2）</a>
                                        <a href="javascript:;" class="message-reply">回复</a>
                                    </div>
                                    <div class="reply-list">
                                        <ul class="reply-list-ul">
                                            <li>
                                                <img src="{{asset('img/avatar2.jpg')}}" class="floor-guest-ava" />
                                                <div class="gloor-guest-cnt">
                                                    <a href="javascript:;" class="floor-guest-name">牛犇犇</a>
                                                    <span class="floor-guest-words">你好</span>
                                                </div>
                                                <div class="floor-bottom">
                                                    <span class="floor-guest-time">2017-7-8  17：25</span><a href="javascript:;" class="reply-btn">回复</a>
                                                </div>
                                            </li>
                                            <li>
                                                <img src="{{asset('img/avatar3.jpg')}}" class="floor-guest-ava" />
                                                <div class="gloor-guest-cnt">
                                                    <a href="javascript:;" class="floor-guest-name">李道山</a>回复&nbsp;<a href="javascript:;" class="floor-guest-name">牛犇犇</a>
                                                    <span class="floor-guest-words">你好</span>
                                                </div>
                                                <div class="floor-bottom">
                                                    <span class="floor-guest-time">2017-7-8  17：25</span><a href="javascript:;" class="reply-btn">回复</a>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="reply-box">
                                            <textarea class="reply-enter"></textarea>
                                            <div class="publish-box"><button class="publish-btn" type="button">发表</button></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mes-list-box clearfix">
                                    <div class="floor-host">
                                        <img src="{{asset('img/avatar1.jpg')}}" class="floor-host-ava" />
                                        <div class="floor-host-desc">
                                            <a href="javascript:;" class="floor-host-name">李道山</a><span class="floor-host-time">2017-7-8  17：25</span>
                                            <span class="floor-host-words">你好</span>
                                        </div>
                                    </div>
                                    <div class="message-reply-show">
                                        <a href="javascript:;" class="look-reply">查看回复（0）</a>
                                        <a href="javascript:;" class="message-reply">回复</a>
                                    </div>
                                    <div class="reply-list">
                                        <ul class="reply-list-ul">

                                        </ul>
                                        <div class="reply-box">
                                            <textarea class="reply-enter"></textarea>
                                            <div class="publish-box"><button class="publish-btn" type="button">发表</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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