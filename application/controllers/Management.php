<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

/**
 * Description of Management
 *
 * @author jj
 */
class Management extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Users_model','Orders_model'));
    }

    public function index() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Gestión';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['totalorders'] = $this->Orders_model->get_total_orders();
        $data['totalsale'] = $this->Orders_model->get_total_sale();
        $data['totalcost'] = $this->Orders_model->get_total_cost();
        $this->load->view('admin/management_view', $data);
    }
}
