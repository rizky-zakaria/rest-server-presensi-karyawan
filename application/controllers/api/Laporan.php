<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Laporan extends REST_Controller
{
    public function index_post()
    {
        $laporan = $this->post('laporan');
        $id_user = $this->post('id_user');
        $id_laporan = date('dMY') . $id_user;
        $tgl_presensi = date('d M Y');

        // $cek = $this->db->query("");

        $absensi = $this->db->query("SELECT id_presensi FROM presensi WHERE id_user = $id_user AND tgl_presensi = '$tgl_presensi'")->row_array();
        $id_presensi = $absensi['id_presensi'];

        $cek = $this->db->query("SELECT id_laporan FROM laporan_kerja WHERE id_presensi = '$id_presensi' AND tgl_laporan = '$tgl_presensi'")->row_array();

        if ($cek) {
            $this->response([
                'status' => false,
                'messages' => "Anda telah melakukan pelaporan"
            ], REST_Controller::HTTP_NOT_FOUND);
        } else {
            $query = $this->db->query("INSERT INTO `laporan_kerja` (`id_laporan`, `id_presensi`, `uraian_pekerjaan`, `tgl_laporan`) VALUES ('$id_laporan', '$id_presensi', '$laporan', '$tgl_presensi')");
            if ($query) {
                $this->response([
                    'status' => true,
                    'messages' => "Berhasil Menambahkan Laporan"
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'messages' => "Data Not Found"
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }
}
