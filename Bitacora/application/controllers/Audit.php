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
        $data['stateLog'] = '7';
        $data['pl'] = $this->Audits_model->get_pl(9);
        $data['plprocess'] = $this->Audits_model->get_pl_process(7, $id_user);
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
        $data['stateLog'] = '8';
        $data['pl'] = $this->Audits_model->get_pl(10);
        $data['plprocess'] = $this->Audits_model->get_pl_process(8, $id_user);
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
        $data['stateLog'] = '9';
        $data['pl'] = $this->Audits_model->get_pl(11);
        $data['plprocess'] = $this->Audits_model->get_pl_process(9, $id_user);
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
        $this->load->view('coord_pays_view', $data);
    }

    public function pays_add() {
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
        $data['paysAdd'] = $this->Payments_model->get_pays_process(0, $id_user);
        $this->load->view('coord_pays_add_view', $data);
    }

    public function pays_process() {
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
        $data['paysProcess'] = $this->Payments_model->get_pays_process(1, $id_user);
        $this->load->view('coord_pays_process_view', $data);
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
        $this->load->view('financial_view', $data);
    }

    public function financial_process() {
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
        $data['pays_process'] = $this->Payments_model->get_pays_financial(11, $id_user);
        $this->load->view('financial_process_view', $data);
    }

    public function assign() {
        $idOrder = $this->input->post('idOrder');
        $idArea = $this->input->post('idArea');
        $idState = $this->input->post('idState');
        $idTech = $this->input->post('idTech');
        $stateLog = $this->input->post('stateLog');
        $data = array(
            'idArea' => $idArea,
            'idOrderState' => $idState,
            'historyBackState' => 0,
            'statePays' => 0,
            'dateAssign' => date('Y-m-d H:i:s'),
            'dateUpdate' => date('Y-m-d H:i:s'));
        $data2 = array(
            'idOrder' => $idOrder,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'idProcessState' => $stateLog,
            'stateLog' => 0
        );
        $this->Orders_model->register_log($data2);
        $res = $this->Visits_model->assign_order($idOrder, $data);
        if ($res === TRUE) {
            $titulo = '¡Has Sido Vinculado para el Inicio de la Siguiente Actividad!';
            $content = $this->Orders_model->get_order_by_email_coordext($idOrder);
            $technical = $this->Users_model->get_user_xid($idTech);
            $order = "";
            $this->Utils->sendMail($technical->email, 'Inicio de Actividades - BITACORA', 'templates/email_activitie_init.php', $technical, $content, $order, $titulo);
            echo 'ok';
        } else {
            echo $res;
        }
    }

    public function assign_percent() {
        $idOrder = $this->input->post('idOrder');
        $percent = $this->input->post('percent');
        $valor = $this->input->post('valor');
        $idTech = $this->input->post('idTech');
        $data = array(
            'idOrder' => $idOrder,
            'idTechnical' => $idTech,
            'percent' => $percent,
            'state' => 1,
            'value' => $valor);
        $data1 = array(
            'historyBackState' => 0,
            'statePays' => 1);
        $res = $this->Payments_model->assign_pay($idOrder, $data, $data1);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function process_pays() {
        $date = date('Y-m-d H:i:s');
        foreach (array_keys($_POST['idorder']) as $key) {
            $idorder = $_POST['idorder'][$key];
            $idtech = $_POST['idtech'][$key];
            $idpay = $_POST['idpay'][$key];
            $valor = $_POST['valor'][$key];
            $percent = $_POST['percent'][$key];
            $data = array(
                'idPay' => $idpay,
                'idOrder' => $idorder,
                'idTechnical' => $idtech,
                'percent' => $percent,
                'value' => $valor
            );
            $data1 = array(
                'state' => 2
            );
            $data2 = array(
                'idArea' => 3,
                'idOrderState' => 12,
                'historyBackState' => 0,
                'statepays' => 0,
                'dateUpdate' => $date
            );
            $data3 = array(
                'idOrder' => $idorder,
                'idUserProcess' => $this->session->userdata('id_usuario'),
                'idProcessState' => 11
            );
            $this->Orders_model->register_log($data3);
            $res = $this->Payments_model->process_pays($idorder, $idpay, $data, $data1, $data2);
            $this->generate_pdf($idpay);
        }
        if ($res === TRUE) {
            $this->session->set_flashdata('item', array('message' => 'Pagos registrados exitosamente', 'class' => 'success'));
            redirect('Audit/financial');
        } else {
            $this->session->set_flashdata('item', array('message' => 'Error en bbdd!', 'class' => 'error'));
            redirect('Audit/financial');
        }
    }

    public function remove_process_pays() {
        $idpay = $this->input->post('idpay');
        $id = $this->input->post('id');
        $data = array(
            'idArea' => 3,
            'idOrderState' => 13);
        $data1 = array(
            'state' => 1);
        $res = $this->Payments_model->remove_process_pays($id, $idpay, $data, $data1);
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

    public function history_assign_percent_aut() {
        $idOrder = $this->input->get('idOrder');
        $data['pays'] = $this->Payments_model->get_pays_order_aut($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function return_order_register_visit_site() {
        $idOrder = $this->input->post('idOrder');
        $idArea = $this->input->post('idArea');
        $idState = $this->input->post('idState');
        $stateLog = $this->input->post('stateLog');
        $data = array(
            'idArea' => $idArea,
            'idOrderState' => $idState,
            'historyBackState' => 1,
            'dateUpdate' => date('Y-m-d H:i:s')
        );
        $data2 = array(
            'idOrder' => $idOrder,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'idProcessState' => $stateLog,
            'stateLog' => 1
        );
        $this->Orders_model->register_log($data2);
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

    public function generate_pdf($param) {
        $data['pay'] = $this->Payments_model->get_pays_xid($param);
        $this->load->library('pdfgenerator');
        $html = $this->load->view('templates/pdf_factura', $data, true);
        $filename = 'report_' . $param;
        $folder = './reportes/pagos/';
        $this->pdfgenerator->saveDisk($filename, $html, $folder);
    }

}
