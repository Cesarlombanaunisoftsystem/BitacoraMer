<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
        $data['orders'] = $this->Orders_model->get_orders_design(2,7);
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
        $data['orders'] = $this->Orders_model->get_orders_design(3,9);
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
        $data['orders'] = $this->Orders_model->get_orders_design(2,8);
        $data['tecs'] = $this->Users_model->get_tecs();
        $this->load->view('design_audit_view', $data);
    }

    public function return_order_design() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idArea' => 2,
            'idOrderState' => $this->input->post('state'));
        $res = $this->Visits_model->return_order($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    function register_order_design() {
        $dir_subida = './uploads/';
        $filename = $this->generateRandomString() . $_FILES['file']['name'];
        $fichero_subido = $dir_subida . $filename;
        if (move_uploaded_file($_FILES['file']['tmp_name'], $fichero_subido)) {
            $data = array(
                'idTypeDocument' => '6',
                'idOrder' => $this->input->post('idOrder'),
                'file' => $filename,
                'observation'=> $this->input->post('observacion'),
                'idState' => 1,
                'dateSave' => date('Y-m-d H:i:s')
            );
            $this->Orders_model->add_order_document($data);
            $data1 = array(
                'idArea' => '3',
                'idOrderState' => '9'
            );
            $content = "";
            $this->Utils->sendMail('yflorezr@gmail.com', 'Auditoria de Diseño MER INFRAESTRUCTURA  - BITACORA', 'templates/review_design.php', $content);
            $this->Orders_model->update_order($this->input->post('idOrder'), $data1);
            redirect(base_url() . 'Design/register');
        } else {
            redirect(base_url() . 'Design/register');
            echo "¡Posible ataque de subida de ficheros!\n";
        }
    }

    function approved_order_design() {
        $data = array( 
            'idArea' => '3',
            'idOrderState' => '9'
        );
        $this->Orders_model->update_order($this->input->post('idOrder'), $data);
        redirect(base_url() . 'Design/audit?success');
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
