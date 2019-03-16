<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logbookproduct_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_logbook_product';
        $this->primary_key = 'id';
        parent::__construct();
    }

    function create_object($data) {
        $array = array(
            'product_id', 'logbook_id'
        );
        $obj = array();
        foreach ($array as $key) {
            if (isset($data[$key])) {
                $obj[$key] = $data[$key];
            } else
                continue;
        }

        return $obj;
    }

}
