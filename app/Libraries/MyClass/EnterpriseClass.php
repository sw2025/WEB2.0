<?php
    class  EnterpriseClass extends BaseClass{

        /**添加文件的名字
         * @param $data
         */
        public static function processInsert ($data){
            //遍历data数组对象
            foreach ($data as $k => $v){
                //将文档的路径url解析出来获取到文件名
                $v->docname = preg_replace('/^.+[\\\\\\/]/', '', $v->documenturl);
                if(!empty($v->documenturl)){
                    //对文档的路径进行加密
                    $v->downurl = \Illuminate\Support\Facades\Crypt::encrypt($v->documenturl);
                    //获取到文档路径的上二级文件夹路径
                    $pathname = dirname(dirname($v->documenturl));
                    //获取到文档的上个文件夹路径
                    $firstname = dirname($v->documenturl);
                    if ($dh = opendir($pathname)) {
                        while (($file = readdir($dh)) !== false) {
                            //若文件名不是. .. 或者这个文件的本身
                            if($file!='.'&& $file!='..' && $pathname.'/'.$file != $firstname){
                                //打开上2级目录的其他文件夹
                                if(is_dir($pathname.'/'.$file)){
                                    if ($dh2 = opendir($pathname.'/'.$file)) {
                                        while (($file2 = readdir($dh2)) !== false) {
                                            if($file2!='.'&& $file2!='..'){
                                                //先把文件的名字改成utf-8的编码方式
                                                $file2=iconv("gb2312","utf-8",$file2);
                                                $nnn  = iconv("utf-8","gb2312",$pathname.'/'.$file.'/'.$file2);
                                                //把加密后的地址 放进 oldpath中 参数是文件的名称
                                                $v->oldpath[] = [$file2,\Illuminate\Support\Facades\Crypt::encrypt($pathname.'/'.$file.'/'.$file2),date('Y年m月d日 H时i分s秒',filemtime($nnn))];
                                            }
                                        }
                                        closedir($dh2);
                                    }
                                }

                            }
                        }
                        closedir($dh);
                    } else {
                        $v->downurl = null;
                        $v->oldpath = null;
                    }
                } else {
                    $v->downurl = null;
                    $v->oldpath = null;
                }
            }
            return $data;
        }
    }
?>