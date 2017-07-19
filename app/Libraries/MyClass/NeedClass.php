<?php
    class  NeedClass extends BaseClass{
        /**处理首页数据
         * @param $datas
         * @return mixed
         */
        public static  function dataHandle($datas){
            foreach ($datas as $data){
                $briefs=$data->brief;
                $times=$data->created_at;
                $data->created_at=date("Y-m-d",strtotime($times));
                if(mb_strlen($briefs,"utf8")>20){
                   $data->brief=mb_substr($briefs,0,20,"utf8")."...";
                }
            }
            return $datas;
        }
    }
?>