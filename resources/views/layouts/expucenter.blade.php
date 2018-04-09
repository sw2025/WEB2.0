<div class="sw-pop"></div>
<div class="sw-aside">
    <div class="sw-avatar-wrapper">
            <span class="sw-set-Wrapper">
                <img src="{{$showimage2 or ''}}" class="sw-avatar">
                <a href="javascript:;" class="sw-setting"><i class="iconfont icon-cog" onclick=window.location="{{url('personalSet')}}"></i></a>
            </span>
        <span class="sw-avatar-name" style="font-size: 12px;">{{$expertname or ''}}</span>
    </div>
    <ul class="sw-aside-list my-ucenter">
        <li class="sw-aside-item" id="expmyshow">
            <a href="{{url('expmyshow/myShowList')}}" class="sw-item-title my1"><i class="iconfont ">&#xe693;</i> 我的评议 </a>
        </li>
        <li class="sw-aside-item" id="expmymeet">
            <a href="{{url('expmymeet/myMeetList')}}" class="sw-item-title my2"><i class="iconfont ">&#xe661;</i> 我的约见</a>
        </li>
        <li class="sw-aside-item" id="expmysector">
            <a href="{{url('expmysector/mySectorList')}}" class="sw-item-title my3"><i class="iconfont ">&#xe610;</i> 我的私董会</a>
        </li>
        <li class="sw-aside-item" id="expshows">
            <a href="javascript:;" class="sw-item-title my3"><i class="iconfont ">&#xe610;</i> 项目中心</a>
        </li>
        <li class="sw-aside-item" id="expmycharge">
            <a href="{{url('expmycharge/myCharge')}}" class="sw-item-title my4"><i class="iconfont ">&#xe631;</i> 我的钱包</a>
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
        window.location = "{{url('/expindex/index')}}";
    });

      

    

</script>