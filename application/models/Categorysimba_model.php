<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categorysimba_model extends MY_Model {

    public function __construct() {
        $this->table = 'category';
        $this->primary_key = 'id';
        $this->has_many_pivot['product'] = array(
            'foreign_model' => 'Productsimba_model',
            'pivot_table' => 'product_category',
            'local_key' => 'id',
            'pivot_local_key' => 'category_id', /* this is the related key in the pivot table to the local key
              this is an optional key, but if your column name inside the pivot table
              doesn't respect the format of "singularlocaltable_primarykey", then you must set it. In the next title
              you will see how a pivot table should be set, if you want to  skip these keys */
            'pivot_foreign_key' => 'product_id', /* this is also optional, the same as above, but for foreign table's keys */
            'foreign_key' => 'id',
            'get_relate' => FALSE /* another optional setting, which is explained below */
        );
        parent::__construct();
    }

}
