<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Group_model extends MY_Model {

    public function __construct() {
        $this->table = 'groups';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
