<?php

class Ajax extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function login() {
        if (isset($_POST['identity']) && isset($_POST['password'])) {
            $this->load->model("user_model");
            // check to see if the user is logging in
            if ($this->user_model->login($this->input->post('identity'), $this->input->post('password'))) {
                echo json_encode(array('success' => 1, 'username' => $this->session->userdata('identity'), "role" => $this->session->userdata('role')));
            } else {
                echo json_encode(array('success' => 0, 'msg' => "Tài khoản hoặc mật khẩu không đúng"));
            }
        } else {
            echo json_encode(array('success' => 0, 'msg' => "Tài khoản hoặc mật khẩu không đúng"));
        }
    }

    function listslider() {
        $this->load->model("slider_model");
        $this->load->model("hinhanh_model");
        $arr_slider = $this->slider_model->where(array('deleted' => 0))->as_array()->get_all();
        foreach ($arr_slider as &$slider) {
            $hinh = $this->hinhanh_model->where(array('id_hinhanh' => $slider['id_hinhanh']))->as_array()->get_all();
            $slider['hinh'] = $hinh[0];
        }
        echo json_encode($arr_slider);
    }

    function news() {
        $this->load->model("tintuc_model");
        $search = $this->input->get("search");
        $page = $this->input->get("page");
        $limit = $this->input->get("limit");
        $page = $page != "" ? $page : 1;
        $limit = $limit != "" ? $limit : 10;
        /*
         * TINH COUNT
         */
        if ($search != "") {
            $short_language = short_language_current();
            $where = $this->tintuc_model->where("deleted = 0 AND is_private = 0 AND is_highlight = 0 AND (title_" . $short_language . " like '%" . $search . "%' OR (title_vi like '%" . $search . "%' AND title_" . $short_language . " IN(NULL,'')))", NULL, NULL, FALSE, FALSE, TRUE);
        } else
            $where = $this->tintuc_model->where(array('deleted' => 0, 'is_private' => 0, 'is_highlight' => 0));

        $count = $where->count_rows();
        /*
         * LAY DATA
         */
        if ($search != "") {
            $short_language = short_language_current();
            $where = $this->tintuc_model->where("deleted = 0 AND is_private = 0 AND is_highlight = 0 AND (title_" . $short_language . " like '%" . $search . "%' OR (title_vi like '%" . $search . "%' AND title_" . $short_language . " IN(NULL,'')))", NULL, NULL, FALSE, FALSE, TRUE)->order_by("date", "DESC")->with_files()->with_typeobj()->as_array();
        } else
            $where = $this->tintuc_model->where(array('deleted' => 0, 'is_private' => 0, 'is_highlight' => 0))->order_by("date", "DESC")->with_files()->with_typeobj()->as_array();
        $data = $where->paginate($limit, NULL, $page);

        $max_page = ceil($count / $limit);
//        echo "<pre>";
//        print_r($data);
//        die();
        $this->data['count'] = $count;
        $this->data['data'] = $data;
        $this->data['current_page'] = $page;
        $this->data['max_page'] = $max_page;

        echo $this->blade->view()->make('ajax/news', $this->data)->render();
    }

    function product() {
        $this->load->model("product_model");
        $search = $this->input->get("search");
        $page = $this->input->get("page");
        $limit = $this->input->get("limit");
        $page = $page != "" ? $page : 1;
        $limit = $limit != "" ? $limit : 10;
        /*
         * TINH COUNT
         */
        if ($search != "") {
            $short_language = short_language_current();
            $where = $this->product_model->where("deleted = 0 AND (name_" . $short_language . " like '%" . $search . "%' OR (name_vi like '%" . $search . "%' AND name_" . $short_language . " IN(NULL,'')))", NULL, NULL, FALSE, FALSE, TRUE);
        } else
            $where = $this->product_model->where(array('deleted' => 0));

        $count = $where->count_rows();
        /*
         * LAY DATA
         */
        if ($search != "") {
            $short_language = short_language_current();
            $where = $this->product_model->where("deleted = 0 AND (name_" . $short_language . " like '%" . $search . "%' OR (name_vi like '%" . $search . "%' AND name_" . $short_language . " IN(NULL,'')))", NULL, NULL, FALSE, FALSE, TRUE)->order_by("date", "DESC")->with_files()->as_array();
        } else
            $where = $this->product_model->where(array('deleted' => 0))->order_by("date", "DESC")->with_files()->as_array();
        $data = $where->paginate($limit, NULL, $page);

        $max_page = ceil($count / $limit);
//        echo "<pre>";
//        print_r($data);
//        die();
        $this->data['count'] = $count;
        $this->data['data'] = $data;
        $this->data['current_page'] = $page;
        $this->data['max_page'] = $max_page;

        echo $this->blade->view()->make('ajax/product', $this->data)->render();
    }

    function editpage() {
        $id = $this->input->get('id');
        $link = $this->input->get('link');
        $seo = $this->input->get('seo');
        $template = $this->input->get('template');
        $page = $this->input->get('page');
        $param = $this->input->get('param');
        $array = array(
            'seo_url' => $seo,
            'template' => $template,
            'link' => $link,
            'page' => $page,
            'param' => $param
        );
        $this->page_model->update($array, $id);
    }

    function addpage() {
        $link = $this->input->get('link');
        $seo = $this->input->get('seo');
        $template = $this->input->get('template');
        $page = $this->input->get('page');
        $param = $this->input->get('param');
        $array = array(
            'seo_url' => $seo,
            'template' => $template,
            'link' => $link,
            'page' => $page,
            'param' => $param
        );
        $this->page_model->insert($array);
    }

    function removepage() {
        $id = $this->input->get('id');
        $this->page_model->update(array("deleted" => 1), $id);
    }

    function rowpage() {
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
        $arr_page = $this->page_model->where(array("deleted" => 0))->as_array()->get_all();
        $page_ava = array_map(function($item) {
            return $item['link'];
        }, $arr_page);
        $this->data['page_ava'] = $page_ava;
        $this->data['link'] = $dataselect;
        echo $this->blade->view()->make('ajax/ajaxpage', $this->data)->render();
    }

    function contactsubmit() {

//        if (isset($_SESSION['timer_contact']) && $_SESSION['timer_contact'] > date("Y-m-d H:i:s")) {
//            echo json_encode(array('msg' => "Xin chờ trong ít phút", 'timer' => $_SESSION['timer_contact'], 'code' => 401));
//            die();
//        }

        $recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);
        if (isset($response['success']) and $response['success'] === true) {
            $this->load->model("comment_model");
            if (isset($_POST['content'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $content = $_POST['content'];
                $array = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'content' => $content,
                    'date' => time()
                );
                $this->comment_model->insert($array);
                /*
                 * SET LIMIT 
                 */
                $_SESSION['timer_contact'] = date("Y-m-d H:i:s", strtotime("+1 minutes"));
                echo json_encode(array('code' => 400, 'msg' => "Cảm ơn bạn đã góp ý cho chúng tôi!"));
                /*
                 * Mail setting
                 */
//            $this->load->config('ion_auth', TRUE);
//            $this->load->library(array('email'));
//            $email_config = $this->config->item('email_config', 'ion_auth');
//
//            if ($this->config->item('use_ci_email', 'ion_auth') && isset($email_config) && is_array($email_config)) {
//                $this->email->initialize($email_config);
//            }
//            /*
//             * Send mail
//             */
//            $this->email->clear();
//            $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
//            $this->email->to(config_item("email_dk"));
//            $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - Tin nhắn');
//            $html = "<p><strong>Tên:</strong>$name</p>"
//                    . "<p><strong>Email:</strong>$email</p>"
//                    . "<p><strong>Số điện thoại:</strong>$sodt</p>"
//                    . "<p><strong>Tin nhắn:</strong>$message</p>";
//            $this->email->message($html);
//            $this->email->send();
            } else {
                echo json_encode(array('code' => 402, 'msg' => "Vui lòng nhập đầy đủ thông tin."));
            }
        } else {
            echo json_encode(array('code' => 403, 'msg' => "Vui lòng nhấn nút Captcha."));
        }
    }

    function updatemenu() {
        $this->load->model("menu_model");
        $array = json_decode($_POST["data"], true);
        $this->menu_model->delete(array('deleted' => 0));

        recursive_insert_menu_data($array, 0);
        $result = 1;
        $msg = 'Success.';
        $return = array('status' => $result, 'msg' => $msg);
        echo json_encode($return);
    }

    function setlanguage() {
        $_SESSION['language_current'] = $_POST['language'];
        echo 1;
    }

    function downloadfile() {
        $this->load->model("user_model");
        $this->load->model("hinhanh_model");
        $is_logged_in = $this->user_model->logged_in();
        if (!$is_logged_in) {
            echo json_encode(array("code" => 403, "msg" => "Yêu cầu đăng nhập."));
            die();
        }
        $role_user = $this->session->userdata('role');
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $file = $this->hinhanh_model->where(array("id_hinhanh" => $id))->as_array()->get();
            if ($file) {
                $role_download = $file['role_download'];
                if ($role_download == 0 || in_array($role_user, explode(",", $role_download))) {
                    $real_name = $file['real_hinhanh'];
                    $src = FCPATH . $file['src'];
                    header("Cache-Control: public");
                    header("Content-Description: File Transfer");
                    header("Content-Disposition: attachment; filename=" . $real_name);
                    header("Content-Transfer-Encoding: binary");
                    readfile($src);
                } else {
                    echo json_encode(array("code" => 406, "msg" => "Bạn không có quyền download file!"));
                    die();
                }
            } else {
                echo json_encode(array("code" => 405, "msg" => "File không tồn tại!"));
                die();
            }
        } else {
            echo json_encode(array("code" => 404, "msg" => "Thiếu thông số."));
            die();
        }
    }

    ////////////
}
