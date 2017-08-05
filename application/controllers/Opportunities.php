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
        $this->form_validation->set_rules('city', '"Ville"', 'trim|xss_clean|min_length[1]|required');

        if(isset($_POST['post'])){
            $this->form_validation->set_rules('post_date', '"Date de contact par courrier"', 'trim|xss_clean|callback_regex_date[post_date]', array('regex_date' => 'Veuillez rentrer une "Date de contact par courrier" au format AAAA-MM-JJ'));
        }
        if(isset($_POST['email'])){
            $this->form_validation->set_rules('email_date', '"Date de contact par email"', 'trim|xss_clean|callback_regex_date[email_date]', array('regex_date' => 'Veuillez rentrer une "Date de contact par email" au format AAAA-MM-JJ'));
        }
        if(isset($_POST['phone'])){
            $this->form_validation->set_rules('phone_date', '"Date de contact par téléphone"', 'trim|xss_clean|callback_regex_date[phone_date]', array('regex_date' => 'Veuillez rentrer une "Date de contact par téléphone" au format AAAA-MM-JJ'));
        }
        if(isset($_POST['phone_relaunch'])){
            $this->form_validation->set_rules('phone_relaunch_date', '"Date de contact par relance téléphonique"', 'trim|xss_clean|callback_regex_date[phone_relaunch_date]', array('regex_date' => 'Veuillez rentrer une "Date de contact par relance téléphonique" au format AAAA-MM-JJ'));
        }
        if(isset($_POST['interview'])){
            $this->form_validation->set_rules('interview_date', '"Date d\'entretien"', 'trim|xss_clean|callback_regex_date_interview[interview_date]', array('regex_date_interview' => 'Veuillez rentrer une "Date d\'entretien" au format AAAA-MM-JJ hh-mm-ss'));
        }

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

    public function regex_date($input_name){
        $date = $this->input->post($input_name);

        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
            return true;
        } else {
            return false;
        }
    }

    public function regex_date_interview(){
        $date = $this->input->post('interview_date');

        if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/", $date)){
            return true;
        } else {
            return false;
        }
    }




}
