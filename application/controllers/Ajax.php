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
                $role_permission_feedback = implode(",", $this->user_model->role_permission(29));
                echo json_encode(array('success' => 1, 'role_feedback' => $role_permission_feedback, 'username' => $this->session->userdata('identity'), "role" => $this->session->userdata('role')));
            } else {
                echo json_encode(array('success' => 0, 'code' => 501, 'msg' => lang('alert_501')));
            }
        } else {
            echo json_encode(array('success' => 0, 'code' => 501, 'msg' => lang('alert_501')));
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
        $this->load->model("categorysimba_model");
        $category = $this->input->get("category");
        $search = $this->input->get("search");
        $page = $this->input->get("page");
        $limit = $this->input->get("limit");
        $page = $page != "" ? $page : 1;
        $limit = $limit != "" ? $limit : 10;
        $sql_where = "deleted = 0";
        if ($category > 0) {
            $category = $this->categorysimba_model->where('id', $category)->with_product()->as_array()->get();
//            echo "<pre>";
//            print_r($category);
//            die();
            if (isset($category['product']) && count($category['product'])) {
                $array_product = array_keys($category['product']);
                $str_product = implode(",", $array_product);
                $sql_where .= " AND id_product IN ($str_product)";
            }
        }
        if ($search != "") {
            $short_language = short_language_current();
            $sql_where .= " AND (name_" . $short_language . " like '%" . $search . "%' OR (name_vi like '%" . $search . "%' AND name_" . $short_language . " IN(NULL,'')))";
        }

        /*
         * TINH COUNT
         */
        $count = $this->product_model->where($sql_where, NULL, NULL, FALSE, FALSE, TRUE)->count_rows();
        /*
         * LAY DATA
         */
        $data = $this->product_model->where($sql_where, NULL, NULL, FALSE, FALSE, TRUE)->order_by("date", "DESC")->with_files()->as_array()->paginate($limit, NULL, $page);
//        echo "<pre>";
//        print_r($count);
//        print_r($limit);
//        die();
        $max_page = ceil($count / $limit);

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
            $this->load->model("option_model");
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
                /*
                 * Mail setting
                 */
                $conf = $this->option_model->get_setting_mail();
//            $this->load->config('ion_auth', TRUE);
                $config = array(
                    'mailtype' => 'html',
                    'protocol' => "smtp",
                    'smtp_host' => $conf['email_server'],
                    'smtp_user' => $conf['email_username'], // actual values different
                    'smtp_pass' => $conf['email_password'],
                    'charset' => "utf-8",
                    'smtp_crypto' => $conf['email_security'],
                    'wordwrap' => TRUE,
                    'smtp_port' => 465,
                    'starttls' => true,
                    'newline' => "\r\n"
                );
                $this->load->library("email", $config);

//            /*
//             * Send mail
//             */
//            $this->email->clear();
                $this->email->from($conf['email_email'], $conf['email_name']);
                $this->email->to($conf['email_contact']); /// $conf['email_contact']
                $this->email->subject("Góp ý");
                $html = "<p><strong>Tên: </strong>$name</p>"
                        . "<p><strong>Email: </strong>$email</p>"
                        . "<p><strong>Số điện thoại: </strong>$phone</p>"
                        . "<p><strong>Nội dung: </strong></p><p>" . nl2br($content) . "</p>";
                $this->email->message($html);
                if ($this->email->send()) {
                    echo json_encode(array('code' => 400, 'msg' => lang('alert_400')));
                } else {
                    show_error($this->email->print_debugger());
                }
            } else {
                echo json_encode(array('code' => 402, 'msg' => lang('alert_402')));
            }
        } else {
            echo json_encode(array('code' => 401, 'msg' => lang('alert_401')));
        }
    }

    function modalfeedback() {
        $this->load->model("customersimba_model");
        $this->load->model("productsimba_model");
        $this->data['customers'] = $this->customersimba_model->where(array('deleted' => 0))->limit(10)->as_array()->get_all();
        $this->data['products'] = $this->productsimba_model->limit(10)->as_array()->get_all();
        echo $this->blade->view()->make('ajax/modalfeedback', $this->data)->render();
    }

    function feedback() {
        $this->load->model("feedback_model");
        $this->load->model("option_model");
        if (isset($_POST['content'])) {
            $data = $_POST;
            $data['date'] = time();
            $data_up = $this->feedback_model->create_object($data);
            $id = $this->feedback_model->insert($data_up);
            /*
             * SET LIMIT 
             */
            $_SESSION['timer_contact'] = date("Y-m-d H:i:s", strtotime("+1 minutes"));
            /*
             * Mail setting
             */
//            $this->load->config('ion_auth', TRUE);

            $feedback = $this->feedback_model->where("id", $id)->with_product()->with_customer()->order_by("date", "DESC")->as_object()->get();

            $conf = $this->option_model->get_setting_mail();
//            $this->load->config('ion_auth', TRUE);
            $config = array(
                'mailtype' => 'html',
                'protocol' => "smtp",
                'smtp_host' => $conf['email_server'],
                'smtp_user' => $conf['email_username'], // actual values different
                'smtp_pass' => $conf['email_password'],
                'charset' => "utf-8",
                'smtp_crypto' => $conf['email_security'],
                'wordwrap' => TRUE,
                'smtp_port' => 465,
                'starttls' => true,
                'newline' => "\r\n"
            );
            $this->load->library("email", $config);

//            /*
//             * Send mail
//             */
//            $this->email->clear();
            $this->email->from($conf['email_email'], $conf['email_name']);
            $this->email->to('simbasalesrun@simba.com.vn'); /// $conf['email_contact']
            $this->email->subject($feedback->subject);
            $html = "<p><strong>Tên: </strong>" . $feedback->name . "</p>"
                    . "<p><strong>Khách hàng: </strong>" . (isset($feedback->customer) ? $feedback->customer->code . "-" . $feedback->customer->short_name : "") . "</p>"
                    . "<p><strong>Sản phẩm: </strong>" . (isset($feedback->product) ? $feedback->product->code . "-" . $feedback->product->name_vi : "") . "</p>"
                    . "<p><strong>Nội dung: </strong></p><p>" . nl2br($feedback->content) . "</p>";
            $this->email->message($html);
            if ($this->email->send()) {
                echo json_encode(array('code' => 400, 'msg' => lang('alert_400')));
            } else {
                show_error($this->email->print_debugger());
            }
        } else {
            echo json_encode(array('code' => 402, 'msg' => lang("alert_402")));
        }
    }

    function feedbackcustomer() {
        $this->load->model("customersimba_model");
        $search = $this->input->post("data");
        $search = $search['q'];
        $data = $this->customersimba_model->where("deleted = 0 AND (code like '%$search%' OR short_name like '%$search%')", NULL, NULL, FALSE, FALSE, TRUE)->limit(20)->as_array()->get_all();
        $results = array();
        foreach ($data as $row) {
            $results[] = array("id" => $row['id'], 'text' => $row['code'] . ' - ' . $row['short_name']);
        }
        echo json_encode(array('q' => $search, 'results' => $results));
    }

    function feedbackproduct() {
        $this->load->model("productsimba_model");
        $search = $this->input->post("data");
        $search = $search['q'];
        $data = $this->productsimba_model->where("(code like '%$search%' OR name_vi like '%$search%')", NULL, NULL, FALSE, FALSE, TRUE)->limit(20)->as_array()->get_all();
        $results = array();
        foreach ($data as $row) {
            $results[] = array("id" => $row['id'], 'text' => $row['code'] . ' - ' . $row['name_vi']);
        }
        echo json_encode(array('q' => $search, 'results' => $results));
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
            echo json_encode(array("code" => 403, "msg" => lang('alert_403')));
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
                    header("Content-Type: application/force-download");
                    header("Content-Type: application/octet-stream");
                    header("Content-Type: application/download");
                    header("Content-Disposition: attachment; filename=" . $real_name);
                    header("Content-Transfer-Encoding: binary");
                    readfile($src);
                } else {
                    echo json_encode(array("code" => 406, "msg" => lang('alert_406')));
                    die();
                }
            } else {
                echo json_encode(array("code" => 405, "msg" => lang('alert_405')));
                die();
            }
        } else {
            echo json_encode(array("code" => 404, "msg" => lang('alert_404')));
            die();
        }
    }

    ////////////
}
