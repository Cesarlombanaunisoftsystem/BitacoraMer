<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Admin
 *
 * @author jhon
 */
class Parametrization extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->model(array('Users_model', 'Categories_model',
            'Areas_model', 'Docs_model', 'Activities_model', 'Payments_model',
            'States_model', 'Services_model', 'Taxes_model', 'Cellars_model'));
    }

    public function index() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Administración';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $this->load->view('admin/admin_view', $data);
    }

    public function prices() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Precios de venta';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['usuarios'] = $this->Users_model->get_users();
        $this->load->view('admin/prices_view', $data);
    }

    public function get_categories() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Categorias';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['categories'] = $this->Categories_model->get_categories();
        $this->load->view('admin/categories_view', $data);
    }

    public function get_category($id_category) {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Editar Categoria';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['category'] = $this->Categories_model->get_category($id_category);
        $this->load->view('admin/category_edit_view', $data);
    }

    public function add_category() {
        $data = array(
            'name_category' => $this->input->post('name'),
            'description' => $this->input->post('desc'),
        );
        $res = $this->Categories_model->add_category($data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function edit_category() {
        $id_category = $this->input->post('id');
        $data = array(
            'name_category' => $this->input->post('name'),
            'description' => $this->input->post('desc')
        );
        $res = $this->Categories_model->edit_category($id_category, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function delete_category() {
        $id_category = $this->input->post('idCategory');
        $res = $this->Categories_model->delete_category($id_category);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function get_activities() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Precios de Venta';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['categories'] = $this->Categories_model->get_categories();
        $data['states'] = $this->States_model->get_states();
        $this->load->view('admin/activities_view', $data);
    }

    public function get_activitie($id_activitie) {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Editar Actividad';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['activities'] = $this->Activities_model->get_activitie($id_activitie);
        $data['categories'] = $this->Categories_model->get_categories();
        $data['states'] = $this->States_model->get_states();
        $this->load->view('admin/activities_edit_view', $data);
    }

    public function add_activitie() {
        $data = array(
            'name_activitie' => $this->input->post('name'),
            'observations' => $this->input->post('obsv'),
            'idUser' => $this->session->userdata('id_usuario'),
            'idOrderCategory' => $this->input->post('category'),
            'idState' => $this->input->post('state'),
            'dateSave' => date('Y-m-d H:i:s')
        );
        $res = $this->Activities_model->add_activitie($data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function edit_activitie() {
        $id_activitie = $this->input->post('id');
        $data = array(
            'name_activitie' => $this->input->post('name'),
            'observations' => $this->input->post('obvs'),
            'idOrderCategory' => $this->input->post('category'),
            'idState' => $this->input->post('state')
        );
        $res = $this->Activities_model->edit_activitie($id_activitie, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function delete_activitie() {
        $id_activitie = $this->input->post('idActivitie');
        $res = $this->Activities_model->delete_activitie($id_activitie);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function get_services() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Servicios';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['services'] = $this->Services_model->services();
        $data['activities'] = $this->Activities_model->get_activities();
        $data['states'] = $this->States_model->get_states();
        $data['taxes'] = $this->Taxes_model->get_taxes();
        $this->load->view('admin/services_view', $data);
    }

    public function get_service($id) {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Servicios';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['service'] = $this->Services_model->get_service($id);
        $data['activities'] = $this->Activities_model->get_activities();
        $data['states'] = $this->States_model->get_states();
        $data['taxes'] = $this->Taxes_model->get_taxes();
        $this->load->view('admin/edit_service_view', $data);
    }

    public function add_service() {
        $data = array(
            'name_service' => $this->input->post('name'),
            'observations' => $this->input->post('obsv'),
            'price' => $this->input->post('price'),            
            'unit_measurement' => $this->input->post('unidadm'),
            'idTask' => $this->input->post('tax'),
            'idUser' => $this->session->userdata('id_usuario'),
            'idState' => $this->input->post('state'),
            'dateSave' => date('Y-m-d H:i:s'),
            'idActivitie' => $this->input->post('activitie')
        );
        $res = $this->Services_model->add_service($data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function edit_service() {
        $id_service = $this->input->post('id');
        $data = array(
            'name_service' => $this->input->post('name'),
            'observations' => $this->input->post('obsv'),
            'price' => $this->input->post('price'),
            'unit_measurement' => $this->input->post('unidadm'),
            'idTask' => $this->input->post('tax'),
            'idActivitie' => $this->input->post('activitie'),
            'idState' => $this->input->post('state')
        );
        $res = $this->Services_model->edit_service($id_service, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function delete_service() {
        $id_service = $this->input->post('idService');
        $res = $this->Services_model->delete_service($id_service);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function payment_methods() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Formas de pago';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['payments'] = $this->Payments_model->get_payments();
        $this->load->view('admin/payments_view', $data);
    }

    public function get_pay($id) {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Servicios';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['pay'] = $this->Payments_model->get_pay($id);
        $this->load->view('admin/edit_pay_view', $data);
    }

    public function add_pay() {
        $data = array(
            'name_pay' => $this->input->post('name')
        );
        $res = $this->Payments_model->add_pay($data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function edit_pay() {
        $id_pay = $this->input->post('id');
        $data = array(
            'name_pay' => $this->input->post('name')
        );
        $res = $this->Payments_model->edit_pay($id_pay, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function delete_pay() {
        $id_pay = $this->input->post('idPay');
        $res = $this->Payments_model->delete_pay($id_pay);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function areas() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Impuestos';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['areas'] = $this->Areas_model->get_areas();
        $data['states'] = $this->States_model->get_states();
        $this->load->view('admin/areas_view', $data);
    }

    public function get_area($id) {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Servicios';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['states'] = $this->States_model->get_states();
        $data['area'] = $this->Areas_model->get_area($id);
        $this->load->view('admin/edit_area_view', $data);
    }

    public function add_area() {
        $data = array(
            'name_area' => $this->input->post('name'),
            'idState' => $this->input->post('state')
        );
        $res = $this->Areas_model->add_area($data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function edit_area() {
        $id_area = $this->input->post('id');
        $data = array(
            'name_area' => $this->input->post('name'),
            'idState' => $this->input->post('state')
        );
        $res = $this->Areas_model->edit_area($id_area, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function delete_area() {
        $id_area = $this->input->post('idArea');
        $res = $this->Areas_model->delete_area($id_area);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
    
    public function docs() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Impuestos';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['docs'] = $this->Docs_model->get_docs();
        $data['states'] = $this->States_model->get_states();
        $this->load->view('admin/docs_view', $data);
    }

    public function get_doc($id) {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Servicios';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['states'] = $this->States_model->get_states();
        $data['doc'] = $this->Docs_model->get_doc($id);
        $this->load->view('admin/edit_doc_view', $data);
    }

    public function add_doc() {
        $data = array(
            'name_type' => $this->input->post('name'),
            'idState' => $this->input->post('state')
        );
        $res = $this->Docs_model->add_doc($data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function edit_doc() {
        $id_doc = $this->input->post('id');
        $data = array(
            'name_type' => $this->input->post('name'),
            'idState' => $this->input->post('state')
        );
        $res = $this->Docs_model->edit_doc($id_doc, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function delete_doc() {
        $id_doc = $this->input->post('idDoc');
        $res = $this->Docs_model->delete_doc($id_doc);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
    
    public function taxes() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Impuestos';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['taxes'] = $this->Payments_model->get_taxes();
        $this->load->view('admin/taxes_view', $data);
    }

    public function get_tax($id) {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Servicios';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['tax'] = $this->Payments_model->get_tax($id);
        $this->load->view('admin/edit_tax_view', $data);
    }

    public function add_tax() {
        $data = array(
            'name_tax' => $this->input->post('name'),
            'percent_tax' => $this->input->post('percent')
        );
        $res = $this->Payments_model->add_tax($data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function edit_tax() {
        $id_tax = $this->input->post('id');
        $data = array(
            'name_tax' => $this->input->post('name'),
            'percent_tax' => $this->input->post('percent')
        );
        $res = $this->Payments_model->edit_tax($id_tax, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function delete_tax() {
        $id_tax = $this->input->post('idTax');
        $res = $this->Payments_model->delete_tax($id_tax);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }
    
    public function cellar() {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Bodegas';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['states'] = $this->States_model->get_states();
        $data['cellars'] = $this->Cellars_model->get_cellars();
        $this->load->view('admin/cellar_view', $data);
    }
    
    public function get_cellar($id) {
        if ($this->session->userdata('perfil') == FALSE) {
            redirect(base_url() . 'login');
        }
        $data['name'] = $this->session->userdata('username');
        $data['profile'] = $this->session->userdata('perfil');
        $data['titulo'] = 'Servicios';
        $id_user = $this->session->userdata('id_usuario');
        $data['datos'] = $this->Users_model->get_user_permits($id_user);
        $data['states'] = $this->States_model->get_states();
        $data['cellar'] = $this->Cellars_model->get_cellar($id);
        $this->load->view('admin/edit_cellar_view', $data);
    }

    public function add_cellar() {
        $data = array(
            'name_cellar' => $this->input->post('name'),
            'idState' => $this->input->post('state')
        );
        $res = $this->Cellars_model->add_cellar($data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function edit_cellar() {
        $id = $this->input->post('id');
        $data = array(
            'name_cellar' => $this->input->post('name'),
            'idState' => $this->input->post('state')
        );
        $res = $this->Cellars_model->edit_tax($id, $data);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function delete_cellar() {
        $id = $this->input->post('id');
        $res = $this->Cellars_model->delete_cellar($id);
        if ($res === TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

}
