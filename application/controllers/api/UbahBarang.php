<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class UbahBarang extends REST_Controller
{
    public function index_post()
    {
        $id = $this->post('id');
        $nama = $this->post('nama');
        $harga = $this->post('harga');
        $keterangan = $this->post('keterangan');
        $image = $this->_uploadImage();

        $data = $this->db->query("UPDATE `tb_barang` SET `nama` = '$nama', `keterangan` = '$keterangan', `harga` = '$harga', `image` = '$image' WHERE `tb_barang`.`id` = $id; ");

        if ($data) {
            $this->response(
                [
                    'status' => true,
                    'messages' => 'Data Berhasil Di Ubah',
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
        $config['file_name']            = $this->post('nama') . date('dmYHiS');
        $config['overwrite']            = true;
        $config['max_size']             = 8000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }
        return "default.jpg";

        // print_r($this->upload->display_errors());
    }
}
