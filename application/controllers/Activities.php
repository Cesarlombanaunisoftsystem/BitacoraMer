<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

/**
 * Description of Orders
 *
 * @author jhon
 */
class Activities extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Activities_model', 'Services_model'));
    }

    public function get_services() {
        $options = "";
        if ($this->input->post('idActivities')) {
            $activities = $this->input->post('idActivities');
            $services = $this->Services_model->get_services($activities);
            foreach ($services as $fila) {
                $options .= '<option value="' . $fila->id . '">' . $fila->name_service . '</option>';
            }
            echo '<option>Seleccionar Servicio</option> ' . $options;
        }
    }

}
