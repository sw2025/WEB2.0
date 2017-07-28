<?php
    class  EventClass extends BaseClass{

        static public $statusarr = [
            4 => '已邀请',
            5 => '已响应',
            6 => '正在办事',
            7 => '已完成'
        ];

        static public function handelObj ($data)
        {
            foreach($data as $v){
                $v->brief = mb_strcut($v->brief,0,40,'utf-8').'...';
                $v->eventtime = date('Y年m月d日',strtotime($v->eventtime));
                $v->status = self::$statusarr[$v->configid];
            }
            return $data;
        }
    }
?>