<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ncc_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_ncc';
        $this->primary_key = 'id';
        parent::__construct();
    }

    function create_object($data) {
        $array = array(
            'name', 'short_name', 'code', 'address', 'phone', 'fax', 'email', 'contact_people', 'tax_code', 'stauts'
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
