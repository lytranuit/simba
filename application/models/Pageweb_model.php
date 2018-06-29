<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PageWeb_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_page_web';
        $this->primary_key = 'id';
        parent::__construct();
    }

    function create_object($data) {
        $array = array(
            'title_vi', 'content_vi', 'title_en', 'content_en', 'title_jp', 'content_jp', 'id_user', 'active'
        );
        $obj = array();
        foreach ($array as $key) {
            if (isset($data[$key])) {
                $obj[$key] = $data[$key];
            } else
                continue;
        }

        return $obj;
    }

}
