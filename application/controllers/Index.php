<?php

class Index extends MY_Controller {

    function __construct() {
        parent::__construct();
////////////////////////////////
////////////
        $this->data['is_login'] = $this->user_model->logged_in();
        $this->data['userdata'] = $this->session->userdata();
        $this->data['stylesheet_tag'] = array(
            'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700',
            base_url() . 'public/lib/bootstrap/css/bootstrap.min.css',
            base_url() . 'public/lib/font-awesome/css/font-awesome.min.css',
            base_url() . 'public/lib/animate/animate.min.css',
            base_url() . 'public/lib/ionicons/css/ionicons.min.css',
            base_url() . 'public/lib/owlcarousel/assets/owl.carousel.min.css',
            base_url() . 'public/lib/lightbox/css/lightbox.min.css',
            base_url() . "public/lib/froala_editor/css/froala_style.min.css",
            base_url() . 'public/css/style.css'
        );
        
        $this->data['javascript_tag'] = array(
            "https://www.google.com/recaptcha/api.js",
            base_url() . 'public/lib/jquery/jquery.min.js',
            base_url() . 'public/lib/jquery/jquery-migrate.min.js',
            base_url() . 'public/lib/bootstrap/js/bootstrap.bundle.min.js',
            base_url() . "public/lib/jquery-validation/jquery.validate.js",
            base_url() . 'public/lib/easing/easing.min.js',
            base_url() . 'public/lib/superfish/hoverIntent.js',
            base_url() . 'public/lib/superfish/superfish.min.js',
            base_url() . 'public/lib/wow/wow.min.js',
            base_url() . 'public/lib/waypoints/waypoints.min.js',
            base_url() . 'public/lib/counterup/counterup.min.js',
            base_url() . 'public/lib/owlcarousel/owl.carousel.min.js',
            base_url() . 'public/lib/isotope/isotope.pkgd.min.js',
            base_url() . 'public/lib/lightbox/js/lightbox.min.js',
            base_url() . 'public/lib/touchSwipe/jquery.touchSwipe.min.js',
            base_url() . 'public/js/main.js'
        );
    }

    public function _remap($method, $params = array()) {
        if (!method_exists($this, $method)) {
            show_404();
        }
        $this->$method($params);
    }

    public function listall() {
        //echo __DIR__;
        $dirmodule = APPPATH . 'modules/';
        $dir = APPPATH . 'controllers/';
        $this->load->library('directoryinfo');
        $sortedarray1 = $this->directoryinfo->readDirectory($dir, true);
        $sortedarray2 = $this->directoryinfo->readDirectory($dirmodule, true);
        $arr = array_merge(array($sortedarray1), $sortedarray2);
    }

    public function page_404() {
        echo $this->blade->view()->make('page/404-page', $this->data)->render();
    }

    public function delete_img() {
        $this->load->model("hinhanh_model");
        $hinh = $this->hinhanh_model->hinhanh_sudung();
        $this->hinhanh_model->delete_img_not($hinh[0]['id']);
        echo "<pre>";
        print_r($hinh);
        die();
    }

