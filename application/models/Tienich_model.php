<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tienich_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_tienich';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
