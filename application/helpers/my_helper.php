<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
if (!function_exists('config_item')) {

    function config_item($str)
    {
        $CI = &get_instance();
        $item = $CI->config->item($str);
        return $item;
    }
}
if (!function_exists('sluggable')) {

    function sluggable($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
}
if (!function_exists('get_url_seo')) {

    function get_url_seo($func, $param = array())
    {
        $url = $func;
        $CI = &get_instance();
        $CI->load->model('page_model');
        $CI->load->helper('url');
        $page = $CI->page_model->where(array("link" => $func, "deleted" => 0))->as_array()->get_all();
        if (count($page)) {
            $url = $page[0]['seo_url'] != "" ? $page[0]['seo_url'] : $url;
            $pos = 0;
            foreach ($param as $row) {
                if (strpos($url, "(:num)", $pos) !== FALSE) {
                    $pos = strpos($url, "(:num)", $pos);
                    $length = 6;
                } elseif (strpos($url, "(.*)", $pos)) {
                    $pos = strpos($url, "(.*)", $pos);
                    $length = 4;
                } else {
                    break;
                }
                $url = substr_replace($url, $row, $pos, $length);
            }
        }
        return base_url() . $url;
    }
}
if (!function_exists('get_url_page')) {

    function get_url_page($id)
    {
        $url = "";
        $CI = &get_instance();
        $CI->load->model('pageweb_model');
        $CI->load->helper('url');
        $page = $CI->pageweb_model->where(array("id" => $id))->as_array()->get_all();
        if (count($page)) {
            $url = $page[0]['alias'];
        }
        return base_url() . $url;
    }
}
if (!function_exists('language_current')) {

    function language_current()
    {
        $CI = &get_instance();
        $language_current = $CI->config->item('language');
        if (isset($_SESSION['language_current'])) {
            $language_current = $_SESSION['language_current'];
        }
        return $language_current;
    }
}

if (!function_exists('short_language_current')) {

    function short_language_current()
    {
        $CI = &get_instance();
        $language_current = $CI->config->item('language');
        $arr_lang = $CI->config->item('language_list');
        if (isset($_SESSION['language_current'])) {
            $language_current = $_SESSION['language_current'];
        }

        return $arr_lang[$language_current];
    }
}

if (!function_exists('pick_language')) {

    function pick_language($data, $struct = 'name_')
    {
        $CI = &get_instance();
        $short_lang = short_language_current();
        $data = (array) $data;
        if (isset($data[$struct . $short_lang]) && $data[$struct . $short_lang] != "") {
            return $struct . $short_lang;
        } else {
            return $struct . 'vi';
        }
    }
}

if (!function_exists('strtofloat')) {

    function strtofloat($str)
    {
        $str = str_replace(".", "", $str); // replace dots (thousand seps) with blancs 
        $str = str_replace(",", ".", $str); // replace ',' with '.'
        if (preg_match("#([0-9\.]+)#", $str, $match)) { // search for number that may contain '.' 
            return floatval($match[0]);
        } else {
            return floatval($str); // take some last chances with floatval 
        }
    }
}

if (!function_exists('is_permission')) {

    function is_permission($func)
    {
        $array_permission = $_SESSION['permission'];
        $role = $_SESSION['role'];
        if ($role == 1 || in_array($func, $array_permission)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('has_permission')) {

    function has_permission($func)
    {
        $CI = &get_instance();
        $CI->load->model('permission_model');
        $permission = $CI->permission_model->where(array("function" => $func, 'deleted' => 0))->as_array()->get_all();
        if (count($permission)) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('html_nestable')) {

    function html_nestable($array, $column, $parent)
    {
        $html = "";
        $return = array_filter($array, function ($item) use ($column, $parent) {
            return $item[$column] == $parent;
        });
        ///Bebin Tag
        if ($parent == 0) {
            $id_nestable = "id='nestable'";
        } else {
            $id_nestable = "";
        }
        $html .= '<ol class="dd-list" ' . $id_nestable . '>';
        ///Content
        foreach ($return as $row) {
            $btn_remove = "";
            if (!in_array($row['id'], array(1, 2, 3))) {
                $btn_remove = '<a class="btn btn-sm btn-default" href="' . base_url() . 'admin/removerole/' . $row['id'] . '" title="delete" data-type="confirm"><i class="fa fa-trash"></i></a>';
            }
            if ($row['email'] != "") {
                $row['email'] = " (" . $row['email'] . ")";
            }
            $html .= '<li class="dd-item" id="menuItem_' . $row['id'] . '" data-id="' . $row['id'] . '">
                            <div class="dd-handle"> <span class="drag-indicator"></span>
                                <div>' . $row['name'] . $row['email'] . '</div>
                                <div class="dd-nodrag btn-group pull-right">
                                    <a class="btn btn-sm btn-default" href="' . base_url() . 'admin/editrole/' . $row['id'] . '"><i class="fa fa-pencil"></i></a> 
                                    ' . $btn_remove . '    
                                </div>
                            </div>';
            $html .= html_nestable($array, $column, $row['id']);
            $html .= '</li>';
        }
        ///End Tag
        $html .= '</ol>';

        return $html;
    }
}

if (!function_exists('sendmaillogbok')) {
    function sendmaillogbok($id)
    {
        $CI = &get_instance();
        $CI->load->model('logbook_model');
        $CI->load->model('option_model');
        $logbook = $CI->logbook_model->where(array("id" => $id))->with_author()->with_customers()->with_products()->with_nccObject()->with_files()->as_object()->get();
        // print_r($logbook);
        // die();
        if (!empty($logbook)) {
            $conf = $CI->option_model->get_setting_mail_report();
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
            $email_to = explode(",", $logbook->email_send);
            if (empty($email_to)) {
                return False;
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

            $CI->load->library("email", $config);
            $CI->email->clear(TRUE);
            $CI->email->from($conf['email_email'], $conf['email_name']);
            $CI->email->to($email_to); /// $conf['email_contact']
            $CI->email->subject("$fullname - Báo cáo - $logbook->subject - " . date("Y/m/d", $logbook->date));
            $html = "";
            $ncc = $logbook->ncc;
            if (isset($logbook->nccObject)) {
                $ncc = $logbook->nccObject->code . "-" . $logbook->nccObject->short_name . $logbook->ncc;
            }
            $data['ncc'] = $ncc;
            $data['nhansu'] = $logbook->nhansu;
            $data['nhansukhac'] = $logbook->nhansukhac;
            $data['new_customer'] = $logbook->new_customer;
            $data['new_product'] = $logbook->new_product;
            $data['listcustomer'] = implode("<br>", $customers);
            $data['listproduct'] = implode("<br>", $products);
            $data['date'] = date("Y-m-d H:i:s", $logbook->date);
            $data['date_end'] = date("Y-m-d H:i:s", $logbook->date_end);
            $data['email_send'] = $logbook->email_send;
            $data['content'] = str_replace( "<!--[if !supportLineBreakNewLine]-->", "", $logbook->content );
            $data['note'] = $logbook->note;
            $data['search'] = $logbook->search;
            $html = $CI->blade->view()->make('email/baocao', $data)->render();

            // $file_log = './log_' . $logbook->id . '.log';
            // file_put_contents($file_log, $html, FILE_APPEND);
            // // print_r($html);
            // die();
            $CI->email->message($html);
            // echo "<pre>";
            // print_r($logbook->files);
            // die();
            if (!empty($logbook->files)) {
                foreach ($logbook->files as $row) {
                    $CI->email->attach(APPPATH . "../" . $row->src);
                }
            }

            // die();
            $CI->logbook_model->update(array("is_sent" => 1), $logbook->id);

            if ($CI->email->send()) {
                //                echo json_encode(array('code' => 400, 'msg' => lang('alert_400')));
            } else {
                $file_log = './log_' . $logbook->id . '.log';
                file_put_contents($file_log, $CI->email->print_debugger(), FILE_APPEND);
            }
        }
    }
}
