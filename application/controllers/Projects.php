<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Projects
 *
 * @author jj
 */
class Projects extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Users_model', 'Orders_model', 'Projects_model', 'Utils'));
    }

    public function activitie_init() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Mis Proyectos';
        $id_user = $this->session->userdata('id_usuario');
        if ($this->session->userdata('id_profile') !== '4') {
            $data['type'] = 'INICIO DE ACTIVIDAD';
        } else {
            $data['type'] = 'AUDITORIA COORDINADOR';
        }
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['projects'] = $this->Projects_model->get_daily_management(12);
        $data['registers'] = $this->Projects_model->get_daily_management(18);
        $this->load->view('activitie_init_view', $data);
    }

    public function register_activitie() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrderState' => 18
        );
        $res = $this->Orders_model->assign_state($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function get_daily_management() {
        $idOrder = $this->input->get('idOrder');
        $data['res'] = $this->Projects_model->get_daily_management_order($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_daily_management_xid() {
        $id = $this->input->get('id');
        $data['res'] = $this->Projects_model->get_daily_management_xid($id);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function register_daily_management() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            $idOrder = $this->input->post('idOrderDaily');
            $attendant = $this->input->post('attendant');
            $content = $this->input->post('detailgest');
            $order = $this->Orders_model->get_order_by_id($idOrder);
            $idcoordinator = $order->idCoordinatorInt;
            $coordinator = $this->Users_model->get_user_xid($idcoordinator);
            if ($attendant === '1') {
                $this->Utils->sendMail($coordinator->email, 'Atención a Gestión Contratista, Orden No:' . $idOrder, 'templates/email_coordinator.php', $content);
            }
            //obtenemos el archivo a subir
            $file = $_FILES['userfile']['name'];
            //comprobamos si existe un directorio para subir el archivo
            //si no es así, lo creamos
            if (!is_dir("./uploads/"))
                mkdir("./uploads/", 0777);
            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/" . $file)) {
                $data = array(
                    'idOrder' => $this->input->post('idOrderDaily'),
                    'type_management' => $this->input->post('typegest'),
                    'detail' => $this->input->post('detailgest'),
                    'percent_execute' => $this->input->post('valpercentexe'),
                    'percent_materials' => $this->input->post('valpercentmat'),
                    'check_attention' => $this->input->post('attendant'),
                    'image' => $file
                );
                $res = $this->Projects_model->register_daily_management_order($data);
                echo $this->valida($res);
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    function valida($res) {
        if ($res === true) {
            return 'ok';
        } else {
            return 'error';
        }
    }

}
