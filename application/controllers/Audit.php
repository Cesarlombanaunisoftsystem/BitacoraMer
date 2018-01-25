<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Audit
 *
 * @author jhon
 */
class Audit extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Users_model', 'Audits_model'));
    }
    
    public function pl_1() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Presupuesto PL -Auditoria-';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['pl_1'] = $this->Audits_model->get_pl1();
        $this->load->view('audit_pl1_view', $data);
    }
}