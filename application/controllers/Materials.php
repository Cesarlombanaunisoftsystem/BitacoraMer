<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
        $data['process'] = $this->Audits_model->get_pl(16);
        $this->load->view('materials_view', $data);
    }

    public function get_materials_cellar_mer() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Gestión de Materiales Bodega Principal';
        $data['link'] = 'get_materials_cellar_mer';
        $data['cellar'] = '1';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['cellars'] = $this->Cellars_model->get_cellars();
        $data['materials'] = $this->Cellars_model->get_materials_cellar(16);
        $data['process'] = $this->Cellars_model->get_materials_cellar(17);
        $this->load->view('cellars_view', $data);
    }
    
    public function get_materials_cellar_ext() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Gestión de Materiales Bodega Externa';
        $data['link'] = 'get_materials_cellar_ext';
        $data['cellar'] = '2';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $data['cellars'] = $this->Cellars_model->get_cellars();
        $data['materials'] = $this->Cellars_model->get_materials_cellar(16);
        $data['process'] = $this->Cellars_model->get_materials_cellar(17);
        $this->load->view('cellars_view', $data);
    }

    public function get_materials() {
        $idOrder = $this->input->get('idOrder');
        $cellar = $this->input->get('cellar');
        $data['materials'] = $this->Materials_model->get_materials($idOrder,$cellar);
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
            'idOrderState' => 16
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
        $id = $this->input->post();
        $idOrder = $this->input->post('idOrder');
        $idCellar = $this->input->post('selcellar');
        $data = array('idCellar' => $idCellar);
        $data1 = array(
            'idOrderState' => 16
        );
        foreach ($id as $key => $value) {
            if ($key !== 'selcellar') {
                $this->Materials_model->assign($value, $idOrder, $data, $data1);
            }
        }
        echo 'ok';
    }

    public function assign_materials_x_order() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrderState' => 17
        );
        $res = $this->Materials_model->assign_materials_x_order($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
    
    public function pdf_order_materials($idOrder,$cellar) {
        $data['datos'] = $this->Orders_model->get_order_by_id($idOrder);
        $data['materials'] = $this->Materials_model->get_data_cellar_order($idOrder,$cellar);
        $html = $this->load->view('order_materials_report', $data, true);
        $this->generate_pdf($html);
    }

    public function pdf_materials_sql($ccost) {
        $data['datos'] = $this->Orders_model->get_order_by_id($ccost);
        $data['materials'] = $this->Materials_model->get_data_cellar_order($ccost);
        $html = $this->load->view('materials_report', $data, true);
        $this->pdf_materials($html);
    }

    public function generate_pdf($data) {
        $this->load->library('pdfgenerator');
        $html = $data;
        $filename = 'report_' . time();
        $this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
    }

}
