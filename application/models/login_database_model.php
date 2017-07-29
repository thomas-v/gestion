<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Login_database_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_by_email($email){
        $condition = "user_email =" . "'" . $email . "'";
        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return false;
        } else {
            return true;
        }
    }

    function validate_user($email) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('user_login');
        $this->db->where('user_email',$email );
        $login = $this->db->get()->result();

        if ( is_array($login) && count($login) == 1 ) {
            return $login;
        }
        else{
            return false;
        }
    }

}

?>