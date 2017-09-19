<?php 
    class  ConsultClass extends BaseClass{

        static public $statusarr = [
            4 => '已邀请',
            5 => '已响应',
            6 => '正在咨询',
            7 => '已完成',
            8 => '已评价'
        ];

        static public function handelObj ($data)
        {
            foreach($data as $v){
                $v->brief = mb_strcut($v->brief,0,400,'utf-8').'...';
                $v->consulttime = date('Y年m月d日',strtotime($v->starttime)). '-'.date('Y年m月d日',strtotime($v->endtime));
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