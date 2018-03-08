<div class="sw-pop"></div>
<div class="sw-aside">
    <div class="sw-avatar-wrapper">
            <span class="sw-set-Wrapper">
                <img src="{{$showimage or ''}}" class="sw-avatar">
                <a href="javascript:;" class="sw-setting"><i class="iconfont icon-cog"></i></a>
            </span>
        <span class="sw-avatar-name" style="font-size: 12px;">{{$enterprisename or ''}}</span>
    </div>
    <ul class="sw-aside-list">
        <li class="sw-aside-item">
            <a href="javascript:;" class="sw-item-title">我的创业孵化</a>
            <ul class="sw-aside-sublist">
                <li id="entmyshow">
                    <a href="{{url('entmyshow/myshowindex')}}">项目评议</a>
                </li>
                <li id="entmymeet">
                    <a href="#">约见投资人</a>
                </li>
                <li id="entmylineshow">
                    <a href="#">线下路演</a>
                </li>
            </ul>
        </li>
        <li class="sw-aside-item">
            <a href="javascript:;" class="sw-item-title">我的成长加速</a>
            <ul class="sw-aside-sublist">
                <li id="entmydav">
                    <a href="#">约见大咖</a>
                </li>
                <li id="entmyvideo">
                    <a href="#">线上私董会</a>
                </li>
            </ul>
        </li>
        <li class="sw-aside-item">
            <a href="javascript:;" class="sw-item-title">我的转型加速</a>
        </li>
    </ul>
    <button type="button" class="sw-left-btn"><i class="iconfont icon-rilijiantouyoushuang"></i></button>
</div>

<style>
    .sw-avatar{
        cursor: pointer;
    }
</style>
<script>
    $('.sw-avatar').on('click',function () {
        window.location = "{{url('/entindex/index')}}";
    });

</script>