    public function index() {
        $this->data['title'] = "Trang chủ";
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    function category() {
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    function gioithieu() {
        $this->load->model("option_model");
        $gioithieu = $this->option_model->where(array("name" => 'gioi-thieu'))->as_array()->get_all();
        $this->data['gioithieu'] = $gioithieu[0];
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/froala_style.min.css");
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    function signin() {
        $this->data['title'] = $this->lang->line('create_user_heading');

        if ($this->ion_auth->logged_in()) {
            redirect('/', 'refresh');
        }

        $tables = $this->config->item('tables', 'ion_auth');
        $identity_column = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('ten', "", 'required');
        if ($this->form_validation->run() == true) {
            $email = $this->input->post('email');
            $identity = $this->input->post('username');
            $password = $this->input->post('password');

            $additional_data = array(
                'last_name' => $this->input->post('ten'),
                'phone' => $this->input->post('dienthoai'),
                'gioitinh' => $this->input->post("gioitinh")
            );
        }
        if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', "");
            redirect("index/login", 'refresh');
        } else {
            $this->data['message'] = $this->session->flashdata('message');
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    public function page($param) {
        $id = $param[0];
        $this->load->model("pageweb_model");
        $tin = $this->pageweb_model->where(array('id' => $id))->as_array()->get_all();
        $this->data['tin'] = $tin[0];
        $this->data['title'] = $tin[0]['title'];
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/froala_style.min.css");
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function tintuc($param) {
        $id = $param[0];
        $this->load->model("tintuc_model");
        $this->load->model("user_model");
        $tin = $this->tintuc_model->where(array('id' => $id))->with_author()->with_hinhanh()->with_files()->as_object()->get();
        $this->data['tin'] = $tin;
//        echo "<pre>";
//        print_r($tin);
//        die();
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/froala_style.min.css");
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    function searchtintuc() {
//        $this->load->model("tintuc_model");
//        $this->load->model("user_model");
//        $this->data['arr_tin'] = $this->tintuc_model->where(array('deleted' => 0))->as_array()->get_all();
//        foreach ($this->data['arr_tin'] as $k => &$tin) {
//            $author = $this->user_model->where(array("id" => $tin['id_user']))->fields(array("username"))->as_array()->get_all();
//            $arr_hinhanh = $this->tintuc_model->get_tintuc_hinhanh($tin['id_tintuc']);
//            $tin['author'] = $author[0]['username'];
//            $tin['arr_hinhanh'] = $arr_hinhanh;
//        }
////        echo "<pre>";
////        print_r($this->data['arr_tin']);
////        die();
//        array_push($this->data['stylesheet_tag'], base_url() . "public/css/froala_style.min.css");
//        $this->data['template'] = 'right';
//        echo "<pre>";
//        print_r($this->data);
//        die();
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    // log the user out
    function logout() {
        $this->data['title'] = "Logout";

        // log the user out
        $logout = $this->user_model->logout();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function checkEmail() {
        $email = $this->input->get('email');
        $this->load->model("user_model");
        $check = $this->user_model->where(array("email" => $email, "deleted" => 0))->as_array()->get_all();
        if (!$check) {
            echo json_encode(true);
        } else {
            echo json_encode(array("Email đã tồn tại!"));
        }
    }

    public function checkUsername() {
        $username = $this->input->get('username');
        $this->load->model("user_model");
        $check = $this->user_model->where(array("username" => $username, "deleted" => 0))->as_array()->get_all();
        if (!$check) {
            echo json_encode(true);
        } else {
            echo json_encode(array("Tài khoản đã tồn tại!"));
        }
    }

    public function checkUserpass() {
        $id = $this->input->post('id');
        $pass = $this->input->post('passwordold');
        $check = $this->ion_auth->hash_password_db($id, $pass);
        if ($check === TRUE) {
            echo json_encode(true);
        } else {
            echo json_encode(array("Password cũ không đúng!"));
        }
    }

    public function quanlypage() {
        //phpinfo();die();
        $this->data['template'] = "box";
        $arr_page = $this->page_model->where(array("deleted" => 0))->as_array()->get_all();
        $page_ava = array_map(function($item) {
            return $item['link'];
        }, $arr_page);

        $this->data['arr_page'] = $arr_page;
        //$dirmodule = APPPATH . 'modules/';
        $dir = APPPATH . 'controllers/';
        $this->load->library('directoryinfo');
        $arr = $this->directoryinfo->readDirectory($dir, array("Auth.php", "Ajax.php"));
        $arr = array($arr);
        // $sortedarray2 = $this->directoryinfo->readDirectory($dirmodule, true);
        // $arr = array_merge(array($sortedarray1), $sortedarray2);
//        echo "<pre>";
//        print_r($arr);
//        die();
        $dataselect = array();
        foreach ($arr as $key => $row) {
            $module = mb_strtolower($key, 'UTF-8');
            foreach ($row as $key1 => $row1) {
                $class = mb_strtolower($key1, 'UTF-8');
                foreach ($row1 as $row2) {
                    $method = mb_strtolower($row2, 'UTF-8');
                    if ($module) {
                        $page = $module . "/" . $class . "/" . $method;
                    } else {
                        $page = $class . "/" . $method;
                    }
                    $dataselect[$page] = $page;
                }
            }
        }
        $this->data['page_ava'] = $page_ava;
        $this->data['link'] = $dataselect;

        array_push($this->data['stylesheet_tag'], base_url() . "public/admin/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.min.css");
//        array_push($this->data['stylesheet_tag'], base_url() . "public/css/bootstrap-editable.css");
//        array_push($this->data['stylesheet_tag'], base_url() . "public/css/typeahead.js-bootstrap.css");
//        array_push($this->data['javascript_tag'], base_url() . "public/js/bootstrap-editable.min.js");
        array_push($this->data['javascript_tag'], base_url() . "public/admin/plugins/jquery-datatable/jquery.dataTables.js");
        array_push($this->data['javascript_tag'], base_url() . "public/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.min.js");
//        array_push($this->data['javascript_tag'], base_url() . "public/js/typeahead.js");
//        array_push($this->data['javascript_tag'], base_url() . "public/js/typeaheadjs.js");
//        array_push($this->data['javascript_tag'], base_url() . "public/js/combobox.js");
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function success() {
        echo json_encode(1);
    }

}
