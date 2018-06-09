<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PageWeb_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_page_web';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
