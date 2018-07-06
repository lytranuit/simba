<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role_model extends MY_Model {

    public function __construct() {
        $this->table = 'role';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
