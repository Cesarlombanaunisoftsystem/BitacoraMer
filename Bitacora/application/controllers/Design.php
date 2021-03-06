<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

/**
 * Description of Visit
 *
 * @author jhon
 */
class Design extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Users_model', 'Visits_model', 'Orders_model', 'Utils'));
    }

    public function register() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Registro de Diseño';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['orders'] = $this->Orders_model->get_orders_design(2, 7);
        $data['tecs'] = $this->Users_model->get_tecs();
        $this->load->view('design_register_view', $data);
    }

    public function proccess() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Registro de Diseño';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['orders'] = $this->Orders_model->get_orders_design_process(5, $id_user);
        $data['tecs'] = $this->Users_model->get_tecs();
        $this->load->view('design_list_view', $data);
    }

    public function audit() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Auditoria de Diseño';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['orders'] = $this->Orders_model->get_orders_design(2, 8);
        $data['tecs'] = $this->Users_model->get_tecs();
        $this->load->view('design_audit_view', $data);
    }

    public function audit_process() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Auditoria de Diseño';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['orders'] = $this->Orders_model->get_orders_design_process(6, $id_user);
        $data['tecs'] = $this->Users_model->get_tecs();
        $this->load->view('design_audit_process_view', $data);
    }

    public function return_order_design() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idArea' => 1,
            'idOrderState' => $this->input->post('state'),
            'historybackState' => 1,
            'dateUpdate' => date('Y-m-d H:i:s'));
        $data2 = array(
            'idOrder' => $idOrder,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'idProcessState' => 5,
            'obsvLog' => $this->input->post('obsv'),
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
    
    public function return_order_design_audit() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrderState' => 7,
            'historybackState' => 1,
            'dateUpdate' => date('Y-m-d H:i:s'));
        $data2 = array(
            'idOrder' => $idOrder,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'idProcessState' => 6,
            'obsvLog' => $this->input->post('obsv'),
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

    function register_order_design() {
        $idOrder = $this->input->post('idOrder');
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            //obtenemos el archivo a subir
            $file = $_FILES['file']['name'];
            if (!$file) {
                echo "ko";
            }
            //comprobamos si existe un directorio para subir el archivo
            //si no es así, lo creamos
            if (!is_dir("./uploads/"))
                mkdir("./uploads/", 0777);
            //comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['file']['tmp_name'], "./uploads/" . $file)) {
                $data = array(
                    'idTypeDocument' => '6',
                    'idOrder' => $idOrder,
                    'file' => $file,
                    'idState' => 1,
                    'dateSave' => date('Y-m-d H:i:s')
                );
                $this->Orders_model->add_order_document($data);
                $data1 = array(
                    'idArea' => '2',
                    'idOrderState' => '8',
                    'historybackState' => 0,
                    'dateUpdate' => date('Y-m-d H:i:s')
                );
                $data2 = array(
                    'idOrder' => $idOrder,
                    'idProcessState' => 5,
                    'idUserProcess' => $this->session->userdata('id_usuario'),
                    'stateLog' => 0,
                    'obsvLog' => $this->input->post('observacion')
                );
                $this->Orders_model->register_log($data2);
                $titulo = 'MER INFRAESTRUCTURA COLOMBIA';
                $content = $this->Orders_model->get_order_by_email_coordext($idOrder);
                $technical = "";
                $order = "";
                $this->Utils->sendMail($content->email, 'Auditoria de Diseño MER INFRAESTRUCTURA  - BITACORA', 'templates/review_design.php', $technical, $content, $order, $titulo);
                $res = $this->Orders_model->update_order($idOrder, $data1);
                echo $this->valida($res);
            }
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    function valida($res) {
        if ($res === TRUE) {
            return 'ok';
        } else {
            return 'error';
        }
    }

    function approved_order_design() {
        $data = array(
            'idArea' => '3',
            'idOrderState' => '9',
            'dateUpdate' => date('Y-m-d H:i:s')
        );
        $data2 = array(
            'idOrder' => $this->input->post('idOrder'),
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'idProcessState' => 6,
            'obsvLog' => $this->input->post('obsv'),
            'stateLog' => 0
        );
        $this->Orders_model->register_log($data2);
        $res = $this->Orders_model->update_order($this->input->post('idOrder'), $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

}
