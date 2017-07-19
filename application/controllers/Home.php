<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_database_model', 'login_database');
    }

    public function index()
    {
        $this->load->view('login_page');
    }

    // gestion de l'enregistrement d'un user
    public function register_validation(){
        $this->form_validation->set_rules('pseudo_register', '"pseudo"', 'trim|required|xss_clean|min_length[5]|alpha_numeric');

        $this->form_validation->set_rules('password_register', '"mot de passe"', 'trim|required|xss_clean|min_length[5]|matches[confirm_password_register]');

        $this->form_validation->set_rules('confirm_password_register', '"confirmation du mot de passe"', 'trim|required|xss_clean|min_length[5]');

        $this->form_validation->set_rules('email_register', '"adresse mail"', 'trim|required|valid_email|xss_clean|callback_check_email', array('check_email' => 'Cet email est déjà enregistré'));

        if ($this->form_validation->run() == false) {

            $data['register'] = true;

            $this->load->view('login_page', $data);

        }else {

            $email = $this->input->post('email_register');
            $password = $this->input->post('password_register');
            $pseudo = $this->input->post('pseudo_register');

        }
    }

    // gestion de la connection d'un user
    public function login_validation(){
        $this->form_validation->set_rules('pseudo_login', '"pseudo"', 'trim|required|xss_clean|alpha_numeric');

        $this->form_validation->set_rules('password_login', '"mot de passe"', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $this->load->view('login_page');

        }else {
            die('form ok');
            $this->load->view('user/compte_utilisateur');

        }
    }

    // verification de l'unicité de l'email
    public function check_email(){

        $email = $this->input->post('email_register');

        $statut_email = $this->login_database->get_by_email($email);

        return $statut_email;

    }
}