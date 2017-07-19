<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $this->load->view('login_page');
    }

    // gestion de l'enregistrement d'un user
    public function register_validation(){
        $this->form_validation->set_rules('pseudo_register', '"pseudo"', 'trim|required|xss_clean|min_length[5]|alpha_numeric');

        $this->form_validation->set_rules('password_register', '"mot de passe"', 'trim|required|xss_clean|min_length[5]');

        $this->form_validation->set_rules('email_register', '"adresse mail"', 'trim|required|valid_email|is_unique[users.email]|xss_clean');

        if ($this->form_validation->run() == false) {

            $data['register'] = true;

            $this->load->view('login_page', $data);

        }else {
            die('form ok');
            $this->load->view('user/compte_utilisateur');

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
}