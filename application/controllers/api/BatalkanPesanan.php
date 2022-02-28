<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class BatalkanPesanan extends REST_Controller
{

    public function index_post()
    {

        $id = $this->post('id');
        $data = $this->db->query("UPDATE `tb_transaksi` SET `status`='Dibatalkan', keterangan='Telah Di Booking' WHERE id = '$id'");

        if ($data) {
            $this->response(
                [
                    'status' => true,
                    'messages' => 'Data Berhasil DiBatalkan',
                ],
                REST_Controller::HTTP_OK
            );
        } else {
            $this->response(
                [
                    'status' => false,
                    'messages' => 'Data Gagal DiBatalkan',
                ],
                REST_Controller::HTTP_NOT_FOUND
            );
        }
    }
}
