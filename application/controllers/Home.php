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
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
    }

    public function index() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 1) {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = 'Admin | bitacora';
        $this->load->view('admin/home_view', $data);
    }

}
