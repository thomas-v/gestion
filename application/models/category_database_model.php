<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Category_database_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function validate_name($name, $user_id) {
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

    public function get_category_by_user($user_id){
        $this->db->select('name');
        $this->db->select('id');
        $this->db->from('category');
        $this->db->where('user_id',$user_id );
        $this->db->order_by("name","asc");
        $cats_user = $this->db->get()->result();

        return $cats_user;
    }

    public function delete_by_id($user_id, $category_id){
        $this->db->where('user_id', $user_id);
        $this->db->where('id', $category_id);
        $this->db->delete('category');
    }

    public function get_category_by_id($cat_id, $user_id){
        $this->db->select('name');
        $this->db->from('category');
        $this->db->where('user_id',$user_id );
        $this->db->where('id',$cat_id );
        $cat_name = $this->db->get()->result();

        return $cat_name;
    }

}

?>