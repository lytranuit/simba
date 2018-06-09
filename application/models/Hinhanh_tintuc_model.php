<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hinhanh_tintuc_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_hinhanh_tintuc';
        $this->primary_key = 'id_hinhanh_tintuc';
        parent::__construct();
    }

}
