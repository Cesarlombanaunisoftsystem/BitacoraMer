<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

/**
 * Description of Orders
 *
 * @author jhon
 */
class Services extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Services_model'));
    }

    public function get_service() {
        if ($this->input->post('selService')) {
            $service = $this->input->post('selService');
            $datos = $this->Services_model->get_service($service);
            if ($datos != FALSE) {
                echo $datos->model_tree;
            }
        }
    }

    public function get_folder_service() {
        if ($this->input->post('selService')) {
            $service = $this->input->post('selService');
            $datos = $this->Services_model->get_folder_service($service);
            if ($datos != FALSE) {
                echo $datos->folder;
            }
        }
    }

    public function get_service_price() {
        if ($this->input->post('idServices')) {
            $service = $this->input->post('idServices');
            $price = $this->Services_model->get_service($service);
            $input = '<input type="number" class="form-control" name="price" id="vrUnit" value="' . $price->price . '" readonly required/>'
                    . '<input type="hidden" name="cost" id="cost" value="' . $price->cost . '"/>';
            echo $input;
        }
    }

    public function get_service_unit_measurement() {
        if ($this->input->post('idServices')) {
            $service = $this->input->post('idServices');
            $unit = $this->Services_model->get_service($service);
            $input = '<input type="text" class="form-control" name="unidadm" id="unidadm" value="' . $unit->unit_measurement . '" readonly required/>';
            echo $input;
        }
    }

    public function get_model_tree() {
        $idService = $this->input->get('idService');
        $data['tree'] = $this->Services_model->get_service($idService);
        $resultadosJson = json_encode($data);
        echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
    }

}
