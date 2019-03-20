<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Role_model extends MY_Model {

    public function __construct() {
        $this->table = 'role';
        $this->primary_key = 'id';
        $this->has_many_pivot['permission'] = array(
            'foreign_model' => 'Permission_model',
            'pivot_table' => 'role_permission',
            'local_key' => 'id',
            'pivot_local_key' => 'id_role', /* this is the related key in the pivot table to the local key
              this is an optional key, but if your column name inside the pivot table
              doesn't respect the format of "singularlocaltable_primarykey", then you must set it. In the next title
              you will see how a pivot table should be set, if you want to  skip these keys */
            'pivot_foreign_key' => 'id_permission', /* this is also optional, the same as above, but for foreign table's keys */
            'foreign_key' => 'id',
            'get_relate' => TRUE /* another optional setting, which is explained below */
        );
        parent::__construct();
    }

    function create_object($data) {
        $array = array(
            'name', 'email', 'parent_id', 'sort', 'filter'
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

    function get_email_role($role, $parent) {
//        return "lytranuit@gmail.com";
        $return = array();
        if ($parent == 0) {
            return $return;
        }
        $query = $this->db->select('id,parent_id,email')
                ->where('id', $parent)
                ->limit(1)
                ->get("role");
        if ($query->num_rows() === 1) {
            $parent_obj = $query->row();
            array_push($return, $parent_obj->email);
            $return = array_merge($return, $this->get_email_role($parent, $parent_obj->parent_id));
        }
        return $return;
//        $this_role =    }
    }

}
