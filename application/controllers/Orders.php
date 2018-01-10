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
    }

    function index() {
        if ($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 1) {
            redirect(base_url() . 'login');
        }
        $data['titulo'] = 'Registro Orden de servicio';
        $this->load->view('admin/register-orders', $data);
    }

}
