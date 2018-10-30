<?php

use Philo\Blade\Blade;

class Widget {

    private $data = array();
    protected $CI;

    function __construct() {
        $this->CI = &get_instance();
        $this->CI->lang->load(array('home'));
        $this->CI->load->model("user_model");
        $this->data['is_login'] = $this->CI->user_model->logged_in();
        $this->data['userdata'] = $this->CI->session->userdata();
        ////////////////////////////////
        $views = APPPATH . "views/";
        $cache = APPPATH . "cache/";
        $this->blade = new Blade($views, $cache);
    }

    function header() {
//        echo "tran";die();
//        echo APPPATH;die();
        $this->CI->load->model("menu_model");
        $this->CI->load->model("categorysimba_model");
        $all_menu = $this->CI->menu_model->where("deleted", 0)->order_by(array('id_parent' => "ASC", 'order' => "ASC"))->as_array()->get_all();
//        array_unshift($all_menu, array('id' => 0, 'id_page' => 0, 'text' => "Trang chủ", 'id_parent' => 0));
        $this->data['menu'] = $all_menu;
        $this->data['language_list'] = $this->CI->config->item('language_list');
        $this->data['category'] = $this->CI->categorysimba_model->where("is_displayed", 1)->as_array()->get_all();

//        echo "<pre>";
//        print_r($this->data['menu']);
//        die();
        echo $this->blade->view()->make('widget/header', $this->data)->render();
    }

    function footer() {
        $this->CI->load->model("pageweb_model");
        $this->CI->load->model("user_model");
        $hl = short_language_current();
        $hl = $hl == "jp" ? "ja" : $hl;
        $lienket = $this->CI->pageweb_model->where(array('deleted' => 0, 'active' => 1))->order_by('date', "DESC")->limit(5)->as_array()->get_all();
        $this->data['lienket'] = $lienket;
        $role_gopy = "";
        if ($this->data['is_login']) {
            $role_gopy = implode(",", $this->CI->user_model->role_permission(29));
        }
        $this->data['role_feedback'] = $role_gopy;
        $this->data['captcha'] = $this->CI->recaptcha->getWidget(array('style' => 'transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;'));
        $this->data['scriptCap'] = $this->CI->recaptcha->getScriptTag(array('hl' => $hl));
        echo $this->blade->view()->make('widget/footer', $this->data)->render();
    }

    function silder() {
        $this->CI->load->model("slider_model");
        $this->CI->load->model("tintuc_model");
        $this->CI->load->model("hinhanh_model");

        $arr_slider = $this->CI->slider_model->where(array('deleted' => 0))->as_array()->get_all();
        foreach ($arr_slider as &$slider) {
            $hinh = $this->CI->hinhanh_model->where(array('id_hinhanh' => $slider['id_hinhanh']))->as_array()->get_all();
            $slider['hinh'] = $hinh[0];
        }

        $arr_tintuc = $this->CI->tintuc_model->where(array('deleted' => 0, 'is_private' => 0, 'is_highlight' => 1))->order_by("date", "DESC")->limit(3)->with_hinhanh()->as_array()->get_all();
        $this->data['list_silder'] = $arr_slider;
        $this->data['list_tintuc'] = $arr_tintuc;
//        echo "<pre>";
//        print_r($arr_tintuc);die();
        $language_list = $this->CI->config->item('language_list');
        $this->data['lang'] = $language_list[language_current()];
        echo $this->blade->view()->make('widget/slider', $this->data)->render();
    }

    function about1() {
        $short_language = short_language_current();
        $this->CI->load->model("about_model");
        $this->data['arr_about'] = $this->CI->about_model->where(array('deleted' => 0, 'language' => $short_language))->with_hinhanh()->as_object()->get_all();
        echo $this->blade->view()->make('widget/about1', $this->data)->render();
    }

    function news() {
        $this->CI->load->model("categorysimba_model");
        $this->data['category'] = $this->CI->categorysimba_model->where("is_displayed", 1)->as_array()->get_all();
        echo $this->blade->view()->make('widget/news', $this->data)->render();
    }

    function category() {
        $this->CI->load->model("category_model");

        if ($this->data['is_login']) {
            $role_user = $this->CI->session->userdata('role');
            $this->data['data'] = $this->CI->category_model->where("deleted = 0 AND (role_show IS NULL OR role_show = '' OR FIND_IN_SET($role_user,role_show))", NULL, NULL, FALSE, FALSE, TRUE)->order_by("date", "DESC")->with_hinhanh()->as_array()->get_all();
        } else {
            $this->data['data'] = $this->CI->category_model->where("deleted = 0 AND (role_show IS NULL OR role_show = '')", NULL, NULL, FALSE, FALSE, TRUE)->order_by("date", "DESC")->with_hinhanh()->as_array()->get_all();
        }
        //        echo "<pre>";
//        print_r($this->data['data']);
//        die();
        echo $this->blade->view()->make('widget/category', $this->data)->render();
    }

    function client() {
        $this->CI->load->model("client_model");
        $this->data['data'] = $this->CI->client_model->where(array('deleted' => 0))->with_hinhanh()->as_array()->get_all();
        echo $this->blade->view()->make('widget/client', $this->data)->render();
    }

    function testimonials() {
        $this->CI->load->model("happy_model");
        $this->data['data'] = $this->CI->happy_model->where(array('deleted' => 0))->order_by(array("order" => "ASC", "date" => "DESC"))->with_hinhanh()->as_array()->get_all();
        echo $this->blade->view()->make('widget/testimonials', $this->data)->render();
    }

}
