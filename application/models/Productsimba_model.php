<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productsimba_model extends MY_Model {

    public function __construct() {
        $this->table = 'product';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
