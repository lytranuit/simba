<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productfile_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_product_file';
        $this->primary_key = 'id';
        parent::__construct();
    }
    
}
