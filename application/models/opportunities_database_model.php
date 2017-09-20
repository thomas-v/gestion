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

    public function add_opportunitie($data){
        $this->db->insert('opportunities', $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    public function add_contact($data){
        $this->db->insert('contact', $data);
    }

    public function get_opportunities_by_category($category_id){
        $this->db->from('opportunities');
        $this->db->where('category_id', $category_id );
        $opportunities = $this->db->get()->result();

        return $opportunities;
    }

    public function get_contact_by_opportunitie($opportunitie_id){
        $this->db->select('name');
        $this->db->select('date');
        $this->db->from('contact');
        $this->db->join('type_contact', 'type_contact.id = contact.type_contact_id', 'left');
        $this->db->where('opportunitie_id', $opportunitie_id );
        $contacts = $this->db->get()->result();

        return $contacts;
    }
    
    public function delete($opportunitie_id){
        $this->db->where('id', $opportunitie_id);
        $this->db->delete('opportunities');
    }
}

?>