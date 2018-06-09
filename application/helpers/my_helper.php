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
if (!function_exists('recursive_menu_data')) {

    function recursive_menu_data($array, $parent) {
        $menu = array_filter($array, function($item) use($parent) {
            return $item['id_parent'] == $parent;
        });
        $return = array();
        foreach ($menu as $key => $row) {
            $tmp = array('id' => $row['id'], 'id_page' => $row['id_page'], 'text' => $row['text'], 'expanded' => 'true');
            $tmp['items'] = recursive_menu_data($array, $row['id']);
            array_push($return, $tmp);
        }
        return $return;
    }

}
if (!function_exists('recursive_insert_menu_data')) {

    function recursive_insert_menu_data($array, $parent) {
        $CI = &get_instance();
        $CI->load->model("menu_model");

        foreach ($array as $key => $row) {
            if ($parent == 0 && $key == 0)
                continue;

            $data = array(
                'id_page' => $row['id_page'],
                'order' => $key,
                'id_parent' => $parent,
                'text' => $row['text'],
            );
            $id = $CI->menu_model->insert($data);
            if ($id > 0) {
                $child = $row['child'];
                recursive_insert_menu_data($child, $id);
            }
        }
    }

}
if (!function_exists('recursive_menu_html')) {

    function recursive_menu_html($array, $parent) {
        $html = "";
        $menu = array_filter($array, function($item) use($parent) {
            return $item['id_parent'] == $parent;
        });

        foreach ($menu as $key => $row) {
            $id = $row['id'];
            $child = array_filter($array, function($item) use($id) {
                return $item['id_parent'] == $id;
            });
            $tag = $drop_menu = $end_drop_menu = $end_tag = "";
            if ($parent == 0) {
                if (count($child)) {
                    $tag = '<li class="nav-item dropdown">';
                    $end_tag = '</li>';
                    $drop_menu = '<div class="dropdown-menu">';
                    $end_drop_menu = '</div>';
                    $item = '<a class="nav-link link dropdown-toggle" data-toggle="dropdown-submenu" aria-expanded="false" href="' . get_url_page($row['id_page']) . '">' . $row['text'] . '</a>';

                    $child = recursive_menu_html($array, $id);

                    $html .= $tag . $item . $drop_menu . $child . $end_drop_menu . $end_tag;
                } else {
                    $tag = '<li class="nav-item">';
                    $end_tag = '</li>';
                    $item = '<a class="nav-link link" href="' . get_url_page($row['id_page']) . '">' . $row['text'] . '</a>';

                    $html .= $tag . $item . $end_tag;
                }
            } else {
                if (count($child)) {
                    $tag = '<div class="dropdown">';
                    $end_tag = '</div>';
                    $drop_menu = '<div class="dropdown-menu dropdown-submenu">';
                    $end_drop_menu = '</div>';
                    $item = '<a class="dropdown-item dropdown-toggle" data-toggle="dropdown-submenu" aria-expanded="false" href="' . get_url_page($row['id_page']) . '">' . $row['text'] . '</a>';

                    $child = recursive_menu_html($array, $id);

                    $html .= $tag . $item . $drop_menu . $child . $end_drop_menu . $end_tag;
                } else {
                    $item = '<a class="dropdown-item" href="' . get_url_page($row['id_page']) . '">' . $row['text'] . '</a>';

                    $html .= $tag . $item . $end_tag;
                }
            }
        }
        return $html;
    }

}