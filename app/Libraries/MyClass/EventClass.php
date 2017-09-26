<?php
    class  EventClass extends BaseClass{

        static public $statusarr = [
            4 => '已邀请',
            5 => '已响应',
            6 => '正在办事',
            7 => '已完成',
            8 => '已评价',
            9 => '已终止'
        ];

        static public function handelObj ($data)
        {
            foreach($data as $v){
                $v->brief = mb_strcut($v->brief,0,400,'utf-8').'...';
                $v->eventtime = date('Y年m月d日',strtotime($v->eventtime));
                $v->status = self::$statusarr[$v->configid];
                switch($v->domain1){
                    case '找资金':
                        $v->icon = 'v-manage-link-icon';
                        break;
                    case '找技术':
                        $v->icon = 'v-manage-link-icon nature1';
                        break;
                    case '定战略':
                        $v->icon = 'v-manage-link-icon nature2';
                        break;
                    case '找市场':
                        $v->icon = 'v-manage-link-icon nature3';
                        break;
                    default :
                        $v->icon = 'v-manage-link-icon';
                        break;
                }
                switch($v->configid){
                    case 1:
                        $v->btnicon = 'eventwait';
                        break;
                    case 2:
                        $v->btnicon = 'eventfollow';
                        break;
                    case 3:
                        $v->btnicon = 'eventdont';
                        break;
                    case 4:
                        $v->btnicon = 'eventput';
                        break;
                    case 5:
                        $v->btnicon = 'response';
                        break;
                    case 6:
                        $v->btnicon = 'eventing';
                        break;
                    case 7:
                        $v->btnicon = 'eventend';
                        break;
                    case 8:
                        $v->btnicon = 'eventend';
                        break;
                    case 9:
                        $v->btnicon = 'eventdont';
                        break;
                }
            }
            return $data;
        }
    }
?>