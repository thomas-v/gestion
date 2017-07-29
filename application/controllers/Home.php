<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(true);
        $this->load->model('login_database_model', 'login_database');
    }

    public function index()
    {
        $this->load->view('login_page');
    }

    // gestion de l'enregistrement d'un user
    public function register_validation(){
        $this->form_validation->set_rules('pseudo_register', '"pseudo"', 'trim|xss_clean|min_length[5]|callback_pseudo_check|required', array('pseudo_check' => 'Le pseudo doit posséder au minimum 5 caractères, être alphanumérique et peut contenir le caractère _'));

        $this->form_validation->set_rules('password_register', '"mot de passe"', 'trim|required|xss_clean|min_length[5]|matches[confirm_password_register]|callback_password_check', array('password_check' => 'Le mot de passe doit posséder au minimum 5 caractères, être alphanumérique et peut contenir les caractères _ - &'));

        $this->form_validation->set_rules('confirm_password_register', '"confirmation du mot de passe"', 'trim|xss_clean');

        $this->form_validation->set_rules('email_register', '"adresse mail"', 'trim|required|valid_email|xss_clean|callback_check_email', array('check_email' => 'Cet email est déjà enregistré'));

        if ($this->form_validation->run() == false) {

            $data['register'] = true;

            $this->load->view('login_page', $data);

        }else {

            $email = $this->input->post('email_register');
            $password = $this->input->post('password_register');
            $pseudo = $this->input->post('pseudo_register');

            $data = array(
                'user_name' => $pseudo,
                'user_email' => $email,
                'user_password' => $this->encryption->encrypt($password)
            );

            $this->db->insert('user_login', $data);

            $this->login($email, $pseudo);



        }
    }

    // gestion de la connection d'un user
    public function login_validation(){
        $this->form_validation->set_rules('email_login', '"pseudo"', 'trim|required|xss_clean|valid_email');

        $this->form_validation->set_rules('password_login', '"mot de passe"', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $this->load->view('login_page');

        }else {
            $password = $this->input->post('password_login');
            $email = $this->input->post('email_login');

            if($user = $this->login_database->validate_user($email)){
                if($password == $this->encryption->decrypt($user[0]->user_password)){
                    $this->login($user[0]->user_email, $user[0]->user_name, $user[0]->id);
                }
            }
            $this->session->set_flashdata('error_message', 'L\'email ou le mot de passe est incorrect');
            $this->load->view('login_page');
        }
    }

    // verification de l'unicité de l'email
    public function check_email(){

        $email = $this->input->post('email_register');

        $statut_email = $this->login_database->get_by_email($email);

        return $statut_email;

    }

    //regex sur le pseudo
    public function pseudo_check($str)
    {
        if (1 !== preg_match("`^([a-zA-Z0-9_]{0,36})$`", $str))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    //regex sur le mot de passe
    public function password_check($str)
    {
        if (1 !== preg_match("`^([a-zA-Z0-9_-]{0,36})$`", $str))
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    //connection
    public function login($email, $pseudo, $id){
        $this->session->set_userdata('user_id', $id);
        $this->session->set_userdata('user_email', $email);
        $this->session->set_userdata('user_pseudo', $pseudo);

        //redirect('/jobs/list');
    }
}