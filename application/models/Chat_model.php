<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chat_model extends MY_Model {

    public function __construct() {
        $this->table = 'tbl_chat';
        $this->primary_key = 'id';
        parent::__construct();
    }

    public function newchat($id_room, $time) {
        $sql = "SELECT * FROM tbl_chat where room = $id_room and note_date >= '$time'";
        $query = $this->db->query($sql);
        $return = $query->result_array();
        return $return;
    }

    public function allboxchat($limit) {
        $sql = "SELECT * FROM tbl_chat";
        $query = $this->db->query($sql);
        $return = $query->result_array();
        return $return;
    }

    public function contentchat($id) {
        $sql = "SELECT a.*,b.ip_address FROM tbl_chat as a JOIN tbl_room as b ON a.room = b.id WHERE room = $id";
        $query = $this->db->query($sql);
        $return = $query->result_array();
        return $return;
    }

}
