<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_model extends MY_Model {

    public function __construct() {
        $this->table = 'category';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
