<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Galeri extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index_get()
    {
        $data = $this->db->get('tb_galeri')->result_array();
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

    public function index_post()
    {
        $foto = $this->_uploadImage();

        $data = $this->db->query("INSERT INTO tb_galeri (id, foto) VALUES (null, '$foto') ");

        if ($data) {
            $this->response(
                [
                    'status' => true,
                    'messages' => 'Data Berhasil Di Input',
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

    private function _uploadImage()
    {
        $config['upload_path']          = './assets/img';
        $config['allowed_types']        = 'jpg|png|jpeg|docx|pdf';
        $config['file_name']            = date('dmYHiS');
        $config['overwrite']            = true;
        $config['max_size']             = 8000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto')) {
            return $this->upload->data("file_name");
        }
        return "default.jpg";

        // print_r($this->upload->display_errors());
    }
}
