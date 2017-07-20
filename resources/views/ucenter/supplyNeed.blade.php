@extends("layouts.ucenter")
@section("content")
    <div class="main">
            <!-- 发布需求 / start -->
            <h3 class="main-top">发布需求</h3>
            <div class="ucenter-con">
                <div class="main-right">
                    <div class="card-step">
                        <span class="green-circle">1</span>提交需求<span class="card-step-cap">&gt;</span>
                        <span class="gray-circle">2</span>需求审核
                    </div>
                    <div class="publish-need">
                        <div class="publish-need-sel">
                            <span class="publ-need-sel-cap">需求分类</span><a href="javascript:;" class="publ-need-sel-def">请选择</a>
                            <ul class="publish-need-list">
                                <li>
                                    <a href="javascript:;">销售类</a>
                                    <ul class="publ-sub-list">
                                        <li>demo1</li>
                                        <li>demo2</li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;">销售类</a>
                                    <ul class="publ-sub-list">
                                        <li>demo1</li>
                                        <li>demo2</li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;">销售类</a>
                                    <ul class="publ-sub-list">
                                        <li>demo1</li>
                                        <li>demo2</li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;">销售类</a>
                                    <ul class="publ-sub-list">
                                        <li>demo1</li>
                                        <li>demo2</li>
                                    </ul>
                                </li>
                            </ul>
                            <textarea name="" class="publish-need-txt" cols="30" rows="10" placeholder="请输入需求描述"></textarea>
                        </div>
                        <div><button class="test-btn publish-submit" type="button">提交</button></div>
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript">
    $(function(){
        $('.publ-need-sel-def').click(function() {
            $(this).next('ul').stop().slideToggle();
        });
        $('.publish-need-list li').hover(function() {
            $(this).children('ul').stop().show();
        }, function() {
            $(this).children('ul').stop().hide();
        });

        $('.publ-sub-list li').click(function() {
            var publishHtml = $(this).html();
            $('.publ-need-sel-def').html(publishHtml);
            $('.publish-need-list').hide();
        });
    })
</script>
@endsection