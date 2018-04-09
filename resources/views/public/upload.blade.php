@extends("layouts.master")
@section("content")
    <link type="text/css" rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('webupload/webuploader.css')}}">
    <script type="text/javascript" src="{{asset('webupload/webuploader.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery/jquery.qrcode.min.js')}}"></script> 
    <style type="text/css">
            #picker {
            display: inline-block;
            line-height: 1.428571429;
            vertical-align: middle;
            margin: 0 12px 0 0;
        }
        .btn-default:active, .btn-default.active {
            background-color: #e0e0e0;
            border-color: #dbdbdb;
            box-shadow: inset 0 3px 5px rgba(0,0,0,0.125);
        }
        .btn-default:hover, .btn-default:focus {
            background-color: #e0e0e0;
            background-position: 0 -15px;
        }
        .btn-default{
                text-shadow: 0 1px 0 #fff;
                background-image: -webkit-linear-gradient(top,#fff 0,#e0e0e0 100%);
                background-image: linear-gradient(to bottom,#fff 0,#e0e0e0 100%);
                background-repeat: repeat-x;
                border-color: #dbdbdb;
                border-color: #ccc;
                color: #333;
                background-color: #fff;
                display: inline-block;
                padding: 6px 12px;
                margin-bottom: 0;
                font-size: 14px;
                font-weight: normal;
                line-height: 1.428571429;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                cursor: pointer;
                border-radius: 4px;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                -o-user-select: none;
                user-select: none;
        }
        .uploader-list {
            width: 100%;
            overflow: hidden;
        }
    </style>
    <div class="swcontainer sw-ucenter" style="min-height: 400px;">
        <div class="main" style="margin-top: 105px">
            <h1 style="font-size: 22px;color: #61498f;margin-bottom: 25px;">文件扫码上传 <i class="iconfont" style="font-size: 23px;">&#xe7f6;</i></h1>
        </div>

        <div id="uploader" class="wu-example">
            <!--用来存放文件信息-->
            <div id="thelist" class="uploader-list"></div>
            <div class="btns">
                <div id="picker">选择文件</div>
                <button id="ctlBtn" class="btn btn-default" style="display: none">开始上传</button>
            </div>
        </div>

        <div id="code" style="display: none;padding: 20px;"></div> 
               
    </div>



    <script type="text/javascript">

        //var shuffle = "{{$shuffle}}";
        var shuffle = 15515258286;
        var timeout;
        var uploader = WebUploader.create({

            // swf文件路径
            swf:   '/webupload/Uploader.swf',

            // 文件接收服务端。
            server: 'http://test2.sw2025.com/acceptfile',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#picker',
            accept:{
                title: 'PDF',
                extensions: 'pdf',
                mimeTypes: 'application/pdf'
            },
            fileNumLimit:1,
            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false

        });

        uploader.on( 'fileQueued', function( file ) {
            $list = $('#thelist');
            $list.html('');
            $list.append( '<div id="' + file.id + '" class="item">' +
                '<h4 class="info">' + file.name + '</h4>' +
                '<p class="state">等待上传...</p>' +
            '</div>' );

            $('#ctlBtn').css('display','inline');
        });

        uploader.on( 'uploadProgress', function( file, percentage ) {
            var $li = $( '#'+file.id ),
                $percent = $li.find('.progress .progress-bar');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<div class="progress progress-striped active">' +
                  '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                  '</div>' +
                '</div>').appendTo( $li ).find('.progress-bar');
            }

            $li.find('p.state').text('上传中');

            $percent.css( 'width', percentage * 100 + '%' );
        });

        uploader.on( 'uploadSuccess', function( file ) {
            $( '#'+file.id ).find('p.state').text('已上传成功');
            $('#picker').css('background-color','#ccc');
            $('#ctlBtn').css('display','none');
            $('#picker .webuploader-pick').css('background-color','#ccc');
            $('#picker input').attr('disabled','true');
            layer.msg('已上传');
        });

        uploader.on( 'uploadError', function( file ) {
            $( '#'+file.id ).find('p.state').text('上传出错 请重新上传或者查看是否文件过大');
            layer.msg('上传出错 请重新上传或者查看是否文件过大');
        });

        uploader.on( 'uploadComplete', function( file ) {
            $( '#'+file.id ).find('.progress').fadeOut();
        });

         $("#code").qrcode({ 
            render: "table", //table方式 
            width: 200, //宽度 
            height:200, //高度 
            text: shuffle //任意内容 
        }); 

        $('#ctlBtn').on('click',function () {
            layer.open({
              type: 1,
              title: '扫码开始上传',
              closeBtn: 0,
              shadeClose: false,
              shade:0.8,
              move:false,
              content: $('#code'),
            });
            timeout = window.setInterval(function(){
                $.post('/getUploadStatus',{'code':shuffle},function (data) {
                    if(data.code == 1){
                        window.clearInterval(timeout);
                        layer.msg('扫码成功,开始上传',function () {
                            layer.closeAll();
                            uploader.option( 'formData', {
                                code: shuffle,
                            });
                            uploader.upload();
                        });
                    } else if(data.code == 3){
                        window.clearInterval(timeout);
                        layer.msg('您已经扫码上传成功请重新扫码上传',function () {
                            window.location = window.location.href;
                        });   
                    }
                });
            },3000);

        });

       
        
    </script>
@endsection