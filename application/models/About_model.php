<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class About_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_about';
        $this->primary_key = 'id';
        $this->has_one['hinhanh'] = array('foreign_model' => 'Hinhanh_model', 'foreign_table' => 'tbl_hinhanh', 'foreign_key' => 'id_hinhanh', 'local_key' => 'id_hinhanh');
        parent::__construct();
    }

    public function create_object($data) {
        $content = isset($data['content']) ? $data['content'] : '';
        $language = isset($data['language']) ? $data['language'] : 'vi';
        $order = isset($data['order']) ? $data['order'] : '0';
        $id_hinhanh = isset($data['id_hinhanh']) ? $data['id_hinhanh'] : null;
        $obj = array(
            'content' => $content,
            'language' => $language,
            'order' => $order,
            'id_hinhanh' => $id_hinhanh,
        );
        return $obj;
    }

}
