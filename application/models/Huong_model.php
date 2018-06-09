<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Huong_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_huong';
        $this->primary_key = 'id_huong';
        parent::__construct();
    }

}
