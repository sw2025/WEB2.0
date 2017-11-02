<?php 
    class  ConsultClass extends BaseClass{

        static public $statusarr = [
            4 => '已邀请',
            5 => '已响应',
            6 => '正在咨询',
            7 => '已完成',
            8 => '已评价',
            9 => '异常结束'
        ];

        static public $statusarr2 = [
            0 => '待响应',
            1 => '待响应',
            2 => '已响应',
            3 => '正在办事',
            4 => '已完成',
            5 => '已失效'
        ];

        static public function handelObj ($data)
        {
            foreach($data as $v){
                $v->brief = mb_strcut($v->brief,0,400,'utf-8').'...';
                $v->consulttime = date('Y年m月d日',strtotime($v->starttime)). '-'.date('Y年m月d日',strtotime($v->endtime));
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


        static public function handelObj2 ($data)
        {

            foreach($data as $v){
                $v->brief = mb_strcut($v->brief,0,400,'utf-8').'...';
                $v->consulttime = date('Y年m月d日',strtotime($v->consulttime));
                $v->status = self::$statusarr2[$v->state];
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
                switch($v->state){
                    case 0:
                        $v->btnicon = 'eventput';
                        break;
                    case 1:
                        $v->btnicon = 'eventput';
                        break;
                    case 2:
                        $v->btnicon = 'response';
                        break;
                    case 3:
                        $v->btnicon = 'eventing';
                        break;
                    case 4:
                        $v->btnicon = 'eventend';
                        break;
                    case 5:
                        $v->btnicon = 'eventdont';
                        break;
                }
            }
            return $data;
        }
    }
?>