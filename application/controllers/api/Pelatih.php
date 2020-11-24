<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pelatih extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }

    public function index_post()
    {
        $id = $this->post('id_user');
        $data = $this->db->query("SELECT * FROM  user JOIN tim JOIN lapangan JOIN pelatih JOIN jadwal WHERE user.id_user = $id AND pelatih.id_user=user.id_user")->result_array();
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
