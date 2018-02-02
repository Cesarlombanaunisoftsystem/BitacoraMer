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
            'idOrderState' => 3,
            'historybackState' => 0);
        $res = $this->Visits_model->assign_order($idOrder, $data);
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
            'idArea' => 1,
            'idOrderState' => 1);
        $res = $this->Visits_model->return_order($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function return_order_assign() {
        $idOrder = $this->input->post('idOrder');
        $obsv = $this->input->post('obsvgen');
        $data = array(
            'idArea' => 1,
            'idOrderState' => 2,
            'observations' => $obsv,
            'historybackState' => 1);
        $res = $this->Visits_model->return_order($idOrder, $data);
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
        $res = $this->Visits_model->return_order($idOrder, $data);
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
    
    public function register_docs() {
        $dir_subida = './uploads/';
        $filefoto = $this->generateRandomString() . $_FILES['fileregfoto']['name'];
        $filepsinm = $this->generateRandomString() . $_FILES['filepisnm']['name'];
        $filetss = $this->generateRandomString() . $_FILES['filetss']['name'];
        $fichero1 = $dir_subida . $filefoto;
        $fichero2 = $dir_subida . $filepsinm;
        $fichero3 = $dir_subida . $filetss;
        move_uploaded_file($_FILES['fileregfoto']['tmp_name'], $fichero1);
        move_uploaded_file($_FILES['filepisnm']['tmp_name'], $fichero2);
        move_uploaded_file($_FILES['filetss']['tmp_name'], $fichero3);
            $dataFoto = array(
                'file' => $filefoto,
                'observation' => $_POST['obsvRegPic'],
                'dateSave' => date('Y-m-d')
            );            
            $this->Orders_model->upload_doc($_POST['idOrder'], $_POST['idTypeRegFoto'], $dataFoto);
            $dataPsinm = array(
                'file' => $filepsinm,
                'observation' => $_POST['obsvPsinm'],
                'dateSave' => date('Y-m-d')
            );            
            $this->Orders_model->upload_doc($_POST['idOrder'], $_POST['idTypePsinm'], $dataPsinm);
            $dataTss = array(
                'file' => $filetss,
                'observation' => $_POST['obsvTss'],
                'dateSave' => date('Y-m-d')
            );            
            $this->Orders_model->upload_doc($_POST['idOrder'], $_POST['idTypeTss'], $dataTss);
            $dataGen = array(  
                'idArea' => 1,
                'idOrderState' => 6,
                'observations' => $_POST['obsvgen']
            );   
            $this->Orders_model->update_order($_POST['idOrder'],$dataGen);
            redirect(base_url() . 'Visit/site_init');
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
