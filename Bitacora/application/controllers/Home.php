<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
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
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Users_model','Cities_model'));
    }

    public function index() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Inicio';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $this->load->view('admin/home_view', $data);
    }
    
    public function menu(){
         if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['dat'] = file_get_contents(base_url('dist/js/items_menu.json'));
        $this->load->view('menu/menu',$data);
    }
    
    public function autocomplete(){
         if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $key = $_POST['keyword'];
        $data['datos'] = $this->Cities_model->get_city($key);
        header('Content-Type: application/json');
        echo json_encode($data['datos']);
    }

}
