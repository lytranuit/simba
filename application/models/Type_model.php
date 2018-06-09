<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Type_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_type';
        $this->primary_key = 'id_type';
        parent::__construct();
    }

}
