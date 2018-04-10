<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Documents
 *
 * @author jj
 */
class Documents extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Users_model', 'Orders_model',
            'Projects_model', 'Docs_model',
            'Utils'));
    }

    public function index() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Centro de Documentación';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['orders'] = $this->Docs_model->register_docs(0);
        $this->load->view('documents_view', $data);
    }

    public function process() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Centro de Documentación';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['orders'] = $this->Docs_model->register_docs_process(1,$id_user);
        $this->load->view('documents_process_view', $data);
    }
    
    public function audit() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Auditoria de Documentación';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['orders'] = $this->Projects_model->register_data_close_visit(24);
        $this->load->view('audit_documents_view', $data);
    }
    
    public function audit_process() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Auditoria de Documentación';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['orders'] = $this->Projects_model->register_data_close_visit_process(25,$id_user);
        $this->load->view('audit_documents_process_view', $data);
    }

    public function get_documents_order() {
        $idOrder = $this->input->get('idOrder');
        $data['res'] = $this->Docs_model->get_documents_order($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function register_order() {
        $id = $this->input->post('idOrder');
        $data = array(
            'stateDoc' => 1,
            'dateUpdate' => date('Y-m-d H:i:s'));
        $res = $this->Orders_model->update_order($id, $data);
        if ($res == true) {
            echo 'ok';
        } else {
            echo 'error';
        }   
    }

    public function assign() {
        $id = $this->input->post('idOrder');
        $data = array(
            'idArea' => 3,
            'idOrderState' => 24,
            'historybackState' => 0,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'dateUpdate' => date('Y-m-d H:i:s'));
        $res = $this->Orders_model->update_order($id, $data);
        if ($res === TRUE) {
            $param = "";
            $titulo = 'MER GROUP, Agradece su participación como integrante fundamental de nuestros procesos, de esta manera queremos  compartir con usted la siguiente información para el trámite de auditoria de documentación';
            $content = $this->Orders_model->get_order_by_email_coordext($id);
            $this->Utils->sendMail($content->email, 'Auditoria de Documentación - MER', 'templates/email_audit_settlement.php', $content, $titulo, $order="",$param);
            echo 'ok';
        } else {
            echo 'error';
        }
    }

}
