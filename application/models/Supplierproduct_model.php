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
            'supplier_id',
            'name_vi',
            'name_en', 'name_jp',
            'code',
            'description',
            'detail',
            'special_unit',
            'description_unit',
            'special_order',
            'volume',
            'concentration',
            'element',
            'guide',
            'preservation',
            'material',
            'origin',
            'begin_date',
            'expiry_date',
            'number_publish',
            'price',
            'import_company',
            'name_nsx',
            'address_nsx',
            'video', 'deleted'
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
