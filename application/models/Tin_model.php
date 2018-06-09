<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tin_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_tin';
        $this->primary_key = 'id_tin';
        parent::__construct();
    }

    public function get_tin_hinhanh($id) {
        return $this->db->select("tbl_hinhanh.*")
                        ->where("tbl_hinhanh_tin.id_tin", $id)
                        ->where("tbl_hinhanh_tin.deleted", 0)
                        ->join("tbl_hinhanh", "tbl_hinhanh_tin.id_hinhanh = tbl_hinhanh.id_hinhanh")
                        ->get("tbl_hinhanh_tin")->result_array();
    }

}
