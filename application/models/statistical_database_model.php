<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Statistical_database_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    public function open_connection($user_id, $user_agent, $user_ip){
        $data = array(
            'user_id' => $user_id,
            'user_agent' => $user_agent,
            'user_ip' => $user_ip
        );

        $this->db->insert('statistical', $data);

        $insert_id = $this->db->insert_id();

        return $insert_id;
    }
}

?>