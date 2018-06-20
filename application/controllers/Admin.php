<?php

class Admin extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->data['is_login'] = $this->user_model->logged_in();
        $this->data['userdata'] = $this->session->userdata();
        $this->data['template'] = "admin";
        $this->data['title'] = "Admin";
        $this->data['stylesheet_tag'] = array(
            "https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext",
            "https://fonts.googleapis.com/icon?family=Material+Icons",
            "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css",
            base_url() . "public/admin/plugins/bootstrap/css/bootstrap.css ",
            base_url() . "public/admin/plugins/node-waves/waves.css ",
            base_url() . "public/admin/plugins/animate-css/animate.css ",
            base_url() . "public/admin/plugins/morrisjs/morris.css ",
            base_url() . "public/admin/css/style.css ",
            base_url() . "public/admin/css/themes/all-themes.css"
        );
        $this->data['javascript_tag'] = array(
            base_url() . "public/admin/plugins/jquery/jquery.min.js",
            base_url() . "public/admin/plugins/bootstrap/js/bootstrap.js",
            base_url() . "public/admin/plugins/bootstrap-select/js/bootstrap-select.js",
            base_url() . "public/admin/plugins/jquery-slimscroll/jquery.slimscroll.js",
            base_url() . "public/admin/plugins/jquery-validation/jquery.validate.js",
            base_url() . "public/admin/plugins/node-waves/waves.js",
            base_url() . "public/admin/plugins/jquery-countto/jquery.countTo.js",
            base_url() . "public/admin/plugins/raphael/raphael.min.js",
            base_url() . "public/admin/plugins/morrisjs/morris.js",
            base_url() . "public/admin/plugins/chartjs/Chart.bundle.js",
            base_url() . "public/admin/plugins/flot-charts/jquery.flot.js",
            base_url() . "public/admin/plugins/flot-charts/jquery.flot.resize.js",
            base_url() . "public/admin/plugins/flot-charts/jquery.flot.pie.js",
            base_url() . "public/admin/plugins/flot-charts/jquery.flot.categories.js",
            base_url() . "public/admin/plugins/flot-charts/jquery.flot.time.js",
            base_url() . "public/admin/plugins/jquery-sparkline/jquery.sparkline.js",
            base_url() . "public/admin/js/admin.js"
        );
    }

    public function _remap($method, $params = array()) {
        if (!method_exists($this, $method)) {
            show_404();
        }
        if (!$this->user_model->logged_in()) {
//redirect them to the login page
            redirect("index", "refresh");
        } elseif ($this->has_right($method, $params)) {
            $this->$method($params);
        } else {
            show_404();
        }
    }

    private function has_right($method, $params = array()) {
        /* check admin */
        $fun_admin = array(
            "quanlyuser",
            "change_group",
            "remove_user",
            "activate",
            "deactivate",
            "quanlytintuc",
            "quanlymenu",
            "dangtintuc",
            "edittintuc",
            "editbanner",
            "activate_tintuc",
            "deactivate_tintuc",
            "remove_tintuc",
            "editgioithieu",
            "slider",
        );
        if (in_array($method, $fun_admin) && $this->data['userdata']['role'] != 1) {
            return false;
        }
        /* Tin đăng check */
        $fun_tin = array(
            "edittin",
            "activate_tin",
            "deactivate_tin",
            "remove_tin",
        );
        if (in_array($method, $fun_tin)) {
            $id = $params[
                    0];
            $id_user = $this->session->userdata('user_id');
            $this->load->model("tin_model");
            $tin = $this->tin_model->where(array('deleted' => 0, 'id_user' => $id_user, 'id_tin' => $id))->as_array()->get_all();
            if (!count($tin)) {
                return false;
            }
        }
        return true;
    }

    public function index() { /////// trang ca nhan
//        $id_user = $this->session->userdata('user_id');
//        $this->load->model("user_model");
//        if (isset($_POST[   'edit_user'])) {
//            
//        $additional_data = array(
//                'last_name' => $this-> input->post('ten'),
//                'phone' => $this->input->post('dienthoai'),
//                'gioitinh' => $this->input->post("gioitinh")
//            );
//            $this->user_model->update($additional_data, $id_user);
//            header('Location: ' . $_SERVER['HTTP_REFERER']);
//            exit;
//        } else {
//            $user = $this->user_model->where(array('id' => $id_user))->as_array()->get_all();
//            $this->data['user'] = $user[  0];
//            //echo $this->data['content'];
//            echo $this->blade->view()->make('page/page', $this->data)->render();
//        }
        $this->data['menu_active'] = "info";
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function slider() {
//        $id_user = $this->session->userdata('user_id');
        load_inputfile($this->data);
        $this->data['menu_active'] = "banner";
        array_push($this->data['javascript_tag'], base_url() . "public/admin/js/include/slider.js");
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function saveslider() {
        if (isset($_POST['listhinh'])) {
            $this->load->model("slider_model");
            $arr_id = json_decode($this->input->post('listhinh'), true);
            $this->slider_model->update(array("deleted" => 1));
            foreach ($arr_id as $key => $id) {
                $additional_data = array(
                    'id_hinhanh' => $id,
                    'order' => $key
                );
                $this->slider_model->insert($additional_data);
            }
            echo json_encode(array('success' => 1));
        }
    }

    /*
     * QUản lý User
     */

    public function quanlyuser() {
        $this->load->model("user_model");
        $this->load->model("group_model");
        $this->data['arr_groups'] = $this->group_model->where(array('deleted' => 0))->fields(array("id as value", "name as text"))->as_array()->get_all();
        $this->data['arr_users'] = $this->user_model->where(array('deleted' => 0))->as_object()->get_all();
        foreach ($this->data['arr_users'] as $k => &$user) {
            $group = $this->ion_auth->get_users_groups($user->id)->result();
            $arr = array();
            foreach ($group as $row) {
                array_push($arr, $row->id);
            }
            $user->groups = implode(",", $arr);
        }
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/dataTables.bootstrap.min.css");
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/bootstrap-editable.css");
        array_push($this->data['javascript_tag'], base_url() . "public/js/bootstrap-editable.min.js");
        array_push($this->data['javascript_tag'], base_url() . "public/js/jquery.dataTables.min.js");
        array_push($this->data['javascript_tag'], base_url() . "public/js/dataTables.bootstrap.min.js");
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    function change_group($params) {
        $id_user = $params[0];
        $arr_group = $this->input->post("value");
        ////remove group cu
        $this->ion_auth->remove_from_group('', $id_user);
        foreach ($arr_group as $grp) {
            $this->ion_auth->add_to_group($grp, $id_user);
        }
    }

    function changepass() {
        $id_user = $this->session->userdata('user_id');
        if (isset($_POST['change_pass'])) {
            $this->ion_auth->change_password($this->session->userdata('identity'), $this->input->post('passwordold'), $this->input->post('password'));
            $this->session->set_flashdata('success', "Thay đổi mật khẩu thành công!");
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            $this->data['id_user'] = $id_user;
            $this->data['success'] = $this->session->flashdata('success');
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

//remove a user
    function remove_user($params) {
        $id = $params[0];
        $this->load->model("user_model");
        $this->user_model->update(array("deleted" => 1), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

// activate the user
    function activate($params) {
        $id = $params[0];
        $code = isset($params[1]) ? $params[1] : false;
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

// deactivate the user
    function deactivate($params) {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }
        $id = (int) $params[0];
        $this->ion_auth->deactivate($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * Message
     */

    public function quanlymessage() {
        $this->load->model("contact_model");
        $this->data['arr_tin'] = $this->contact_model->where(array('deleted' => 0))->as_object()->get_all();
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/dataTables.bootstrap.min.css");
        array_push($this->data['javascript_tag'], base_url() . "public/js/jquery.dataTables.min.js");
        array_push($this->data['javascript_tag'], base_url() . "public/js/dataTables.bootstrap.min.js");
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    /*
     * PAge
     */

    public function quanlypage() {
        $this->load->model("pageweb_model");
        $this->data['menu_active'] = "page";
        $this->data['arr_tin'] = $this->pageweb_model->where(array('deleted' => 0))->as_object()->get_all();
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function thempage() { ////////// Trang dang tin
        if (isset($_POST['dangtin'])) {
            $post_title = $_POST['post_titles'];
            $post_content = $_POST['post_contents'];
            $data_up = array(
                'title' => $post_title,
                'alias' => sluggable($post_title),
                'content' => $post_content
            );
            $this->load->model("pageweb_model");
            $id_tin = $this->pageweb_model->insert($data_up);
            redirect('admin/quanlypage', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "page";
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function editpage($param) {
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $this->load->model("page_model");
            $this->load->model("pageweb_model");
            $post_title = $_POST['post_titles'];
            $post_content = $_POST['post_contents'];
            $post_alias = sluggable($post_title);
            $check = $this->pageweb_model->where(array('alias' => $post_alias))->as_array()->get_all();
            $check2 = $this->page_model->where(array('seo_url' => $post_alias))->as_array()->get_all();
            while (count($check) && $check[0]['id'] != $id && count($check2)) {
                $post_alias = $_POST['post_alias'] . "-" . rand();
                $check = $this->pageweb_model->where(array('alias' => $post_alias))->as_array()->get_all();
            }
            $data_up = array(
                'title' => $post_title,
                'alias' => $post_alias,
                'content' => $post_content
            );
            $this->pageweb_model->update($data_up, $id);
            redirect('admin/quanlypage', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "page";
            $this->load->model("pageweb_model");
            $tin = $this->pageweb_model->where(array('id' => $id))->as_array()->get_all();
            $this->data['tin'] = $tin[0];
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function removepage($params) {
        $this->load->model("pageweb_model");
        $id = $params[0];
        $this->pageweb_model->update(array("deleted" => 1), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * Loai Tin Tức
     */

    public function quanlytype() {
        $this->data['menu_active'] = "type";
        $id_user = $this->session->userdata('user_id');
        $this->load->model("typetintuc_model");
        $this->data['arr_tin'] = $this->typetintuc_model->where(array('deleted' => 0))->as_object()->get_all();
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function themtype() { ////////// Trang dang tin
        if (isset($_POST['dangtin'])) {
            $name_vi = $_POST['name_vi'];
            $name_en = isset($_POST['name_en']) ? $_POST['name_en'] : "";
            $name_jp = isset($_POST['name_jp']) ? $_POST['name_jp'] : "";
            $data_up = array(
                'name_vi' => $name_vi,
                'name_en' => $name_en,
                'name_jp' => $name_jp
            );
            $this->load->model("typetintuc_model");
            $id_tin = $this->typetintuc_model->insert($data_up);
            redirect('admin/quanlytype', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "type";
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function edittype($param) {
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $name_vi = $_POST['name_vi'];
            $name_en = isset($_POST['name_en']) ? $_POST['name_en'] : "";
            $name_jp = isset($_POST['name_jp']) ? $_POST['name_jp'] : "";
            $data_up = array(
                'name_vi' => $name_vi,
                'name_en' => $name_en,
                'name_jp' => $name_jp
            );
            $this->load->model("typetintuc_model");
            $this->typetintuc_model->update($data_up, $id);
            redirect('admin/quanlytype', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "type";
            $this->load->model("typetintuc_model");
            $tin = $this->typetintuc_model->where(array('id' => $id))->as_array()->get_all();
            $this->data['tin'] = $tin[0];
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function removetype($params) {
        $this->load->model("typetintuc_model");
        $id = $params[0];
        $this->typetintuc_model->update(array("deleted" => 1), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * Tin Tuc
     */

    public function quanlytintuc() {
        $this->data['menu_active'] = "tintuc";
        $this->load->model("tintuc_model");
        $this->load->model("hinhanh_model");
        $this->load->model("typetintuc_model");
        $this->data['arr_tin'] = $this->tintuc_model->where(array('deleted' => 0))->as_object()->get_all();
        foreach ($this->data['arr_tin'] as $k => &$tin) {
            $tin->title = mb_substr($tin->title, 0, 50) . "...";
            $hinh = $this->hinhanh_model->where(array('id' => $tin->id_hinhanh))->as_object()->get_all();
            $type = $this->typetintuc_model->where(array('id' => $tin->type))->as_object()->get_all();
            $tin->obj_hinh = $hinh[0];
            $tin->obj_type = $type[0];
        }
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function themtintuc() { ////////// Trang dang tin
        if (isset($_POST['dangtin'])) {
            $post_title = $_POST['post_titles'];
            $post_content = $_POST['post_contents'];
            $user_id = $this->session->userdata('user_id');
            $data_up = array(
                'title' => $post_title,
                'alias' => sluggable($post_title),
                'content' => $post_content,
                'date' => date("Y-m-d H:i:s"),
                'id_user' => $user_id
            );
            $this->load->model("tintuc_model");
            $this->load->model("hinhanh_tintuc_model");
            $this->load->model("hinhanh_model");
            $id_tintuc = $this->tintuc_model->insert($data_up);
            $hinhanh = $this->input->post('id_hinhanh');
            if (count($hinhanh) > 0) {
                foreach ($hinhanh as $hinh) {
                    $this->hinhanh_tintuc_model->insert(array('id_tintuc' => $id_tintuc, 'id_hinhanh' => $hinh));
                    $this->hinhanh_model->update(array('deleted' => 0), $hinh);
                }
            }
            redirect('member/quanlytintuc', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            load_inputfile($this->data);
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function edittintuc($param) {
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $post_title = $_POST['post_titles'];
            $post_content = $_POST['post_contents'];
            $user_id = $this->session->userdata('user_id');
            $data_up = array(
                'title' => $post_title,
                'alias' => sluggable($post_title),
                'content' => $post_content,
                'date' => date("Y-m-d H:i:s"),
                'id_user' => $user_id
            );
            $this->load->model("tintuc_model");
            $this->load->model("hinhanh_tintuc_model");
            $this->load->model("hinhanh_model");
            $this->tintuc_model->update($data_up, $id);
            $hinhanh = $this->input->post('id_hinhanh');
            $this->hinhanh_tintuc_model->where(array("id_tintuc" => $id))->update(array('deleted' => 1));
            if (count($hinhanh) > 0) {
                foreach ($hinhanh as $hinh) {
                    $this->hinhanh_tintuc_model->insert(array('id_tintuc' => $id, 'id_hinhanh' => $hinh));
                    $this->hinhanh_model->update(array('deleted' => 0), $hinh);
                }
            }
            redirect('member/quanlytintuc', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->load->model("tintuc_model");
            $tin = $this->tintuc_model->where(array('id_tintuc' => $id))->as_array()->get_all();
            $arr_hinhanh = $this->tintuc_model->get_tintuc_hinhanh($tin[0]['id_tintuc']);
            $tin[0]['arr_hinhanh'] = $arr_hinhanh;
//            echo "<pre>";
//            print_r($arr_hinhanh);
//            die();
            $this->data['tin'] = $tin[0];
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/fileinput.css");

            array_push($this->data['stylesheet_tag'], base_url() . "public/css/froala_editor.min.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/froala_style.min.css");
            /////////// Plugin
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/plugins/char_counter.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/plugins/code_view.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/plugins/colors.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/plugins/emoticons.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/plugins/file.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/plugins/fullscreen.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/plugins/image.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/plugins/image_manager.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/plugins/line_breaker.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/plugins/quick_insert.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/plugins/table.css");

            array_push($this->data['javascript_tag'], base_url() . "public/js/fileinput.js");
            ///////// Editor
            array_push($this->data['javascript_tag'], base_url() . "public/js/froala_editor.min.js");
            /////////// Plugin
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/align.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/char_counter.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/colors.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/emoticons.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/entities.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/font_size.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/fullscreen.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/image.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/image_manager.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/link.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/lists.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/paragraph_format.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/paragraph_style.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/quick_insert.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/save.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/url.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/video.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/languages/en_gb.js");
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function editbanner() {
        if (isset($_POST['banner'])) {
            $this->load->model("option_model");
            $this->load->model("hinhanh_model");
            $idhinhanh = $this->input->post('id_hinhanh');
            $banner = $this->option_model->where('name', "banner")->as_array()->get();
            if (!empty($banner)) {
                $id = $banner['id_option'];
                $this->option_model->update(array("content" => $idhinhanh), $id);
                $this->hinhanh_model->update(array('deleted' => 0), $idhinhanh);
            } else {
                $this->option_model->insert(array("content" => $idhinhanh, 'name' => "banner"));
                $this->hinhanh_model->update(array('deleted' => 0), $idhinhanh);
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            $this->load->model("option_model");
            $this->load->model("hinhanh_model");
            $banner = $this->option_model->where('name', "banner")->as_array()->get();
            if (!empty($banner)) {
                $id_img_banner = $banner['content'];
                $img_banner = $this->hinhanh_model->where(array('id_hinhanh' => $id_img_banner))->as_array()->get();
                if (!empty($img_banner)) {
                    $html = "\"<img src='" . base_url() . $img_banner['thumb_src'] . "' class='file-preview-image' alt='" . $img_banner['ten_hinhanh'] . "' title='" . $img_banner['ten_hinhanh'] . "'>\",";
                    $htmlcon = "{
                        caption: '" . $img_banner['ten_hinhanh'] . "',
                        width: '120px',
                        url: '" . base_url() . "member/deleteImage/" . $img_banner['id_hinhanh'] . "',
                        key: " . $img_banner['id_hinhanh'] . "
                    },";
                    $img_banner['hinhhtml'] = $html;
                    $img_banner['hinhconf'] = $htmlcon;
                    $this->data['img_banner'] = $img_banner;
                }
            }
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/fileinput.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/froala_editor.min.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/froala_style.min.css");
            array_push($this->data['stylesheet_tag'], base_url() . "public/css/plugins/colors.css");

            array_push($this->data['javascript_tag'], base_url() . "public/js/froala_editor.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/plugins/colors.min.js");
            array_push($this->data['javascript_tag'], base_url() . "public/js/fileinput.js");
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

// activate the tin
    function activate_tintuc($params) {
        $this->load->model("tintuc_model");
        $id = $params[0];
        $this->tintuc_model->update(array("active" => 1), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

// deactivate the tin
    function deactivate_tintuc($params) {
        $this->load->model("tintuc_model");
        $id = $params[0];
        $this->tintuc_model->update(array("active" => 0), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

//remove a tin
    function remove_tintuc($params) {
        $this->load->model("tintuc_model");
        $id = $params[0];
        $this->tintuc_model->update(array("deleted" => 1), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * MENU
     */

    public function quanlymenu() {
        $this->load->model("pageweb_model");
        $this->load->model("menu_model");
        $all_menu = $this->menu_model->where("deleted", 0)->as_array()->get_all();
        $data = recursive_menu_data($all_menu, 0);
        array_unshift($data, array('id' => 0, 'id_page' => 0, 'text' => "Trang chủ", 'expanded' => false, 'enabled' => false));
        $this->data['data'] = $data;
        $this->data['page'] = $this->pageweb_model->where("deleted", 0)->as_array()->get_all();
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/kendo.default.min.css");
        array_push($this->data['stylesheet_tag'], base_url() . "public/css/kendo.common.min.css");
        array_push($this->data['javascript_tag'], base_url() . "public/js/kendo.all.min.js");
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    /*
     * UPload hình ảnh
     */

    public function uploadimage() {
        ini_set('post_max_size', '64M');
        ini_set('upload_max_filesize', '64M');
        $this->load->helper('file');
        $date = date("Y-m-d");
        $upload_path_url = "public/uploads/$date/";
        $dir = FCPATH . "public/uploads/$date/";
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '10000';
        $this->load->library('upload', $config);
        $files = $_FILES;
        $_FILES['file']['name'] = time() . "_" . $files['file']['name'];
        $real_name = $files['file']['name'];
        if (!$this->upload->do_upload('file')) {
            $errors = $this->upload->display_errors();
            print_r($errors);
        } else {
            $data = $this->upload->data();
            /*
             * Array
              (
              [file_name] => png1.jpg
              [file_type] => image/jpeg
              [file_path] => /home/ipresupu/public_html/uploads/
              [full_path] => /home/ipresupu/public_html/uploads/png1.jpg
              [raw_name] => png1
              [orig_name] => png.jpg
              [client_name] => png.jpg
              [file_ext] => .jpg
              [file_size] => 456.93
              [is_image] => 1
              [image_width] => 1198
              [image_height] => 1166
              [image_type] => jpeg
              [image_size_str] => width="1198" height="1166"
              )

              // to re-size for thumbnail images un-comment and set path here and in json array
              $config = array();
              $config['image_library'] = 'gd2';
              $config['source_image'] = $data['full_path'];
              $config['create_thumb'] = TRUE;
              $config['new_image'] = $data['file_path'] . 'thumbs/';
              $config['maintain_ratio'] = TRUE;
              $config['thumb_marker'] = '';
              $config['width'] = 75;
              $config['height'] = 50;
              $this->load->library('image_lib', $config);
              $this->image_lib->resize();
             */
            ///resize 1
            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['full_path'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = "100%";
            $config['width'] = 768;
            $config['height'] = 576;
            $config['new_image'] = $data['file_path'] . $config['width'] . "x" . $config['height'] . "_" . $data['file_name'];
            $bg_src = $upload_path_url . $config['width'] . "x" . $config['height'] . "_" . $data['file_name'];
            $dim = (intval($data["image_width"]) / intval($data["image_height"])) - ($config['width'] / $config['height']);
            $config['master_dim'] = ($dim > 0) ? "height" : "width";
            $this->load->library('image_lib');
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            ///resize 2
            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['full_path'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = "100%";
            $config['width'] = 1200;
            $config['height'] = 450;
            $config['new_image'] = $data['file_path'] . $config['width'] . "x" . $config['height'] . "_" . $data['file_name'];
            $slider_src = $upload_path_url . $config['width'] . "x" . $config['height'] . "_" . $data['file_name'];
            $dim = (intval($data["image_width"]) / intval($data["image_height"])) - ($config['width'] / $config['height']);
            $config['master_dim'] = ($dim > 0) ? "height" : "width";
            $this->load->library('image_lib');
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            ///resize 3
            $config = array();
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['full_path'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = "100%";
            $config['width'] = 125;
            $config['height'] = 100;
            $config['new_image'] = $data['file_path'] . $config['width'] . "x" . $config['height'] . "_" . $data['file_name'];
            $thumb_src = $upload_path_url . $config['width'] . "x" . $config['height'] . "_" . $data['file_name'];
            $dim = (intval($data["image_width"]) / intval($data["image_height"])) - ($config['width'] / $config['height']);
            $config['master_dim'] = ($dim > 0) ? "height" : "width";
            $this->load->library('image_lib');
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            ////////////
            if (!$this->image_lib->resize()) { //Resize image
                echo json_encode("resize");
            } else {
                $info = new StdClass;
                $info->name = $data['file_name'];
                $info->size = $data['file_size'] * 1024;
                $info->type = $data['file_type'];
                $info->url = $upload_path_url . $data['file_name'];
                $info->deleteType = 'GET';
                $info->error = null;
                $data_up = array(
                    'ten_hinhanh' => $info->name,
                    'real_hinhanh' => $real_name,
                    'src' => $info->url,
                    'thumb_src' => $thumb_src,
                    'bg_src' => $bg_src,
                    'slider_src' => $slider_src,
                    'id_user' => $this->session->userdata('user_id'),
                    'deleted' => 1,
                    'date' => date("Y-m-d H:i:s")
                );
                $this->load->model('hinhanh_model');
                $id_image = $this->hinhanh_model->insert($data_up);
                echo json_encode(array("link" => base_url() . $info->url));
            }
        }
    }

    public function uploadhinhanh() {
        ini_set('post_max_size', '64M');
        ini_set('upload_max_filesize', '64M');
        $this->load->helper('file');
        $date = date("Y-m-d");
        $upload_path_url = "public/uploads/$date/";
        $dir = FCPATH . "public/uploads/$date/";
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = '10000';
        $this->load->library('upload', $config);
        $files = $_FILES;

        $file_count = count($_FILES['hinhanh']['name']);
        for ($i = 0; $i < $file_count; $i++) {
            $_FILES['hinhanh']['name'] = time() . "_" . $i . "_" . $files['hinhanh']['name'][$i];
            $_FILES['hinhanh']['type'] = $files['hinhanh']['type'][$i];
            $_FILES['hinhanh']['tmp_name'] = $files['hinhanh']['tmp_name'][$i];
            $_FILES['hinhanh']['error'] = $files['hinhanh']['error'][$i];
            $_FILES['hinhanh']['size'] = $files['hinhanh']['size'][$i];
            $real_name = $files['hinhanh']['name'][$i];
            if (!$this->upload->do_upload('hinhanh')) {
                $errors = $this->upload->display_errors();
                print_r($errors);
            } else {
                $data = $this->upload->data();
                /*
                 * Array
                  (
                  [file_name] => png1.jpg
                  [file_type] => image/jpeg
                  [file_path] => /home/ipresupu/public_html/uploads/
                  [full_path] => /home/ipresupu/public_html/uploads/png1.jpg
                  [raw_name] => png1
                  [orig_name] => png.jpg
                  [client_name] => png.jpg
                  [file_ext] => .jpg
                  [file_size] => 456.93
                  [is_image] => 1
                  [image_width] => 1198
                  [image_height] => 1166
                  [image_type] => jpeg
                  [image_size_str] => width="1198" height="1166"
                  )

                  // to re-size for thumbnail images un-comment and set path here and in json array
                  $config = array();
                  $config['image_library'] = 'gd2';
                  $config['source_image'] = $data['full_path'];
                  $config['create_thumb'] = TRUE;
                  $config['new_image'] = $data['file_path'] . 'thumbs/';
                  $config['maintain_ratio'] = TRUE;
                  $config['thumb_marker'] = '';
                  $config['width'] = 75;
                  $config['height'] = 50;
                  $this->load->library('image_lib', $config);
                  $this->image_lib->resize();
                 */
                ///resize 1
                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $data['full_path'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = "100%";
                $config['width'] = 768;
                $config['height'] = 576;
                $config['new_image'] = $data['file_path'] . $config['width'] . "x" . $config['height'] . "_" . $data['file_name'];
                $bg_src = $upload_path_url . $config['width'] . "x" . $config['height'] . "_" . $data['file_name'];
                $dim = (intval($data["image_width"]) / intval($data["image_height"])) - ($config['width'] / $config['height']);
                $config['master_dim'] = ($dim > 0) ? "height" : "width";
                $this->load->library('image_lib');
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                ///resize 2
                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $data['full_path'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = "100%";
                $config['width'] = 1200;
                $config['height'] = 450;
                $config['new_image'] = $data['file_path'] . $config['width'] . "x" . $config['height'] . "_" . $data['file_name'];
                $slider_src = $upload_path_url . $config['width'] . "x" . $config['height'] . "_" . $data['file_name'];
                $dim = (intval($data["image_width"]) / intval($data["image_height"])) - ($config['width'] / $config['height']);
                $config['master_dim'] = ($dim > 0) ? "height" : "width";
                $this->load->library('image_lib');
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                ///resize 3
                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $data['full_path'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $config['quality'] = "100%";
                $config['width'] = 125;
                $config['height'] = 100;
                $config['new_image'] = $data['file_path'] . $config['width'] . "x" . $config['height'] . "_" . $data['file_name'];
                $thumb_src = $upload_path_url . $config['width'] . "x" . $config['height'] . "_" . $data['file_name'];
                $dim = (intval($data["image_width"]) / intval($data["image_height"])) - ($config['width'] / $config['height']);
                $config['master_dim'] = ($dim > 0) ? "height" : "width";
                $this->load->library('image_lib');
                $this->image_lib->clear();
                $this->image_lib->initialize($config);
                ////////////
                if (!$this->image_lib->resize()) { //Resize image
                    echo json_encode("resize");
                } else {

                    $info = new StdClass;
                    $info->name = $data['file_name'];
                    $info->size = $data['file_size'] * 1024;
                    $info->type = $data['file_type'];
                    $info->url = $upload_path_url . $data['file_name'];
                    $info->deleteType = 'GET';
                    $info->error = null;
                    $data_up = array(
                        'ten_hinhanh' => $info->name,
                        'real_hinhanh' => $real_name,
                        'src' => $info->url,
                        'thumb_src' => $thumb_src,
                        'bg_src' => $bg_src,
                        'slider_src' => $slider_src,
                        'id_user' => $this->session->userdata('user_id'),
                        'deleted' => 1,
                        'date' => date("Y-m-d H:i:s")
                    );
                    $this->load->model('hinhanh_model');
                    $id_image = $this->hinhanh_model->insert($data_up);
                    if (IS_AJAX) {
                        echo json_encode(array(
                            'initialPreview' => array(base_url() . $info->url),
                            'initialPreviewConfig' => array(array('caption' => $info->name, 'width' => '120px', 'height' => '160px', 'url' => base_url() . '/index/success/' . $id_image, 'key' => $id_image)),
                            'append' => true,
                            'key' => $id_image
                        ));
                    } else {
                        $file_data['upload_data'] = $this->upload->data();
                    }
                }
            }
        }
    }

    public function upload() {
        
    }

    public function deleteImage($params) {//gets the job done but you might want to add error checking and security
        $this->load->model('hinhanh_model');
        $id = $params[0];
        $file = $this->hinhanh_model->where('id_hinhanh', $id)->as_array()->get();
        $success = 0;
        if (file_exists($file['src'])) {
            $success = unlink($file['src']);
        }
        if (file_exists($file['real_hinhanh'])) {
            $success = unlink($file['real_hinhanh']);
        }
        if (file_exists($file['thumb_src'])) {
            $success = unlink($file['thumb_src']);
        }
        if (file_exists($file['bg_src'])) {
            $success = unlink($file['bg_src']);
        }
        if (file_exists($file['slider_src'])) {
            $success = unlink($file['slider_src']);
        }
        $data = array('deleted' => 1);
        $this->hinhanh_model->update($data, $id);
//        $info = new StdClass;
//        $info->sucess = $success;
//        if (IS_AJAX) {
////I don't think it matters if this is set but good for error checking in the console/firebug
//            echo json_encode(array($info));
//        } else {
////here you will need to decide what you want to show for a successful delete        
//            $file_data['delete_data'] = $file;
////$this->load->view('admin/delete_success', $file_data);
//        }
        echo json_encode(1);
    }

}
