<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customersimba_model extends MY_Model {

    public function __construct() {
        $this->table = 'customer';
        $this->primary_key = 'id';
        parent::__construct();
    }

}