<?php

use Philo\Blade\Blade;

class Widget {

    private $data = array();
    protected $CI;

    function __construct() {
        $this->CI = &get_instance();
        $this->CI->load->helper(array('url', 'language', 'my'));
        $this->CI->lang->load(array('auth', 'home'));
        ////////////////////////////////
        $views = APPPATH . "views/";
        $cache = APPPATH . "cache/";
        $this->blade = new Blade($views, $cache);
    }

    function header() {
//        echo "tran";die();
//        echo APPPATH;die();
        $this->CI->load->model("menu_model");
        $all_menu = $this->CI->menu_model->where("deleted", 0)->order_by(array('id_parent' => "ASC", 'order' => "ASC"))->as_array()->get_all();
//        array_unshift($all_menu, array('id' => 0, 'id_page' => 0, 'text' => "Trang chủ", 'id_parent' => 0));
        $this->data['menu'] = recursive_menu_html($all_menu, 0);
        $this->data['language_list'] = $this->CI->config->item('language_list');
//        echo "<pre>";
//        print_r($this->data['menu']);
//        die();
        echo $this->blade->view()->make('widget/header', $this->data)->render();
    }

    function footer() {
        echo $this->blade->view()->make('widget/footer', $this->data)->render();
    }

    function silder() {
        echo $this->blade->view()->make('widget/slider', $this->data)->render();
    }

    function about1() {
        echo $this->blade->view()->make('widget/about1', $this->data)->render();
    }

    function about2() {
        echo $this->blade->view()->make('widget/about2', $this->data)->render();
    }

    function service() {
        echo $this->blade->view()->make('widget/service', $this->data)->render();
    }

    function service1() {
        echo $this->blade->view()->make('widget/service1', $this->data)->render();
    }

    function call() {
        echo $this->blade->view()->make('widget/call', $this->data)->render();
    }

    function fact() {
        echo $this->blade->view()->make('widget/fact', $this->data)->render();
    }

    function category() {
        echo $this->blade->view()->make('widget/category', $this->data)->render();
    }

    function category1() {
        echo $this->blade->view()->make('widget/category1', $this->data)->render();
    }

    function client() {
        echo $this->blade->view()->make('widget/client', $this->data)->render();
    }

    function testimonials() {
        echo $this->blade->view()->make('widget/testimonials', $this->data)->render();
    }

    function team() {
        echo $this->blade->view()->make('widget/team', $this->data)->render();
    }

}
