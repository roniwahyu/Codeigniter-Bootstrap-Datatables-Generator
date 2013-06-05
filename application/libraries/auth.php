<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

    var $AT = null;

    function __construct() {
        $this->AT = & get_instance();
        $this->AT->load->database();
    }

    function process_login($user, $pass) {
        $this->AT->db->where('username', $user);
        
        $this->AT->db->where('password', md5($pass));
        $this->AT->db->where('status', 1);
        $eo = $this->AT->db->get('user_ci');

        if ($eo->num_rows == 1) {
            $login = $eo->row_array();

     
            $id = $login['id'];            
            $sess = array('id' => $id, 'login' => TRUE);
            $this->AT->session->set_userdata($sess);
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

?>