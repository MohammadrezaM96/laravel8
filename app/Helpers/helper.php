<?php

use Morilog\Jalali\Jalalian;

//function getSetting($key, $attr = null)
//{
//    return \App\Setting::getSet($key, $attr);
//}
//
//function getSettingId($key)
//{
//    return \App\Setting::getId($key);
//}

function convertDate($date){
    return Jalalian::forge($date)->ago();
}

?>
