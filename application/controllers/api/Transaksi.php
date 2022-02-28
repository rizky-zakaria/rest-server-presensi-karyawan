<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Transaksi extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index_get()
    {
        $data = $this->db->query("SELECT a.keterangan, a.id, a.timestamps, a.lokasi_acara, a.tgl_sewa, a.status, b.nama AS nama_peminjam, r.nama AS nama_barang FROM tb_transaksi a JOIN tb_user u JOIN tb_biodata b JOIN tb_barang r ON a.id_user = u.id AND a.id_barang = r.id AND u.id = b.id_user WHERE status = 'diajukan' ORDER BY a.tgl_sewa ASC")->result_array();
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
        $id = date("Ymdhis");
        $id_barang = $this->post('id_barang');
        $id_user = $this->post('id_user');
        $tgl_sewa = $this->post('tgl_sewa');
        $status = 'diajukan';
        $lokasi = $this->post('lokasi_acara');
        $timestamps = date('Ymd');

        $insert = $this->db->query("INSERT INTO tb_transaksi (id, id_barang, id_user, tgl_sewa, lokasi_acara, status, timestamps) VALUES ('$id', '$id_barang', '$id_user', '$tgl_sewa', '$lokasi', '$status', '$timestamps')");

        if ($insert) {
            $this->response(
                [
                    'status' => true,
                    'messages' => 'Data Berhasil Di Tambah',
                ],
                REST_Controller::HTTP_OK
            );
        } else {
            $this->response(
                [
                    'status' => false,
                    'messages' => 'Data Gagal DiTambahkan',
                ],
                REST_Controller::HTTP_NOT_FOUND
            );
        }
    }
}
