<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
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
class Orders extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Activities_model', 'Users_model', 'Payments_model',
            'Orders_model', 'Areas_model', 'Taxes_model', 'Cellars_model'));
    }

    public function index() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Registro orden de servicio';
        $data['activities'] = $this->Activities_model->get_activities_xtype(1);
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['formspay'] = $this->Payments_model->get_payments();
        $data['coordinators_int'] = $this->Users_model->get_coordinators_int();
        $data['coordinators_ext'] = $this->Users_model->get_coordinators_ext();
        $data['areas'] = $this->Areas_model->get_areas();
        $this->db->select_max('id');
        $result = $this->db->get('tbl_orders')->row_array();
        $idOrder = $result['id'];
        $data['order'] = $this->Orders_model->get_order_bitacora($idOrder, 1);
        $data['ordersTray'] = $this->Orders_model->get_orders_tray($id_user);
        $data['details'] = $this->Orders_model->get_order_details($idOrder, 1);
        $data['taxes'] = $this->Taxes_model->get_taxes();
        $data['tecs'] = $this->Users_model->get_tecs();
        $this->load->view('admin/register-orders', $data);
    }

    public function get_order() {
        $order = $this->input->get('order');
        $coi = $this->input->get('coi');
        $data['res'] = $this->Orders_model->get_order($order, $coi);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_order_xid() {
        $id = $this->input->get('idOrder');
        $data['res'] = $this->Orders_model->get_order_by_id($id);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_details() {
        $id = $this->input->get('id');
        $type = $this->input->get('type');
        $data['res'] = $this->Orders_model->get_order_details($id, $type);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
    
    public function get_services_order() {
        $idOrder = $this->input->get('idOrder');
        $data['serv'] = $this->Orders_model->get_services_order($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_details_service() {
        $id = $this->input->get('id');
        $idService = $this->input->get('idServices');
        $data['res'] = $this->Orders_model->get_details_service($id, $idService);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_details_order() {
        $idOrder = $this->input->get('idOrder');
        $data['docs'] = $this->Orders_model->get_docs($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_order_materials() {
        $idOrder = $this->input->get('idOrder');
        $data['materials'] = $this->Orders_model->get_materials($idOrder);
        $data['cellars'] = $this->Cellars_model->get_cellars();
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_order_materials_cellar() {
        $idOrder = $this->input->get('idOrder');
        $idCellar = $this->input->get('cellar');
        $data['materials'] = $this->Orders_model->get_materials_assign_by_cellar($idOrder, $idCellar);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
    
    public function get_order_materials_cellar_back() {
        $idOrder = $this->input->get('idOrder');
        $idCellar = $this->input->get('cellar');
        $data['materials'] = $this->Orders_model->get_materials_back_by_cellar($idOrder, $idCellar);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_observations_order() {
        $idOrder = $this->input->get('idOrder');
        $data['observations'] = $this->Orders_model->get_observations_order($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_observation_order() {
        $idOrder = $this->input->get('idOrder');
        $state = $this->input->get('state');
        $data['observation'] = $this->Orders_model->get_observation_order($idOrder, $state);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_observations_detail() {
        $id = $this->input->get('id');
        $data['obsv'] = $this->Orders_model->get_observations_detail($id);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    function add_order() {
        $type = $this->input->post('type');
        $data = array(
            'uniquecode' => $this->input->post('order'),
            'coi' => $this->input->post('coi'),
            'idUser' => $this->session->userdata('id_usuario'),
            'idOrderType' => $type,
            'idOrderState' => 1,
            'idUser' => $this->session->userdata('id_usuario'),
            'dateSave' => date('Y-m-d H:i:s')
        );
        $res = $this->Orders_model->add_order($data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    function update_head_order() {
        $id = $this->input->post('id');
        $data = array(
            'idCoordinatorExt' => $this->input->post('idCoorExt'),
            'idCoordinatorint' => $this->input->post('idCoorInt'),
            'idFormPay' => $this->input->post('idPay')
        );
        $res = $this->Orders_model->update_order($id, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function add_order_detail() {
        $data = array(
            'idOrder' => $this->input->post('idOrder'),
            'idActivities' => $this->input->post('idActivities'),
            'idServices' => $this->input->post('idServices'),
            'site' => $this->input->post('site'),
            'price' => $this->input->post('price'),
            'cost' => $this->input->post('cost'),
            'count' => $this->input->post('count'),
            'total' => $this->input->post('total'),
            'total_cost' => $this->input->post('totalCost'),
            'dateSave' => date('Y-m-d H:i:s')
        );
        $res = $this->Orders_model->add_order_detail($data);
        if ($res == true) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function remove_order_detail() {
        $id = $this->input->post('id');
        $res = $this->Orders_model->remove_order_detail($id);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function details_orders_tray() {
        $id = $this->input->get('idOrder');
        $data['details'] = $this->Orders_model->details_orders_tray($id);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function register_order() {
        $id = $this->input->post('id');
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            //obtenemos el archivo a subir
            $file = $_FILES['userfile']['name'];
            //comprobamos si existe un directorio para subir el archivo
            //si no es así, lo creamos
            if (!is_dir("./uploads/"))
                mkdir("./uploads/", 0777);
            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/" . $file)) {
                mkdir("./documents/" . $this->input->post('id'), 0777);
                $veryState = $this->verify_step($this->input->post('idArea'));
                $data = array(
                    'uniqueCodeCentralCost' => $this->input->post('uniqueCodeCentralCost'),
                    'idAreaSend' => $veryState['idArea'],
                    'idCoordinatorExt' => $this->input->post('idCoordinatorExt'),
                    'idCoordinatorInt' => $this->input->post('idCoordinatorInt'),
                    'idTechnicals' => $this->input->post('idTech'),
                    'idFormPay' => $this->input->post('idFormPay'),
                    'subtotal' => $this->input->post('subtotal'),
                    'discount' => $this->input->post('discount'),
                    'iva' => $this->input->post('idTax'),
                    'total' => $this->input->post('total'),
                    'idArea' => $veryState['idArea'],
                    'idOrderState' => $veryState['idState'],
                    'observations' => $this->input->post('observations'),
                    'idUser' => $this->session->userdata('id_usuario'),
                    'dateSave' => date('Y-m-d H:i:s')
                );
                $dataDoc1 = array(
                    'idTypeDocument' => $this->input->post('idTypeDocument1'),
                    'idOrder' => $this->input->post('id'),
                    'dateSave' => date('Y-m-d')
                );
                $dataDoc2 = array(
                    'idTypeDocument' => $this->input->post('idTypeDocument2'),
                    'idOrder' => $this->input->post('id'),
                    'dateSave' => date('Y-m-d')
                );
                $dataDoc3 = array(
                    'idTypeDocument' => $this->input->post('idTypeDocument3'),
                    'idOrder' => $this->input->post('id'),
                    'dateSave' => date('Y-m-d')
                );
                $dataDoc4 = array(
                    'idTypeDocument' => $this->input->post('idTypeDocument4'),
                    'idOrder' => $this->input->post('id'),
                    'dateSave' => date('Y-m-d')
                );
                $data2 = array(
                    'idOrder' => $this->input->post('id'),
                    'idUserProcess' => $this->session->userdata('id_usuario'),
                    'idProcessState' => 1,
                    'obsvLog' => $this->input->post('observations')
                );
                $this->Orders_model->register_log($data2);
                $this->Orders_model->upload_pdf($id, $file);
                $res = $this->Orders_model->register_order($id, $data, $dataDoc1, $dataDoc2, $dataDoc3, $dataDoc4);
                echo $this->valida($res);
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    function verify_step($area) {
        if ($area === '1') {
            $data = array('idArea' => 1, 'idState' => 2);
            return $data;
        }
        if ($area === '2') {
            $data = array('idArea' => 2, 'idState' => 7);
            return $data;
        }
        if ($area === '3') {
            $data = array('idArea' => 3, 'idState' => 9);
            return $data;
        }
        if ($area === '4') {
            $data = array('idArea' => 4, 'idState' => 13);
            return $data;
        }
    }

    function valida($res) {
        if ($res === true) {
            return 'ok';
        } else {
            return 'error';
        }
    }

    public function get_reg_photos_xid() {
        $id = $this->input->get('id');
        $res = $this->Orders_model->get_reg_photos_xid($id);
        $resultadosJson = json_encode($res->file);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_reg_photos_xid_stage2() {
        $id = $this->input->get('id');
        $res = $this->Orders_model->get_reg_photos_xid_stage2($id);
        $resultadosJson = json_encode($res->file2);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

}
