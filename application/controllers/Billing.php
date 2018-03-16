<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

/**
 * Description of Billing
 *
 * @author jj
 */
class Billing extends CI_Controller {

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
        $data['titulo'] = 'Facturación';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['data'] = $this->Financial_model->get_settlement(27);
        $data['process'] = $this->Financial_model->get_settlement_process(28,$id_user);
        $this->load->view('invoice_view', $data);
    }

    public function register() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrderState' => $this->input->post('state'),
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'invoice' => $this->input->post('fdm'),
            'dateInvoice' => date('Y-m-d H:m:i')
        );
        $res = $this->Orders_model->update_order($idOrder, $data);
        if ($res === TRUE) {
            echo "ok";
        } else {
            echo "error";
        }
    }
    
    public function cancel() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'stateInvoice' => 1
        );
        $res = $this->Orders_model->update_order($idOrder, $data);
        if ($res === TRUE) {
            echo "ok";
        } else {
            echo "error";
        }
    }

}
