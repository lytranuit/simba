<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Option_model extends MY_Model {

    public function __construct() {
        $this->table = 'options';
        $this->primary_key = 'id_option';
        parent::__construct();
    }

    function update_role_download($role) {
        $sql = "UPDATE tbl_hinhanh AS a JOIN tbl_product_file AS b ON a.`id_hinhanh` = b.`id_file` SET a.role_download = '$role'";
//        echo $sql;
//        die();
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_setting_mail() {
        $sql = "SELECT * FROM settings where group_name = 'system_simba_email'";
//        echo $sql;
//        die();
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $result = array();
        foreach ($data as $row) {
            $result[$row['opt_key']] = $row['opt_value'];
        }
        return $result;
    }

    function get_setting_mail_quote() {
        $sql = "SELECT * FROM settings where group_name = 'system_simba_quote_email'";
//        echo $sql;
//        die();
        $query = $this->db->query($sql);
        $data = $query->result_array();
        $result = array();
        foreach ($data as $row) {
            $result[$row['opt_key']] = $row['opt_value'];
        }
        return $result;
    }

}
