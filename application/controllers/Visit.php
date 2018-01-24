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
        $this->load->model(array('Users_model', 'Visits_model', 'Orders_model'));
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
            'idArea' => 2);
        $res = $this->Visits_model->assign_order_technic($idOrder, $data);
        if ($res === TRUE) {
            $technical = $this->Users_model->get_user_xid($idUser);
            $content['content'] = $this->Orders_model->get_order_by_id_email($idOrder);
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html';
            $config['protocol'] = 'mail';
            $config['smtp_host'] = 'mail.instasoft.com.co';
            $config['smtp_port'] = '465';
            $config['smtp_user'] = 'jhon.valdes@instasoft.com.co';
            $config['smtp_pass'] = 'jhV_3103';
            $config['validation'] = TRUE;
            $this->email->initialize($config);
            $this->email->clear();
            $this->email->from('jhon.valdes@instasoft.com.co', 'Unisoft');
            $this->email->to($technical->email);
            //$this->email->cc($destination);
            //$this->email->bcc($destination);
            $this->email->subject('Programación de visita a sitio');
            $body = $this->load->view('templates/email_tecnico.php', $content, TRUE);
            $this->email->message($body);
            $this->email->send();
            echo 'ok';
        } else {
            echo $res;
        }
    }

    public function return_order_register() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idArea' => NULL);
        $res = $this->Visits_model->return_order_register($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

}
