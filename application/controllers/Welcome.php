<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_database_model', 'category_database');

    }

	public function index()
	{
	    $data['categorys'] = $this->category_database->get_category_by_user($this->session->userdata('user_id'));


		$this->load->view('welcome_page', $data);
	}


}
