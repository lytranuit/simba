<?php

class Index extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        ////////////////////////////////
        ////////////
        $this->data['is_login'] = $this->user_model->logged_in();
        $this->data['userdata'] = $this->session->userdata();
        $version = $this->config->item("version");
        $this->data['stylesheet_tag'] = array(
            'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700',
            base_url() . 'public/lib/bootstrap/css/bootstrap.min.css',
            base_url() . 'public/lib/font-awesome/css/font-awesome.min.css',
            base_url() . 'public/lib/animate/animate.min.css',
            base_url() . 'public/lib/ionicons/css/ionicons.min.css',
            base_url() . 'public/lib/owlcarousel/assets/owl.carousel.min.css',
            base_url() . 'public/lib/fancybox/jquery.fancybox.min.css',
            base_url() . 'public/lib/froala_editor/froala_style.min.css',
            base_url() . "public/admin/plugins/chosen/chosen.min.css",
            base_url() . 'public/css/style.css?v=' . $version,
        );

        $this->data['javascript_tag'] = array(
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
            base_url() . 'public/lib/fancybox/jquery.fancybox.min.js',
            base_url() . 'public/lib/touchSwipe/jquery.touchSwipe.min.js',
            base_url() . "public/admin/plugins/chosen/chosen.jquery.js",
            base_url() . "public/lib/ajaxchosen/chosen.ajaxaddition.jquery.js",
            base_url() . 'public/js/main.js?v=' . $version,
        );
    }

    public function _remap($method, $params = array())
    {
        if (!method_exists($this, $method)) {
            show_404();
        }
        $this->$method($params);
    }

    public function listall()
    {
        //echo __DIR__;
        $dirmodule = APPPATH . 'modules/';
        $dir = APPPATH . 'controllers/';
        $this->load->library('directoryinfo');
        $sortedarray1 = $this->directoryinfo->readDirectory($dir, true);
        $sortedarray2 = $this->directoryinfo->readDirectory($dirmodule, true);
        $arr = array_merge(array($sortedarray1), $sortedarray2);
    }

    public function page_404()
    {
        echo $this->blade->view()->make('page/404-page', $this->data)->render();
    }

    public function cronjonsendmail()
    {
        $this->load->model("logbook_model");
        $this->load->model("option_model");
        $logbooks = $this->logbook_model->where(array("is_sent" => 0))->with_author()->with_customers()->with_products()->with_nccObject()->with_files()->as_object()->get_all();
        if (!empty($logbooks)) {
            $conf = $this->option_model->get_setting_mail_report();
            $config = array(
                'mailtype' => 'html',
                'protocol' => "smtp",
                'smtp_host' => $conf['email_server'],
                'smtp_user' => $conf['email_username'], // actual values different
                'smtp_pass' => $conf['email_password'],
                'smtp_crypto' => $conf['email_security'],
                'wordwrap' => TRUE,
                'smtp_port' => $conf['email_port'],
                'newline' => "\r\n",
                'crlf' => "\r\n",
            );
            $this->load->library("email", $config);
            foreach ($logbooks as $logbook) {
                $email_to = explode(",", $logbook->email_send);
                if (empty($email_to)) {
                    continue;
                }

                $products = $customers = array();
                if (isset($logbook->products)) {
                    foreach ($logbook->products as $row) {
                        array_push($products, "- $row->code - $row->name_vi");
                    }
                }
                if (isset($logbook->customers)) {
                    foreach ($logbook->customers as $row) {
                        array_push($customers, "- $row->code - $row->short_name");
                    }
                }
                $fullname = $logbook->author->fullname;
                //            /*
                //             * Send mail
                //             */
                //            $this->email->clear();
                //            print_r($email_to);
                //            die();

                $this->email->clear(TRUE);
                $this->email->from($conf['email_email'], $conf['email_name']);
                $this->email->to($email_to); /// $conf['email_contact']
                $this->email->subject("$fullname - Báo cáo - $logbook->subject - " . date("Y/m/d", $logbook->date));
                $html = "";
                $ncc = $logbook->ncc;
                if (isset($logbook->nccObject)) {
                    $ncc = $logbook->nccObject->code . "-" . $logbook->nccObject->short_name . $logbook->ncc;
                }
                $this->data['ncc'] = $ncc;
                $this->data['nhansu'] = $logbook->nhansu;
                $this->data['nhansukhac'] = $logbook->nhansukhac;
                $this->data['new_customer'] = $logbook->new_customer;
                $this->data['new_product'] = $logbook->new_product;
                $this->data['listcustomer'] = implode("<br>", $customers);
                $this->data['listproduct'] = implode("<br>", $products);
                $this->data['date'] = date("Y-m-d H:i:s", $logbook->date);
                $this->data['date_end'] = date("Y-m-d H:i:s", $logbook->date_end);
                $this->data['email_send'] = $logbook->email_send;
                $this->data['content'] = $logbook->content;
                $this->data['note'] = $logbook->note;
                $this->data['search'] = $logbook->search;
                $html = $this->blade->view()->make('email/baocao', $this->data)->render();

                // $file_log = './log_' . $logbook->id . '.log';
                // file_put_contents($file_log, $html, FILE_APPEND);
                // // print_r($html);
                // die();
                $this->email->message($html);
                if (!empty($logbook->files)) {
                    foreach ($logbook->files as $row) {
                        $this->email->attach(base_url() . $row->src);
                    }
                }


                if ($this->email->send()) {
                    //                echo json_encode(array('code' => 400, 'msg' => lang('alert_400')));

                    $this->logbook_model->update(array("is_sent" => 1), $logbook->id);
                } else {
                    $file_log = './log_' . $logbook->id . '.log';
                    file_put_contents($file_log, $this->email->print_debugger(), FILE_APPEND);
                }
            }
        }
        /*
         * Quote
         */

        $this->load->model("supplierproduct_model");
        $quotes = $this->supplierproduct_model->where(array("is_sent" => 0))->with_supplier()->with_files()->as_object()->get_all();
        if (!empty($quotes)) {
            $conf = $this->option_model->get_setting_mail_quote();
            $config = array(
                'mailtype' => 'html',
                'protocol' => "smtp",
                'smtp_host' => $conf['email_server'],
                'smtp_user' => $conf['email_username'], // actual values different
                'smtp_pass' => $conf['email_password'],
                'smtp_crypto' => $conf['email_security'],
                'wordwrap' => TRUE,
                'smtp_port' => $conf['email_port'],
                'starttls' => true,
                'newline' => "\r\n",
                'crlf' => "\r\n",
            );
            $this->load->library("email", $config);
            foreach ($quotes as $quote) {

                //            /*
                //             * Send mail
                //             */
                //            $this->email->clear();
                //            print_r($email_to);
                //            die();

                $this->email->clear(TRUE);
                $this->email->CharSet = "UTF-8";
                $this->email->from($conf['email_email'], $conf['email_name']);
                $this->email->to($conf['email_contact']); /// $conf['email_contact']
                $this->email->subject("Báo giá Online - " . date("Y/m/d"));
                $html = "";
                $this->data['row'] = $quote;
                $html = $this->blade->view()->make('email/baogia', $this->data)->render();
                $this->email->message($html);
                if (!empty($quote->files)) {
                    foreach ($quote->files as $row) {
                        $this->email->attach(base_url() . $row->src);
                    }
                }


                $this->supplierproduct_model->update(array("is_sent" => 1), $quote->id);
                if ($this->email->send()) {
                    //                echo json_encode(array('code' => 400, 'msg' => lang('alert_400')));
                } else {
                    $file_log = './log_' . $quote->id . '.log';
                    file_put_contents($file_log, $this->email->print_debugger(), FILE_APPEND);
                }
            }
        }
        echo 1;
    }

    public function formlogbook()
    {
        $this->load->model("logbook_model");
        $this->load->model("logbookcustomer_model");
        $this->load->model("logbookproduct_model");
        $this->load->model("option_model");

        $this->load->model("user_model");
        // check to see if the user is logging in
        $role_feedback = $this->user_model->role_permission(29);
        $role_user = $this->session->userdata('role');
        if (!$this->user_model->logged_in() || ($role_user != "1" && !in_array($role_user, $role_feedback))) {
            echo "<p>" . lang('alert_407') . " <a href='" . base_url() . "'>" . lang('Home') . "</a>";
            die();
        }

        $this->load->model("role_model");
        $this->data['roles'] = $this->role_model->where(array("deleted" => 0, 'filter' => 1))->as_object()->get_all();
        $this->load->model("ncc_model");
        $this->data['ncc'] = $this->ncc_model->where(array("deleted" => 0))->as_object()->get_all();
        array_push($this->data['stylesheet_tag'], base_url() . "public/lib/jqueryui/jquery-ui.css");
        array_push($this->data['stylesheet_tag'], base_url() . "public/lib/pickadate/themes/default.css");
        array_push($this->data['stylesheet_tag'], base_url() . "public/lib/pickadate/themes/default.date.css");
        array_push($this->data['stylesheet_tag'], base_url() . "public/lib/pickadate/themes/default.time.css");
        array_push($this->data['stylesheet_tag'], base_url() . "public/lib/tag-it/css/jquery.tagit.css");

        array_push($this->data['javascript_tag'], base_url() . "public/lib/jqueryui/jquery-ui.js");
        array_push($this->data['javascript_tag'], base_url() . "public/admin/plugins/jquery-inputmask/jquery.inputmask.bundle.js");
        array_push($this->data['javascript_tag'], base_url() . "public/lib/pickadate/picker.js");
        array_push($this->data['javascript_tag'], base_url() . "public/lib/pickadate/picker.date.js");
        array_push($this->data['javascript_tag'], base_url() . "public/lib/pickadate/picker.time.js");
        array_push($this->data['javascript_tag'], base_url() . "public/lib/pickadate/legacy.js");
        array_push($this->data['javascript_tag'], base_url() . "public/lib/tag-it/js/tag-it.js");
        $this->data['template'] = 'page';

        load_editor($this->data);
        load_inputfile($this->data);
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function formquote()
    {
        $this->load->model("option_model");
        //        $this->load->library("recaptcha");
        $this->load->model("user_model");
        array_push($this->data['stylesheet_tag'], base_url() . "public/lib/pickadate/themes/default.css");
        array_push($this->data['stylesheet_tag'], base_url() . "public/lib/pickadate/themes/default.date.css");
        array_push($this->data['stylesheet_tag'], base_url() . "public/lib/pickadate/themes/default.time.css");

        array_push($this->data['javascript_tag'], base_url() . "public/admin/plugins/jquery-inputmask/jquery.inputmask.bundle.js");
        array_push($this->data['javascript_tag'], base_url() . "public/lib/pickadate/picker.js");
        array_push($this->data['javascript_tag'], base_url() . "public/lib/pickadate/picker.date.js");
        array_push($this->data['javascript_tag'], base_url() . "public/lib/pickadate/picker.time.js");
        array_push($this->data['javascript_tag'], base_url() . "public/lib/pickadate/legacy.js");
        $this->data['template'] = 'page';

        load_editor($this->data);
        load_inputfile($this->data);

        $hl = short_language_current();
        $hl = $hl == "jp" ? "ja" : $hl;
        $this->data['captcha'] = $this->recaptcha->getWidget(array('style' => 'transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;display:inline-block;vertical-align:middle;'));
        $this->data['scriptCap'] = $this->recaptcha->getScriptTag(array('hl' => $hl));
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function delete_img()
    {
        $this->load->model("hinhanh_model");
        $hinh = $this->hinhanh_model->hinhanh_sudung();
        $this->hinhanh_model->delete_img_not($hinh[0]['id']);
        echo "<pre>";
        print_r($hinh);
        die();
    }

    public function index()
    {
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    function gioithieu()
    {
        $this->load->model("option_model");
        $gioithieu = $this->option_model->where(array("name" => 'gioi-thieu'))->as_array()->get_all();
        $this->data['gioithieu'] = $gioithieu[0];
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function page($param)
    {
        $id = $param[0];
        $this->load->model("pageweb_model");
        $tin = $this->pageweb_model->where(array('id' => $id))->as_array()->get();
        $this->data['tin'] = $tin;
        $this->data['title'] = $tin[pick_language($tin, 'title_')];
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    function search()
    {
        $search = $this->input->get("q");
        $category = $this->input->get("category");
        $this->load->model("productsimba_model");
        $this->load->model("categorysimba_model");
        $category = $category != "" ? $category : 0;

        $sql_where = "status = 1 AND id NOT IN (SELECT product_id FROM product_private WHERE deleted = 0)";
        if ($search != "") {
            $short_language = short_language_current();
            $sql_where .= " AND (code like '%" .
                $this->db->escape_like_str($search) . "%' ESCAPE '!' OR  name_" . $short_language . " like '%" .
                $this->db->escape_like_str($search) . "%' ESCAPE '!' OR (name_vi like '%" .
                $this->db->escape_like_str($search) . "%' ESCAPE '!' AND name_" . $short_language . " IN(NULL,'')))";
        }
        if (!$this->data['is_login']) {
            $sql_where .= " AND require_year_old = 0";
        }
        if ($category > 0) {
            $category = $this->categorysimba_model->where('id', $category)->with_product()->as_array()->get();
            //            echo "<pre>";
            //            print_r($category);
            //            die();
            if (isset($category['product']) && count($category['product'])) {
                $array_product = array_keys($category['product']);
                $str_product = implode(",", $array_product);
                $sql_where .= " AND id IN ($str_product)";
            }
        }

        $data = $this->productsimba_model->where($sql_where, NULL, NULL, FALSE, FALSE, TRUE)->as_array()->get_all();
        $this->data['product'] = $data;
        //        echo "<pre>";
        //        print_r($data);
        //        die();
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    public function news($param)
    {
        $id = $param[0];
        $this->load->model("tintuc_model");
        $tin = $this->tintuc_model->where(array('id' => $id))->with_author()->with_hinhanh()->with_files()->as_object()->get();
        $tin = json_decode(json_encode($tin), true);
        $this->data['tin'] = $tin;
        $this->data['title'] = $tin[pick_language($tin, 'title_')];
        //        echo "<pre>";
        //        print_r($tin);
        //        die();
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    function category($param)
    {
        $id = $param[0];
        $this->load->model("category_model");
        $tin = $this->category_model->where(array('id' => $id))->with_hinhanh()->with_products()->as_object()->get();
        $tin = json_decode(json_encode($tin), true);
        //        print_r($tin['products']);
        //        die();
        $tin['products'] = isset($tin['products']) ? array_values($tin['products']) : array();
        //        echo "<pre>";
        //        print_r($tin);
        //        die();
        $this->data['tin'] = $tin;
        $this->data['title'] = $tin[pick_language($tin, 'name_')];
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    function product($param)
    {
        $id = $param[0];
        $this->load->model("product_model");
        $this->load->model("productsimba_model");
        $tin = $this->product_model->where(array('id' => $id))->with_hinhanh()->with_product()->with_files()->as_object()->get();
        $tin = json_decode(json_encode($tin), true);
        $tin['product']['country'] = $this->productsimba_model->xuatxu($tin['product']['origin_country_id']);
        $tin['product']['preservation'] = $this->productsimba_model->preservation($tin['product']['preservation_id']);
        $this->data['tin'] = $tin;
        $this->data['title'] = $tin[pick_language($tin, 'name_')];

        //        echo "<pre>";
        //        print_r($tin);
        //        die();
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    function productsimba($param)
    {
        $id = $param[0];
        $this->load->model("productsimba_model");
        $tin = $this->productsimba_model->where(array('id' => $id))->as_object()->get();
        $tin = json_decode(json_encode($tin), true);
        $tin['country'] = $this->productsimba_model->xuatxu($tin['origin_country_id']);
        $tin['preservation'] = $this->productsimba_model->preservation($tin['preservation_id']);
        $this->data['tin'] = $tin;
        $this->data['title'] = $tin[pick_language($tin, 'name_')];
        //        echo "<pre>";
        //        print_r($tin);
        //        die();
        echo $this->blade->view()->make('page/page', $this->data)->render();
    }

    // log the user out
    function logout()
    {

        $this->data['title'] = "Logout";

        // log the user out
        $logout = $this->user_model->logout();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function quanlypage()
    {
        //phpinfo();die();
        $this->data['template'] = "box";
        $arr_page = $this->page_model->where(array("deleted" => 0))->as_array()->get_all();
        $page_ava = array_map(function ($item) {
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

    public function success()
    {
        echo json_encode(1);
    }
}
