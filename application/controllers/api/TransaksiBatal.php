<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class TransaksiBatal extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index_get()
    {
        $data = $this->db->query("SELECT a.keterangan, a.id, a.timestamps, a.lokasi_acara, a.tgl_sewa, a.status, b.nama AS nama_peminjam, r.nama AS nama_barang FROM tb_transaksi a JOIN tb_user u JOIN tb_biodata b JOIN tb_barang r ON a.id_user = u.id AND a.id_barang = r.id AND u.id = b.id_user WHERE status = 'Dibatalkan' ORDER BY a.tgl_sewa ASC")->result_array();
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
        $id = $this->post('id');
        $alasan = $this->post('keterangan');
        $date = date('Ymd');
        $data = $this->db->query("UPDATE `tb_transaksi` SET `status`='Dibatalkan', keterangan='$alasan', timestamps='$date' WHERE id = '$id'");

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
