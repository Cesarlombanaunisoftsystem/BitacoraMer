<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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

}
