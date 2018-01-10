<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Orders
 *
 * @author jhon
 */
class Activities extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Activities_model','Services_model'));
    }

    public function get_services() {
		$options = "";
		if ($this->input->post('idActivities')) {
			$activities = $this->input->post('idActivities');
			$services = $this->Services_model->get_services($activities);
			foreach ($services as $fila) {
                        $options .= '<option value="'.$fila->id.'">'.$fila->name.'</option>';
		    }
            echo '<option>Seleccionar</option>'.$options;
        }
	}

}
