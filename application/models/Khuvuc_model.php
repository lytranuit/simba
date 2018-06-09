<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Khuvuc_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_khuvuc';
        $this->primary_key = 'id_khuvuc';
        parent::__construct();
    }

    public function get_khuvuc_co_tin() {
        $sql = "SELECT a.*,COUNT(a.id_khuvuc) as num_tin FROM $this->table as a JOIN tbl_tin as b ON a.id_khuvuc = b.id_khuvuc WHERE a.deleted = 0 and b.deleted = 0 GROUP BY a.id_khuvuc";
        $query = $this->db->query($sql);
        $return = $query->result_array();
        return $return;
    }

}
