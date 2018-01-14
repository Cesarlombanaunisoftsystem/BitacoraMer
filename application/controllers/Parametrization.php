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
class Parametrization extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Users_model','Categories_model','Activities_model','Payments_model'));
    }

    public function index() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Administración';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $this->load->view('admin/admin_view', $data);
    }
    
    public function prices() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Usuarios';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['usuarios'] = $this->Users_model->get_users(); 
        $this->load->view('admin/prices_view', $data);        
    }
    
    public function get_categories() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Precios de Venta';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);        
        $data['categories'] = $this->Categories_model->get_categories();
        $this->load->view('admin/categories_view', $data);
    }
    
    public function get_category($id_category) {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Precios de Venta';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);        
        $data['category'] = $this->Categories_model->get_category($id_category);
        $this->load->view('admin/category_edit_view', $data);
    }
    
    public function add_category() {
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('desc'),
        );
        $res = $this->Categories_model->add_category($data);
        if($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
    
    public function edit_category() {
        $id_category = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('desc')
        );
        $res = $this->Categories_model->edit_category($id_category,$data);
        if($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
    
    public function delete_category() {
        $id_category = $this->input->post('idCategory');
        $res = $this->Categories_model->delete_category($id_category);
        if($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
    
    public function get_activities() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Precios de Venta';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);        
        $data['activities'] = $this->Activities_model->get_activities();
        $this->load->view('admin/activities_view', $data);
    }
    
    public function get_services() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Precios de Venta';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);        
        $data['activities'] = $this->Services_model->get_services();
        $this->load->view('admin/services_view', $data);
    }
    
    public function payment_methods() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Formas de pago';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);        
        $data['payments'] = $this->Payments_model->get_payments();
        $this->load->view('admin/payments_view', $data);
    }
    
    public function taxes() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Impuestos';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);        
        $data['taxes'] = $this->Payments_model->get_taxes();
        $this->load->view('admin/taxes_view', $data);
    }
   

}