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
        $data['visits'] = $this->Visits_model->get_orders_visit_process($id_user, 2);
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
            $data2 = array(
                'idOrder' => $idOrder,
                'idProcessState' => 2,
                'obsvLog' => $this->input->post('obsv')
            );
            $this->Orders_model->register_log($data2);
            if ($res === TRUE) {
                $technical = $this->Users_model->get_user_xid($idUser);
                $content = $this->Orders_model->details_orders_tray($idOrder);
                $order = $this->Orders_model->get_order_by_id($idOrder);
                $titulo = '¡Has Sido Asignado para Realizar Visita En Sitio!';
                $this->Utils->sendMail($technical->email, 'Programación de visita a sitio', 'templates/email_tecnico.php', $technical, $content, $order, $titulo);
                echo 'ok';
            } else {
                echo 'error';
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
            $data2 = array(
                'idOrder' => $idOrder,
                'idProcessState' => 2,
                'obsvLog' => $this->input->post('obsv')
            );
            $this->Orders_model->register_log($data2);
            if ($res === TRUE) {
                $technical = $this->Users_model->get_user_xid($idUser);
                $content = $this->Orders_model->get_order_by_id_email($idOrder);
                $order = $this->Orders_model->get_order_by_id($idOrder);
                $titulo = '¡Has Sido Asignado para Realizar Visita De Cierre!';
                $this->Utils->sendMail($technical->email, 'Programación de visita de cierre', 'templates/email_tecnico.php', $technical, $content, $order, $titulo);
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
        $data2 = array(
            'idOrder' => $idOrder,
            'idProcessState' => 4
        );
        $this->Orders_model->register_log($data2);
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
        $data['process'] = $this->Visits_model->get_orders_visit_process($id_user, 4);
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
        $data['process'] = $this->Visits_model->get_orders_visit_process($id_user, 3);
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
        $data['process'] = $this->Visits_model->get_orders_visit_process($id_user, 4);
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
        $image = "";
        $quantity = count($_FILES['fileregfoto']['name']);
        for ($i = 0; $i < $quantity; $i++) {
            //subimos el archivo ha subido
            move_uploaded_file($_FILES['fileregfoto']['tmp_name'][$i], "./uploads/" . $_FILES['fileregfoto']['name'][$i]);
            //concatenamos para guardar nombres en la base de datos
            $image .= $_FILES['fileregfoto']['name'][$i] . ",";
        }
        $imageconcat = trim($image, ",");
        if ($imageconcat) {
            $dataFoto = array(
                'file' => $imageconcat,
                'observation' => $this->input->post('obsvRegPic'),
                'idState' => 1,
                'dateSave' => date('Y-m-d')
            );
            $this->Orders_model->upload_doc($this->input->post('idOrder'), $this->input->post('idTypeRegFoto'), $dataFoto);
        }
        $filepsinm = $_FILES['filepisnm']['name'];
        if ($filepsinm && move_uploaded_file($_FILES['filepisnm']['tmp_name'], "./uploads/" . $filepsinm)) {
            $dataPsinm = array(
                'file' => $filepsinm,
                'observation' => $this->input->post('obsvPsinm'),
                'idState' => 1,
                'dateSave' => date('Y-m-d')
            );
            $this->Orders_model->upload_doc($this->input->post('idOrder'), $this->input->post('idTypePsinm'), $dataPsinm);
        }
        $filetss = $_FILES['filetss']['name'];
        if ($filetss && move_uploaded_file($_FILES['filetss']['tmp_name'], "./uploads/" . $filetss)) {
            $dataTss = array(
                'file' => $filetss,
                'observation' => $this->input->post('obsvTss'),
                'idState' => 1,
                'dateSave' => date('Y-m-d')
            );
            $this->Orders_model->upload_doc($this->input->post('idOrder'), $this->input->post('idTypeTss'), $dataTss);
        }
        $filedas = $_FILES['filedas']['name'];
        if ($filedas && move_uploaded_file($_FILES['filedas']['tmp_name'], "./uploads/" . $filedas)) {
            $dataDas = array(
                'file' => $filedas,
                'observation' => $this->input->post('obsvDas'),
                'idState' => 1,
                'dateSave' => date('Y-m-d')
            );
            $this->Orders_model->upload_doc($this->input->post('idOrder'), $this->input->post('idTypeDas'), $dataDas);
        }
        $dataGen = array(
            'idArea' => 1,
            'idOrderState' => 6,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'observations' => $this->input->post('obsvgen'),
            'dateUpdate' => date('Y-m-d H:i:s')
        );
        $this->Orders_model->update_order($this->input->post('idOrder'), $dataGen);
        $data2 = array(
            'idOrder' => $this->input->post('idOrder'),
            'idProcessState' => 3,
            'obsvLog' => $this->input->post('obsvgen')
        );
        $this->Orders_model->register_log($data2);
        redirect(base_url() . 'Visit/site_init');
    }

    public function register_docs_visit_close() {
        $image = "";
        $quantity = count($_FILES['fileregfoto']['name']);
        for ($i = 0; $i < $quantity; $i++) {
            //subimos el archivo ha subido
            move_uploaded_file($_FILES['fileregfoto']['tmp_name'][$i], "./uploads/" . $_FILES['fileregfoto']['name'][$i]);
            //concatenamos para guardar nombres en la base de datos
            $image .= $_FILES['fileregfoto']['name'][$i] . ",";
        }
        $imageconcat = trim($image, ",");
        if ($imageconcat) {
            $dataFoto = array(
                'file2' => $imageconcat,
                'observation2' => $this->input->post('obsvRegPic'),
                'idState2' => 1,
                'dateSave2' => date('Y-m-d')
            );
            $this->Orders_model->upload_doc($this->input->post('idOrder'), 1, $dataFoto);
        }
        $filepsinm = $_FILES['filepisnm']['name'];
        if ($filepsinm && move_uploaded_file($_FILES['filepisnm']['tmp_name'], "./uploads/" . $filepsinm)) {
            $dataPsinm = array(
                'file2' => $filepsinm,
                'observation2' => $this->input->post('obsvPsinm'),
                'idState2' => 1,
                'dateSave2' => date('Y-m-d')
            );
            $this->Orders_model->upload_doc($this->input->post('idOrder'), 2, $dataPsinm);
        }
        $filetss = $_FILES['filetss']['name'];
        if ($filetss && move_uploaded_file($_FILES['filetss']['tmp_name'], "./uploads/" . $filetss)) {
            $dataTss = array(
                'file2' => $filetss,
                'observation2' => $this->input->post('obsvTss'),
                'idState2' => 1,
                'dateSave2' => date('Y-m-d')
            );
            $this->Orders_model->upload_doc($this->input->post('idOrder'), 3, $dataTss);
        }
        $filedas = $_FILES['filedas']['name'];
        if ($filedas && move_uploaded_file($_FILES['filedas']['tmp_name'], "./uploads/" . $filedas)) {
            $dataDas = array(
                'file2' => $filedas,
                'observation2' => $this->input->post('obsvDas'),
                'idState2' => 1,
                'dateSave2' => date('Y-m-d')
            );
            $this->Orders_model->upload_doc($this->input->post('idOrder'), 4, $dataDas);
        }
        $filedoc = $_FILES['userfile']['name'];
        if ($filedoc && move_uploaded_file($_FILES['userfile']['tmp_name'], "./uploads/" . $filedoc)) {
            $dataDoc = array(
                'idTypeDocument' => 7,
                'idOrder' => $this->input->post('idOrder'),
                'file2' => $filedoc,
                'observation2' => $this->input->post('obsvDoc'),
                'idState2' => 1,
                'dateSave2' => date('Y-m-d')
            );
            $this->Orders_model->upload_docs($dataDoc);
        }
        $dataGen = array(
            'idArea' => 3,
            'idOrderState' => 19,
            'id_type_management' => 3,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'dateUpdate' => date('Y-m-d H:i:s')
        );
        $this->Orders_model->update_order($this->input->post('idOrder'), $dataGen);
        $dataDaily = array(
            'idOrder' => $this->input->post('idOrder'),
            'id_type_management' => 3,
            'detail' => $this->input->post('obsvgen')
        );
        $this->Projects_model->register_daily_management_order($dataDaily);
        redirect(base_url() . 'Visit/validation_close');
    }

}
