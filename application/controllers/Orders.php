<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Orders
 *
 * @author jhon
 */
class Orders extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Activities_model'));
    }

    function index() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 1) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('profile');
        $data['activities'] = $this->Activities_model->get_activities_bts();
        $data['titulo'] = 'Registro Orden de servicio';
        $this->load->view('admin/register-orders', $data);
    }

}
