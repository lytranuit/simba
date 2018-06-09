<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cron_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_cron';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
