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
class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Users_model', 'Permits_model'));
    }

    public function index() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Usuarios';
        $id_user = $this->session->userdata('id_usuario');
        $data['roles'] = $this->Users_model->get_roles();
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['usuarios'] = $this->Users_model->get_users();
        $this->load->view('admin/users_view', $data);
    }

    public function get_user($id_user_assign) {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Editar Usuario';
        $id_user = $this->session->userdata('id_usuario');
        $data['titulos'] = $this->Permits_model->get_permits();
        $data['roles'] = $this->Users_model->get_roles();
        $data['perfil'] = $this->Users_model->get_user_xid($id_user_assign);
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $this->load->view('admin/user_edit_view', $data);
    }

    public function add_user() {
        $data = array(
            'name_user' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => sha1($this->input->post('passw')),
            'mobile' => $this->input->post('cel'),
            'phone' => $this->input->post('tel'),
            'idUserProfile' => $this->input->post('rol'),
            'dateSave' => date('Y-m-d')
        );
        $res = $this->Users_model->add_user($data);
        if($res === TRUE) {
            echo 'ok';
        } else if($res === FALSE) {
            echo 'error';
        } else if($res === 'error'){
            echo 'ko';
        }
    }
    
    public function edit_user() {
        $id_user = $this->input->post('id');
        $data = array(
            'name_user' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('cel'),
            'phone' => $this->input->post('tel'),
            'idUserProfile' => $this->input->post('rol')
        );
        $res = $this->Users_model->edit_user($id_user,$data);
        if($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
    
    public function delete_user() {
        $id_user = $this->input->post('idUser');
        $res = $this->Users_model->delete_user($id_user);
        if($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function get_user_permits($id_user_assign) {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Permisos Usuario';
        $id_user = $this->session->userdata('id_usuario');
        $data['titulos'] = $this->Permits_model->get_permits();
        $data['perfil'] = $this->Users_model->get_user_xid($id_user_assign);
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['permisos'] = $this->Users_model->get_user_permits($id_user_assign);
        $this->load->view('admin/user_permits_view', $data);
    }

    public function add_permit() {
        $id_permit = $this->input->post('idPermit');
        $id_user_assign = $this->input->post('idUsuario');
        $res = $this->Users_model->add_permit($id_permit, $id_user_assign);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function remove_permit() {
        $id_permit = $this->input->post('idPermit');
        $id_user_assign = $this->input->post('idUsuario');
        $res = $this->Users_model->remove_permit($id_permit, $id_user_assign);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

}
