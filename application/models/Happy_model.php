<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Happy_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_happy_client';
        $this->primary_key = 'id';
        $this->has_one['hinhanh'] = array('foreign_model' => 'Hinhanh_model', 'foreign_table' => 'tbl_hinhanh', 'foreign_key' => 'id_hinhanh', 'local_key' => 'id_hinhanh');
        parent::__construct();
    }

    function create_object($data) {
        $array = array(
            'id_hinhanh', 'name', 'position', 'comment', 'order', 'active'
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
