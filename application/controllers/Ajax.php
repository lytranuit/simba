<?php

class Ajax extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function login() {
        $this->load->model("user_model");
        //validate form input
        $this->form_validation->set_rules('identity', "", 'required');
        $this->form_validation->set_rules('password', "", 'required');

        if ($this->form_validation->run() == true) {
            // check to see if the user is logging in
            if ($this->user_model->login($this->input->post('identity'), $this->input->post('password'))) {
                echo json_encode(array('success' => 1, "role" => $this->session->userdata('role')));
            } else {
                echo json_encode(array('success' => 0, 'msg' => "Tài khoản hoặc mật khẩu không đúng"));
            }
        } else {
            echo json_encode(array('success' => 0, 'msg' => "Tài khoản hoặc mật khẩu không đúng"));
        }
    }

    function loadslider() {
        $this->data['id'] = "new" . rand();
        echo $this->blade->view()->make('ajax/ajaxslider', $this->data)->render();
    }

    function loadtienich() {
        $this->data['id'] = "new" . rand();
        echo $this->blade->view()->make('ajax/ajaxtienich', $this->data)->render();
    }

    function loadlydo() {
        $this->data['id'] = "new" . rand();
        echo $this->blade->view()->make('ajax/ajaxlydo', $this->data)->render();
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
            $where = $this->tintuc_model->where("deleted = 0 AND title_" . $short_language . " like '%" . $search . "%'", NULL, NULL, FALSE, FALSE, TRUE);
        } else
            $where = $this->tintuc_model->where(array('deleted' => 0));

        $count = $where->count_rows();
        /*
         * LAY DATA
         */
        if ($search != "") {
            $short_language = short_language_current();
            $where = $this->tintuc_model->where("deleted = 0 AND is_private = 0 AND title_" . $short_language . " like '%" . $search . "%'", NULL, NULL, FALSE, FALSE, TRUE)->order_by("date", "DESC")->as_array();
        } else
            $where = $this->tintuc_model->where(array('deleted' => 0, 'is_private' => 0))->order_by("date", "DESC")->with_files()->with_typeobj()->as_array();
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

    function get_quan_huyen() {
        if (isset($_GET['parent']))
            $parent = $_GET['parent'];
        else
            $parent = 0;
        $this->load->model("khuvuc_model");
        $quan = $this->khuvuc_model->where(array('parent' => $parent, 'deleted' => 0))->order_by("order")->as_array()->get_all();
        echo '<option value="' . $parent . '">--- Chọn Quận/Huyện ---</option>';
        foreach ($quan as $cate) {
            echo '<option value="' . $cate['id_khuvuc'] . '">' . $cate['ten_khuvuc'] . '</option>';
        }
    }

    function get_tin() {
        $page = $this->input->get('page');
        $this->load->model("tin_model");
        $this->load->model("user_model");
        $this->load->model("khuvuc_model");
        $this->load->model("hinhanh_model");
        $per_page = 10;
        $total_posts = $this->tin_model->where(array('deleted' => 0, 'active' => 1))->count_rows();
        $this->data['count_page'] = round($total_posts / $per_page);
        $this->data['arr_tin'] = $this->tin_model->where(array('deleted' => 0, 'active' => 1))->order_by("id_tin", "DESC")->as_array()->paginate($per_page, $total_posts, $page);
        foreach ($this->data['arr_tin'] as &$row) {
            $arr_hinhanh = $this->tin_model->get_tin_hinhanh($row['id_tin']);
            if (count($arr_hinhanh)) {
                $hinhanh = $arr_hinhanh;
            } else {
                $hinhanh = $this->hinhanh_model->where(array("default" => 1, 'deleted' => 0))->as_array()->get_all();
            }
            $author = $this->user_model->where(array('id' => $row['id_user']))->as_array()->get_all();
            $khuvuc = $this->khuvuc_model->where(array('id_khuvuc' => $row['id_khuvuc']))->as_array()->get_all();
            $row['hinhanh'] = $hinhanh[0]['thumb_src'];
            $row['arr_hinhanh'] = $hinhanh;
            $row['author'] = $author[0]['username'];
            $row['khuvuc'] = $khuvuc[0]['ten_khuvuc'];
            if ($row['gia'] != 0) {
                if ($row['gia'] < 1000) {
                    $row['gia'] = $row['gia'] . " triệu";
                } else {
                    if ($row['gia'] % 1000) {
                        $row['gia'] = number_format($row['gia'] / 1000, 2, ',', ".") . " tỷ";
                    } else {
                        $row['gia'] = number_format($row['gia'] / 1000) . " tỷ";
                    }
                }
            } else {
                $row['gia'] = "Thương lượng";
            }
        }
        echo $this->blade->view()->make('ajax/ajaxtin', $this->data)->render();
    }

    function insertchat() {
        $text = $this->input->post('text');
        $id_room = $this->input->post('room');
        $id_customer = $this->input->post('id_customer');
        $this->load->model("chat_model");
        $this->load->model("room_model");
        $array = array(
            'room' => $id_room,
            'id_customer' => $id_customer,
            'note_content' => htmlentities($text),
        );
        $this->chat_model->insert($array);
        /*
         * Log file
         */
        $dir = FCPATH . "public/log/";
        $filename = $dir . 0 . ".txt";
        file_put_contents($filename, "Create log \r\n");
    }

    function realtime() {
        if (isset($_GET['time'])) {
            $this->load->model("chat_model");
            $this->load->model("room_model");
            set_time_limit(0);
            session_write_close(); ///////////// bo qua session
            $dir = FCPATH . "public/log/";
            $ip_address = $this->input->ip_address();
            $room = $this->room_model->where(array('ip_address' => $ip_address))->as_array()->get();
            if ($room) {
                $id_room = $room['id'];
            } else {
                $array = array(
                    'ip_address' => $ip_address,
                );
                $id_room = $this->room_model->insert($array);
            }
            $filename = $dir . $id_room . ".txt";
            if (file_exists($filename)) {
                
            } else {
                file_put_contents($filename, "Create log \r\n");
            }
            $filename_admin = $dir . 0 . ".txt";
            if (file_exists($filename_admin)) {
                
            } else {
                file_put_contents($filename_admin, "Create log \r\n");
            }
            $currentfile = filemtime($filename);
            $currentfile_admin = filemtime($filename_admin);
            $lastmofi = $_GET['time'];
            $micro_seconds = 10000;
//            echo $currentfile;
//            echo "<br>";
//            echo $lastmofi;
//            echo "<br>";
//            echo $currentfile_admin;
//            echo "<br>";
//            die();
            while ($currentfile <= $lastmofi && $currentfile_admin <= $lastmofi) {
                usleep($micro_seconds);
                clearstatcache();
                $currentfile = filemtime($filename);
                $currentfile_admin = filemtime($filename_admin);
            }
            /*
             * Lay data return
             */
            $time = $currentfile > $currentfile_admin ? $currentfile : $currentfile_admin;
            $date = date("Y-m-d H:i:s", $time - 2);
            $data = $this->chat_model->newchat($id_room, $date);
            echo json_encode(array('time' => $time, 'data' => $data));
        }
    }

    function contactsubmit() {

        if (isset($_SESSION['timer_contact']) && $_SESSION['timer_contact'] > date("Y-m-d H:i:s")) {
            echo json_encode(array('msg' => "Xin chờ trong ít phút", 'timer' => $_SESSION['timer_contact'], 'code' => 401));
            die();
        }
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

    ////////////
}
