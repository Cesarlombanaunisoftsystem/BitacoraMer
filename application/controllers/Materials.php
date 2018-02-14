<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Audit
 *
 * @author jhon
 */
class Materials extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Audits_model','Users_model', 'Visits_model', 'Activities_model', 'Orders_model', 'Services_model'));
    }
    
    public function index() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Gestión de Materiales';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['materials'] = $this->Audits_model->get_pl(12);
        $data['process'] = $this->Audits_model->get_pl(16);
        $this->load->view('materials_view', $data);
    }
}
