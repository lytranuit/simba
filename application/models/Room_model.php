<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Room_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_room';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
