<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

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
        $this->load->model(array('Users_model', 'Audits_model', 'Visits_model', 'Activities_model', 'Orders_model', 'Services_model', 'Payments_model', 'Utils'));
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
        $data['plprocess'] = $this->Audits_model->get_pl(10);
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
        $data['plprocess'] = $this->Audits_model->get_pl(11);
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
        $data['plprocess'] = $this->Audits_model->get_pl(12);
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
        $data['pays'] = $this->Payments_model->get_pays_box();
        $data['paysAdd'] = $this->Payments_model->get_pays(2);
        $data['paysProcess'] = $this->Payments_model->get_pays(2);
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
        $data['pays'] = $this->Payments_model->get_pays(1);
        $data['pays_process'] = $this->Payments_model->get_pays(2);
        $this->load->view('financial_view', $data);
    }

    public function assign() {
        $idOrder = $this->input->post('idOrder');
        $idArea = $this->input->post('idArea');
        $idState = $this->input->post('idState');
        $idTech = $this->input->post('idTech');
        $data = array(
            'idArea' => $idArea,
            'idOrderState' => $idState,
            'historyBackState' => 0,
            'dateAssign' => date('Y-m-d H:i:s'));
        $res = $this->Visits_model->assign_order($idOrder, $data);
        if ($res === TRUE) {
            $titulo = '¡Has Sido Vinculado para el Inicio de la Siguiente Actividad!';
            $technical = $this->Users_model->get_user_xid($idTech);
            $content = $this->Orders_model->get_order_by_id_email($idOrder);
            $this->Utils->sendMail($technical->email, 'Inicio de Actividades - BITACORA', 'templates/email_activitie_init.php', $content, $titulo);
            echo 'ok';
        } else {
            echo $res;
        }
    }

    public function assign_percent() {
        $idOrder = $this->input->post('idOrder');
        $percent = $this->input->post('percent');
        $value = $this->input->post('value');
        $idTech = $this->input->post('idTech');
        $data = array(
            'idOrder' => $idOrder,
            'idTechnical' => $idTech,
            'percent' => $percent,
            'value' => $value);
        $data1 = array(
            'statePays' => 1,
            'historyBackState' => 0);
        $res = $this->Payments_model->assign_pay($idOrder, $data, $data1);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function process_pays() {
        $id = $this->input->post('id');
        $data = array(
            'idOrder' => $id,
            'state' => 2,
            'dateUpdate' => date('Y-m-d H:i:s'));
        $data1 = array(
            'idArea' => 3,
            'idOrderState' => 12,
            'historyBackState' => 0);
        $res = $this->Payments_model->process_pays($id, $data, $data1);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function remove_process_pays() {
        $id = $this->input->post('id');
        $data = array(
            'idOrder' => $id,
            'state' => 0);
        $data1 = array(
            'idArea' => 3,
            'idOrderState' => 13);
        $res = $this->Payments_model->remove_process_pays($id, $data, $data1);
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

    public function pdf_pays() {
        $data['pays'] = $this->Payments_model->get_pays_xusers();
        $arr = array('state' => 1);
        $this->Payments_model->remove_pays_state($arr);
        $this->load->library('pdfgenerator');
        $html = $this->load->view('pays_report', $data, true);
        $filename = 'report_' . time();
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }

}
