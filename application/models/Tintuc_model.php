<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tintuc_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_tintuc';
        $this->primary_key = 'id_tintuc';
        parent::__construct();
    }

    public function get_tintuc_hinhanh($id) {
        return $this->db->select("tbl_hinhanh.*")
                        ->where("tbl_hinhanh_tintuc.id_tintuc", $id)
                        ->where("tbl_hinhanh_tintuc.deleted", 0)
                        ->join("tbl_hinhanh", "tbl_hinhanh_tintuc.id_hinhanh = tbl_hinhanh.id_hinhanh")
                        ->get("tbl_hinhanh_tintuc")->result_array();
    }

}
