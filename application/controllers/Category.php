<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //$this->output->enable_profiler(true);
        $this->load->model('category_database_model', 'category_database');
    }

    //ajout d'une nouvelle categorie
    public function add(){
        $this->form_validation->set_rules('category', '"catégorie"', 'trim|xss_clean|min_length[1]|required|callback_category_check', array('category_check' => 'Ce nom de catégorie est déjà utilisé'));

        if ($this->form_validation->run() == false) {

            $data['add_no_success'] = true;
            $this->load->view('welcome_page', $data);

        }
        else{
            $category = $this->input->post('category');

            $data = array(
                'name' => $category,
                'user_id' => $this->session->userdata('user_id')
            );

            $this->db->insert('category', $data);

            $this->session->set_flashdata('add_success', "La catégorie '$category' a bien été ajouté");
            $this->load->view('welcome_page');
        }
    }

    //verifie si le nom de categorie est déjà utilisé
    public function category_check(){
        $category = $this->input->post('category');

        $statut_category = $this->category_database->validate_name($category, $this->session->userdata('user_id'));

        return $statut_category;

    }
}