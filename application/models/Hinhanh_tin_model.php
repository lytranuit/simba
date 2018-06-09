<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hinhanh_tin_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_hinhanh_tin';
        $this->primary_key = 'id_hinhanh_tin';
        parent::__construct();
    }

}
