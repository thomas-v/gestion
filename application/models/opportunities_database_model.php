<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Opportunities_database_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function validate_company_name($category_id, $name){
        $this->db->select('company');
        $this->db->from('opportunities');
        $this->db->where('category_id',$category_id );
        $this->db->where('company',$name );
        $result = $this->db->get()->result();

        if ( is_array($result) && count($result) == 1 ) {
            return false;
        }
        else{
            return true;
        }
    }

}

?>