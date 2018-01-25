<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Visit
 *
 * @author jhon
 */
class Visit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Users_model', 'Visits_model', 'Orders_model', 'Utils'));
    }

    public function program() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Programación de visita a sitio';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['visits'] = $this->Visits_model->get_orders_state2();
        $data['tecs'] = $this->Users_model->get_tecs();
        $this->load->view('visit_program_view', $data);
    }

    public function assigns() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Programación de visita a sitio';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['visits'] = $this->Visits_model->get_orders_assign_technics();
        $this->load->view('visit_assign_view', $data);
    }

    public function assign() {
        $idOrder = $this->input->post('idOrder');
        $idUser = $this->input->post('idTech');
        $data = array(
            'idTechnicals' => $idUser,
            'date' => $this->input->post('date'),
            'idArea' => 1,
            'idOrderState' => 3);
        $res = $this->Visits_model->assign_order_technic($idOrder, $data);
        if ($res === TRUE) {
            $technical = $this->Users_model->get_user_xid($idUser);
            $content = $this->Orders_model->get_order_by_id_email($idOrder);
            $this->Utils->sendMail($technical->email, 'Programación de visita a sitio', 'templates/email_tecnico.php', $content);            
            echo 'ok';
        } else {
            echo $res;
        }
    }

    public function return_order_register() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idArea' => NULL,
            'idOrderState' => 1);
        $res = $this->Visits_model->return_order_register($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function return_order_assign() {
        $idOrder = $this->input->post('idOrder');
        $obsv = $this->input->post('obsvGen');
        $data = array(
            'idArea' => 1,
            'idOrderState' => 2,
            'observations' => $obsv);
        $res = $this->Visits_model->return_order_register($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
    
    public function register_order_validate() {
        $idOrder = $this->input->post('idOrder');
        $obsv = $this->input->post('obsvGen');
        $data = array(
            'idArea' => 1,
            'idOrderState' => 4,
            'observations' => $obsv);
        $res = $this->Visits_model->register_order_validate($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function site_init() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Registro de datos visitas inicial al sitio';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['visits'] = $this->Visits_model->get_orders_assign_technics();
        $this->load->view('visit_init_register_data_view', $data);
    }

    public function get_docs_visit_init_register() {
        $idOrder = $this->input->get('idOrder');
        $data['docs'] = $this->Orders_model->get_docs($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
}
