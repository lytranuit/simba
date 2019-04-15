<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplierproduct_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_supplier_product';
        $this->primary_key = 'id';
        $this->has_one['supplier'] = array('foreign_model' => 'Supplier_model', 'foreign_table' => 'tbl_supplier', 'foreign_key' => 'id', 'local_key' => 'supplier_id');
        $this->has_many_pivot['files'] = array(
            'foreign_model' => 'Hinhanh_model',
            'pivot_table' => 'tbl_supplier_product_file',
            'local_key' => 'id',
            'pivot_local_key' => 'supplier_product_id', /* this is the related key in the pivot table to the local key
              this is an optional key, but if your column name inside the pivot table
              doesn't respect the format of "singularlocaltable_primarykey", then you must set it. In the next title
              you will see how a pivot table should be set, if you want to  skip these keys */
            'pivot_foreign_key' => 'file_id', /* this is also optional, the same as above, but for foreign table's keys */
            'foreign_key' => 'id_hinhanh',
            'get_relate' => TRUE /* another optional setting, which is explained below */
        );
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
