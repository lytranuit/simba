<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slider_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_slider';
        $this->primary_key = 'id';
        parent::__construct();
    }

}
