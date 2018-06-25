<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_product';
        $this->primary_key = 'id';
        $this->has_one['hinhanh'] = array('foreign_model' => 'Hinhanh_model', 'foreign_table' => 'tbl_hinhanh', 'foreign_key' => 'id_hinhanh', 'local_key' => 'id_hinhanh');
        parent::__construct();
    }

    public function create_object($data) {
        $name_vi = isset($data['name_vi']) ? $data['name_vi'] : '';
        $content_vi = isset($data['content_vi']) ? $data['content_vi'] : '';
        $name_en = isset($data['name_en']) ? $data['name_en'] : '';
        $content_en = isset($data['content_en']) ? $data['content_en'] : '';
        $name_jp = isset($data['name_jp']) ? $data['name_jp'] : '';
        $content_jp = isset($data['content_jp']) ? $data['content_jp'] : '';
        $id_category = isset($data['id_category']) ? $data['id_category'] : null;
        $id_hinhanh = isset($data['id_hinhanh']) ? $data['id_hinhanh'] : null;
        $obj = array(
            'name_vi' => $name_vi,
            'content_vi' => $content_vi,
            'name_en' => $name_en,
            'content_en' => $content_en,
            'name_jp' => $name_jp,
            'content_jp' => $content_jp,
            'id_category' => $id_category,
            'id_hinhanh' => $id_hinhanh,
        );
        return $obj;
    }

}
