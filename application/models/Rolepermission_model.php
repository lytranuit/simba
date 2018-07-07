<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rolepermission_model extends MY_Model {

    public function __construct() {
        $this->table = 'role_permission';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
