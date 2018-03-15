<div class="sw-pop"></div>
<div class="sw-aside">
    <div class="sw-avatar-wrapper">
            <span class="sw-set-Wrapper">
                <img src="{{$showimage or ''}}" class="sw-avatar" style="cursor: pointer;" onclick= window.location="{{url('/entindex/index')}}">
                <a href="javascript:;" class="sw-setting"><i class="iconfont icon-cog" onclick=window.location="{{url('personalSet')}}"></i></a>
            </span>
        <span class="sw-avatar-name" style="font-size: 12px;">{{$enterprisename or ''}}</span>
    </div>
    <ul class="sw-aside-list">
        <li class="sw-aside-item">
            <a href="javascript:;" class="sw-item-title" style="cursor:default;color:#a18e8e">我的创业孵化</a>
            <ul class="sw-aside-sublist">
                <li id="entmyshow">
                    <a href="{{url('entmyshow/myshowindex')}}">VC直评</a>
                </li>
                <li id="entmymeet">
                    <a href="{{url('entmymeet/mymeetindex')}}">约见投资人</a>
                </li>
                <li id="entmylineshow">
                    <a href="{{url('entmylineshow/mylineshowindex')}}">直通路演</a>
                </li>
            </ul>
        </li>
        <li class="sw-aside-item">
            <a href="javascript:;" class="sw-item-title" style="cursor:default;color:#a18e8e">我的成长加速</a>
            <ul class="sw-aside-sublist">
                <li id="entmydav">
                    <a href="{{url('entmydav/mydavindex')}}">约见大V</a>
                </li>
                <li id="entmysector">
                    <a href="{{url('entmysector/mysectorindex')}}">线上私董会</a>
                </li>
            </ul>
        </li>
        <li class="sw-aside-item">
            <a href="javascript:;" class="sw-item-title" style="border-top: 2px solid #e0e0e0; cursor:default;color:#a18e8e">我的转型加速</a>
            <ul class="sw-aside-sublist">
                <li id="entmydav">
                    <a href="">提交项目</a>
                </li>

            </ul>
        </li>
    </ul>

    <button type="button" class="sw-left-btn"><i class="iconfont icon-rilijiantouyoushuang"></i></button>
</div>
