<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Register extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index_post()
    {
        $username = $this->post('username');
        $password = md5($this->post('password'));
        $nama = $this->post('nama');
        $alamat = $this->post('alamat');
        $nik = $this->post('nik');
        $no_hp = $this->post('no_hp');
        $jk = $this->post('jk');
        // $foto = $this->post('foto');

        $cek_user = $this->db
            ->query("SELECT * FROM  tb_user WHERE username = '$username'")
            ->result_array();
        // var_dump($cek_user);
        // die;
        if ($cek_user != null) {
            $this->response([
                'status' => false,
                'messages' => 'Username Sudah DiGunakan',
            ]);
        } else {
            $cek_nik = $this->db
                ->query("SELECT * FROM tb_biodata WHERE nik = '$nik'")
                ->result_array();
            if ($cek_nik) {
                $this->response([
                    'status' => false,
                    'messages' => 'Nik Sudah Digunakan',
                ]);
            } else {
                $insert_user = $this->db->query(
                    "INSERT INTO `tb_user` (`id`, `username`, `password`, `role`) VALUES (NULL, '$username', '$password', '2')"
                );
                $get_user = $this->db
                    ->query(
                        "SELECT * FROM  tb_user WHERE username = '$username'"
                    )
                    ->row_array();
                if ($get_user) {
                    $data = $this->db->query(
                        'INSERT INTO `tb_biodata` (`id`, `id_user`, `nama`, `alamat`, `nik`, `no_hp`, `jk`) VALUES (NULL,' .
                            $get_user['id'] .
                            " , '$nama', '$alamat', '$nik', '$no_hp', '$jk')"
                    );
                    if ($data) {
                        $this->response(
                            [
                                'status' => true,
                                'messages' => 'Data Anda Berhasil Di Tambahkan',
                            ],
                            REST_Controller::HTTP_OK
                        );
                    } else {
                        $this->response(
                            [
                                'status' => false,
                                'messages' => 'Data Gagal Di Tambahkan',
                            ],
                            REST_Controller::HTTP_NOT_FOUND
                        );
                    }
                }
            }
        }
    }

    public function index_get()
    {
        $data = $this->db->get('tb_user')->result_array();
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
                    'status' => true,
                    'messages' => 'Data Not Found',
                    'data' => $data,
                ],
                REST_Controller::HTTP_NOT_FOUND
            );
        }
    }
}
