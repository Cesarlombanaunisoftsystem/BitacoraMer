<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Projects
 *
 * @author JHON JAIRO VALDÉS ARISTIZABAL
 */
class Projects extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Users_model', 'Orders_model', 'Projects_model',
            'Materials_model', 'Utils', 'Services_model', 'HistoryMaterial_model'));
    }

    public function activitie_init() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Mis Proyectos';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['projects'] = $this->Projects_model->get_daily_management();
        $this->load->view('activitie_init_view', $data);
    }

    public function register_activities() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Mis Proyectos';
        $id_user = $this->session->userdata('id_usuario');
        $data['types'] = $this->Projects_model->get_types_management(1);
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['registers'] = $this->Projects_model->get_daily_management_contract();
        $this->load->view('activitie_register_view', $data);
    }

    public function materials_back($id) {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Mis Proyectos';
        $id_user = $this->session->userdata('id_usuario');
        $data['order'] = $this->Orders_model->get_order_by_id($id);
        $data['types'] = $this->Projects_model->get_types_management(1);
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['materials'] = $this->Materials_model->get_materials_order($id);
        $this->load->view('materials_back_view', $data);
    }

    public function register_activitie() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrderState' => 18,
            'dateUpdate' => date('Y-m-d H:i:s')
        );
        $data2 = array(
            'idOrder' => $idOrder,
            'idUserProcess' => $this->session->userdata('id_usuario'),
            'idProcessState' => 15
        );
        $this->Orders_model->register_log($data2);
        $res = $this->Orders_model->assign_state($idOrder, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function register_back_materials() {
        $id = $this->input->post('id');
        $countback = $this->input->post('countBack');
        $data = array(
            'count_back' => $countback
        );
        $res = $this->Materials_model->assign_state($id, $data);
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

    public function get_observation_close() {
        $idOrder = $this->input->get('idOrder');
        $data['observation'] = $this->Projects_model->get_observation_close($idOrder);
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
        echo $res->image;
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
        $titulo = "";
        $user = "";
        if ($attendant === '1') {
            $this->Utils->sendMail($coordinator->email, 'Atención a Gestión Contratista, Orden No:' . $uniquecode, 'templates/email_coordinator.php', $user, $content, $order, $titulo);
        }

        if (isset($_FILES['userfile']['name'])) {
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
        }
        $image = trim($images, ',');
        // comprobamos si es una solicitud de visita de cierre o sino una gestion diaria
        switch ($this->input->post('typegest')) {
            case 1:
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

                break;
            case 2:
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
                    'idOrderState' => 19,
                    'id_type_management' => 2,
                    'dateUpdate' => date('Y-m-d H:i:s')
                );
                $res = $this->Projects_model->closing_visit_request($data, $idOrder, $data1);
                echo $this->valida($res);
                break;
            case 3:
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
                    'idOrderState' => 23,
                    'id_type_management' => 3,
                    'dateUpdate' => date('Y-m-d H:i:s')
                );
                $res = $this->Projects_model->closing_visit_request($data, $idOrder, $data1);
                echo $this->valida($res);
                break;
            case 4:
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
                    'idOrderState' => 22,
                    'id_type_management' => 6,
                    'dateUpdate' => date('Y-m-d H:i:s')
                );
                $res = $this->Projects_model->closing_visit_request($data, $idOrder, $data1);
                echo $this->valida($res);
                break;
            case 5:
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
                    'idOrderState' => 18,
                    'id_type_management' => 5,
                    'dateUpdate' => date('Y-m-d H:i:s')
                );
                $res = $this->Projects_model->closing_visit_request($data, $idOrder, $data1);
                echo $this->valida($res);
                break;
            case 6:
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
                    'idOrderState' => 23,
                    'id_type_management' => 6,
                    'dateUpdate' => date('Y-m-d H:i:s')
                );
                $res = $this->Projects_model->closing_visit_request($data, $idOrder, $data1);
                echo $this->valida($res);
                break;
            default:
                break;
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
                'idOrderState' => 22,
                'id_type_management' => 6,
                'dateUpdate' => date('Y-m-d H:i:s')
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
                'idOrderState' => 21,
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
        $data['types'] = $this->Projects_model->get_types_management(0);
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['projects'] = $this->Projects_model->get_daily_managements($id_user);
        $this->load->view('closing_visit_request_view', $data);
    }

    public function closing_visit_request_process() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Mis Proyectos';
        $id_user = $this->session->userdata('id_usuario');
        $data['types'] = $this->Projects_model->get_types_management(0);
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['projects'] = $this->Projects_model->get_daily_managements($id_user);
        $data['registers'] = $this->Projects_model->get_daily_management_contract();
        $this->load->view('closing_visit_request_process_view', $data);
    }

    public function mark_closing_visit() {
        $idOrder = $this->input->post('idOrder');
        $data = array(
            'idOrderState' => 20,
            'dateUpdate' => date('Y-m-d H:i:s')
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
            'idOrderState' => 22,
            'id_type_management' => 4,
            'dateUpdate' => date('Y-m-d H:i:s')
        );
        $res = $this->Orders_model->assign_state($idOrder, $data);
        $dataDaily = array(
            'idOrder' => $idOrder,
            'id_type_management' => 4
        );
        $this->Projects_model->register_daily_management_order($dataDaily);
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
            'id_type_management' => 4,
            'observations' => $this->input->post('obsv'),
            'dateUpdate' => date('Y-m-d H:i:s')
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
            'observations' => $this->input->post('obsv'),
            'dateUpdate' => date('Y-m-d H:i:s')
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

    public function return_materials() {
        $idUser = $this->session->userdata('id_usuario');
        $date = date('Y-m-d H:i:s');
        $idOrder = $_POST['idOrder'];
        foreach (array_keys($_POST['idDetail']) as $key) {
            $idCellar = $_POST['idCellar'][$key];
            $idDetail = $_POST['idDetail'][$key];
            $countback = $_POST['countback'][$key];
            $data = array(
                'idCellar' => $idCellar,
                'idDetail' => $idDetail,
                'count_back' => $countback,
                'state' => 0,
            );
            $this->Materials_model->return_materials($data);
        }
        $data1 = array(
            'idOrder' => $idOrder,
            'id_type_management' => 6
        );
        $data2 = array(
            'stateMaterial' => 2,
            'dateUpdate' => $date
        );
        $dataLog = array(
            'idOrder' => $idOrder,
            'idUserProcess' => $idUser,
            'idProcessState' => 15,
            'stateLog' => 0
        );
        $this->Orders_model->register_log($dataLog);
        $res = $this->Materials_model->return_materials_log($idOrder, $data1, $data2);
        if ($res === TRUE) {
            $this->session->set_flashdata('item', array('message' => 'Material devuelto exitosamente', 'class' => 'success'));
            redirect('Projects/register_activities');
        } else {
            $this->session->set_flashdata('item', array('message' => 'Error en bbdd!', 'class' => 'error'));
            redirect('Projects/register_activities');
        }
    }

    public function content() {
        $path = "";
        $filesel = $this->input->get('filesel');
        for ($i = 0; $i < count($filesel); $i++) {
            $path .= $filesel[$i] . "/";
        }
        $directorio = opendir("./documents/" . $path);
        while ($file = readdir($directorio)) { //obtenemos un archivo y luego otro sucesivamente
            $dirfile = base_url() . "documents/" . $path . $file;
            $info = new SplFileInfo($file);
            if (($info->getExtension() !== "jpg") && ($info->getExtension() !== "png")) {
                echo "<a href='" . $dirfile . "' target='blank'>" . $file .
                "</a><i class='fa fa-trash' style='color:red' onclick='trush();'></i>" . "&nbsp;&nbsp;&nbsp;";
            } else {
                echo "<a href='" . $dirfile . "' target='blank'><img src='" .
                $dirfile . "' heigth='60px' width='60px'></a><i class='fa fa-trash' style='color:red' onclick='trush();'></i>" . "&nbsp;&nbsp;&nbsp;";
            }
        }
    }

    public function register_docs() {
        $idOrder = $this->input->post('idOrder');
        $filesel = $this->input->post('filesel');
        $obsv = $this->input->post('obsvdocs');
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

            $path = str_replace(",", "/", $filesel);
            $quantity = count($_FILES['files']['name']);
            for ($i = 0; $i < $quantity; $i++) {
                //subimos el archivo
                move_uploaded_file($_FILES['files']['tmp_name'][$i], "./documents/" . $path . "/" . $_FILES['files']['name'][$i]);
            }
            $data = array(
                'idOrder' => $idOrder,
                'obsvDocs' => $obsv,
                'idUser' => $this->session->userdata('id_usuario')
            );
            $res = $this->Orders_model->upload_docs_center($data);
            echo $this->valida($res);
        } else {
            throw new Exception("Error Processing Request", 1);
        }
    }

    public function getObsvDocCenter() {
        $idOrder = $this->input->get('idOrder');
        $data['obsv'] = $this->Orders_model->getObsvDocCenter($idOrder);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

    public function generate_paths() {
        $query = $this->Orders_model->get_order_uniquecode($this->input->post('idOrder'));
        $order = $query->uniquecode . '-' . $query->coi;
        $sql = $this->Services_model->get_services_order($this->input->post('idOrder'));
        foreach ($sql as $value) {
            $q = $this->Services_model->get_services_path($value->idServices);
            $string = $q->folder;
            $array = explode(",", $string);
            for ($i = 0; $i < count($array); $i++) {
                mkdir("./documents/" . $order . "/" . $value->name_service . "/" . $array[$i], 0777, TRUE);
            }
        }
    }

    public function getMaterials() {
        $query = $this->HistoryMaterial_model->getDataFromHistory($this->input->post('idOrder'));
        echo json_encode($query);
    }

}
