<?php 
    class  ConsultClass extends BaseClass{

        static public $statusarr = [
            4 => '已邀请',
            5 => '已响应',
            6 => '正在咨询',
            7 => '已完成'
        ];

        static public function handelObj ($data)
        {
            foreach($data as $v){
                $v->brief = mb_strcut($v->brief,0,40,'utf-8').'...';
                $v->consulttime = date('Y年m月d日',strtotime($v->starttime)). '-'.date('Y年m月d日',strtotime($v->endtime));
                $v->status = self::$statusarr[$v->configid];
            }
            return $data;
        }
    }
?>