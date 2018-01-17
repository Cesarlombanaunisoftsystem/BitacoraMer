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
class Orders extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Activities_model', 'Users_model','Payments_model','Orders_model','Areas_model','Taxes_model'));
    }

    public function index() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Registro orden de servicio';
        $data['activities'] = $this->Activities_model->get_activities_bts();
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['formspay'] = $this->Payments_model->get_payments();
        $data['coordinators_int'] = $this->Users_model->get_coordinators_int();
        $data['coordinators_ext'] = $this->Users_model->get_coordinators_ext();
        $data['areas'] = $this->Areas_model->get_areas();
        $this->db->select_max('id');
        $result = $this->db->get('tbl_orders')->row_array();
        $idOrder = $result['id'];
        $data['dataOrder'] = $this->Orders_model->get_order($idOrder);
        $data['details'] = $this->Orders_model->get_order_details($idOrder);
        $data['taxes'] = $this->Taxes_model->get_taxes();
        $this->load->view('admin/register-orders', $data);
    }

    public function add_order(){
        $data = array(
            'uniquecode' => $this->input->post('order'),
            'uniqueCodeCentralCost' => $this->input->post('centCost'),
            'dataSave' => date('Y-m-d H:i:s')
                );
        $res = $this->Orders_model->add_order($data);
        if($res == true){
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function add_order_detail(){
        $data = array(
            'idOrder' => $this->input->post('idOrder'),
            'idActivities' => $this->input->post('idActivities'),
            'idServices' => $this->input->post('idServices'),
            'site' => $this->input->post('site'),
            'price' => $this->input->post('price'),
            'count' => $this->input->post('count'),
            'total' => $this->input->post('total'),
            'dateSave' => date('Y-m-d H:i:s')
                );
        $res = $this->Orders_model->add_order_detail($data);
        if($res == true){
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function remove_order_detail(){
        $id = $this->input->post('id');
        $res = $this->Orders_model->remove_order_detail($id);
        if($res == true){
            echo 'ok';
        } else {
            echo 'error';
        }
    }

}
