<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplierproduct_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_supplier_product';
        $this->primary_key = 'id';
        parent::__construct();
    }

    function create_object($data) {
        $array = array(
            'name_vi', 'name_en', 'name_jp', 'code', 'address', 'phone', 'fax', 'email', 'note'
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
