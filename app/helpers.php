<?php

if (!function_exists('convert_name')) {
    function convert_name($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
        $str = preg_replace("/( )/", '_', $str);
        return $str;
    }
}

if (!function_exists('check_posttype')) {
    function check_posttype($title, $rw = null, $id = null)
    {
        $url = "#";
        switch ($title) {
            case 'tin-tuc':
                $url = $rw == null && $id == null ? route('news.tintuc') : route('news.detail', ['rw' => $rw == "" || $rw == null ? $id : $rw]);
                break;
            case 'truyen-thong-noi-gi-ve-chung-toi':
                $url = $rw == null && $id == null ? route('news.social.listing') : route('news.social', ['rw' => $rw == "" || $rw == null ? $id : $rw]);
                break;
            case 'khuyen-mai':
                $url = $rw == null && $id == null ? route('Promotion') : route('Promotion.detail', ['rw' => $rw == "" || $rw == null ? $id : $rw]);
                break;
            case 'chinh-sach':
                $url = $rw == null && $id == null ? route('news.policy.listing') : route('news.policy', ['rw' => $rw == "" || $rw == null ? $id : $rw]);
                break;
            default:
                $url = '#';
                break;
        }
        return $url;
    }
}

if(!function_exists('namePosttype')){
    function namePosttype($name, $default){
        $title = "";
        switch ($name) {
            case 'tin-tuc':
                $title = 'Tin tức';
                break;
            case 'truyen-thong-noi-gi-ve-chung-toi':
                $title = "Truyền thông nói về chúng tôi";
                break;
            default:
                $title = $default;
                break;
        }
        return $title;
    }
}

if (!function_exists('url_image')) {
    function url_image($url, $default_url = null)
    {
        if ($url == null || $url == "") {
            return $default_url;
        }
        if (str_contains($url, 'http') || str_contains($url, 'https')) {
            return $url;
        }
        return env('BASE_URL') . $url;
    }
}

if (!function_exists('formatDatetime')) {
    function formatDatetime($datetime)
    {
        $tz = 'Asia/Ho_Chi_Minh';
        if ($datetime == 'now') {
            $timestamp = time();
            $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
            $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
            return $dt->format('Y-m-dTH:i:sP');
        }
        $dt = new DateTime($datetime, new DateTimeZone($tz)); //first argument "must" be a string
        return $dt->format('Y-m-dTH:i:sP');
    }
}

if(!function_exists('percentSale')){
    function percentSale($oldPrice, $salePrice){
        if(intval($oldPrice == 0)){
            return 0;
        }
        $percent = 100 - intVal($salePrice) / (intVal($oldPrice) / 100);
        return $percent;
    }
}
