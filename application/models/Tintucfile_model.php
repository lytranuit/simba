<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tintucfile_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_tintuc_file';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
