<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logbook_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_logbook';
        $this->primary_key = 'id';
        $this->has_many_pivot['products'] = array(
            'foreign_model' => 'Productsimba_model',
            'pivot_table' => 'tbl_logbook_product',
            'local_key' => 'id',
            'pivot_local_key' => 'logbook_id', /* this is the related key in the pivot table to the local key
              this is an optional key, but if your column name inside the pivot table
              doesn't respect the format of "singularlocaltable_primarykey", then you must set it. In the next title
              you will see how a pivot table should be set, if you want to  skip these keys */
            'pivot_foreign_key' => 'product_id', /* this is also optional, the same as above, but for foreign table's keys */
            'foreign_key' => 'id',
            'get_relate' => TRUE /* another optional setting, which is explained below */
        );
        $this->has_many_pivot['customers'] = array(
            'foreign_model' => 'Customersimba_model',
            'pivot_table' => 'tbl_logbook_customer',
            'local_key' => 'id',
            'pivot_local_key' => 'logbook_id', /* this is the related key in the pivot table to the local key
              this is an optional key, but if your column name inside the pivot table
              doesn't respect the format of "singularlocaltable_primarykey", then you must set it. In the next title
              you will see how a pivot table should be set, if you want to  skip these keys */
            'pivot_foreign_key' => 'customer_id', /* this is also optional, the same as above, but for foreign table's keys */
            'foreign_key' => 'id',
            'get_relate' => TRUE /* another optional setting, which is explained below */
        );
        parent::__construct();
    }

    function create_object($data) {
        $array = array(
            'ncc', 'nhansu', 'nhansukhac', 'content', 'date', 'deleted', 'new_product', 'new_customer', 'note', 'status', 'user_id', 'email_send'
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
