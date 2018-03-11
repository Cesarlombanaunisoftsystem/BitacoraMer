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
        $this->load->model(array('Users_model', 'Orders_model', 'Financial_model',
            'Payments_model', 'Materials_model', 'Activities_model', 'Utils'));
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
        $data['categories'] = $this->Activities_model->get_activities_xtype(8);
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

    public function getPays() {
        $idOrder = $this->input->get('idOrder');
        $data['res'] = $this->Financial_model->getPays($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function getPayContract() {
        $idOrder = $this->input->get('idOrder');
        $data['res'] = $this->Financial_model->getPayContract($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function getDetailsPays() {
        $idOrder = $this->input->get('idOrder');
        $data['res'] = $this->Financial_model->getPays($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function getPayMaterials() {
        $idOrder = $this->input->get('idOrder');
        $data['res'] = $this->Financial_model->getPayMaterials($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function getDetailsMaterials() {
        $idOrder = $this->input->get('idOrder');
        $data['res'] = $this->Materials_model->get_materials_cellar($idOrder);
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

    public function getDetailsAdd() {
        $id = $this->input->get('idOrder');
        $data['res'] = $this->Financial_model->getDetailsAdd($id);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function register() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrderState' => 26
        );
        $res = $this->Orders_model->update_order($idOrder, $data);
        if ($res === TRUE) {
            $titulo = 'MER GROUP, Agradece su participación como integrante fundamental de nuestros procesos, de esta manera queremos  compartir con usted la siguiente  información para el trámite de auditoria de liquidación';
            $content = $this->Orders_model->get_order_by_email_coordext($idOrder);
            $this->Utils->sendMail($content->email, 'Auditoria de Liquidación - MER', 'templates/email_audit_settlement.php', $content, $titulo);
            echo "ok";
        } else {
            echo "error";
        }
    }

    public function addAditionals() {
        $data = array(
            'idOrder' => $this->input->post('idOrder'),
            'idActivities' => $this->input->post('idActivities'),
            'idServices' => $this->input->post('idServices'),
            'cost' => $this->input->post('cost')
        );
        $this->Orders_model->add_order_detail($data);
    }

    public function updateCount() {
        $id = $this->input->post('id');
        $data = array(
            'count' => $this->input->post('count'),
            'total_cost' => $this->input->post('total_cost')
        );
        $res = $this->Orders_model->update_order_detail($id, $data);
        if ($res == true) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function updateObsv() {
        $id = $this->input->post('id');
        $data = array(
            'observation' => $this->input->post('obsv')
        );
        $res = $this->Orders_model->update_order_detail($id, $data);
        if ($res == true) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

}
