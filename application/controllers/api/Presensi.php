<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Presensi extends REST_Controller
{

    public function index_post()
    {
        date_default_timezone_set('Asia/Makassar');
        $id_user = $this->post('id_user');
        $waktu_datang = date('H:i:s');
        $waktu_pulang = date('H:i:s');
        $tgl_presensi = date('d M Y');
        $keterangan = 'Hadir';
        $id_presensi = date('dMY') . $id_user;
        $flag = $this->post('flag');
        // var_dump($id_presensi);
        // die;
        if ($flag === 'datang') {
            $cek_datang = $this->db->query("SELECT waktu_datang FROM presensi WHERE id_presensi = '$id_presensi' AND waktu_datang = '-' ")->row_array();
            // var_dump($cek_datang);
            // die;
            if ($cek_datang !== null) {
                //     $this->response([
                //         'status' => false,
                //         'messages' => "Anda Telah Melakukan Presensi Datang Hari Ini"
                //     ], REST_Controller::HTTP_FOUND);
                // } else {
                if (date('H') < 9) {
                    $query = $this->db->query("UPDATE `presensi` SET `waktu_datang` = '$waktu_datang', `ket_datang` = 'Tepat Waktu' WHERE `presensi`.`id_presensi` = '$id_presensi'");
                    if ($query) {
                        $this->response([
                            'status' => true,
                            'messages' => "Berhasil Melakukan Presensi"
                        ], REST_Controller::HTTP_OK);
                    } else {
                        $this->response([
                            'status' => false,
                            'messages' => "Data Not Found"
                        ], REST_Controller::HTTP_NOT_FOUND);
                    }
                } else {
                    $query = $this->db->query("UPDATE `presensi` SET `waktu_datang` = '$waktu_datang', `ket_datang` = 'Terlambat' WHERE `presensi`.`id_presensi` = '$id_presensi'");
                    if ($query) {
                        $this->response([
                            'status' => true,
                            'messages' => "Berhasil Melakukan Presensi"
                        ], REST_Controller::HTTP_OK);
                    } else {
                        $this->response([
                            'status' => false,
                            'messages' => "Data Not Found"
                        ], REST_Controller::HTTP_NOT_FOUND);
                    }
                }
            } else {
                $this->response([
                    'status' => false,
                    'messages' => "Server Belum DiAktifkan"
                ], REST_Controller::HTTP_FOUND);
            }
        } else if ($flag === 'pulang') {
            $cek_pulang = $this->db->query("SELECT waktu_pulang FROM presensi WHERE id_presensi = '$id_presensi' ")->row_array();
            // var_dump($cek_pulang['waktu_pulang']);
            // die;
            if ($cek_pulang['waktu_pulang'] === "-") {
                if (date('H') < 17) {
                    $query = $this->db->query("UPDATE `presensi` SET `waktu_pulang` = '$waktu_pulang', `ket_pulang` = 'Cepat Pulang' WHERE `presensi`.`id_presensi` = '$id_presensi'");
                    if ($query) {
                        $this->response([
                            'status' => true,
                            'messages' => "Berhasil Melakukan Presensi Presensi Pulang"
                        ], REST_Controller::HTTP_OK);
                    } else {
                        $this->response([
                            'status' => false,
                            'messages' => "Data Not Found"
                        ], REST_Controller::HTTP_NOT_FOUND);
                    }
                } else {
                    $query = $this->db->query("UPDATE `presensi` SET `waktu_pulang` = '$waktu_pulang', `ket_pulang` = 'Tepat Waktu' WHERE `presensi`.`id_presensi` = '$id_presensi'");
                    if ($query) {
                        $this->response([
                            'status' => true,
                            'messages' => "Berhasil Melakukan Presensi Presensi Pulang"
                        ], REST_Controller::HTTP_OK);
                    } else {
                        $this->response([
                            'status' => false,
                            'messages' => "Data Not Found"
                        ], REST_Controller::HTTP_NOT_FOUND);
                    }
                }
            } elseif ($cek_pulang !== null) {
                $this->response([
                    'status' => false,
                    'messages' => "Anda Telah Melakukan Presensi Pulang Hari Ini"
                ], REST_Controller::HTTP_FOUND);
            }
        } else {
            $this->response([
                'status' => false,
                'messages' => "Gagal Melakukan Absensi"
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}
