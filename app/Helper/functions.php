<?php

if(!function_exists('getDateRus')){
    function getDateRus($date) {
        $months = array(
            '01' => 'января', '02' => 'февраля', '03' => 'марта', '04' => 'апреля',
            '05' => 'мая', '06' => 'июня', '07' => 'июля', '08' => 'августа',
            '09' => 'сентября', '10' => 'октября', '11' => 'ноября', '12' => 'декабря'
        ); 
        $m = date('m', strtotime($date));
        $date_view = date("j ".$months[$m]." Y г.", strtotime($date));
        return $date_view;
    }
}

if(!function_exists('getDayRus')){
    function getDayRus($date) {
        $days = array(
            'воскресенье', 'понедельник', 'вторник', 'среда',
            'четверг', 'пятница', 'суббота'
        );
        $n = date("w", strtotime($date));
        return $days[(date($n))];
    }
}

if(!function_exists('getStage')){
    function getStage($date) {
        $curr_date = date("d.m.Y");
        $date_start = date("d.m.Y", strtotime($date));
        $new_date_start = date_create($date_start);
        $new_curr_date = date_create($curr_date);
        $date_diff = date_diff($new_date_start, $new_curr_date);
        $stage_float = $date_diff->y . ',' . $date_diff->m;
        $stage = floor((float) $stage_float);
        return $stage;
    }
}

if(!function_exists('getUrlPath')){
    function getUrlPath($url){
        $str = '';
        foreach($url as $key=>$val){
            $str .= '&'.$key.'='.$val;
        }
        return $str;
    }
}