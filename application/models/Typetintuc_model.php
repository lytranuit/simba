<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Typetintuc_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_tintuc_type';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
