<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

/**
 * Description of Maintenance
 *
 * @author jhon
 */
class Maintenance extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Activities_model', 'Users_model', 'Payments_model', 'Orders_model', 'Areas_model', 'Taxes_model'));
    }
    
    public function index() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Registro orden de servicio das';
        $data['activities'] = $this->Activities_model->get_activities_xtype(3);
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['formspay'] = $this->Payments_model->get_payments();
        $data['coordinators_int'] = $this->Users_model->get_coordinators_int();
        $data['coordinators_ext'] = $this->Users_model->get_coordinators_ext();
        $data['areas'] = $this->Areas_model->get_areas();
        $this->db->select_max('id');
        $result = $this->db->get('tbl_orders')->row_array();
        $idOrder = $result['id'];
        $data['order'] = $this->Orders_model->get_order_bitacora($idOrder,3);
        $data['ordersTray'] = $this->Orders_model->get_orders_tray($id_user);
        $data['details'] = $this->Orders_model->get_order_details($idOrder,3);
        $data['taxes'] = $this->Taxes_model->get_taxes();
        $this->load->view('admin/maintenance', $data);
    }
}
