<?php

class Admin extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->data['is_login'] = $this->user_model->logged_in();
        $this->data['userdata'] = $this->session->userdata();
        $this->data['template'] = "admin";
        $this->data['title'] = "Admin";
        $version = $this->config->item("version");
        $this->data['stylesheet_tag'] = array(
            "https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext",
            "https://fonts.googleapis.com/icon?family=Material+Icons",
            "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css",
            base_url() . "public/admin/plugins/bootstrap/css/bootstrap.css ",
            base_url() . "public/admin/plugins/bootstrap-select/css/bootstrap-select.css",
            base_url() . "public/admin/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css",
            base_url() . "public/admin/plugins/node-waves/waves.css ",
            base_url() . "public/admin/plugins/animate-css/animate.css ",
            base_url() . "public/admin/plugins/morrisjs/morris.css ",
            base_url() . "public/admin/plugins/sweetalert/sweetalert.css",
            base_url() . "public/admin/plugins/chosen/chosen.min.css",
            base_url() . "public/admin/css/themes/all-themes.css",
            base_url() . "public/admin/css/style.css?v=" . $version
        );
        $this->data['javascript_tag'] = array(
            base_url() . "public/admin/plugins/jquery/jquery.min.js",
            base_url() . "public/admin/plugins/bootstrap/js/bootstrap.js",
            base_url() . "public/admin/plugins/bootstrap-select/js/bootstrap-select.js",
            base_url() . "public/admin/plugins/jquery-slimscroll/jquery.slimscroll.js",
            base_url() . "public/admin/plugins/jquery-validation/jquery.validate.js",
            base_url() . "public/admin/plugins/node-waves/waves.js",
            base_url() . "public/admin/plugins/raphael/raphael.min.js",
            base_url() . "public/admin/plugins/morrisjs/morris.js",
            base_url() . "public/admin/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js",
            base_url() . "public/admin/plugins/sweetalert/sweetalert.min.js",
            base_url() . "public/admin/plugins/chosen/chosen.jquery.js",
            base_url() . "public/lib/ajaxchosen/chosen.ajaxaddition.jquery.js",
            base_url() . "public/admin/js/admin.js?v=" . $version
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

        /*
         * SET PERMISSION
         */
        $role_user = $this->session->userdata('role');
        $this->user_model->set_permission($role_user);

        /* Change method */
        switch ($method) {
            case 'updatetintuc':
                $method = 'edittintuc';
                break;
            case 'editmenu':
                $method = 'quanlymenu';
                break;
            case 'updatenoibat':
                $method = 'editnoibat';
                break;
            case 'updatenoibo':
                $method = 'editnoibo';
                break;
            case 'updateproduct':
                $method = 'editproduct';
                break;
            case 'viewtin':
                $method = 'quanlynoibo';
                break;
            case 'updatepage':
                $method = "editpage";
                break;
            case 'quanlylogbook':
                $method = 'quanlyfeedback';
                break;
            case 'editlogbook':
                $method = 'editfeedback';
                break;
            case 'removelogbook':
                $method = 'removefeedback';
                break;
            case 'slider':
            case 'saveslider':
            case 'gioithieu':
            case 'savegioithieu':
            case 'quanlycategory':
            case 'themcategory':
            case 'editcategory':
            case 'updatecategory':
            case 'removecategory':
            case 'quanlyclient':
            case 'themclient':
            case 'editclient':
            case 'updateclient':
            case 'removeclient':
            case 'quanlyhappy':
            case 'themhappy':
            case 'edithappy':
            case 'updatehappy':
            case 'removehappy':
                $method = 'trangchu';
                break;
        }
        if (has_permission($method) && !is_permission($method)) {
            return false;
        }
        /* Tin đăng check */
//        $fun_tin = array(
//            "edittin",
//            "activate_tin",
//            "deactivate_tin",
//            "remove_tin",
//        );
//        if (in_array($method, $fun_tin)) {
//            $id = $params[0];
//            $id_user = $this->session->userdata('user_id');
//            $this->load->model("tin_model");
//            $tin = $this->tin_model->where(array('deleted' => 0, 'id_user' => $id_user, 'id_tin' => $id))->as_array()->get_all();
//            if (!count($tin)) {
//                return false;
//            }
//        }
        return true;
    }

    public function index() { /////// trang ca nhan
        $id_user = $this->session->userdata('user_id');
        $this->load->model("user_model");
        if (isset($_POST['edit_user'])) {
            $additional_data = array(
                'fullname' => $this->input->post('fullname'),
            );
            $this->user_model->update($additional_data, $id_user);
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            $user = $this->user_model->where(array('id' => $id_user))->as_object()->get();
            $this->data['user'] = $user;
            $this->data['menu_active'] = "info";
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
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

    function changepass() {
        $id_user = $this->session->userdata('user_id');
        $this->load->model("user_model");
        $user = $this->user_model->where(array("id" => $id_user))->get();
        if (!isset($_POST['password']) || (isset($_POST['password']) && $user->password != md5($_POST['password']))) {
            echo json_encode(array('code' => 402, "msg" => "Mật khẩu cũ không đúng."));
            die();
        }
        if (!isset($_POST['confirmpassword']) || !isset($_POST['newpassword']) || (isset($_POST['newpassword']) && isset($_POST['confirmpassword']) && $_POST['newpassword'] != $_POST['confirmpassword'])) {
            echo json_encode(array('code' => 403, "msg" => "Xác nhận mật khẩu mới không đúng."));
            die();
        }
        $additional_data = array(
            'password' => md5($this->input->post('newpassword')),
        );
        $this->user_model->update($additional_data, $id_user);
        echo json_encode(array('code' => 400, "msg" => "Thay đổi mật khẩu thành công."));
        die();
    }

    function changepasswithout() {
        $id_user = $this->input->post('id_user');
        $this->load->model("user_model");
        if (!isset($_POST['confirmpassword']) || !isset($_POST['newpassword']) || (isset($_POST['newpassword']) && isset($_POST['confirmpassword']) && $_POST['newpassword'] != $_POST['confirmpassword'])) {
            echo json_encode(array('code' => 403, "msg" => "Xác nhận mật khẩu mới không đúng."));
            die();
        }
        $additional_data = array(
            'password' => md5($this->input->post('newpassword')),
        );
//        print_r($additional_data);
//        echo $id_user;
//        die();
        $this->user_model->update($additional_data, $id_user);
        echo json_encode(array('code' => 400, "msg" => "Thay đổi mật khẩu thành công."));
        die();
    }

    /*
     * Gioithieu
     */

    public function gioithieu() {
        $this->load->model("about_model");
        $this->data['arr_vi'] = $this->about_model->where(array('deleted' => 0, 'language' => 'vi'))->order_by("order", "ASC")->with_hinhanh()->as_object()->get_all();
        $this->data['arr_en'] = $this->about_model->where(array('deleted' => 0, 'language' => 'en'))->order_by("order", "ASC")->with_hinhanh()->as_object()->get_all();
        $this->data['arr_jp'] = $this->about_model->where(array('deleted' => 0, 'language' => 'jp'))->order_by("order", "ASC")->with_hinhanh()->as_object()->get_all();
//        echo "<pre>";
//        print_r($this->data['arr_en']);
//        die();
        $this->data['menu_active'] = "about";
        array_push($this->data['stylesheet_tag'], base_url() . "public/admin/css/timeline.css");
        load_editor($this->data);
        load_inputfile($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function savegioithieu() {
        $this->load->model("about_model");
        $this->about_model->update(array('deleted' => 1));
        $array = json_decode($this->input->post('data'), true);
//        var_dump($array);
//        die();
        foreach ($array as $row) {
            $data = $this->about_model->create_object($row);
            $this->about_model->insert($data);
        }
        echo json_encode(array('success' => 1));
    }

    /*
     * Quan ly language
     */

    public function quanlylanguage() {
        $this->data['menu_active'] = "language";
        load_datatable($this->data);
        $translations = $this->_load_language();
        $this->data['moduleData'] = $translations;
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function savelanguage() {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $lang => $row) {
            $path = APPPATH . "language/" . $lang . "/home_lang.php";
            // Backup original file
            if (is_file($path)) {
                $slaveModule = $this->_load_module($path);
                $fp = fopen($path . '.' . date('Y-M-d-H-i-s') . '.bak', 'w');
                fwrite($fp, implode($slaveModule));
                fclose($fp);
            }

            $master = array();
            $master[] = "<?php \n\n";
            foreach ($row as $key => $value) {
                $master[] = '$lang[\'' . $key . '\'] = \'' . str_replace("'", "\'", $value) . '\';';
            }
            // Add closing PHP tag
            $master[] = NULL;
            $master[] = NULL;
            $master[] = "\n\n?>";

            // Clean up new line characters from textarea inputs
            foreach ($master as $line_number => $line) {
                $master[$line_number] = str_replace("\n", '', $line);
                $master[$line_number] .= "\n";
            }
            // Check syntax and attempt to save file
            $php = implode($master);
//            echo $php;
//            die();
            if (!$this->_invalid_php_syntax($php)) {
                $fp = @fopen($path, 'w');
                if (fwrite($fp, $php) !== FALSE) {
                    fclose($fp);
                }
            }
        }
        echo json_encode(1);
    }

    /*
     * PAge
     */

    public function quanlypage() {
        $this->load->model("pageweb_model");
        $this->data['menu_active'] = "page";
        $this->data['arr_tin'] = $this->pageweb_model->where(array('deleted' => 0))->order_by('date', "DESC")->as_object()->get_all();
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function thempage() { ////////// Trang dang tin
        if (isset($_POST['dangtin'])) {
            $this->load->model("pageweb_model");
            $data = $_POST;
            $data['date'] = time();
            $data['active'] = 1;
            $data['id_'] = $this->session->userdata('user_id');
            $data_up = $this->pageweb_model->create_object($data);
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
            $this->load->model("pageweb_model");
            $data = $_POST;
            $data_up = $this->pageweb_model->create_object($data);
            $this->pageweb_model->update($data_up, $id);
            redirect('admin/quanlypage', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "page";
            $this->load->model("pageweb_model");
            $tin = $this->pageweb_model->where(array('id' => $id))->as_array()->get();
            $this->data['tin'] = $tin;
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function updatepage($params) {
        $this->load->model("pageweb_model");
        $id = $params[0];
        $this->pageweb_model->update(array("date" => time()), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
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
        $this->data['arr_tin'] = $this->typetintuc_model->where(array('deleted' => 0))->order_by('id', "DESC")->as_object()->get_all();
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function themtype() { ////////// Trang dang tin
        if (isset($_POST['dangtin'])) {
            $name_vi = $_POST['name_vi'];
            $name_en = isset($_POST['name_en']) ? $_POST['name_en'] : "";
            $name_jp = isset($_POST['name_jp']) ? $_POST['name_jp'] : "";
            $color = isset($_POST['color']) ? $_POST['color'] : "#000000";
            $data_up = array(
                'name_vi' => $name_vi,
                'name_en' => $name_en,
                'name_jp' => $name_jp,
                'color' => $color
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
            $color = isset($_POST['color']) ? $_POST['color'] : "#000000";
            $data_up = array(
                'name_vi' => $name_vi,
                'name_en' => $name_en,
                'name_jp' => $name_jp,
                'color' => $color
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
     * Category
     */

    public function quanlycategory() {
        $this->data['menu_active'] = "category";
        $this->load->model("category_model");
        $this->data['arr_tin'] = $this->category_model->where(array('deleted' => 0))->with_hinhanh()->order_by('date', "DESC")->as_object()->get_all();
//        print_r($this->data['arr_tin']);
//        die();
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function themcategory() { ////////// Trang dang tin
        if (isset($_POST['dangtin'])) {
            $data = $_POST;
            $this->load->model("category_model");
            $data['role_show'] = isset($data['role_show']) ? implode(",", $data['role_show']) : null;
            $data['date'] = time();
            $data_up = $this->category_model->create_object($data);
            $this->category_model->insert($data_up);
            redirect('admin/quanlycategory', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "category";
            $this->load->model("categorysimba_model");
            $this->load->model("role_model");
            $this->data['role'] = $this->role_model->as_array()->get_all();
            $this->data['arr_category'] = $this->categorysimba_model->as_object()->get_all();
            load_inputfile($this->data);
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function editcategory($param) {
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $data = $_POST;
            $this->load->model("category_model");
            $data['role_show'] = isset($data['role_show']) ? implode(",", $data['role_show']) : null;
            $data_up = $this->category_model->create_object($data);
            $this->category_model->update($data_up, $id);
            redirect('admin/quanlycategory', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "category";
            $this->load->model("categorysimba_model");
            $this->load->model("category_model");
            $this->load->model("role_model");

            $this->data['arr_category'] = $this->categorysimba_model->as_object()->get_all();

            $tin = $this->category_model->with_hinhanh()->where(array('id' => $id))->as_object()->get();
            $this->data['tin'] = $tin;

            $this->data['role'] = $this->role_model->as_array()->get_all();
            load_inputfile($this->data);
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function updatecategory($params) {
        $this->load->model("category_model");
        $id = $params[0];
        $this->category_model->update(array("date" => time()), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    function removecategory($params) {
        $this->load->model("category_model");
        $id = $params[0];
        $this->category_model->update(array("deleted" => 1), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * Product
     */

    public function quanlyproduct() {
        $this->data['menu_active'] = "product";
//        $this->load->model("product_model");
        $this->data['arr_tin'] = array();
//        print_r($this->data['arr_tin']);
//        die();
        $this->load->model("role_model");
        $this->load->model("option_model");

        $this->data['role'] = $this->role_model->as_array()->get_all();
        $this->data['role_download'] = $this->option_model->where("name", "role_download")->get();
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function themproduct() { ////////// Trang dang tin
        if (isset($_POST['dangtin'])) {
            $data = $_POST;
            $this->load->model("product_model");
            $this->load->model("productfile_model");
            $this->load->model("hinhanh_model");
            $data['date'] = time();
            $data_up = $this->product_model->create_object($data);
            $id = $this->product_model->insert($data_up);
            $files = $this->input->post('id_files');
            $role_download = is_array($this->input->post('role_download')) ? implode(",", $this->input->post('role_download')) : "";
//            $this->productfile_model->where('id_product', $id)->delete();
            if (count($files) > 0) {
                foreach ($files as $file) {
                    $this->productfile_model->insert(array('id_product' => $id, 'id_file' => $file));
                    $this->hinhanh_model->update(array('deleted' => 0, 'role_download' => $role_download), $file);
                }
            }
            redirect('admin/quanlyproduct', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "product";
            $this->load->model("productsimba_model");
            $this->load->model("role_model");
            $this->load->model("option_model");
            $this->data['role_download'] = $this->option_model->where("name", "role_download")->get();
            $this->data['role'] = $this->role_model->as_array()->get_all();
            $this->data['arr_category'] = $this->productsimba_model->as_object()->get_all();
            load_inputfile($this->data);
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function editproduct($param) {
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $data = $_POST;
            $this->load->model("product_model");
            $this->load->model("productfile_model");
            $this->load->model("hinhanh_model");
            $data_up = $this->product_model->create_object($data);
            $this->product_model->update($data_up, $id);
            $files = $this->input->post('id_files');
            $role_download = is_array($this->input->post('role_download')) ? implode(",", $this->input->post('role_download')) : "";
            $this->productfile_model->where('id_product', $id)->delete();
            if (count($files) > 0) {
                foreach ($files as $file) {
                    $this->productfile_model->insert(array('id_product' => $id, 'id_file' => $file));
                    $this->hinhanh_model->update(array('deleted' => 0, 'role_download' => $role_download), $file);
                }
            }
            redirect('admin/quanlyproduct', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "product";
            $this->load->model("productsimba_model");
            $this->load->model("product_model");
            $this->load->model("role_model");
            $this->load->model("option_model");
            $this->data['role_download'] = $this->option_model->where("name", "role_download")->get();
            $this->data['role'] = $this->role_model->as_array()->get_all();
            $this->data['arr_category'] = $this->productsimba_model->as_object()->get_all();

            $tin = $this->product_model->with_hinhanh()->with_files()->where(array('id' => $id))->as_object()->get();
            $this->data['tin'] = $tin;

            load_inputfile($this->data);
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function updateproduct($params) {
        $this->load->model("product_model");
        $id = $params[0];
        $this->product_model->update(array("date" => time()), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    function updatedownload() {
        if (isset($_POST['updatedownload'])) {
            $this->load->model("option_model");
            $role_download = implode(",", $this->input->post('role_download'));
            $this->option_model->where("name", 'role_download')->update(array("content" => $role_download));
            $this->option_model->update_role_download($role_download);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    function removeproduct($params) {
        $this->load->model("product_model");
        $id = $params[0];
        $this->product_model->update(array("deleted" => 1), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * Client
     */

    public function quanlyclient() {
        $this->data['menu_active'] = "client";
        $this->load->model("client_model");
        $this->data['arr_tin'] = $this->client_model->where(array('deleted' => 0))->with_hinhanh()->order_by('order', "DESC")->as_object()->get_all();
//        print_r($this->data['arr_tin']);
//        die();
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function themclient() { ////////// Trang dang tin
        if (isset($_POST['dangtin'])) {
            $data = $_POST;
            $this->load->model("client_model");
            $data['date'] = time();
            $data_up = $this->client_model->create_object($data);
            $this->client_model->insert($data_up);
            redirect('admin/quanlyclient', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "client";
            load_inputfile($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function editclient($param) {
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $data = $_POST;
            $this->load->model("client_model");
            $data_up = $this->client_model->create_object($data);
            $this->client_model->update($data_up, $id);
            redirect('admin/quanlyclient', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "client";
            $this->load->model("client_model");
            $tin = $this->client_model->where(array('id' => $id))->with_hinhanh()->as_object()->get();
            $this->data['tin'] = $tin;
            load_inputfile($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function updateclient($params) {
        $this->load->model("client_model");
        $id = $params[0];
        $this->client_model->update(array("order" => time()), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    function removeclient($params) {
        $this->load->model("client_model");
        $id = $params[0];
        $this->client_model->update(array("deleted" => 1), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * Happy Client
     */

    public function quanlyhappy() {
        $this->data['menu_active'] = "happy";
        $this->load->model("happy_model");
        $this->data['arr_tin'] = $this->happy_model->where(array('deleted' => 0))->with_hinhanh()->order_by(array('order' => "ASC", 'date' => "DESC"))->as_object()->get_all();
//        print_r($this->data['arr_tin']);
//        die();
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function themhappy() { ////////// Trang dang tin
        if (isset($_POST['dangtin'])) {
            $data = $_POST;
            $this->load->model("happy_model");
            $data['date'] = time();
            $data_up = $this->happy_model->create_object($data);
            $this->happy_model->insert($data_up);
            redirect('admin/quanlyhappy', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "happy";
            load_inputfile($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function edithappy($param) {
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $data = $_POST;
            $this->load->model("happy_model");
            $data_up = $this->happy_model->create_object($data);
            $this->happy_model->update($data_up, $id);
            redirect('admin/quanlyhappy', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "happy";
            $this->load->model("happy_model");
            $tin = $this->happy_model->where(array('id' => $id))->with_hinhanh()->as_object()->get();
            $this->data['tin'] = $tin;
            load_inputfile($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function updatehappy($params) {
        $this->load->model("happy_model");
        $id = $params[0];
        $this->happy_model->update(array("date" => time()), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    function removehappy($params) {
        $this->load->model("happy_model");
        $id = $params[0];
        $this->happy_model->update(array("deleted" => 1), $id);
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
        $this->data['arr_tin'] = $this->tintuc_model->where(array('deleted' => 0, 'is_private' => 0, 'is_highlight' => 0))->order_by('date', "DESC")->as_object()->get_all();
        foreach ($this->data['arr_tin'] as $k => &$tin) {
            $tin->title_vi = mb_strlen($tin->title_vi) < 50 ? $tin->title_vi : mb_substr($tin->title_vi, 0, 50) . "...";
            $hinh = $this->hinhanh_model->where(array('id_hinhanh' => $tin->id_hinhanh))->as_object()->get_all();
            $type = $this->typetintuc_model->where(array('id' => $tin->type))->as_object()->get_all();
            $tin->obj_hinh = isset($hinh[0]) ? $hinh[0] : array();
            $tin->obj_type = isset($type[0]) ? $type[0] : array();
        }
//        print_r($this->data['arr_tin']);
//        die();
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function themtintuc() { ////////// Trang dang tin
        if (isset($_POST['dangtin'])) {
            $this->load->model("tintuc_model");
            $this->load->model("tintucfile_model");
            $this->load->model("hinhanh_model");
            $data = $_POST;
            $data['id_user'] = $this->session->userdata('user_id');
            $data['active'] = 1;
            $data['date'] = time();
            $data_up = $this->tintuc_model->create_object($data);
            $id_tintuc = $this->tintuc_model->insert($data_up);
            $files = $this->input->post('id_files');
//            $this->tintucfile_model->where('id_tintuc', $id_tintuc)->update(array('deleted' => 0));
            if (count($files) > 0) {
                foreach ($files as $file) {
                    $this->tintucfile_model->insert(array('id_tintuc' => $id_tintuc, 'id_file' => $file));
                    $this->hinhanh_model->update(array('deleted' => 0), $file);
                }
            }
            redirect('admin/quanlytintuc', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->load->model("typetintuc_model");
            $this->data['arr_type'] = $this->typetintuc_model->where(array('deleted' => 0))->as_array()->get_all();
            load_inputfile($this->data);
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function edittintuc($param) {
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $this->load->model("tintuc_model");
            $this->load->model("tintucfile_model");
            $this->load->model("hinhanh_model");
            $data = $_POST;
            $data['id_user'] = $this->session->userdata('user_id');
            $data['active'] = 1;
            $data_up = $this->tintuc_model->create_object($data);
            $this->tintuc_model->update($data_up, $id);
            $files = $this->input->post('id_files');
            $this->tintucfile_model->where('id_tintuc', $id)->delete();
            if (count($files) > 0) {
                foreach ($files as $file) {
                    $this->tintucfile_model->insert(array('id_tintuc' => $id, 'id_file' => $file));
                    $this->hinhanh_model->update(array('deleted' => 0), $file);
                }
            }
            redirect('admin/quanlytintuc', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->load->model("typetintuc_model");
            $this->load->model("tintuc_model");
            $this->data['arr_type'] = $this->typetintuc_model->where(array('deleted' => 0))->as_array()->get_all();

            $tin = $this->tintuc_model->with_hinhanh()->with_files()->where(array('id' => $id))->as_object()->get();
//            echo "<pre>";
//            print_r($tin);
//            die();
            $this->data['tin'] = $tin;
            load_inputfile($this->data);
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function updatetintuc($params) {
        $this->load->model("tintuc_model");
        $id = $params[0];
        $this->tintuc_model->update(array("date" => time()), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    function removetintuc($params) {
        $this->load->model("tintuc_model");
        $id = $params[0];
        $this->tintuc_model->update(array("deleted" => 1), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * Tin Tuc noi bat
     */

    public function quanlynoibat() {
        $this->data['menu_active'] = "noibat";
        $this->load->model("tintuc_model");
        $this->data['arr_tin'] = $this->tintuc_model->where(array('deleted' => 0, 'is_highlight' => 1))->order_by('date', "DESC")->with_hinhanh()->as_object()->get_all();
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function themnoibat() { ////////// Trang dang tin
        if (isset($_POST['dangtin'])) {
            $this->load->model("tintuc_model");
            $this->load->model("tintucfile_model");
            $this->load->model("hinhanh_model");
            $data = $_POST;
            $data['id_user'] = $this->session->userdata('user_id');
            $data['active'] = 1;
            $data['is_highlight'] = 1;
            $data['date'] = time();
            $data_up = $this->tintuc_model->create_object($data);
            $id_tintuc = $this->tintuc_model->insert($data_up);
            $files = $this->input->post('id_files');
//            $this->tintucfile_model->where('id_tintuc', $id_tintuc)->update(array('deleted' => 0));
            if (count($files) > 0) {
                foreach ($files as $file) {
                    $this->tintucfile_model->insert(array('id_tintuc' => $id_tintuc, 'id_file' => $file));
                    $this->hinhanh_model->update(array('deleted' => 0), $file);
                }
            }
            redirect('admin/quanlynoibat', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            load_inputfile($this->data);
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    public function editnoibat($param) { ////////// Trang dang tin
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $this->load->model("tintuc_model");
            $this->load->model("tintucfile_model");
            $this->load->model("hinhanh_model");
            $data = $_POST;
            $data['id_user'] = $this->session->userdata('user_id');
            $data['active'] = 1;
            $data['date'] = time();
            $data['is_highlight'] = 1;
            $data_up = $this->tintuc_model->create_object($data);
            $this->tintuc_model->update($data_up, $id);
            $files = $this->input->post('id_files');
            $this->tintucfile_model->where('id_tintuc', $id)->delete();
            if (count($files) > 0) {
                foreach ($files as $file) {
                    $this->tintucfile_model->insert(array('id_tintuc' => $id, 'id_file' => $file));
                    $this->hinhanh_model->update(array('deleted' => 0), $file);
                }
            }
            redirect('admin/quanlynoibat', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->load->model("tintuc_model");
            $tin = $this->tintuc_model->with_hinhanh()->with_files()->where(array('id' => $id))->as_object()->get();
//            echo "<pre>";
//            print_r($tin);
//            die();
            $this->data['tin'] = $tin;
            load_inputfile($this->data);
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function updatenoibat($params) {
        $this->load->model("tintuc_model");
        $id = $params[0];
        $this->tintuc_model->update(array("date" => time()), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    function removenoibat($params) {
        $this->load->model("tintuc_model");
        $id = $params[0];
        $this->tintuc_model->where(array('is_highlight' => 1, 'id' => $id))->update(array("deleted" => 1));
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * Tin Tuc noi bo
     */

    public function quanlynoibo() {
        $this->data['menu_active'] = "noibo";
        $this->load->model("tintuc_model");
        $this->data['arr_tin'] = $this->tintuc_model->where(array('deleted' => 0, 'is_private' => 1))->order_by('date', "DESC")->with_hinhanh()->as_object()->get_all();
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function themnoibo() { ////////// Trang dang tin
        if (isset($_POST['dangtin'])) {
            $this->load->model("tintuc_model");
            $this->load->model("tintucfile_model");
            $this->load->model("hinhanh_model");
            $data = $_POST;
            $data['id_user'] = $this->session->userdata('user_id');
            $data['active'] = 1;
            $data['is_private'] = 1;
            $data['date'] = time();
            $data_up = $this->tintuc_model->create_object($data);
            $id_tintuc = $this->tintuc_model->insert($data_up);
            $files = $this->input->post('id_files');
//            $this->tintucfile_model->where('id_tintuc', $id_tintuc)->update(array('deleted' => 0));
            if (count($files) > 0) {
                foreach ($files as $file) {
                    $this->tintucfile_model->insert(array('id_tintuc' => $id_tintuc, 'id_file' => $file));
                    $this->hinhanh_model->update(array('deleted' => 0), $file);
                }
            }
            redirect('admin/quanlynoibo', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            load_inputfile($this->data);
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    public function editnoibo($param) { ////////// Trang dang tin
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $this->load->model("tintuc_model");
            $this->load->model("tintucfile_model");
            $this->load->model("hinhanh_model");
            $data = $_POST;
            $data['id_user'] = $this->session->userdata('user_id');
            $data['active'] = 1;
            $data['is_private'] = 1;
            $data_up = $this->tintuc_model->create_object($data);
            $this->tintuc_model->update($data_up, $id);
            $files = $this->input->post('id_files');
            $this->tintucfile_model->where('id_tintuc', $id)->delete();
            if (count($files) > 0) {
                foreach ($files as $file) {
                    $this->tintucfile_model->insert(array('id_tintuc' => $id, 'id_file' => $file));
                    $this->hinhanh_model->update(array('deleted' => 0), $file);
                }
            }
            redirect('admin/quanlynoibo', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->load->model("tintuc_model");
            $tin = $this->tintuc_model->with_hinhanh()->with_files()->where(array('id' => $id))->as_object()->get();
//            echo "<pre>";
//            print_r($tin);
//            die();
            $this->data['tin'] = $tin;
            load_inputfile($this->data);
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function updatenoibo($params) {
        $this->load->model("tintuc_model");
        $id = $params[0];
        $this->tintuc_model->update(array("date" => time()), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    function removenoibo($params) {
        $this->load->model("tintuc_model");
        $id = $params[0];
        $this->tintuc_model->where(array('is_private' => 1, 'id' => $id))->update(array("deleted" => 1));
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    function viewtin($param) {
        $id = $param[0];
        $this->load->model("tintuc_model");
        $tin = $this->tintuc_model->where(array('id' => $id))->with_hinhanh()->with_files()->as_array()->get();
        $this->data['tin'] = $tin;
//        echo "<pre>";
//        print_r($tin);
//        die();
        array_push($this->data['stylesheet_tag'], base_url() . "public/admin/css/fileicon.css");
        array_push($this->data['stylesheet_tag'], base_url() . "public/lib/froala_editor/css/froala_style.min.css");
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

// deactivate the tin
    function deactivate_tintuc($params) {
        $this->load->model("tintuc_model");
        $id = $params[0];
        $this->tintuc_model->update(array("active" => 0), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * MENU
     */

    public function quanlymenu() {
        $this->load->model("pageweb_model");
        $this->load->model("menu_model");
        $this->data['menu_active'] = "menu";
        $all_menu = $this->menu_model->where("deleted", 0)->order_by("order")->as_object()->get_all();
//        $data = recursive_menu_data($all_menu, 0);
//        array_unshift($data, array('id' => 0, 'id_page' => 0, 'text' => "Trang chủ", 'expanded' => false, 'enabled' => false));
        $this->data['data'] = $all_menu;
//        $this->data['page'] = $this->pageweb_model->where("deleted", 0)->as_array()->get_all();
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    function editmenu($param) {
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $text_vi = $_POST['text_vi'];
            $text_en = isset($_POST['text_en']) ? $_POST['text_en'] : "";
            $text_jp = isset($_POST['text_jp']) ? $_POST['text_jp'] : "";
            $data_up = array(
                'text_vi' => $text_vi,
                'text_en' => $text_en,
                'text_jp' => $text_jp,
            );
            $this->load->model("menu_model");
            $this->menu_model->update($data_up, $id);
            redirect('admin/quanlymenu', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->data['menu_active'] = "menu";
            $this->load->model("menu_model");
            $tin = $this->menu_model->where(array('id' => $id))->as_array()->get_all();
            $this->data['tin'] = $tin[0];
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    /*
     * GOP Y
     */

    public function quanlycomment() {
        $this->load->model("comment_model");
        $this->data['menu_active'] = "comment";
        $all_menu = $this->comment_model->where("deleted", 0)->order_by("date", "DESC")->as_object()->get_all();
        $this->data['data'] = $all_menu;
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    /*
     * GOP ý khác
     */

    public function quanlyfeedback() {
        $this->load->model("feedback_model");
        $this->data['menu_active'] = "feedback";
        $all_menu = $this->feedback_model->where("deleted", 0)->with_product()->with_customer()->order_by("date", "DESC")->as_object()->get_all();
//        echo "<pre>";
//        print_r($all_menu);
//        die();
        $this->data['data'] = $all_menu;
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function editfeedback($param) { ////////// Trang dang tin
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $this->load->model("feedback_model");
            $data = $_POST;
            $data_up = $this->feedback_model->create_object($data);
            $this->feedback_model->update($data_up, $id);
            redirect('admin/quanlyfeedback', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->load->model("feedback_model");
            $tin = $this->feedback_model->with_product()->with_customer()->where(array('id' => $id))->as_object()->get();
//            echo "<pre>";
//            print_r($tin);
//            die();
            $this->load->model("customersimba_model");
            $this->load->model("productsimba_model");
            $this->data['customers'] = $this->customersimba_model->where(array('deleted' => 0))->as_array()->get_all();
            $this->data['products'] = $this->productsimba_model->as_array()->get_all();
            $this->data['tin'] = $tin;
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function removefeedback($params) {
        $this->load->model("feedback_model");
        $id = $params[0];
        $this->feedback_model->update(array("deleted" => 1), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * Logbook
     */

    public function quanlylogbook() {
        $this->load->model("logbook_model");
        $this->data['menu_active'] = "logbook";
        load_datatable($this->data);
        array_push($this->data['stylesheet_tag'], base_url() . "public/lib/froala_editor/froala_style.min.css");
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function editlogbook($param) { ////////// Trang dang tin
        $id = $param[0];
        if (isset($_POST['status'])) {
            $this->load->model("logbook_model");
            $data = $_POST;
            $data_up = $this->logbook_model->create_object($data);
            $this->logbook_model->update($data_up, $id);
            redirect('admin/quanlylogbook', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->load->model("logbook_model");
            $tin = $this->logbook_model->where(array('id' => $id))->with_customers()->with_products()->with_files()->as_object()->get();
            $this->data['customers'] = implode(",", array_keys((array) $tin->customers));
//            echo "<pre>";
//            print_r($tin);
//            die();
            $this->data['tin'] = $tin;

            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function removelogbook($params) {
        $this->load->model("logbook_model");
        $id = $params[0];
        $this->logbook_model->update(array("deleted" => 1), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * Ncc
     */

    public function quanlyncc() {
        $this->load->model("supplier_model");
        $this->data['menu_active'] = "supplier";
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function editncc($param) { ////////// Trang dang tin
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $this->load->model("feedback_model");
            $data = $_POST;
            $data_up = $this->feedback_model->create_object($data);
            $this->feedback_model->update($data_up, $id);
            redirect('admin/quanlyfeedback', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->load->model("feedback_model");
            $tin = $this->feedback_model->with_product()->with_customer()->where(array('id' => $id))->as_object()->get();
//            echo "<pre>";
//            print_r($tin);
//            die();
            $this->load->model("customersimba_model");
            $this->load->model("productsimba_model");
            $this->data['customers'] = $this->customersimba_model->where(array('deleted' => 0))->as_array()->get_all();
            $this->data['products'] = $this->productsimba_model->as_array()->get_all();
            $this->data['tin'] = $tin;
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function removencc($params) {
        $this->load->model("supplier_model");
        $id = $params[0];
        $this->supplier_model->update(array("deleted" => 1), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * Role
     */

    public function quanlyrole() {
        $this->data['menu_active'] = "role";
        $this->load->model("role_model");
//        $this->data['arr_tin'] = $this->role_model->where(array('deleted' => 0))->as_object()->get_all();

        $category = $this->role_model->where(array('deleted' => 0))->order_by('sort', "ASC")->as_array()->get_all();
        $this->data['html_nestable'] = html_nestable($category, 'parent_id', 0);
//        load_datatable($this->data);
        array_push($this->data['javascript_tag'], base_url() . "public/admin/plugins/jquery/jquery-ui.min.js");
        load_sort_nest($this->data);

        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function themrole() { ////////// Trang dang tin
        if (isset($_POST['dangtin'])) {
            $this->load->model("role_model");
            $this->load->model("rolepermission_model");
            $data = $_POST;
            $data_up = $this->role_model->create_object($data);
            $id = $this->role_model->insert($data_up);
            if (isset($_POST['permission'])) {
                $permission = $_POST['permission'];
//            $this->rolepermission_model->where('id_role', $id)->delete();
                foreach ($permission as $row) {
                    $this->rolepermission_model->insert(array('id_role' => $id, 'id_permission' => $row));
                }
            }
            redirect('admin/quanlyrole', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
//            load_inputfile($this->data);
//            load_editor($this->data);
            $this->load->model("permission_model");
            $permission = $this->permission_model->where(array('deleted' => 0))->group_by("module")->as_array()->get_all();
            foreach ($permission as &$row) {
                $row['child'] = $this->permission_model->where(array('module' => $row['module'], 'deleted' => 0))->as_array()->get_all();
            }
            $this->data['permission'] = $permission;
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    public function editrole($param) { ////////// Trang dang tin
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $this->load->model("role_model");
            $this->load->model("rolepermission_model");
            $data = $_POST;
            $data_up = $this->role_model->create_object($data);
            $this->role_model->update($data_up, $id);
            if (isset($_POST['permission'])) {
                $permission = $_POST['permission'];
                $this->rolepermission_model->where('id_role', $id)->delete();
                foreach ($permission as $row) {
                    $this->rolepermission_model->insert(array('id_role' => $id, 'id_permission' => $row));
                }
            }
            redirect('admin/quanlyrole', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->load->model("role_model");
            $this->load->model("permission_model");
            $tin = $this->role_model->where(array('id' => $id))->with_permission()->as_array()->get();
//            echo "<pre>";
//            print_r($tin);
//            die();
            $this->data['tin'] = $tin;
            $permission = $this->permission_model->where(array('deleted' => 0))->group_by("module")->as_array()->get_all();
            foreach ($permission as &$row) {
                $row['child'] = $this->permission_model->where(array('module' => $row['module'], 'deleted' => 0))->as_array()->get_all();
            }
            $this->data['permission'] = $permission;
//            echo "<pre>";
//            print_r($permission);
//            die();
//            load_inputfile($this->data);
//            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    function removerole($params) {
        $this->load->model("role_model");
        $id = $params[0];
        $this->role_model->update(array("deleted" => 1), $id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    /*
     * USER
     */

    public function quanlyuser() {
        $this->data['menu_active'] = "user";
//        $this->load->model("user_model");
//        $this->data['arr_tin'] = $this->user_model->limit(10)->with_role_user()->as_object()->get_all();
//        echo "<pre>";
//        print_r($this->data['arr_tin']);
//        die();
        load_datatable($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function themuser() {
        if (isset($_POST['dangtin'])) {
            $this->load->model("user_model");
            $data = $_POST;
            $data['password'] = md5(123456);
            $data_up = $this->user_model->create_object($data);
            $id_tintuc = $this->user_model->insert($data_up);
            redirect('admin/quanlyuser', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->load->model("role_model");
            $this->data['role'] = $this->role_model->as_array()->get_all();
            load_inputfile($this->data);
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    public function edituser($param) { ////////// Trang dang tin
        $id = $param[0];
        if (isset($_POST['dangtin'])) {
            $this->load->model("user_model");
            $data = $_POST;
            $data_up = $this->user_model->create_object($data);
            $id_tintuc = $this->user_model->update($data_up, $id);
            redirect('admin/quanlyuser', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
        } else {
            $this->load->model("user_model");
            $tin = $this->user_model->where(array('id' => $id))->as_object()->get();
//            echo "<pre>";
//            print_r($tin);
//            die();
            $this->load->model("role_model");
            $this->data['role'] = $this->role_model->as_array()->get_all();
            $this->data['tin'] = $tin;
            load_inputfile($this->data);
            load_editor($this->data);
            echo $this->blade->view()->make('page/page', $this->data)->render();
        }
    }

    /*
     * TABLE USER
     */

    function tableuser() {
        $this->load->model("user_model");
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $page = ($start / $limit) + 1;
        $where = $this->user_model;

        $totalData = $where->count_rows();
        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
//            $max_page = ceil($totalFiltered / $limit);

            $where = $this->user_model;
        } else {
            $search = $this->input->post('search')['value'];
            $where = $this->user_model->where("username like '%" . $search . "%'", NULL, NULL, FALSE, FALSE, TRUE);
            $totalFiltered = $where->count_rows();
            $where = $this->user_model->where("username like '%" . $search . "%'", NULL, NULL, FALSE, FALSE, TRUE);
        }

        $posts = $where->order_by("id", "DESC")->with_role_user()->paginate($limit, NULL, $page);
//        echo "<pre>";
//        print_r($posts);
//        die();
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {

                $nestedData['username'] = $post->username;
                $nestedData['role_name'] = $post->role_user->name;
                $nestedData['active'] = $post->active ? "Có" : "Không";
                $nestedData['action'] = '<a href="' . base_url() . 'admin/edituser/' . $post->id . '" class="btn btn-default" title="edit">'
                        . '<i class="ace-icon fa fa-pencil bigger-120">'
                        . '</i>'
                        . '</a>'
                        . '<a href="' . base_url() . 'admin/removeuser/' . $post->id . '" class="btn btn-default" data-type="confirm" title="remove">'
                        . '<i class="ace-icon fa fa-trash-o bigger-120">'
                        . '</i>'
                        . '</a>';

                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

    /*
     * TABLE Product
     */

    function tableproduct() {
        $this->load->model("product_model");
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $page = ($start / $limit) + 1;
        $where = $this->product_model->where("deleted", 0);

        $totalData = $where->count_rows();
        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
//            $max_page = ceil($totalFiltered / $limit);

            $where = $this->product_model->where("deleted", 0);
        } else {
            $search = $this->input->post('search')['value'];
            $where = $this->product_model->where("deleted = 0 AND name_vi like '%" . $search . "%'", NULL, NULL, FALSE, FALSE, TRUE);
            $totalFiltered = $where->count_rows();
            $where = $this->product_model->where("deleted = 0 and name_vi like '%" . $search . "%'", NULL, NULL, FALSE, FALSE, TRUE);
        }

        $posts = $where->order_by("date", "DESC")->with_hinhanh()->paginate($limit, NULL, $page);
//        echo "<pre>";
//        print_r($posts);
//        die();
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {

                $nestedData['id'] = $post->id;
                $nestedData['hinhanh'] = "<img src='" . base_url() . (isset($post->hinhanh->thumb_src) ? $post->hinhanh->thumb_src : 'public/img/preview.png') . "' width='50'/>";
                $nestedData['name'] = $post->name_vi;
                $action = "";
                if (is_permission("editproduct")) {
                    $action .= '<a href="' . base_url() . 'admin/updateproduct/' . $post->id . '" class="btn btn-default" title="update">
                                    <i class="fa fa-star">
                                    </i>
                                </a>
                                <a href="' . base_url() . 'admin/editproduct/' . $post->id . '" class="btn btn-default" title="edit">'
                            . '<i class="ace-icon fa fa-pencil bigger-120">'
                            . '</i>'
                            . '</a>';
                }
                if (is_permission("removeproduct")) {
                    $action .= '<a href="' . base_url() . 'admin/removeproduct/' . $post->id . '" class="btn btn-default" data-type="confirm" title="remove">'
                            . '<i class="ace-icon fa fa-trash-o bigger-120">'
                            . '</i>'
                            . '</a>';
                }
                $nestedData['action'] = $action;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

    /*
     * TABLE Logbook
     */

    function tablelogbook() {
        $this->load->model("logbook_model");
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $page = ($start / $limit) + 1;
        $where = $this->logbook_model->where("deleted", 0);

        $totalData = $where->count_rows();
        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
//            $max_page = ceil($totalFiltered / $limit);

            $where = $this->logbook_model->where("deleted", 0);
        } else {
            $search = $this->input->post('search')['value'];
            $sql_where = "deleted = 0 AND (ncc like '%" . $search . "%' OR content like '%" . $search . "%')";
            $where = $this->logbook_model->where($sql_where, NULL, NULL, FALSE, FALSE, TRUE);
            $totalFiltered = $where->count_rows();
            $where = $this->logbook_model->where($sql_where, NULL, NULL, FALSE, FALSE, TRUE);
        }

        $posts = $where->with_customers()->with_products()->order_by("date", "DESC")->paginate($limit, NULL, $page);
//        echo "<pre>";
//        print_r($posts);f
//        die();
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $products = $customers = array();
                if (isset($post->products)) {
                    foreach ($post->products as $row) {
                        array_push($products, "- $row->code - $row->name_vi");
                    }
                }
                if (isset($post->customers)) {
                    foreach ($post->customers as $row) {
                        array_push($customers, "- $row->code - $row->short_name");
                    }
                }
                $nestedData['id'] = $post->id;
                $nestedData['ncc'] = $post->ncc;
                $nestedData['customers'] = implode("<br>", $customers) . "<br>$post->new_customer";
                $nestedData['products'] = implode("<br>", $products) . "<br>$post->new_product";
                $nestedData['content'] = "<div class='fr-view'>$post->content</div>";
                $nestedData['date'] = date("Y-m-d", $post->date);
                $nestedData['stauts'] = $post->status == 1 ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>';
                $action = "";
                if (is_permission("editfeedback")) {
                    $action .= '<a href="' . base_url() . 'admin/editlogbook/' . $post->id . '" class="btn btn-default" title="edit">'
                            . '<i class="ace-icon fa fa-pencil bigger-120">'
                            . '</i>'
                            . '</a>';
                }
                if (is_permission("removefeedback")) {
                    $action .= '<a href="' . base_url() . 'admin/removelogbook/' . $post->id . '" class="btn btn-default" data-type="confirm" title="remove">'
                            . '<i class="ace-icon fa fa-trash-o bigger-120">'
                            . '</i>'
                            . '</a>';
                }
                $nestedData['action'] = $action;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

    /*
     * TABLE Nhà cung cấp
     */

    function tablencc() {
        $this->load->model("supplier_model");
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $page = ($start / $limit) + 1;
        $where = $this->supplier_model->where("deleted", 0);

        $totalData = $where->count_rows();
        $totalFiltered = $totalData;

        if (empty($this->input->post('search')['value'])) {
//            $max_page = ceil($totalFiltered / $limit);

            $where = $this->supplier_model->where("deleted", 0);
        } else {
            $search = $this->input->post('search')['value'];
            $sql_where = "deleted = 0 AND (code like '%" . $search . "%' OR name like '%" . $search . "%')";
            $where = $this->supplier_model->where($sql_where, NULL, NULL, FALSE, FALSE, TRUE);
            $totalFiltered = $where->count_rows();
            $where = $this->supplier_model->where($sql_where, NULL, NULL, FALSE, FALSE, TRUE);
        }

        $posts = $where->supplier_model->order_by("id", "DESC")->paginate($limit, NULL, $page);
//        echo "<pre>";
//        print_r($posts);f
//        die();
        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $nestedData['id'] = $post->id;
                $nestedData['code'] = $post->code;
                $nestedData['name'] = $post->name;
                $nestedData['address'] = $post->address;
                $nestedData['phone'] = $post->phone;
                $nestedData['fax'] = $post->fax;
                $nestedData['email'] = $post->email;
                $nestedData['note'] = $post->note;
                $action = "";
                if (is_permission("editfeedback")) {
                    $action .= '<a href="' . base_url() . 'admin/editncc/' . $post->id . '" class="btn btn-default" title="edit">'
                            . '<i class="ace-icon fa fa-pencil bigger-120">'
                            . '</i>'
                            . '</a>';
                }
                if (is_permission("removefeedback")) {
                    $action .= '<a href="' . base_url() . 'admin/removencc/' . $post->id . '" class="btn btn-default" data-type="confirm" title="remove">'
                            . '<i class="ace-icon fa fa-trash-o bigger-120">'
                            . '</i>'
                            . '</a>';
                }
                $nestedData['action'] = $action;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
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
        $ext = pathinfo($files['file']['name'], PATHINFO_EXTENSION);
        $_FILES['file']['name'] = time() . "." . $ext;
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
                    'type' => $info->type,
                    'size' => $info->size,
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
            $ext = pathinfo($_FILES['hinhanh']['name'][$i], PATHINFO_EXTENSION);
            $_FILES['hinhanh']['name'] = time() . "_" . $i . "." . $ext;
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
                        'type' => $info->type,
                        'size' => $info->size,
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

    public function uploadfile() {
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
        $config['allowed_types'] = '*';
        $config['max_size'] = 20 * 1024;
        $this->load->library('upload', $config);
        $files = $_FILES;

        $file_count = count($_FILES['file_up']['name']);
//        echo "<pre>";
//        print_r($_FILES['file_up']);
//        die();
        for ($i = 0; $i < $file_count; $i++) {

            $ext = pathinfo($_FILES['file_up']['name'][$i], PATHINFO_EXTENSION);
            $_FILES['file_up']['name'] = time() . "_" . $i . "." . $ext;
            $_FILES['file_up']['type'] = $files['file_up']['type'][$i];
            $_FILES['file_up']['tmp_name'] = $files['file_up']['tmp_name'][$i];
            $_FILES['file_up']['error'] = $files['file_up']['error'][$i];
            $_FILES['file_up']['size'] = $files['file_up']['size'][$i];
            $real_name = $files['file_up']['name'][$i];
            if (!$this->upload->do_upload('file_up')) {
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
                ////////////
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
                    'type' => $info->type,
                    'size' => $info->size,
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

    public function checkusername() {
        $username = $this->input->get('username');
        $this->load->model("user_model");
        $check = $this->user_model->where(array("username" => $username))->as_array()->get_all();
        if (!$check) {
            echo json_encode(array('success' => 1));
        } else {
            echo json_encode(array('success' => 0, 'msg' => "Tài khoản đã tồn tại!"));
        }
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

//    public function renameimage() {//gets the job done but you might want to add error checking and security
////        echo 1;die();
//        error_reporting(1);
//        error_reporting('On');
//        $this->load->model('hinhanh_model');
//        $files = $this->hinhanh_model->as_array()->get_all();
//        $success = 0;
//        if (!file_exists("public/uploads/2018-08-01/")) {
//            mkdir("public/uploads/2018-08-01/", 0777, true);
//        }
//        foreach ($files as $file) {
//            $ext = pathinfo($file['ten_hinhanh'], PATHINFO_EXTENSION);
//            $id = $file['id_hinhanh'];
//            $data = array();
//            $date = date("Y-m-d", strtotime($file['date']));
////            print_r($file);
////            die();
////            $success
//            if ($file['src'] != "" && file_exists(FCPATH . "public/uploads/$date/" . $file['ten_hinhanh'])) {
//                $name = "public/uploads/2018-08-01/$id.$ext";
//                $success = copy("public/uploads/$date/" . $file['ten_hinhanh'], FCPATH . $name);
//                $data['src'] = $name;
//            }
//            if (count($data))
//                $this->hinhanh_model->update($data, $id);
//        }

    function _load_language() {
        $translations = array();
        $arrray_lang = $this->config->item("language_list");
        foreach ($arrray_lang as $k => $row) {
            $path = APPPATH . "language/" . $k . "/home_lang.php";
//            echo $path;
            $masterModule = $this->_load_module($path);
            foreach ($masterModule as $lineNumber => $line) {
                // Extract each key and value
                if ($this->_is_lang_key($line)) {
                    $key = $this->_get_lang_key($line);
                    $translations[$key][$k] = $this->_get_lang($line);
                }
            }
        }
        return $translations;
    }

    function _load_module($modulePath) {

        /* TODO: Add error checking for non-existent files? */

        $module = @file($modulePath);

        return $module;
    }

    /**
     * Determine if a line of PHP code contains a translation key
     *
     * @param $line string
     * @return boolean
     */
    function _is_lang_key($line) {
        $line = trim($line);
        if (empty($line) || mb_stripos($line, '$lang[') === FALSE) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Extract translation key from a line of PHP code
     *
     * @param $line string
     * @return string
     */
    function _get_lang_key($line) {
        // Trim forward to the first quote mark
        $line = trim(mb_substr($line, mb_strpos($line, '[') + 1));
        // Trim forward to the second quote mark
        $line = trim(mb_substr($line, 0, mb_strpos($line, ']')));
        return mb_substr($line, 1, mb_strlen($line) - 2);
    }

    /**
     * Extract translation string from a line of PHP code
     *
     * @param $line string
     * @return string
     */
    function _get_lang($line) {

        /* Agricultural solution */
        // Trim forward to the first quote mark
        $line = trim(mb_substr($line, strpos($line, '=') + 1));
        // Trim backward from the semi-colon
        $line = mb_substr($line, 0, mb_strrpos($line, ';'));
        $line = trim($line, '\'"');
        /* TODO - This is no good if the string is a PHP expression e.g. 'Hello, ' + CONST + ' how\'s your world?'
          // Trim any encapsulating quote marks
          $line = trim( $line, '\'"' );
         */

        /* Regex based solution ?
          $pattern = '/[^=]*=\s*[\'"]?(.*)[\'"]?;$/';
          $pattern = '/[^=]*=\s*[\'"]?(.*);$/';
          preg_match($pattern, $line, $matches);
          $line = $matches[ 1 ];

          $pattern = '/^[\'"]?(.*)[\'"]{1}$/';
          preg_match($pattern, $line, $matches);
          if ( count( $matches ) >= 1 ) {
          $line = $matches[ 1 ];
          }
         */

        return $this->_escape_templates($line);
    }

    /**
     * Escape template tags
     *
     * @return string
     */
    function _escape_templates($line) {
        return preg_replace('/{(.*)}/', '\\{$1\\}', $line);
    }

    /**
     * Unescape template tags
     *
     * @return string
     */
    function _unescape_templates($line) {
        return preg_replace('/\\\{(.*)\\\}/', '{$1}', $line);
    }

    /**
     * Check PHP syntax
     *
     * Returns FALSE if no errors found otherwise returns the line number of the
     * error with the error message and bad code in variables passed by reference
     *
     * @param $php string
     * @return int
     */
    function _invalid_php_syntax($php, &$err = '', &$bad_code = '') {

        // Remove opening and closing PHP tags
        $php = str_replace('<?php', '', $php);
        $php = str_replace('?>', '', $php);

        // Evaluate the code
        ob_start();
        eval($php);
        $err = ob_get_contents();
        ob_end_clean();

        if (!empty($err)) {
            if (mb_stripos($err, 'Parse error') == FALSE) {
                return FALSE;
            }
        }
        // Remove any html tags returned in error message
        $err_text = strip_tags($err);

        // Get the line number
        $line = (int) trim(substr($err_text, strripos($err_text, ' ')));

        $php = explode("\n", $php);

        $bad_code = $php[max(0, $line - 1)];

        return $line;
    }

}
