<?php
    class  EnterpriseClass extends BaseClass{

        /**添加文件的名字
         * @param $data
         */
        public static function processInsert ($data){
            foreach ($data as $k => $v){
                $v->docname = preg_replace('/^.+[\\\\\\/]/', '', $v->documenturl);
                if(!empty($v->documenturl)){
                    $v->downurl = \Illuminate\Support\Facades\Crypt::encrypt($v->documenturl);
                    $pathname = dirname(dirname($v->documenturl));
                    $firstname = dirname($v->documenturl);
                    if ($dh = opendir($pathname)) {
                        while (($file = readdir($dh)) !== false) {
                            if($file!='.'&& $file!='..' && $pathname.'/'.$file != $firstname){
                                if(is_dir($pathname.'/'.$file)){
                                    if ($dh2 = opendir($pathname.'/'.$file)) {
                                        while (($file2 = readdir($dh2)) !== false) {
                                            if($file2!='.'&& $file2!='..'){
                                                $file2=iconv("gb2312","utf-8",$file2);
                                                $v->oldpath[$file2] = \Illuminate\Support\Facades\Crypt::encrypt($pathname.'/'.$file.'/'.$file2);
                                            }
                                        }
                                        closedir($dh2);
                                    }
                                }

                            }
                        }
                        closedir($dh);
                    } else {
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