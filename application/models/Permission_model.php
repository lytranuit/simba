<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permission_model extends MY_Model {

    public function __construct() {
        $this->table = 'permission';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
