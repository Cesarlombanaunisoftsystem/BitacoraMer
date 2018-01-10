<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','security'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->model('Login_model');
    }

    function index() {
        switch ($this->session->userdata('perfil')) {
            case '':
                $data['token'] = $this->token();
                $data['titulo'] = 'Login | bitacora';
                $this->load->view('login/login_view', $data);
                break;
            case 1:
                redirect(base_url() . 'home');
                break;
            case 2:
                redirect(base_url() . 'editor');
                break;
            case 3:
                redirect(base_url() . 'suscriptor');
                break;
            default:
                $data['titulo'] = 'Login | bitacora';
                $this->load->view('login/login_view', $data);
                break;
        }
    }

    public function new_user() {
        if ($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token')) {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|min_length[2]|max_length[150]|xss_clean');
            $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[5]|max_length[150]|xss_clean');

            //lanzamos mensajes de error si es que los hay

            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $username = $this->input->post('email', TRUE);
                $password = sha1($this->input->post('password', TRUE));
                $check_user = $this->Login_model->login_user($username, $password);
                if ($check_user == TRUE) {
                    $data = array(
                        'is_logued_in' => TRUE,
                        'id_usuario' => $check_user->id,
                        'perfil' => $check_user->idUserProfile,
                        'username' => $check_user->username,
                    );
                    $this->session->set_userdata($data);
                    $this->index();
                }
            }
        } else {
            redirect(base_url() . 'login');
        }
    }

    public function token() {
        $token = sha1(uniqid(rand(), true));
        $this->session->set_userdata('token', $token);
        return $token;
    }

    public function logout_ci() {
        $this->session->sess_destroy();
        $this->index();
    }

}