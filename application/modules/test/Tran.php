<?php

class Tran extends MY_Controller {

    function __construct() {
        parent::__construct();
////////////////////////////////
////////////
        $this->data['is_login'] = $this->ion_auth->logged_in();
////////////////////////////////// Stle mac dinh
        $this->data['stylesheet_tag'] = array(
            base_url() . "public/css/bootstrap.min.css",
            base_url() . "public/css/font-awesome.min.css",
            base_url() . "public/css/animate.min.css",
            base_url() . "public/css/prettyPhoto.css",
            base_url() . "public/css/fixscreen.css",
            base_url() . "public/css/main.css",
            base_url() . "public/css/responsive.css",
            base_url() . "public/css/swipebox.min.css",
            base_url() . "public/css/overlay-bootstrap.css"
        );
        $this->data['javascript_tag'] = array(
            base_url() . "public/js/jquery.js",
            base_url() . "public/js/jquery-ui.min.js",
            base_url() . "public/js/bootstrap.min.js",
            base_url() . "public/js/jquery.prettyPhoto.js",
            base_url() . "public/js/jquery.isotope.min.js",
            base_url() . "public/js/main.js",
            base_url() . "public/js/wow.min.js",
            base_url() . "public/js/moment.js",
            base_url() . "public/js/jquery.swipebox.js"
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
        $dir = APPPATH . 'modules/';
        $this->load->library('directoryinfo');
        $sortedarray = $this->directoryinfo->readDirectory($dir, true);
        echo "<pre>";
        print_r($sortedarray);
    }

    public function page_404() {
        echo $this->blade->view()->make('page/404-page', $this->data)->render();
    }

    public function quanlypage() {
        //phpinfo();die();
        $this->data['template'] = "box";
        $arr_page = $this->page_model->where(array("deleted" => 0))->as_array()->get_all();
        $this->data['arr_page'] = $arr_page;

        array_push($this->data['stylesheet_tag'], base_url() . "public/css/dataTables.bootstrap.min.css");
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/bootstrap-editable.css");
        array_push($this->data['javascript_tag'], base_url() . "public/js/bootstrap-editable.min.js");
        array_push($this->data['javascript_tag'], base_url() . "public/js/jquery.dataTables.min.js");
        array_push($this->data['javascript_tag'], base_url() . "public/js/dataTables.bootstrap.min.js");
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function index() {
//        echo "<pre>";
//        print_r($this->data['arr_tin']);
//        die();
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/flexslider.css");
        array_push($this->data['javascript_tag'], base_url() . "public/js/jquery.flexslider.js");
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    function gioithieu() {
        $this->load->model("option_model");
        $gioithieu = $this->option_model->where(array("name" => 'gioi-thieu'))->as_array()->get_all();
        $this->data['gioithieu'] = $gioithieu[0];
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/froala_style.min.css");
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    function login() {
        if (!$this->ion_auth->logged_in()) {
            $this->data['title'] = $this->lang->line('login_heading');

            //validate form input
            $this->form_validation->set_rules('identity', "", 'required');
            $this->form_validation->set_rules('password', "", 'required');

            if ($this->form_validation->run() == true) {
                // check to see if the user is logging in
                // check for "remember me"
                $remember = (bool) $this->input->post('remember');

                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                    //if the login is successful
                    //redirect them back to the home page
                    $this->session->set_flashdata('message', "");
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                } else {
                    // if the login was un-successful
                    // redirect them back to the login page
                    $this->session->set_flashdata('message', "Tài khoản hoặc mật khẩu không đúng");
                    redirect('index/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
                }
            } else {
                // the user is not logging in so display the login page
                // set the flash data error message if there is one
                $this->data['message'] = $this->session->flashdata('message');
                echo $this->blade->view()->make('page/page', $this->data)->render();
            }
        } else {
            redirect('index', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        }
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
            array_push($this->data['javascript_tag'], base_url() . "public/js/jquery.validate.js");
            echo $this->blade->view()->make('page/signin-page', $this->data)->render();
        }
    }

    public function tin($param) {
        $id = $param[0];
        $this->load->model("tin_model");
        $this->load->model("user_model");
        $this->load->model("huong_model");
        $this->load->model("phaply_model");
        $tin = $this->tin_model->where(array('id_tin' => $id))->as_array()->get_all();
        $author = $this->user_model->where(array("id" => $tin[0]['id_user']))->fields(array("username"))->as_array()->get_all();
        $huong = $this->huong_model->where(array("id_huong" => $tin[0]['id_huong']))->fields(array("ten_huong"))->as_array()->get_all();
        $phaply = $this->phaply_model->where(array("id_phaply" => $tin[0]['id_phaply']))->fields(array("ten_phaply"))->as_array()->get_all();
        $arr_hinhanh = $this->tin_model->get_tin_hinhanh($tin[0]['id_tin']);

        $tin[0]['author'] = $author[0]['username'];
        $tin[0]['phaply'] = $phaply[0]['ten_phaply'];
        $tin[0]['huong'] = $huong[0]['ten_huong'];
        $tin[0]['arr_hinhanh'] = $arr_hinhanh;
        if ($tin[0]['gia'] != 0) {
            if ($tin[0]['gia'] < 1000) {
                $tin[0]['gia'] = $tin[0]['gia'] . " triệu";
            } else {
                if ($tin[0]['gia'] % 1000) {
                    $tin[0]['gia'] = number_format($tin[0]['gia'] / 1000, 2, ',') . " tỉ";
                } else {
                    $tin[0]['gia'] = number_format($tin[0]['gia'] / 1000) . " tỉ";
                }
            }
        } else {
            $tin[0]['gia'] = "Thương lượng";
        }
        $this->data['tin'] = $tin[0];
//        echo "<pre>";
//        print_r($tin);
//        die();
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/froala_style.min.css");
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/flexslider.css");
        array_push($this->data['javascript_tag'], base_url() . "public/js/jquery.flexslider.js");
        array_push($this->data['javascript_tag'], base_url() . "public/js/jquery.jcarousel.min.js");
        echo $this->blade->view()->make('page/tin-page', $this->data)->render();
    }

    function searchtin() {
        $this->load->model("tin_model");
        $this->load->model("user_model");
        $this->load->model("khuvuc_model");
        $this->data['arr_tin'] = $this->tin_model->where(array('deleted' => 0))->as_array()->get_all();
        foreach ($this->data['arr_tin'] as $k => &$tin) {
            $author = $this->user_model->where(array("id" => $tin['id_user']))->fields(array("username"))->as_array()->get_all();
            $arr_hinhanh = $this->tin_model->get_tin_hinhanh($tin['id_tin']);
            $quan = $this->khuvuc_model->where(array("id_khuvuc" => $tin['id_khuvuc']))->as_array()->get_all();
            $tin['author'] = $author[0]['username'];
            $tin['arr_hinhanh'] = $arr_hinhanh;
            $tin['khuvuc'] = $quan[0]['ten_khuvuc'];
            if ($tin['gia'] != 0) {
                if ($tin['gia'] < 1000) {
                    $tin['gia'] = $tin['gia'] . " triệu";
                } else {
                    if ($tin['gia'] % 1000) {
                        $tin['gia'] = number_format($tin['gia'] / 1000, 2, ',') . " tỉ";
                    } else {
                        $tin['gia'] = number_format($tin['gia'] / 1000) . " tỉ";
                    }
                }
            } else {
                $tin['gia'] = "Thương lượng";
            }
        }
//        echo "<pre>";
//        print_r($this->data['arr_tin']);
//        die();
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/froala_style.min.css");
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/owl.theme.css");
        echo $this->blade->view()->make('page/searchtin-page', $this->data)->render();
    }

    public function tintuc($param) {
        $id = $param[0];
        $this->load->model("tintuc_model");
        $this->load->model("user_model");
        $tin = $this->tintuc_model->where(array('id_tintuc' => $id))->as_array()->get_all();
        $author = $this->user_model->where(array("id" => $tin[0]['id_user']))->fields(array("username"))->as_array()->get_all();
        $arr_hinhanh = $this->tintuc_model->get_tintuc_hinhanh($tin[0]['id_tintuc']);

        $tin[0]['author'] = $author[0]['username'];
        $tin[0]['arr_hinhanh'] = $arr_hinhanh;
        $this->data['tin'] = $tin[0];
//        echo "<pre>";
//        print_r($tin);
//        die();
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/froala_style.min.css");
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/flexslider.css");
        array_push($this->data['javascript_tag'], base_url() . "public/js/jquery.flexslider.js");
        array_push($this->data['javascript_tag'], base_url() . "public/js/jquery.jcarousel.min.js");
        echo $this->blade->view()->make('page/tintuc-page', $this->data)->render();
    }

    function searchtintuc() {
        $this->load->model("tintuc_model");
        $this->load->model("user_model");
        $this->data['arr_tin'] = $this->tintuc_model->where(array('deleted' => 0))->as_array()->get_all();
        foreach ($this->data['arr_tin'] as $k => &$tin) {
            $author = $this->user_model->where(array("id" => $tin['id_user']))->fields(array("username"))->as_array()->get_all();
            $arr_hinhanh = $this->tintuc_model->get_tintuc_hinhanh($tin['id_tintuc']);
            $tin['author'] = $author[0]['username'];
            $tin['arr_hinhanh'] = $arr_hinhanh;
        }
//        echo "<pre>";
//        print_r($this->data['arr_tin']);
//        die();
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/froala_style.min.css");
        echo $this->blade->view()->make('page/searchtintuc-page', $this->data)->render();
    }

    // log the user out
    function logout() {
        $this->data['title'] = "Logout";

        // log the user out
        $logout = $this->ion_auth->logout();

        // redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
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

}
