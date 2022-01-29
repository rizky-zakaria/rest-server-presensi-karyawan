<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Auth extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }

    public function index_post()
    {
        $username = $this->post('username');
        $password = md5($this->post('password'));
        $data = $this->db->query("SELECT * FROM  tb_user WHERE username = '$username' AND password='$password'")->result_array();
        if ($data) {
            $this->response([
                'status' => true,
                'messages' => "Data Anda",
                'data' => $data,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => true,
                'messages' => "Data Not Found",
                'data' => $data,
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_get()
    {
        $data = $this->db->get('tb_user')->result_array();
        if ($data) {
            $this->response([
                'status' => true,
                'messages' => "Data Anda",
                'data' => $data,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => true,
                'messages' => "Data Not Found",
                'data' => $data,
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
