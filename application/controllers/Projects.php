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
        $data['types'] = $this->Projects_model->get_types_management();
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['projects'] = $this->Projects_model->get_daily_management(12);
        $data['registers'] = $this->Projects_model->get_daily_management_contract();
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

    public function get_accum_management() {
        $idOrder = $this->input->get('idOrder');
        $data['accums'] = $this->Projects_model->get_accum_management($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_daily_management_xid() {
        $id = $this->input->get('id');
        $data['res'] = $this->Projects_model->get_daily_management_xid($id);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function get_photos_daily_xid() {
        $id = $this->input->get('id');
        $res = $this->Projects_model->get_photos_daily_xid($id);
        $resultadosJson = json_encode($res->image);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function register_daily_management() {
        $images = "";
        $idOrder = $this->input->post('idOrderDaily');
        $attendant = $this->input->post('attendant');
        $content = $this->input->post('detailgest');
        $uniquecode = $this->input->post('uniquecode');
        $order = $this->Orders_model->get_order_by_id($idOrder);
        $idcoordinator = $order->idCoordinatorInt;
        $coordinator = $this->Users_model->get_user_xid($idcoordinator);
        if ($attendant === '1') {
            $this->Utils->sendMail($coordinator->email, 'Atención a Gestión Contratista, Orden No:' . $uniquecode, 'templates/email_coordinator.php', $content);
        }
        //obtenemos el archivo a subir
        $file = $_FILES['userfile']['name'];
        $quantity = count($file);
        //comprobamos si existe un directorio para subir el archivo
        //si no es así, lo creamos
        if (!is_dir("./uploads/"))
            mkdir("./uploads/", 0777);
        for ($i = 0; $i < $quantity; $i++) {
            //subimos el archivo ha subido
            move_uploaded_file($_FILES['userfile']['tmp_name'][$i], "./uploads/" . $file[$i]);
            //guardamos en la base de datos el nombre
            $images .= $file[$i] . ",";
        }
        $image = trim($images, ',');
        // comprobamos si es una solicitud de visita de cierre o sino una gestion diaria
        if ($this->input->post('typegest') === '2') {
            $data = array(
                'idOrder' => $this->input->post('idOrderDaily'),
                'id_type_management' => $this->input->post('typegest'),
                'detail' => $this->input->post('detailgest'),
                'percent_execute' => $this->input->post('valpercentexe'),
                'percent_materials' => $this->input->post('valpercentmat'),
                'check_attention' => $this->input->post('attendant'),
                'image' => $image
            );
            $data1 = array(
                'observations' => $this->input->post('detailgest'),
                'idOrderState' => 19
            );
            $res = $this->Projects_model->closing_visit_request($data, $idOrder, $data1);
            echo $this->valida($res);
        } else {
            $data = array(
                'idOrder' => $this->input->post('idOrderDaily'),
                'id_type_management' => $this->input->post('typegest'),
                'detail' => $this->input->post('detailgest'),
                'percent_execute' => $this->input->post('valpercentexe'),
                'percent_materials' => $this->input->post('valpercentmat'),
                'check_attention' => $this->input->post('attendant'),
                'image' => $image
            );
            $res = $this->Projects_model->register_daily_management_order($data);
            echo $this->valida($res);
        }
    }

    public function register_daily_management_coord() {
        $images = "";
        $idOrder = $this->input->post('idOrderDaily');
        //obtenemos el archivo a subir
        $file = $_FILES['userfile']['name'];
        $quantity = count($file);
        //comprobamos si existe un directorio para subir el archivo
        //si no es así, lo creamos
        if (!is_dir("./uploads/"))
            mkdir("./uploads/", 0777);
        for ($i = 0; $i < $quantity; $i++) {
            //subimos el archivo ha subido
            move_uploaded_file($_FILES['userfile']['tmp_name'][$i], "./uploads/" . $file[$i]);
            //guardamos en la base de datos el nombre
            $images .= $file[$i] . ",";
        }
        $image = trim($images, ',');
        // comprobamos si es una solicitud de visita de cierre o sino una gestion diaria
        if ($this->input->post('typegest') === '4') {
            $data = array(
                'idOrder' => $idOrder,
                'id_type_management' => $this->input->post('typegest'),
                'detail' => $this->input->post('detailgest'),
                'image' => $image
            );
            $data1 = array(
                'observations' => $this->input->post('detailgest'),
                'idOrderState' => 22
            );
            $res = $this->Projects_model->closing_visit_request($data, $idOrder, $data1);
            echo $this->valida($res);
        } else {
            $data = array(
                'idOrder' => $idOrder,
                'id_type_management' => $this->input->post('typegest'),
                'detail' => $this->input->post('detailgest'),
                'image' => $image
            );
            $data1 = array(
                'idOrderState' => 21
            );
            $res = $this->Projects_model->closing_visit_request($data, $idOrder, $data1);
            echo $this->valida($res);
        }
    }

    public function closing_visit_request() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Mis Proyectos';
        $id_user = $this->session->userdata('id_usuario');
        $data['types'] = $this->Projects_model->get_types_management();
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['projects'] = $this->Projects_model->get_daily_managements();
        $data['registers'] = $this->Projects_model->get_daily_management(22);
        $this->load->view('closing_visit_request_view', $data);
    }

    public function mark_closing_visit() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrderState' => 20
        );
        $res = $this->Orders_model->assign_state($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
    
    public function mark_closing_visit_audit() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrderState' => 22
        );
        $res = $this->Orders_model->assign_state($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function back_closing_visit() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrderState' => 18,
            'observations' => $this->input->post('obsv')
        );
        $res = $this->Orders_model->assign_state($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
    
    public function back_closing_visit_audit() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrderState' => 19,
            'observations' => $this->input->post('obsv')
        );
        $res = $this->Orders_model->assign_state($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    function valida($res) {
        if ($res === TRUE) {
            return 'ok';
        } else {
            return 'error';
        }
    }

}
