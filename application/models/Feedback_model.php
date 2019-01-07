<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feedback_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_feedback';
        $this->primary_key = 'id';
        $this->has_one['product'] = array('foreign_model' => 'Productsimba_model', 'foreign_table' => 'product', 'foreign_key' => 'id', 'local_key' => 'product_id');
        $this->has_one['customer'] = array('foreign_model' => 'Customersimba_model', 'foreign_table' => 'customer', 'foreign_key' => 'id', 'local_key' => 'customer_id');
        parent::__construct();
    }

    function create_object($data) {
        $array = array(
            'name', 'customer_id', 'product_id', 'content', 'date', 'subject'
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
