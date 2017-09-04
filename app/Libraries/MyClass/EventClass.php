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
                switch($v->domain1){
                    case '投融资':
                        $v->icon = 'v-manage-link-icon';
                        break;
                    case '产品升级换代':
                        $v->icon = 'v-manage-link-icon nature1';
                        break;
                    case '战略定位':
                        $v->icon = 'v-manage-link-icon nature2';
                        break;
                    case '市场拓展':
                        $v->icon = 'v-manage-link-icon nature3';
                        break;
                    default :
                        $v->icon = 'v-manage-link-icon';
                        break;
                }
            }
            return $data;
        }
    }
?>