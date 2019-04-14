<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplierproductfile_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_supplier_product_file';
        $this->primary_key = 'id';
        parent::__construct();
    }

    function create_object($data) {
        $array = array(
            'supplier_product_id', 'file_id'
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
