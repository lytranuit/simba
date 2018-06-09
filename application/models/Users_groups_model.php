<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_Groups_model extends MY_Model {

    public function __construct() {
        $this->table = 'users_groups';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
