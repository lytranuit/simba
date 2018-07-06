<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productsimba_model extends MY_Model {

    public function __construct() {
        $this->table = 'product';
        $this->primary_key = 'id';
        parent::__construct();
    }

    public function xuatxu($id) {
        return $this->db->select("origin_country.*")
                        ->where("origin_country.id", $id)
                        ->get("origin_country")->row_array();
    }

    public function preservation($id) {
        return $this->db->select("preservation.*")
                        ->where("preservation.id", $id)
                        ->get("preservation")->row_array();
    }

}
