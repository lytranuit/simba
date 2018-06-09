<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Phaply_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_phaply';
        $this->primary_key = 'id_phaply';
        parent::__construct();
    }

}
