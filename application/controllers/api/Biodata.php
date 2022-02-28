<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Biodata extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index_post()
    {
        $id_user = $this->post('id');

        $data = $this->db->query("SELECT * FROM `tb_user` JOIN tb_biodata ON tb_user.id = tb_biodata.id_user WHERE tb_user.id = $id_user")->row_array();
        if ($data) {
            $this->response(
                [
                    'status' => true,
                    'messages' => 'Data Anda',
                    'data' => $data,
                ],
                REST_Controller::HTTP_OK
            );
        } else {
            $this->response(
                [
                    'status' => false,
                    'messages' => 'Data Not Found',
                ],
                REST_Controller::HTTP_NOT_FOUND
            );
        }
    }
}
