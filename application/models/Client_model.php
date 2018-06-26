<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_client';
        $this->primary_key = 'id';
        $this->has_one['hinhanh'] = array('foreign_model' => 'Hinhanh_model', 'foreign_table' => 'tbl_hinhanh', 'foreign_key' => 'id_hinhanh', 'local_key' => 'id_hinhanh');
        parent::__construct();
    }

    public function create_object($data) {
        $name_client = isset($data['name_client']) ? $data['name_client'] : '';
        $link = isset($data['link']) ? $data['link'] : '';
        $id_hinhanh = isset($data['id_hinhanh']) ? $data['id_hinhanh'] : null;
        $obj = array(
            'name_client' => $name_client,
            'link' => $link,
            'id_hinhanh' => $id_hinhanh,
        );
        return $obj;
    }

}
