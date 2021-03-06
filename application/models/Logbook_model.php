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

        $this->has_many_pivot['files'] = array(
            'foreign_model' => 'Hinhanh_model',
            'pivot_table' => 'tbl_logbook_file',
            'local_key' => 'id',
            'pivot_local_key' => 'logbook_id', /* this is the related key in the pivot table to the local key
              this is an optional key, but if your column name inside the pivot table
              doesn't respect the format of "singularlocaltable_primarykey", then you must set it. In the next title
              you will see how a pivot table should be set, if you want to  skip these keys */
            'pivot_foreign_key' => 'id_hinhanh', /* this is also optional, the same as above, but for foreign table's keys */
            'foreign_key' => 'id_hinhanh',
            'get_relate' => TRUE /* another optional setting, which is explained below */
        );

        $this->has_one['nccObject'] = array('foreign_model' => 'Ncc_model', 'foreign_table' => 'tbl_ncc', 'foreign_key' => 'id', 'local_key' => 'ncc_id');
        $this->has_one['author'] = array('foreign_model' => 'User_model', 'foreign_table' => 'user', 'foreign_key' => 'id', 'local_key' => 'user_id');
        parent::__construct();
    }

    function create_object($data) {
        $array = array(
            'ncc', 'nhansu', 'nhansukhac', 'content', 'date', 'date_end', 'date_report', 'deleted', 'new_product', 'new_customer', 'note', 'status', 'user_id', 'email_send', 'subject', 'is_sent', 'ncc_id', 'type_bc', 'search'
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
