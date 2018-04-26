<?php

defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once APPPATH . '/libraries/REST_Controller.php';

class api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'security', 'cookie'));
        $this->load->library(array('form_validation', 'session'));
        $this->load->model(array('Login_model', 'Token_model','Orders_model',
            'Cellars_model','Services_model',
            'HistoryMaterial_model'));
    }

    public function login_post() {
        //bed329f6a51fd6c8a52cf98ab1f061b4
        $data = array(
            'username' => trim($this->post('username')),
            'pass' => sha1($this->post('password'))
        );
        $check_user = $this->Login_model->login_user_api($data['username'], $data['pass']);
        if ($check_user) {
            $dat = array(
                'id_user' => $check_user->id,
                'token' => bin2hex(openssl_random_pseudo_bytes(16)),
            );
            $this->Token_model->add_token($dat);
            $this->response([
                'status' => "ok",
                'response' => 'autenticacion correcta',
                'access_token' => $dat['token'],
            ]);
        } else {
            $this->response([
                'status' => "error",
                'response' => 'Autenticacion error '. json_encode($data),
            ]);
        }
    }

    public function getOrders_post() {
        $headers = $this->input->request_headers();
        $token = $headers['token'];
        $data = $this->Token_model->get_orders($token);
        if ($data) {
            $this->response([
                'status' => "ok",
                'response' => 'autenticacion correcta',
                'data' => $data,
            ]);
        } else {
            $this->response([
                'status' => "error",
                'response' => 'Autenticacion error',
            ]);
        }
    }
    
    public function getOrdersById_post(){
        if($this->validatetoken()){
            $id_order = $this->post('id_order');
            $data = $this->Orders_model->get_materials_upload($id_order);
            //$data['cellars'] = $this->Cellars_model->get_cellars();
            
                $this->response($data);
            
        }else {
            $this->response([
                'status' => "error",
                'response' => 'Autenticacion error',
            ]);
        }
    }
    
    public function getMaterials_post(){
        if($this->validatetoken()){
            $data = $this->Services_model->get_all_services_api();
            $this->response($data);
        }else {
            $this->response([
                'status' => "error",
                'response' => 'Autenticacion error',
            ]);
        }
    }
    
    public function uploadPhoto_post(){
        if($this->validatetoken()){
            $id_order = $this->post('idOrder');
            $idService = $this->post('idService');
            $idMaterial =$this->post('idMaterial');            
            $observacion =$this->post('observacion');
            $base64 = $this->post('photo');
            $image = base64_decode($base64);
            $filename = $id_order."_".$idMaterial . '.' . 'png'; //renama file name based on time
            $data = array(
                'id_order'=>$id_order,
                'id_material'=>$idMaterial,
                'observacion'=>$observacion
            );
            
            $folder = './reportes/material_fotos/';
            file_put_contents($folder. $filename, $image);
            
            if(file_exists($folder. $filename)){
                
                $this->HistoryMaterial_model->add_register($data);
                $this->response([
                    'status' => "ok",
                    'response' => 'Imagen Subida',
                ]);
            }else{
                $this->response([
                    'status' => "error",
                    'response' => 'Imagen no subida, intente nuevamente',
                ]);
            }
            
        }else {
            $this->response([
                'status' => "error",
                'response' => 'Autenticacion error',
            ]);
        }
    }
    
    public function deletePhoto_post() {
        if ($this->validatetoken()) {
            $id_photo = $this->post('idPhoto');
            if ($this->HistoryMaterial_model->delete_register($id_photo)) {
                $this->response([
                    'status' => "ok",
                    'response' => 'Registro eliminado',
                ]);
            } else {
                $this->response([
                    'status' => "error",
                    'response' => 'Registro no encontrado',
                ]);
            }
        } else {
            $this->response([
                'status' => "error",
                'response' => 'Autenticacion error',
            ]);
        }
    }

        public function validatetoken(){
        $headers = $this->input->request_headers();
        $token = $headers['token'];
        $user  = $this->Token_model->get_user($token);
        return $user;        
    }

}
