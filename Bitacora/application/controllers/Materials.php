<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

/**
 * Description of Audit
 *
 * @author jhon
 */
class Materials extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Audits_model', 'Users_model', 'Visits_model',
            'Activities_model', 'Orders_model', 'Services_model', 'Cellars_model',
            'Materials_model'));
    }

    public function index() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Gestión de Materiales';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['cellars'] = $this->Cellars_model->get_cellars();
        $data['materials'] = $this->Audits_model->get_pl(12);
        $this->load->view('materials_view', $data);
    }

    public function process() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Gestión de Materiales';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['cellars'] = $this->Cellars_model->get_cellars();
        $data['process'] = $this->Audits_model->get_pl_process(12, $id_user);
        $this->load->view('materials_process_view', $data);
    }

    public function get_materials_cellar_mer() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Gestión de Materiales Bodega Principal';
        $data['link'] = 'get_materials_cellar_mer';
        $data['link2'] = 'get_materials_cellar_mer_process';
        $data['cellar'] = '1';
        $data['state'] = '13';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['cellars'] = $this->Cellars_model->get_cellars();
        $data['materials'] = $this->Cellars_model->get_materials_cellar(1);
        $this->load->view('cellars_view', $data);
    }

    public function get_materials_cellar_mer_process() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Gestión de Materiales Bodega Principal';
        $data['link'] = 'get_materials_cellar_mer';
        $data['link2'] = 'get_materials_cellar_mer_process';
        $data['cellar'] = '1';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['cellars'] = $this->Cellars_model->get_cellars();
        $data['process'] = $this->Cellars_model->get_materials_cellar_process($id_user, 1, 13);
        $this->load->view('cellars_view_process', $data);
    }

    public function get_materials_cellar_ext() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Gestión de Materiales Bodega Externa';
        $data['link'] = 'get_materials_cellar_ext';
        $data['link2'] = 'get_materials_cellar_ext_process';
        $data['cellar'] = '2';
        $data['state'] = '14';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['cellars'] = $this->Cellars_model->get_cellars();
        $data['materials'] = $this->Cellars_model->get_materials_cellar(2);
        $this->load->view('cellars_view', $data);
    }

    public function get_materials_cellar_ext_process() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Gestión de Materiales Bodega Externa';
        $data['link'] = 'get_materials_cellar_ext';
        $data['link2'] = 'get_materials_cellar_ext_process';
        $data['cellar'] = '2';
        $data['state'] = '14';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['cellars'] = $this->Cellars_model->get_cellars();
        $data['process'] = $this->Cellars_model->get_materials_cellar_process($id_user, 2, 14);
        $this->load->view('cellars_view_process', $data);
    }

    public function get_materials() {
        $idOrder = $this->input->get('idOrder');
        $cellar = $this->input->get('cellar');
        $data['materials'] = $this->Materials_model->get_materials($idOrder, $cellar);
        $data['cellars'] = $this->Cellars_model->get_cellars();
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
    
    public function get_materials_back() {
        $idOrder = $this->input->get('idOrder');
        $cellar = $this->input->get('cellar');
        $data['materials'] = $this->Materials_model->get_materials_back($idOrder, $cellar);
        $data['cellars'] = $this->Cellars_model->get_cellars();
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_materials_cellar() {
        $idOrder = $this->input->get('idOrder');
        $data['materials'] = $this->Materials_model->get_materials_cellar($idOrder);
        $data['cellars'] = $this->Cellars_model->get_cellars();
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function assign() {
        $id = $this->input->post('id');
        $idOrder = $this->input->post('idOrder');
        $idCellar = $this->input->post('idCellar');
        $data = array(
            'idCellar' => $idCellar
        );
        $data1 = array(
            'idOrderState' => 16,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'dateUpdate' => date('Y-m-d H:i:s')
        );
        $res = $this->Materials_model->assign($id, $idOrder, $data, $data1);
        if ($res === TRUE) {
            echo $res;
        } else {
            echo $res;
        }
    }

    public function assign_state() {
        $id = $this->input->post('id');
        $state = $this->input->post('state');
        $data = array(
            'idStateCellar' => $state
        );
        $res = $this->Materials_model->assign_state($id, $data);
        if ($res === TRUE) {
            echo $res;
        } else {
            echo $res;
        }
    }

    public function assign_x_order() {

        if ($_FILES) {
            $archivo = $_FILES['pdfFile']['tmp_name'];
            move_uploaded_file($archivo, "./uploads/" . $_POST['idOrder'][0] . ".pdf");
        }

        if ($this->input->post('selcellarorder')) {
            foreach (array_keys($_POST['id']) as $key) {
                $idOrder = $_POST['idOrder'][$key];
            }
            $data = array('idCellar' => $this->input->post('selcellarorder'));
            $data1 = array(
                'idOrderState' => 16,
                'stateMaterial' => 1,
                'dateUpdate' => date('Y-m-d H:i:s')
            );
            $data2 = array(
                'idOrder' => $idOrder,
                'idUserProcess' => $this->session->userdata('id_usuario'),
                'idProcessState' => 12,
                'stateLog' => 0
            );
            $this->Orders_model->register_log($data2);
            $res = $this->Materials_model->assign_cellar_x_order($idOrder, $data, $data1);
        } else {
            foreach (array_keys($_POST['id']) as $key) {
                $id = $_POST['id'][$key];
                $idOrder = $_POST['idOrder'][$key];
                $idCellar = $_POST['selcellar'][$key];
                $data = array('idCellar' => $idCellar);
                $data1 = array(
                    'idOrderState' => 16,
                    'stateMaterial' => 1,
                    'dateUpdate' => date('Y-m-d H:i:s')
                );
                $res = $this->Materials_model->assign($id, $idOrder, $data, $data1);
            }
            $data2 = array(
                'idOrder' => $idOrder,
                'idUserProcess' => $this->session->userdata('id_usuario'),
                'idProcessState' => 12,
                'stateLog' => 0
            );
            $this->Orders_model->register_log($data2);
        }
        if ($res === TRUE) {
            $this->session->set_flashdata('item', array('message' => 'Material asignado a bodega exitosamente', 'class' => 'success'));
            redirect('Materials');
        } else {
            $this->session->set_flashdata('item', array('message' => 'Error en bbdd!', 'class' => 'error'));
            redirect('Materials');
        }
    }

    public function assign_materials_x_order() {
        $idOrder = $this->input->post('idOrder');
        $state = $this->input->post('state');
        $data = array(
            'idOrderState' => 17,
            'stateMaterial' => 1,
            'historybackState' => 0,
            'dateUpdate' => date('Y-m-d H:i:s')
        );
        $data2 = array(
            'idOrder' => $idOrder,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'idProcessState' => $state,
            'stateLog' => 0
        );
        $this->Orders_model->register_log($data2);
        $res = $this->Materials_model->assign_materials_x_order($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function register_back() {
        $id = $this->input->post('id');
        $idDetail = $this->input->post('idDetail');
        $data = array(
            'state' => 1
        );
        $data2 = array(
            'idStateCellar' => 2
        );
        $res = $this->Materials_model->register_back($id, $idDetail, $data, $data2);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function unregister_back() {
        $id = $this->input->post('id');
        $data = array(
            'state' => 0
        );
        $res = $this->Materials_model->unregister_back($id, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function register_materials_back() {
        $idOrder = $this->input->post('idOrder');
        $state = $this->input->post('state');
        $data = array(
            'idOrderState' => 24,
            'stateMaterial' => 3,
            'historybackState' => 0,
            'dateUpdate' => date('Y-m-d H:i:s')
        );
        $data1 = array(
            'idOrder' => $idOrder,
            'id_type_management' => 6,
            'detail' => 'Devolución recibida'
        );
        $data2 = array(
            'idOrder' => $idOrder,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'idProcessState' => $state,
            'stateLog' => 0
        );
        $this->Orders_model->register_log($data2);
        $res = $this->Materials_model->register_materials_back($idOrder, $data, $data1);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function pdf_order_materials($idOrder, $cellar) {
        $data['datos'] = $this->Orders_model->get_order_by_id($idOrder);
        $data['materials'] = $this->Materials_model->get_data_cellar_order($idOrder, $cellar);
        $html = $this->load->view('order_materials_report', $data, true);
        $this->generate_pdf($html);
    }

    public function pdf_materials_sql($ccost) {
        $data['datos'] = $this->Orders_model->get_order_by_id($ccost);
        $data['materials'] = $this->Materials_model->get_materials_cellar($ccost);
        $html = $this->load->view('materials_report', $data, true);
        $this->generate_pdf($html);
    }

    public function generate_pdf($data) {
        $this->load->library('pdfgenerator');
        $html = $data;
        $filename = 'report_' . time();
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }

}
