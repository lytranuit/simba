<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Option_model extends MY_Model {

    public function __construct() {
        $this->table = 'options';
        $this->primary_key = 'id_option';
        parent::__construct();
    }

}
