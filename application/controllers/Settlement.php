<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

/**
 * Description of Settlement
 *
 * @author JHON JAIRO VALDÉS ARISTIZABAL
 */
class Settlement extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Users_model', 'Financial_model'));
    }
    
    public function index() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Centro de Liquidación';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['data'] = $this->Financial_model->get_settlement(25);
        $data['process'] = $this->Financial_model->get_settlement(26);
        $this->load->view('settlement_view', $data);
    }
    
    public function audit() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Auditoria Centro de Liquidación';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['data'] = $this->Financial_model->get_settlement(26);
        $data['process'] = $this->Financial_model->get_settlement(27);
        $this->load->view('settlement_audit_view', $data);
    }
    
    public function getSaleHead() {
        $idOrder = $this->input->get('idOrder');
        $data['res'] = $this->Financial_model->getSaleHead($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function getSettlement() {
        $idOrder = $this->input->get('idOrder');
        $data['res'] = $this->Financial_model->getVrSettlement($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function getPayContract() {
        $idOrder = $this->input->get('idOrder');
        $data['res'] = $this->Financial_model->getPayContract($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
    
    public function getPayMaterials() {
        $idOrder = $this->input->get('idOrder');
        $data['res'] = $this->Financial_model->getPayMaterials($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
    
    public function getPayAditionals() {
        $idOrder = $this->input->get('idOrder');
        $data['res'] = $this->Financial_model->getPayAditionals($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
    
    public function getDetailsSale() {
        $id = $this->input->get('idOrder');
        $data['res'] = $this->Financial_model->getDetailsSale($id);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

}
