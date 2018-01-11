<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author jhon
 */

class Orders extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Activities_model','Users_model'));
    }

    public function index(){
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Registro orden de servicio';
        $data['acitivities'] = $this->Activities_model->get_activities_bts();
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_data($id_user);
        $this->load->view('admin/register-orders', $data);
    }
}