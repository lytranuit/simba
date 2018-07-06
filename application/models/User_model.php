<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends MY_Model {

    public function __construct() {
        $this->table = 'user';
        $this->primary_key = 'id';
        $this->has_one['role_user'] = array('foreign_model' => 'Role_model', 'foreign_table' => 'role', 'foreign_key' => 'id', 'local_key' => 'role');

        parent::__construct();
    }

    function create_object($data) {
        $array = array(
            'username', 'role', 'fullname', 'active', 'customer_id', 'password'
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

    /**
     * logged_in
     *
     * @return bool
     * @author Mathew
     * */
    public function logged_in() {
        return (bool) $this->session->userdata('identity');
    }

    /**
     * login
     *
     * @return bool
     * @author Mathew
     * */
    public function login($identity, $password) {
        if (empty($identity) || empty($password)) {
            return FALSE;
        }
        $query = $this->db->select('username,id,password,active,customer_id,role')
                ->where('username', $identity)
                ->limit(1)
                ->get("user");
        if ($query->num_rows() === 1) {
            $user = $query->row();

            if (md5($password) == $user->password) {
                if ($user->active == 0) {
                    return FALSE;
                }

                $this->set_session($user);
                return TRUE;
            }
        }
    }

    /**
     * set_session
     *
     * @return bool
     * @author jrmadsen67
     * */
    public function set_session($user) {
        $session_data = array(
            'identity' => $user->username,
            'username' => $user->username,
            'role' => $user->role,
            'customer_id' => $user->customer_id,
            'user_id' => $user->id, //everyone likes to overwrite id so we'll use user_id
        );

        $this->session->set_userdata($session_data);
        return TRUE;
    }

    /**
     * logout
     *
     * @return void
     * @author Mathew
     * */
    public function logout() {
        $identity = $this->config->item('identity', 'ion_auth');

        if (substr(CI_VERSION, 0, 1) == '2') {
            $this->session->unset_userdata(array('identity' => '', 'id' => ''));
        } else {
            $this->session->unset_userdata(array('identity', 'id'));
        }
        // Destroy the session
        $this->session->sess_destroy();

        //Recreate the session
        if (substr(CI_VERSION, 0, 1) == '2') {
            $this->session->sess_create();
        } else {
            if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
                session_start();
            }
            $this->session->sess_regenerate(TRUE);
        }
        return TRUE;
    }

}
