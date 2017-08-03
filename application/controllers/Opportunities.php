<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opportunities extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_database_model', 'category_database');
    }

	public function index()
	{
        $category = $this->input->post('category');

        //recuperation du nom de la catégorie
        if ($category != NULL) {
            $cat = $this->category_database->get_category_by_id($category, $this->session->userdata('user_id'));
            $data['category_name'] = $cat[0]->name;
            $this->load->view('opportunities_list_page', $data);
        }
        else{
            $data['show_list_form_message'] = "Une catégorie est nécessaire à selectionner";
            $data['show_list_success'] = false;
            $data['categorys'] = $this->category_database->get_category_by_user($this->session->userdata('user_id'));
            $this->load->view('welcome_page', $data);
        }

	}


}
