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
			$price = $this->Services_model->get_service_price($service);
			foreach ($price as $fila) {
                $input = '<input type="text" class="form-control" name="price" id="vrUnit" value="'.$fila->price.'" readonly required/>';
		    }
            echo $input;
        }
	}

}