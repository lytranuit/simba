<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comment_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_comment';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
