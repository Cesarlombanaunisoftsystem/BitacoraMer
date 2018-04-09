<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

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
        $this->load->model(array('Users_model', 'Visits_model', 'Orders_model',
            'Activities_model', 'Utils', 'Projects_model', 'Services_model'));
    }

    public function program() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Programación de visitas a sitio';
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
        $data['visits'] = $this->Visits_model->get_orders_visit_process($id_user,2);
        $this->load->view('visit_assign_view', $data);
    }

    public function assign() {
        $idOrder = $this->input->post('idOrder');
        $state = $this->input->post('state');
        $idUser = $this->input->post('idTech');

        if ($state === '2') {
            $data = array(
                'idTechnicals' => $idUser,
                'date' => $this->input->post('date'),
                'idArea' => 1,
                'idOrderState' => 3,
                'observations' => $this->input->post('obsv'),
                'historybackState' => 0,
                'idUserProcess' => $this->session->userdata('id_usuario'),
                'dateAssign' => date('Y-m-d H:i:s'));
            $res = $this->Visits_model->assign_order($idOrder, $data);
            if ($res === TRUE) {
                $technical = $this->Users_model->get_user_xid($idUser);
                $content = $this->Orders_model->details_orders_tray($idOrder);
                $order = $this->Orders_model->get_order_by_id($idOrder);
                $titulo = '¡Has Sido Asignado para Realizar Visita En Sitio!';
                $this->Utils->sendMail($technical->email, 'Programación de visita a sitio', 'templates/email_tecnico.php', $technical, $content, $order, $titulo);
                echo 'ok';
            } else {
                echo $res;
            }
        }
        if ($state === '20') {
            $data = array(
                'idTechnicals' => $idUser,
                'date' => $this->input->post('date'),
                'idArea' => 3,
                'idOrderState' => 21,
                'observations' => $this->input->post('obsv'),
                'historybackState' => 0,
                'idUserProcess' => $this->session->userdata('id_usuario'),
                'dateAssign' => date('Y-m-d H:i:s'));
            $res = $this->Visits_model->assign_order($idOrder, $data);
            if ($res === TRUE) {
                $technical = $this->Users_model->get_user_xid($idUser);
                $content = $this->Orders_model->get_order_by_id_email($idOrder);
                $titulo = '¡Has Sido Asignado para Realizar Visita De Cierre!';
                $this->Utils->sendMail($technical->email, 'Programación de visita de cierre', 'templates/email_tecnico.php', $content, $titulo);
                echo 'ok';
            } else {
                echo 'error';
            }
        }
    }

    public function validation_register_visit_initial() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idArea' => $this->input->post('idArea'),
            'idOrderState' => $this->input->post('idState'),
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'dateAssign' => date('Y-m-d H:i:s'));
        $res = $this->Visits_model->assign_order($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function return_register_visit_init() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idArea' => $this->input->post('idArea'),
            'idOrderState' => $this->input->post('idState'),
            'observations' => $this->input->post('obsv'),
            'dateUpdate' => date('Y-m-d H:i:s'));
        $res = $this->Visits_model->assign_order($idOrder, $data);
        if ($res === TRUE) {
            $content = $this->Orders_model->get_order_by_id_email($idOrder);
            $titulo = '¡Devolución auditoria validación visita!';
            $this->Utils->sendMail($content->email, 'Registro de visita inicial', 'templates/email_tecnico.php', $content, $titulo);
            echo 'ok';
        } else {
            echo $res;
        }
    }

    public function return_order_register() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idArea' => 1,
            'idOrderState' => 1,
            'dateUpdate' => date('Y-m-d H:i:s'));
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
            'historybackState' => 1,
            'dateUpdate' => date('Y-m-d H:i:s'));
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
            'observations' => $obsv,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'dateUpdate' => date('Y-m-d H:i:s'));
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
        $data['process'] = $this->Visits_model->get_orders_visit_process($id_user,4);
        $this->load->view('visit_init_register_data_view', $data);
    }
    
    public function site_init_process() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Registro de datos visitas inicial al sitio';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities_xtype(1);
        $data['process'] = $this->Visits_model->get_orders_visit_process($id_user,4);
        $this->load->view('visit_init_process_view', $data);
    }

    public function validation() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Validación Registro de Visitas Inicial';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['orders'] = $this->Visits_model->get_orders_visit_validation();
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $this->load->view('validation_visit_init_view', $data);
    }
    
    public function validation_process() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Validación Registro de Visitas Inicial';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['process'] = $this->Visits_model->get_orders_visit_process($id_user,6);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['services'] = $this->Services_model->get_all_services();
        $this->load->view('validation_visit_init_process_view', $data);
    }

    public function validation_close() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Registro de datos visita de cierre';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities_xtype(1);
        $data['visits'] = $this->Projects_model->register_data_close_visit(21);
        $this->load->view('visit_close_register_data_view', $data);
    }

    public function validation_close_process() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Registro de datos visita de cierre';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities_xtype(1);
        $data['visits'] = $this->Projects_model->register_data_close_visit(19);
        $this->load->view('visit_close_process_view', $data);
    }

    public function get_docs_visit_init_register() {
        $idOrder = $this->input->get('idOrder');
        $data['docs'] = $this->Orders_model->get_docs($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }
    
    public function get_activities_x_order() {
        $idOrder = $this->input->get('idOrder');
        $data['act'] = $this->Orders_model->details_orders_tray($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function register_docs() {
        $dir_subida = './uploads/';
        $image = "";
        $quantity = count($_FILES['fileregfoto']['name']);
        for ($i = 0; $i < $quantity; $i++) {
            //subimos el archivo ha subido
            move_uploaded_file($_FILES['fileregfoto']['tmp_name'][$i], "./uploads/" . $_FILES['fileregfoto']['name'][$i]);
            //guardamos en la base de datos el nombre
            $image .= $_FILES['fileregfoto']['name'][$i] . ",";
        }
        $imageconcat = trim($image, ",");
        $dataFoto = array(
            'file' => $imageconcat,
            'observation' => $this->input->post('obsvRegPic'),
            'dateSave' => date('Y-m-d')
        );
        $this->Orders_model->upload_doc($this->input->post('idOrder'), $this->input->post('idTypeRegFoto'), $dataFoto);
        $filepsinm = $this->generateRandomString() . $_FILES['filepisnm']['name'];
        $filetss = $this->generateRandomString() . $_FILES['filetss']['name'];
        $filedas = $this->generateRandomString() . $_FILES['filedas']['name'];
        $fichero2 = $dir_subida . $filepsinm;
        $fichero3 = $dir_subida . $filetss;
        $fichero4 = $dir_subida . $filedas;
        move_uploaded_file($_FILES['filepisnm']['tmp_name'], $fichero2);
        move_uploaded_file($_FILES['filetss']['tmp_name'], $fichero3);
        move_uploaded_file($_FILES['filedas']['tmp_name'], $fichero4);

        $dataPsinm = array(
            'file' => $filepsinm,
            'observation' => $this->input->post('obsvPsinm'),
            'dateSave' => date('Y-m-d')
        );
        $this->Orders_model->upload_doc($this->input->post('idOrder'), $this->input->post('idTypePsinm'), $dataPsinm);
        $dataTss = array(
            'file' => $filetss,
            'observation' => $this->input->post('obsvTss'),
            'dateSave' => date('Y-m-d')
        );
        $this->Orders_model->upload_doc($this->input->post('idOrder'), $this->input->post('idTypeTss'), $dataTss);
        $dataDas = array(
            'file' => $filedas,
            'observation' => $this->input->post('obsvDas'),
            'dateSave' => date('Y-m-d')
        );
        $this->Orders_model->upload_doc($this->input->post('idOrder'), $this->input->post('idTypeDas'), $dataDas);
        $dataGen = array(
            'idArea' => 1,
            'idOrderState' => 6,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'observations' => $this->input->post('obsvgen'),
            'dateUpdate' => date('Y-m-d H:i:s')
        );
        $this->Orders_model->update_order($this->input->post('idOrder'), $dataGen);
        redirect(base_url() . 'Visit/site_init');
    }

    public function register_docs_visit_close() {
        $dir_subida = './uploads/';
        $quantity = count($_FILES['fileregfoto']['name']);
        for ($i = 0; $i < $quantity; $i++) {
            //subimos el archivo ha subido
            move_uploaded_file($_FILES['fileregfoto']['tmp_name'][$i], "./uploads/" . $_FILES['fileregfoto']['name'][$i]);
            //guardamos en la base de datos el nombre
            $image = $_FILES['fileregfoto']['name'][$i];
            $dataFoto = array(
                'idTypeDocument' => $this->input->post('idTypeRegFoto'),
                'idOrder' => $this->input->post('idOrder'),
                'file' => $image,
                'observation' => $this->input->post('obsvRegPic'),
                'dateSave' => date('Y-m-d')
            );
            $this->Orders_model->upload_docs($dataFoto);
        }
        $filepsinm = $this->generateRandomString() . $_FILES['filepisnm']['name'];
        $filetss = $this->generateRandomString() . $_FILES['filetss']['name'];
        $filedoc = $this->generateRandomString() . $_FILES['userfile']['name'];
        $fichero2 = $dir_subida . $filepsinm;
        $fichero3 = $dir_subida . $filetss;
        $fichero4 = $dir_subida . $filedoc;
        move_uploaded_file($_FILES['filepisnm']['tmp_name'], $fichero2);
        move_uploaded_file($_FILES['filetss']['tmp_name'], $fichero3);
        move_uploaded_file($_FILES['userfile']['tmp_name'], $fichero4);
        $dataPsinm = array(
            'idTypeDocument' => $this->input->post('idTypePsinm'),
            'idOrder' => $this->input->post('idOrder'),
            'file' => $filepsinm,
            'observation' => $this->input->post('obsvPsinm'),
            'dateSave' => date('Y-m-d')
        );
        $this->Orders_model->upload_docs($dataPsinm);
        $dataTss = array(
            'idTypeDocument' => $this->input->post('idTypeTss'),
            'idOrder' => $this->input->post('idOrder'),
            'file' => $filetss,
            'observation' => $this->input->post('obsvTss'),
            'dateSave' => date('Y-m-d')
        );
        $this->Orders_model->upload_docs($dataTss);
        $dataDoc = array(
            'idTypeDocument' => $this->input->post('idTypeDoc'),
            'idOrder' => $this->input->post('idOrder'),
            'file' => $filedoc,
            'dateSave' => date('Y-m-d')
        );
        $this->Orders_model->upload_docs($dataDoc);
        $dataGen = array(
            'idArea' => 3,
            'idOrderState' => 19,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'observations' => $this->input->post('obsvgen'),
            'dateUpdate' => date('Y-m-d H:i:s')
        );
        $this->Orders_model->update_order($this->input->post('idOrder'), $dataGen);
        $dataDaily = array(
            'idOrder' => $this->input->post('idOrder'),
            'id_type_management' => 2,
            'detail' => $this->input->post('obsvgen')
        );
        $this->Projects_model->register_daily_management_order($dataDaily);
        redirect(base_url() . 'Visit/validation_close');
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
