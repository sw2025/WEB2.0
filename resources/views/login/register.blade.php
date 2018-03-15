@extends("layouts.master")
@section("content")
    <link type="text/css" rel="stylesheet" href="css/login.css">
    <script type="text/javascript" src="js/reg.js"></script>
    <script type="text/javascript" src="{{asset('js/payJudge.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/jquery/jquery.qrcode.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/qrcode.min.js')}}"></script>
    <script type="text/javascript" src="{{url('/js/pingpp.js')}}"></script>
    <style>
        .lawerpop{overflow-y: scroll;padding:10px 20px;line-height: 24px;color:#333;}
        .lawerpop h3{text-align: center;font-size: 20px;height:48px;line-height: 48px;font-weight: normal;}
        .lawerpop p,.lawerpop h4{text-indent: 2em;}
        .layui-layer-btn{text-align: center;}
         .changeWeixin img{
             margin:0 auto;
         }
    </style>
    <!-- 登录 / start -->
    <div class="section sw-bg">
        <div class="swcontainer">
            <div class="user-box user-register-top">
                <h2 class="login-tit">用户注册</h2>
                <span class="login-en-tit">USER REGISTRATION</span>
                <p class="user-tel">
                    <label><i class="iconfont icon-gerenzhongxin1"></i></label><input type="text" placeholder="请输入手机号" class="user-tel-inp" />
                </p>
                <p class="user-test clearfix">
                    <span class="user-test-enter"><label><i class="iconfont icon-duanxinapptuisongmoban"></i></label>
                    <input type="text" placeholder="短信验证码" class="user-test-inp" /></span>
                    <input type="button" class="get-test" id="getCode" value="获得验证码" />
                </p>
                <p class="user-pwd user-register-pwd">
                    <label><i class="iconfont icon-mima"></i></label><input type="password" placeholder="请设置密码" class="user-pwd-inp" />
                </p>
               {{-- <div class="user-role">
                    <label><i class="iconfont icon-iconzh2"></i></label>
                    <div class="user-role-opt"><a href="javascript:;">角色</a>
                    <span class="mutil-choice"><i class="iconfont icon-xiangxiajiantou"></i></span></div>
                    <ul class="user-role-list">
                        <li>企业</li>
                        <li>个人</li>
                    </ul>
                </div>--}}
                <button type="button" class="login-btn">注 册</button>
                <div class="login-bottom">
                    <a href="javascript:;" class="protocol">注册协议</a>
                    <span class="go-login">已有账号，去 <a href="javascript:;" class="to-log switchtype">登录</a></span>
                </div>
            </div>
        </div>
    </div>

    <div class="layer-pop" style="position:fixed;background: rgba(0,0,0,0.3);top: 0;left: 0;width: 100%;height: 100%;z-index: 19891016;display: none;">
        <div class="popWx" style="position: absolute;top: 10%;width: 285px;border: 2px solid #ccc;left: 50%;top: 50%;margin: -160px 0 0 -145px;background: #fff;text-align: center;border-radius: 3px;font-size: 14px;padding: 30px 0 27px;">
            <div class="changeWeixin">
                <div class="popWeixin" id="code">
                </div>
            </div>
            <span class="weixinLittle"></span>
            <div class="weixinTips" style="display: none"><strong>扫瞄二维码完成支付</strong><br>支付完成后请关闭二维码</div>
            <a href="javascript:;" class="closePop" title="关闭" style="position: absolute;top: 0;right: 0;"><i class="iconfont icon-chahao"></i></a>
        </div>
    </div>
    <!-- 登录 / end -->
    <script type="text/javascript">
        $(function(){
            // 获取验证码
            var wait=60;
            function time(o) {
                var o = document.getElementById("getCode");
                if (wait == 0) {
                    o.removeAttribute("disabled");
                    o.value="获得验证码";
                    wait = 60;
                } else {
                    o.setAttribute("disabled", true);
                    o.value= wait + "秒";
                    wait--;
                    setTimeout(function() {
                                time(o)
                            },
                            1000)
                }
            }
            //获取验证码js
            document.getElementById("getCode").onclick=function(){
                var phone= $(".user-tel-inp").val();
                var reg1 = /^1[3578][0-9]{9}$/;//手机号
                if(!(reg1.test(phone))){
                    layer.tips('手机号不能为空或输入错误', '.user-tel', {
                        tips: [2, '#e25633'],
                        time: 4000
                    });
                    return false;
                }
                $.ajax({
                    url:"{{url('getCode')}}",
                    data:{"phone":phone,"action":"register"},
                    dataType:"json",
                    type:"POST",
                    success:function(res){
                        if(res['code']=="code"){
                            layer.tips(res['msg'], '.get-test', {
                                tips: [2, '#e25633'],
                                time: 4000
                            });
                            return false;
                        }else if(res['code']=="phone"){
                            layer.tips(res['msg'], '.user-tel', {
                                tips: [2, '#e25633'],
                                time: 4000
                            });
                            return false;
                        }else{
                            $(this).attr('disabled',true);
                            time();
                        }
                    }
                })
            }


            $('.hover-info').hover(function(){
                $('.hover-info-show').stop().fadeToggle();
            })

            var protocol = '<div class="lawerpop"><h3>升维网平台注册协议</h3><p>升维网用户注册协议:</p><p>本协议是您与升维网，服务等相关事宜所订立的契约，请您仔细阅读本注册协议，您点击"同意并继续"按钮后，本协议即构成对双方有约束力的法律文件。</p> 升维网（www.swchina.com）由本网站负责运营，所提供的各项服务的所有权和运作权均归本网站所有。《升维网用户服务协议》系由用户与本网站的各项服务所订立的相关权利义务规范，适用于用户在本网站的全部活动。</p><p>用户在注册本网站前必须仔细阅读本协议条款，否则用户无权注册。用户一旦注册，即表示接受并同意本协议的所有条件和条款，不愿接受本协议条款的，不得注册。本网站依据本协议为用户提供服务。用户还应不时注意本协议修改情况，在本协议修改后用户继续使用本网站或接受本网站服务时，视为用户同意该修改。</p> 升维网就用户服务及知识产权、隐私权等已经发布的（包括知识产权声明、隐私权规则等）或将来可能发布的任何规则均为本协议不可分割的组成部分，与本协议具有同等的法律效力。 升维网有权对本协议进行修改，修改后的协议在本网站公布后即有效代替原来的协议。用户可随时查阅本协议并以最新协议为准。</p><h4>一、定义</h4><p>1、“用户”指为使用或可能使用服务而升维网注册并登记的自然人、法人或其他组织。</p><p>2、“本协议”指《升维网用户服务协议》。</p><h4>二、特别提醒</h4><p>本网站在此依法做出特别声明如下：</p><p>1、本网站采取以下合理的方式提请用户注意本协议条款：（1）在本协议中本网站以明确的足以引起用户注意的加粗字体等合理方式提醒用户注意相关条款；（2）用户还应特别注意任何未明确以加粗字体等形式标记的，但含有“不承担”、“免除”“不得”“应该”“必须”“承诺”“保证”“无需”“同意”等形式用语的条款。该等条款的确认将导致用户在特定情况下的被动、不便或损失，包括但不限于本协议第二条、第三条、第四条、第五条、第六条、第七条、第八条、第九条等，请用户在确认同意本协议之前再次阅读上述条款。</p><p>2、用户与本网站确认上述条款非属于《中华人民共和国合同法》第40条规定的“免除其责任、加重对方责任、排除对方主要权利的”的条款，本网站尊重用户诉讼的权利，但相关诉讼由资芽所在地人民法院管辖，用户选择同意注册或访问本网站、使用本网站各项服务即视为双方对此约定达成了一致意见。</p><p>3、本网站采取以下方式向用户说明本协议相关条款：用户如有任何条款需要说明的，请立即停止注册或使用本网站，同时立即致电010-64430881。若用户未致电至本网站即视为同意该等条款，则双方在此确认本网站已依法履行了根据用户要求对相关条款进行说明的法定义务，本网站已给予用户充足的时间与充分的选择权来决定是否缔结本协议。</p><p>4、鉴于本网站已依法明确了上述条款、履行了格式条款制订方的义务，用户点击注册或使用本网站各项服务，将被视为且应当被视为用户已经完全注意并同意了本协议所有条款，尤其是提醒用户注意条款的合法性及有效性，用户不应以本网站未对格式条款以合理方式提醒用户注意或未根据用户要求予以说明为由而声称或要求法院或其它任何第三方确认相关条款违法或无效。</p><h4>三、服务内容</h4><p>1、本网站运用自己的系统，根据用户提交的资料:</p><p>（1）作为债权/资产处置等需求信息发布方，用户可以通过互联网络等方式在本网站发布债权/资产处置（包括但不限于需要进行诉讼及非诉讼委托、债权/资产转让等）等需求信息，并可能获得债权、资产处置等其他处置、服务方（包括但不限于接受诉讼、非诉讼委托及受让债权/资产等）的关注。</p><p>（2）作为债权/资产处置服务方，用户可以了解到在本网站发布的各类债权/资产处置等需求信息（包括但不限于需要进行诉讼及非诉讼委托、债权/资产转让等），并可能获得债权/资产处置等需求信息发布方的关注/联系。</p><p>前款所述债权/资产处置等需求信息、债权/资产处置等其他需求发布方信息及债权/资产处置服务方信息均由用户自行描述或填写，用户一旦选择上传/提交，则视为同意全部发布/披露在本网站上。但本网站为维护用户权益及本网站正常运营，有权视情况对部分信息进行模糊化/选择性处理，相关信息发布或披露的具体时间、内容、详尽程度等均由本网站自行确定，用户承诺并保证，任何时候均不因本协议所述的信息发布或披露事宜而主张本网站之违约或侵权。 用户必须自行准备如下设备和承担如下开支：</p><p>上网设备，包括但不限于电脑或者其他上网终端及其他上网装置等；</p><p>（2）上网开支，包括但不限于网络接入费、手机流量费等。</p><p>3、用户提供发布的信息将被显示在公共区域，本网站提请用户在决定公布信息前仔细考虑。</p><h4>四、服务的提供、修改、中止及终止</h4><p>1、用户在注册或接受本网站各项服务的同时，同意接受本网站提供的各类信息服务。用户在此授权本网站可以适时向用户电子邮箱、手机、通信地址等发送信息。</p><p>2、本网站有权随时修改、限制、中止或终止服务而无需通知用户。本网站的修改、限制、中止、终止服务的行为无需对用户或任何第三方负责。但本网站的该等行为不能免除用户根据本协议或在本网站生成的其他协议项下（或有）还未履行完毕的义务。</p><p>3、若用户对本协议的修改有异议:（1）用户可以停止访问本网站或停止使用本网站的各项服务；（2）本网站有权不经任何告知终止、中止本协议或限制用户进入本网站的全部或者部分板块且不承担任何法律责任。</p><p>本网站服务中止、终止或限制用户的行为后，本网站没有义务传送任何未处理的信息或未完成的服务给用户或任何第三方，且该等终止、中止或限制行为并不能豁免用户在本网站已经进行的行为所应承担的义务。</p><h4>五、用户信息的保密</h4><p>1、本协议所称用户信息是指符合法律、法规及相关规定，并符合下列情形的信息：</p><p>（1）用户在本网站注册时，向本网站提供的本人/单位（自然人/法人/其他组织）基本信息（如身份信息、手机号码、通讯地址、电子邮件地址等）；</p><p>（2）用户在接受本网站服务、访问本网站网页时，本网站自动接收并记录的用户的浏览器端或手机客户端数据，包括但不限于IP地址、网站Cookie中的资料及用户要求取用的网页记录； <p>（3）在本网站发布信息时按照本网站要求上传、提交的资料复印件、扫描件。 </p><p>2、本网站对于用户信息将按照本协议及本网站的隐私权规则予以保护、使用或者披露。</p><p>3、在下述情况下，用户信息将会被部分或全部披露：</p><p>（1）为提供用户所要求的产品和服务，而必须和第三方分享用户的个人/法人/其他组织信息；</p><p>（2）经用户同意向其他第三方（非本网站用户）披露；</p><p>（3）根据法律、法规等相关规定，或行政机关要求，向行政机关、司法机构或其他法律规定的第三方披露；</p><p>（4）其它根据法律、法规等相关规定进行的披露。</p><p>4、用户知悉并同意，鉴于本网站为信息发布平台及用户发布信息的目的，本网站有权对用户信息及提交的相关资料适时向其他用户披露全部或部分。</p><h4>六、用户权利</h4><p>1、用户名、密码及安全性</p><p>（1）用户有权选择是否在本网站注册，用户选择在本网站注册的，用户名的命名及使用应遵守相关法律、法规并符合道德规范，不能侵害他人合法权益。</p><p>（2）用户有义务在注册时提供自己的真实资料，并保证诸如电子邮件地址、联系电话、联系地址、邮政编码等内容的真实性、有效性及安全性。其他用户有权通过司法部门要求本网站提供该等相关资料。</p><p>（3）用户一旦在本网站注册成功，将得到用户名和密码，并对以此组用户名和密码登入本网站系统后所发生的所有活动和事件负责，自行承担一切使用该用户名发布/产生的言语、行为等直接或者间接导致的法律责任。</p><p>（4）用户有义务妥善保管在本网站的用户名和密码，用户将对用户名和密码安全负全部责任。因用户转让、授权给第三方使用或非因本网站故意或重大过失导致用户名或密码泄露而造成的任何法律后果由本人自行承担。该原因包括但不限于：遗忘或泄漏密码，密码被他人破解，用户使用的计算机被他人侵入等。</p><p>2、用户有权修改其个人账户中各项可修改信息，自行决定是否提供非必填项的内容。</p><p>3、用户有权根据本协议及本网站发布的相关规则，利用本网站发布债权/资产处置等需求信息，查询发布的债权/</p>资产处置等需求信息信息，有权接受本网站提供的其他有关资讯及信息服务。</p><h4>七、用户义务</h4><p>1、用户应合法使用本网站提供的服务及网站内容，不得利用本站危害国家安全、泄露国家秘密，不得侵犯国家、社会、集体的和公民的合法权益，不得利用本站制作、复制和传       播下列信息：</p><p>（1）煽动抗拒、破坏宪法和法律、行政法规实施的；</p><p>（2）煽动颠覆国家政权，推翻社会主义制度的；</p><p>（3）煽动分裂国家、破坏国家统一的；</p><p>（4）煽动民族仇恨、民族歧视，破坏民族团结的；</p><p>（5）捏造或者歪曲事实，散布谣言，扰乱社会秩序的；</p><p>（6）宣扬封建迷信、淫秽、色情、赌博、暴力、凶杀、恐怖、教唆犯罪的；</p><p>（7）公然侮辱他人或者捏造事实诽谤他人的，或者进行其他恶意攻击的；</p><p>（8）损害国家机关信誉的；</p><p>（9）其他违反宪法和法律、行政法规及规章的。</p><p>2、不得利用本网站用户身份进行违反诚实信用的任何行为；不得通过任何手段恶意注册本网站帐号，亦不得盗用其他用户帐号；不得将本网站以任何形式作为从事各种非法活动的场所、平台或媒介；未经本网站的授权或许可，不得借用本网站的名义从事任何商业活动，也不得以任何形式将本网站作为从事商业活动的场所、平台或媒介。</p><p>3、禁止在本网站从事任何可能违反中国现行的法律、法规、规章和政府规范性文件的行为或者任何未经授权使用本网站的行为，如擅自进入本网站的未公开的系统、不正当的使用密码和网站的任何内容等。</p><p>4、用户若作为债权/资产处置等需求信息发布方，应对其发布的相关信息所涉债权/资产等其他需求享有合法权益，或接受享有合法权益的第三方合法委托发布。</p><p>5、对于用户提供的注册资料或其他上传本网站的文件资料，用户承诺并保证如下： （1）提供合法、有效、真实、准确、详尽的注册资料及本网站要求上传的其他资料； </p>（2）前述如有变动，及时更新相关资料；（3）违反前两项承诺及保证的，自行承担因此引起的相应责任及法律后果，且本网站有终止本人使用本网站各项服务的权利。 用户承诺并保证：提交注册资料、其他资料及发布信息的用户是该等资料所对应的自然人、法人或其他组织。 </p><p>6、用户在本网站以各种形式发布的一切信息，均应符合国家法律、法规等相关规定及网站相关规定，符合社会公序良俗，不侵犯任何第三方的合法权益，否则用户自行承担因此产生的一切法律后果，且本网站因此受到的损失，包括但不限于为此而支出的律师费、调查费、鉴定费、诉讼费及赔偿等，均有权向用户追偿。</p><p>7、用户如违反本协议规定，则本网站有权直接采取一切必要的措施，包括但不限于删除用户发布的信息、删除星级评定或暂停、查封用户帐号，通过诉讼形式追究用户法律责任等。</p><h4>八、知识产权及其他</h4><p>1、用户保证：已经详细阅读，并明确了解本网站的《知识产权声明》。</p><p>2、任何用户接受本协议，即表明该用户主动将其在任何时间段在本网站发表的任何形式的信息的著作财产权，包括但不限于：复制权、发行权、出租权、信息网络传播权、改编权、翻译权、汇编权等，以及应当由著作权人享有的其他可转让权利，均无偿独家转让给本网站运营商即资芽所有，同时表明该用户许可本网站有权就任何主体侵权而单独提起诉讼，并获得全部赔偿。本协议已经构成《中华人民共和国著作权法》第二十五条所规定的书面协议，其效力及于用户在本网站发布的任何受著作权法保护的作品内容，无论该内容形成于本协议签订前还是本协议签订后。</p><p>3、升维网拥有本网站内容及资源的版权,受法律保护,享有对本网站各种协议、声明、规则的修改权；未经资芽的明确书面许可，任何第三方不得为任何非私人或商业目的获取或使用本网站的任何部分或通过本网站可直接或间接获得的任何内容、服务或资料。任何第三方违反本协议的规定以任何方式，和/或以任何文字对本网站的任何部分进行发表、复制、转载、更改、引用、链接、下载或以其他方式进行使用，或向任何其他第三方提供获取本网站任何内容的渠道，则对本网站的使用权将立即终止，且任何第三方必须按照资芽的要求，归还或销毁使用本网站任何部分的内容所创建的资料及任何副本。</p><p>4、本网站未向任何第三方转让本网站或其中的任何内容所相关的任何权益或所有权，且一切未明确向任何第三方授予的权利均归资芽所有。未经本协议明确允许而擅自使用本网站任何内容、服务或资料的，构成对本协议的违约行为或违法行为，资芽保留对任何违反本协议规定的第三方提起诉讼的权利。</p><p>5、资芽可适时对本协议进行修改及更新。对本协议的所有改动一经在本网站上发布即产生法律效力，并适用于改动发布后对本网站的一切注册、访问和使用行为。如用户在修改后的本协议发布后继续使用本网站的，即代表用户接受并同意了这些修改。用户应定期查看本网站，了解对用户具有约束力的本协议的任何修改。</p><p>6、用户同意，其注册本网站的行为视为无条件且不可撤销的许可/同意本网站使用其名称、商标、图文资料、公司简介、资质、人员简介、业务情况等资料，直至其注销在本网站的账户。</p><h4>九、不保证及免责</h4><p>1、本网站作为提供信息发布的平台，本网站、资芽及其他关联方不保证网站上的信息及服务能充分满足用户的需求或能达成任何交易。对于用户在接受本网站的服务过程中可能遇到的描述错误、不准确、延误、不匹配等，本网站不承担法律责任。 </p><p>2、基于本网站的属性及互联网的特殊性，对于在本网站内发布的信息，本网站已经尽到法定的及合理的注意/审查义务，本网站对在本网站内发布的或以任何方式从本网站获得的任何信息，不保证其真实性、合法性、有效性、完整性，用户需自行认定；对于用户因本网站上信息发布后与其他用户之间产生的各种法律关系及法律纠纷，本网站不承担责任，用户自行承担使用本网站信息内容所导致的风险。 本网站郑重提醒：本网站属于信息发布平台，用户与其他用户联系、沟通过程中须谨慎，并自行认定对方信息/情况是否真实、有效，是否委托/接受委托或与之进行合作。</p><p>3、基于互联网的特殊性，本网站不保证服务不会受中断，对服务的及时性、安全性均不予保证。本网站力图使用户能对本网站进行安全访问和使用，但本网站不声明也不保证本网站或其服务器是不含病毒或其它潜在有害因素的；因本网站、服务器或者涉及的第三方网站的设备、系统存在缺陷或者因为计算机病毒造成的损失，本网站均不负责赔偿，用户可以与本网站终止本协议并停止使用本网站。但是，中国现行法律、法规另有规定的除外。</p><p>4、本网站及资芽不对用户所发布信息的保存、修改、删除或储存失败负责。对网站上的非因本网站故意或重大过失所导致的排字错误、疏忽等不承担责任。本网站有权但无义务，改善或更正本网站任何部分之疏漏、错误。</p><p>5、本网站内所有用户发表的信息，仅代表用户个人观点，并不表示本网站赞同其观点或证实其描述，本网站不承担因此引发的任何法律责任。本网站郑重提醒：用户与其他用户联系、沟通过程中须谨慎。</p><p>6、本网站有权删除本网站内各类不符合法律或本协议规定的或侵害第三人合法权益的信息而无需通知用户。</p><h4>十、有关侵权的投诉</h4><p>1、根据《中华人民共和国侵权责任法》第三十六条，任何第三方认为，用户利用本网站平台侵害其民事权益或实施侵权行为的，包括但不限于侮辱、诽谤等，被侵权人有权书面通知本网站采取删除、屏蔽、断开链接等必要措施。</p><p>任何第三方（包括但不限于自然人、法人等）认为本网站用户发布的任何信息或利用本网站平台侵犯其合法权益的，权利人有权向本网站发出通知书，通知书应当包含下列内容：</p><p>（1）权利人的姓名（名称）、联系方式和地址；</p><p>（2）要求删除或者断开链接的信息和网络地址；</p><p>（3）构成侵权的初步证明材料；</p><p>（4）通知书应包含以下声明：“本人本着诚信原则，有证据认为该对象侵害本人或他人的合法权益。本人承诺投诉并提供的全部信息均真实、准确、合法、有效，并自愿承担一切后果。”。 <p>（5）权利人亲笔签字并注明日期，如代理他人投诉的，必须出具权利人签字/盖章的授权书。</p> 通知及相关证明材料扫描件发送至：shengwei2025@163.com。本网站认为必要时，权利人还应将相关文件原件邮寄至以下地址以便核实：地址：北京市朝阳区安贞里浙江大厦1601，邮编：100020；收件人：升维网。</p><p>2、权利人应当对通知书及相关侵权证明材料的的真实性负责。本网站提请注意：如果对侵权投诉不实，则权利人可能承担法律责任。</p><h4>十一、法律适用及管辖</h4><p>1、因用户使用本网站而引起或与之相关的一切争议、权利主张或其它事项，均适用中华人民共和国法律。 </p><p>2、用户和本网站发生争议的，应根据诚实信用原则通过协商加以解决。如果协商不成，则应向资芽所在地人民法院提起诉讼。</p><h4>十二、条款的可分割性</h4><p>若本协议的任何条款被认定为不合法、无效或者无法实施时，则该等条款应视为可分割，不影响本协议其他条款的法律效力。</p><h4>十三、其他</h4><p>1、18周岁以上且具有完全民事行为能力的自然人可以成为本网站用户（仅作为债权/资产处置等需求信息发布方）；根据中国法律、法规、行政规章依法成立并合法存续的法人、其他组织可以成为本网站用户（作为债权/资产处置等需求信息发布方或债权/资产处置服务方）。如用户不符合资格，请勿注册。本网站保留随时中止或终止用户资格的权利。</p><p>2、本着方便用户的原则，本网站含有到其他网站的链接，本网站对链接网站的隐私保护措施不负任何责任。本网站不能保证也没有义务保证第三方网站上信息的真实性和有效性。用户应按照第三方网站的服务协议使用第三方网站，而不是按照本协议。第三方网站的内容、产品、广告和其他任何信息均由用户自行判断并承担风险，与本网站无关。</p><p>3、本网站可能在任何需要的时候增加合作伙伴或本网站关联方网站，但是提供给他们的将仅仅是综合信息，并不涉及用户的个人信息。</p><p>4、本网站没有义务监测网站内容，但是用户确认并同意本网站有权不时地根据法律、法规、政府要求透露、修改或者删除必要的、合适的信息，以便更好地运营本网站并保护自身及本网站其他合法用户。</p><p>5、由于用户违反本协议或任何法律、法规或侵害第三方的权利，而引起第三方对本网站提出的任何形式的索赔、要求、诉讼，本网站有权向用户追偿相关损失，包括但不限于本网站为此支付的律师费、调查费、诉讼费、鉴定费等费用以及名誉损失、向第三方支付的赔偿金、补偿金等。</p><p>6、在本网站的某些部分或页面中可能存在除本协议以外的单独的附加服务条款，当这些条款与本协议存在冲突时，在该部分或页面中存在的附加条款优先适用。</p></div> '
            $('.protocol').on('click',function(){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['9rem', '500px'],
                    content: protocol,
                    btn: ['确定']
                });
            })

        })


        $(".login-btn").on("click",function(){
            var that=this;
            var reg1 = /^1[3578][0-9]{9}$/;//手机号
            var reg2 = /^[a-zA-Z0-9]{6,18}$/;//密码
            var phone=$(".user-tel-inp").val();
            var pwd=$(".user-pwd-inp").val();
            var code=$(".user-test-inp").val();
            var role='企业';
            var type="{{$type}}";
            var id= "{{$id}}";
            if(!(reg1.test(phone))){
                layer.tips('手机号不能为空或输入错误', '.user-tel', {
                    tips: [2, '#e25633'],
                    time: 4000
                });
                return false;
            };
            if(!(reg2.test(pwd))){
                layer.tips('密码只能是6-18位的数字或者字母', '.user-pwd', {
                    tips: [2, '#e25633'],
                    time: 4000
                });
                return false;
            };
            if(!code){
                layer.tips('验证码不能为空!', '.user-test', {
                    tips: [2, '#e25633'],
                    time: 4000
                });
                return false;
            }
            $(this).attr('disabled',true);
            $(this).html('注册中...');
            $.ajax({
                url:"{{url('registerHandle')}}",
                data:{"phone":phone,"passWord":pwd,"codes":code,"role":role,'id':parseInt(id),'type':type},
                dateType:"json",
                type:"POST",
                success:function(res){
                    if(res['code']=="phone"){
                        layer.tips(res['msg'], '.user-tel', {
                            tips: [2, '#e25633'],
                            time: 4000
                        });
                        $(that).removeAttr('disabled');
                        $(that).html('注册');
                    }else if(res['code']=="code"){
                        layer.tips(res['msg'], '.user-test-inp', {
                            tips: [2, '#e25633'],
                            time: 4000
                        });
                        $(that).removeAttr('disabled');
                        $(that).html('注册');
                    }else{
                        var date = new Date();
                        date.setTime(date.getTime() + (120 * 60 * 1000));
                        $.cookie("userId",res['userId'],{expires:date,path:'/',domain:'sw2025.com'});
                        $.cookie("userId",res['userId'],{expires:date,path:'/',domain:'swchina.com'});
                        $.cookie("name",res['name'],{expires:date,path:'/',domain:'sw2025.com'});
                        $.cookie("name",res['name'],{expires:date,path:'/',domain:'swchina.com'});
                        $.cookie("role",res['role'],{expires:date,path:'/',domain:'sw2025.com'});
                        $.cookie("role",res['role'],{expires:date,path:'/',domain:'swchina.com'});
                        $.cookie("register","register",{path:'/',domain:'sw2025.com'});
                        $.cookie("register","register",{path:'/',domain:'swchina.com'});
                        if(type!='' && id!=''){

                            if(res.data.icon==2){
                                layer.msg(res.data.msg,function () {
                                    window.location.href="/";
                                    return false;
                                });
                            } else {
                                if($.trim(type)=='Submit'){
                                    window.location = '/keep'+type+'/'+id;
                                } else {
                                    callPingPay(res.data.data);
                                    $(that).html('注册完成,请支付');
                                    $('.closePop').on('click',function () {
                                        window.location = '/keep'+type+'/'+id;
                                    });
                                }

                            }
                        }else {
                            layer.open({
                                type: 1,
                                skin: 'layui-layer-rim', //加上边框
                                area: ['360px', '160px'],
                                title: false, //不显示标题
                                shadeClose: false, //开启遮罩关闭
                                content: '<div style="padding:10px;background: #e25633;color: #fff;"><span style="font-size:18px;">恭喜您注册成功</span><br /><br />在升维网做身份认证获取更多权益，是否继续认证？</div>',
                                btn: ['认证大V','认证企业','暂不认证'],
                                yes: function(index, layero){
                                    window.location.href="{{asset('uct_mywork')}}";
                                },btn2: function(index, layero){
                                    window.location.href="{{asset('uct_mywork')}}";
                                },btn3: function(index, layero){
                                    if({{$return}}){
                                        window.location.href="{{$returnurl}}";
                                    } else {
                                        window.location.href="{{asset('uct_mywork')}}";
                                    }
                                }
                            });
                        }

                    }
                }
            })
        })
    </script>

@endsection

