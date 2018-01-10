<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Services_model extends CI_Model {

    public function get_services($activiti) {
        $this->db->where('idActivitie', $activiti);
        $this->db->order_by('name', 'asc');
        $localidades = $this->db->get('tbl_services');
        if ($localidades->num_rows() > 0) {
            return $localidades->result();
        }
    }

    public function get_service_price($service) {
        $this->db->where('id', $service);
        $price = $this->db->get('tbl_services');
        if ($price->num_rows() > 0) {
            return $price->result();
        }
    }
}