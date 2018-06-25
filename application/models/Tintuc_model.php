<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tintuc_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_tintuc';
        $this->primary_key = 'id';
        $this->has_one['author'] = array('foreign_model' => 'User_model', 'foreign_table' => 'user', 'foreign_key' => 'id', 'local_key' => 'id_user');
        $this->has_one['hinhanh'] = array('foreign_model' => 'Hinhanh_model', 'foreign_table' => 'tbl_hinhanh', 'foreign_key' => 'id_hinhanh', 'local_key' => 'id_hinhanh');
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
        $title_vi = isset($data['title_vi']) ? $data['title_vi'] : '';
        $content_vi = isset($data['content_vi']) ? $data['content_vi'] : '';
        $title_en = isset($data['title_en']) ? $data['title_en'] : '';
        $content_en = isset($data['content_en']) ? $data['content_en'] : '';
        $title_jp = isset($data['title_jp']) ? $data['title_jp'] : '';
        $content_jp = isset($data['content_jp']) ? $data['content_jp'] : '';
        $date = isset($data['date']) ? $data['date'] : time();
        $type = isset($data['type']) ? $data['type'] : null;
        $id_hinhanh = isset($data['id_hinhanh']) ? $data['id_hinhanh'] : null;
        $id_user = isset($data['id_user']) ? $data['id_user'] : null;
        $active = isset($data['active']) ? $data['active'] : 0;
        $obj = array(
            'title_vi' => $title_vi,
            'content_vi' => $content_vi,
            'title_en' => $title_en,
            'content_en' => $content_en,
            'title_jp' => $title_jp,
            'content_jp' => $content_jp,
            'date' => $date,
            'type' => $type,
            'id_hinhanh' => $id_hinhanh,
            'id_user' => $id_user,
            'active' => $active
        );
        return $obj;
    }

}
