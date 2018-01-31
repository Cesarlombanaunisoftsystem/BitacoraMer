<?php

defined('BASEPATH') OR exit('No direct script access allowed');
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
        $this->load->model(array('Activities_model', 'Users_model', 'Payments_model', 'Orders_model', 'Areas_model', 'Taxes_model'));
    }

    public function index() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Registro orden de servicio';
        $data['activities'] = $this->Activities_model->get_activities_bts();
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['formspay'] = $this->Payments_model->get_payments();
        $data['coordinators_int'] = $this->Users_model->get_coordinators_int();
        $data['coordinators_ext'] = $this->Users_model->get_coordinators_ext();
        $data['areas'] = $this->Areas_model->get_areas();
        $this->db->select_max('id');
        $result = $this->db->get('tbl_orders')->row_array();
        $idOrder = $result['id'];
        $data['order'] = $this->Orders_model->get_order_bitacora($idOrder);
        $data['ordersTray'] = $this->Orders_model->get_orders_tray();
        $data['details'] = $this->Orders_model->get_order_details($idOrder);
        $data['taxes'] = $this->Taxes_model->get_taxes();
        $this->load->view('admin/register-orders', $data);
    }
    
    public function get_order() {
        $order = $this->input->get('order');
        $data['res'] = $this->Orders_model->get_order($order);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
    
    public function get_details() {
        $id = $this->input->get('id');
        $data['res'] = $this->Orders_model->get_order_details($id);
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
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
    
    public function get_observation_order() {
        $idOrder = $this->input->get('idOrder');
        $data['observation'] = $this->Orders_model->get_observation_order($idOrder);
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
        $data = array(
            'uniquecode' => $this->input->post('order'),
            'idUser' => $this->session->userdata('id_usuario'),
            'idOrderType' => 1,
            'idOrderState' => 1,
            'dateSave' => date('Y-m-d H:i:s')
        );
        $res = $this->Orders_model->add_order($data);
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
        if ($res == true) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function details_orders_tray() {
        $id = $this->input->post('idOrder');
        $res = $this->Orders_model->details_orders_tray($id);
        echo json_encode($res);
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
                $data = array(
                    'uniqueCodeCentralCost' => $this->input->post('uniqueCodeCentralCost'),
                    'idCoordinatorExt' => $this->input->post('idCoordinatorExt'),
                    'idCoordinatorInt' => $this->input->post('idCoordinatorInt'),
                    'idFormPay' => $this->input->post('idFormPay'),
                    'subtotal' => $this->input->post('subtotal'),
                    'discount' => $this->input->post('discount'),
                    'iva' => $this->input->post('idTax'),
                    'total' => $this->input->post('total'),
                    'totalCost' => $this->input->post('sumTotalCost'),
                    'idArea' => $this->input->post('idArea'),
                    'idOrderState' => 2,
                    'observations' => $this->input->post('observations'),
                    'idUser' => $this->session->userdata('id_usuario')
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
                sleep(3); //retrasamos la petición 3 segundos
                $this->Orders_model->upload_pdf($id, $file);
                $res = $this->Orders_model->register_order($id, $data, $dataDoc1, $dataDoc2, $dataDoc3, $dataDoc4);
                if ($res === true) {
                    echo 'ok';
                } else {
                    echo 'error';
                }
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }
}
