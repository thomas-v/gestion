<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Category_database_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function validate_name($name, $user_id) {
        // Build a query to retrieve the user's details
        // based on the received username and password
        $this->db->from('category');
        $this->db->where('user_id',$user_id );
        $this->db->where('name',$name );
        $name = $this->db->get()->result();

        if ( is_array($name) && count($name) == 1 ) {
            return false;
        }
        else{
            return true;
        }
    }

}

?>