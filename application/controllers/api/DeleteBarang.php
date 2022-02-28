<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class DeleteBarang extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index_post()
    {
        $id_barang = $this->post('id');
        $data = $this->db->query("SELECT * FROM tb_transaksi WHERE id_barang = $id_barang")->row_array();
        if ($data != null) {
            $this->db->query("DELETE FROM tb_transaksi WHERE id_barang = $id_barang");
            $hapus = $this->db->query("DELETE FROM tb_barang WHERE id = $id_barang");
            if ($hapus > 0) {
                $this->response(
                    [
                        'status' => true,
                        'messages' => 'Data Berhasil DiHapus',
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
        } else {
            $hapus = $this->db->query("DELETE FROM tb_barang WHERE id = $id_barang");
            if ($hapus > 0) {
                $this->response(
                    [
                        'status' => true,
                        'messages' => 'Data Berhasil DiHapus',
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
}
