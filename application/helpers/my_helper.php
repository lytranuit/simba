<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('config_item')) {

    function config_item($str) {
        $CI = &get_instance();
        $item = $CI->config->item($str);
        return $item;
    }

}
if (!function_exists('sluggable')) {

    function sluggable($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

}
if (!function_exists('get_url_seo')) {

    function get_url_seo($func, $param = array()) {
        $url = $func;
        $CI = &get_instance();
        $CI->load->model('page_model');
        $CI->load->helper('url');
        $page = $CI->page_model->where(array("link" => $func, "deleted" => 0))->as_array()->get_all();
        if (count($page)) {
            $url = $page[0]['seo_url'] != "" ? $page[0]['seo_url'] : $url;
            $pos = 0;
            foreach ($param as $row) {
                if (strpos($url, "(:num)", $pos) !== FALSE) {
                    $pos = strpos($url, "(:num)", $pos);
                    $length = 6;
                } elseif (strpos($url, "(.*)", $pos)) {
                    $pos = strpos($url, "(.*)", $pos);
                    $length = 4;
                } else {
                    break;
                }
                $url = substr_replace($url, $row, $pos, $length);
            }
        }
        return base_url() . $url;
    }

}
if (!function_exists('get_url_page')) {

    function get_url_page($id) {
        $url = "";
        $CI = &get_instance();
        $CI->load->model('pageweb_model');
        $CI->load->helper('url');
        $page = $CI->pageweb_model->where(array("id" => $id))->as_array()->get_all();
        if (count($page)) {
            $url = $page[0]['alias'];
        }
        return base_url() . $url;
    }

}
if (!function_exists('language_current')) {

    function language_current() {
        $CI = &get_instance();
        $language_current = $CI->config->item('language');
        if (isset($_SESSION['language_current'])) {
            $language_current = $_SESSION['language_current'];
        }
        return $language_current;
    }

}

if (!function_exists('short_language_current')) {

    function short_language_current() {
        $CI = &get_instance();
        $language_current = $CI->config->item('language');
        $arr_lang = $CI->config->item('language_list');
        if (isset($_SESSION['language_current'])) {
            $language_current = $_SESSION['language_current'];
        }

        return $arr_lang[$language_current];
    }

}

if (!function_exists('pick_language')) {

    function pick_language($data, $struct = 'name_') {
        $CI = &get_instance();
        $short_lang = short_language_current();
        $data = (array) $data;
        if (isset($data[$struct . $short_lang]) && $data[$struct . $short_lang] != "") {
            return $struct . $short_lang;
        } else {
            return $struct . 'vi';
        }
    }

}

if (!function_exists('strtofloat')) {

    function strtofloat($str) {
        $str = str_replace(".", "", $str); // replace dots (thousand seps) with blancs 
        $str = str_replace(",", ".", $str); // replace ',' with '.'
        if (preg_match("#([0-9\.]+)#", $str, $match)) { // search for number that may contain '.' 
            return floatval($match[0]);
        } else {
            return floatval($str); // take some last chances with floatval 
        }
    }

}