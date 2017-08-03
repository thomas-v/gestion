<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Opportunities extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(true);
        $this->load->model('category_database_model', 'category_database');
        $this->load->model('opportunities_database_model', 'opportunities_database');
    }

	public function index()
	{
        $category = $this->input->post('category');

        //recuperation du nom de la catégorie
        if ($category != NULL) {
            $cat = $this->category_database->get_category_by_id($category, $this->session->userdata('user_id'));
            $data['category_name'] = $cat[0]->name;
            $data['category_id'] = $category;
            $this->load->view('opportunities_list_page', $data);
        }
        else{
            $data['show_list_form_message'] = "Une catégorie est nécessaire à selectionner";
            $data['show_list_success'] = false;
            $data['categorys'] = $this->category_database->get_category_by_user($this->session->userdata('user_id'));
            $this->load->view('welcome_page', $data);
        }

	}

    //gestion de l'ajout de société
	public function add(){

        $this->form_validation->set_rules('name', '"Entreprise"', 'trim|xss_clean|min_length[1]|required|callback_company_check', array('company_check' => 'Vous avez déjà posutulé à cette entreprise '));
        $this->form_validation->set_rules('adress', '"Adresse"', 'trim|xss_clean|min_length[1]|required');
        $this->form_validation->set_rules('city', '"Ville"', 'trim|xss_clean|min_length[1]|required');
        $this->form_validation->set_rules('postal_code', '"Code postal"', 'trim|xss_clean|min_length[5]|max_length[5]|required|callback_postal_code_check', array('postal_code_check' => 'Veuillez rentrer un code postal valide'));

        if ($this->form_validation->run() == false) {

            $category_id = $this->input->post('category_id');
            $cat = $this->category_database->get_category_by_id($category_id, $this->session->userdata('user_id'));
            $data['category_name'] = $cat[0]->name;
            $data['category_id'] = $category_id;
            $this->load->view('opportunities_list_page', $data);

        }
        else{

        }
    }

	//verification si entreprise en base
	public function company_check(){
        $name = $this->input->post('name');
        $category_id = $this->input->post('category_id');

        return $this->opportunities_database->validate_company_name($category_id, $name);
    }

    function postal_code_check($zip){
        $regex = '/^[0-9]{5}/i';
        if( !preg_match($regex, $zip) ) {
            return false;
        }
    }


}
