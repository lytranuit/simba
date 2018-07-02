<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tintuc_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_tintuc';
        $this->primary_key = 'id';
        $this->has_one['author'] = array('foreign_model' => 'User_model', 'foreign_table' => 'user', 'foreign_key' => 'id', 'local_key' => 'id_user');
        $this->has_one['hinhanh'] = array('foreign_model' => 'Hinhanh_model', 'foreign_table' => 'tbl_hinhanh', 'foreign_key' => 'id_hinhanh', 'local_key' => 'id_hinhanh');
        $this->has_one['typeobj'] = array('foreign_model' => 'Typetintuc_model', 'foreign_table' => 'tbl_tintuc_type', 'foreign_key' => 'id', 'local_key' => 'type');
        $this->has_many_pivot['files'] = array(
            'foreign_model' => 'Hinhanh_model',
            'pivot_table' => 'tbl_tintuc_file',
            'local_key' => 'id',
            'pivot_local_key' => 'id_tintuc', /* this is the related key in the pivot table to the local key
              this is an optional key, but if your column name inside the pivot table
              doesn't respect the format of "singularlocaltable_primarykey", then you must set it. In the next title
              you will see how a pivot table should be set, if you want to  skip these keys */
            'pivot_foreign_key' => 'id_file', /* this is also optional, the same as above, but for foreign table's keys */
            'foreign_key' => 'id_hinhanh',
            'get_relate' => TRUE /* another optional setting, which is explained below */
        );
        parent::__construct();
    }

    public function get_tintuc_hinhanh($id) {
        return $this->db->select("tbl_hinhanh.*")
                        ->where("tbl_hinhanh_tintuc.id_tintuc", $id)
                        ->where("tbl_hinhanh_tintuc.deleted", 0)
                        ->join("tbl_hinhanh", "tbl_hinhanh_tintuc.id_hinhanh = tbl_hinhanh.id_hinhanh")
                        ->get("tbl_hinhanh_tintuc")->result_array();
    }

    function create_object($data) {
        $array = array(
            'title_vi', 'content_vi', 'title_en', 'content_en', 'title_jp', 'content_jp', 'type', 'id_hinhanh', 'id_user', 'date', 'active', 'is_private', 'is_highlight'
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
