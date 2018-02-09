<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Audit
 *
 * @author jhon
 */
class Audit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Users_model', 'Audits_model', 'Visits_model', 'Activities_model', 'Orders_model', 'Services_model', 'Payments_model'));
    }

    public function pl_1() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Presupuesto PL -Auditoria 1-';
        $data['controller'] = '_1';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['areaReturn'] = '1';
        $data['stateReturn'] = '4';
        $data['areaAssign'] = '3';
        $data['stateAssign'] = '10';
        $data['pl'] = $this->Audits_model->get_pl(9);
        $this->load->view('audit_pl_view', $data);
    }

    public function pl_2() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Presupuesto PL -Auditoria 2-';
        $data['controller'] = '_2';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['areaReturn'] = '3';
        $data['stateReturn'] = '9';
        $data['areaAssign'] = '3';
        $data['stateAssign'] = '11';
        $data['pl'] = $this->Audits_model->get_pl(10);
        $this->load->view('audit_pl_view', $data);
    }

    public function pl_3() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Presupuesto PL -Aprobación-';
        $data['controller'] = '_3';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['areaReturn'] = '3';
        $data['stateReturn'] = '9';
        $data['areaAssign'] = '3';
        $data['stateAssign'] = '12';
        $data['pl'] = $this->Audits_model->get_pl(11);
        $this->load->view('audit_pl_view', $data);
    }

    public function auth_pay() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Autorización de pagos';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['pays'] = $this->Audits_model->get_pl(12);
        $data['paysAdd'] = $this->Audits_model->get_pl(13);
        $data['paysProcess'] = $this->Audits_model->get_pl(14);
        $this->load->view('coord_pays_view', $data);
    }

    public function financial() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Financiero';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['pays'] = $this->Audits_model->get_pl(13);
        $this->load->view('financial_view', $data);
    }

    public function assign() {
        $idOrder = $this->input->post('idOrder');
        $idArea = $this->input->post('idArea');
        $idState = $this->input->post('idState');
        $data = array(
            'idArea' => $idArea,
            'idOrderState' => $idState,
            'historyBackState' => 0);
        $res = $this->Visits_model->assign_order($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo $res;
        }
    }

    public function assign_percent() {
        $idOrder = $this->input->post('idOrder');
        $percent = $this->input->post('percent');
        $value = $this->input->post('value');
        $data = array(
            'idOrder' => $idOrder,
            'percent' => $percent,
            'value' => $value);
        $data1 = array(
            'idArea' => 3,
            'idOrderState' => 13,
            'historyBackState' => 0);
        $res = $this->Payments_model->assign_pay($idOrder, $data, $data1);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function history_assign_percent() {
        $idOrder = $this->input->get('idOrder');
        $data['pays'] = $this->Payments_model->get_pays_order($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function return_order_register_visit_site() {
        $idOrder = $this->input->post('idOrder');
        $idArea = $this->input->post('idArea');
        $idState = $this->input->post('idState');
        $data = array(
            'idArea' => $idArea,
            'idOrderState' => $idState,
            'historyBackState' => 1
        );
        $res = $this->Visits_model->return_order($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function get_details_service() {
        $id = $this->input->get('id');
        $data['res'] = $this->Orders_model->get_details_xid($id);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function edit_detail() {
        $id = $this->input->post('idDetail');
        $idService = $this->input->post('idServices');
        $sql = $this->db->get_where('tbl_services', array('id' => $idService))->result();
        foreach ($sql as $val) {
            $idActivitie = $val->idActivitie;
            $price = $val->price;
            $cost = $val->cost;
        }
        $data = array(
            'idActivities' => $idActivitie,
            'idServices' => $this->input->post('idServices'),
            'count' => $this->input->post('quantity'),
            'price' => $price,
            'cost' => $cost,
            'total' => $price * $this->input->post('quantity'),
            'total_cost' => $cost * $this->input->post('quantity')
        );
        $res = $this->Audits_model->edit_detail($id, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

}
