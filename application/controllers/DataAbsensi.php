<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataAbsensi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != 'logedIn') {
            redirect(base_url("LoginController"));
        }
    }

    public function index()
    {
        $data['data'] = $this->db->query("SELECT * FROM presensi JOIN user JOIN pegawai ON presensi.id_user = user.id_user AND pegawai.id_user = user.id_user")->result_array();
        $this->load->view('templates/header');
        $this->load->view('absensi/index', $data);
        $this->load->view('templates/footer');
    }

    public function logout()
    {
        $data = array('username', 'password', 'role', 'status');
        $this->session->unset_userdata($data);
        redirect(base_url("LoginController"));
    }

    public function mulai_presensi()
    {
        date_default_timezone_set('Asia/Makassar');
        $getUser = $this->db->query("SELECT id_user from user")->result_array();
        // var_dump($getUser);
        $tgl_presensi = date('d M Y');
        foreach ($getUser as $key => $value) {
            $id_user = $value['id_user'];
            // $tgl = date('');
            $cek = $this->db->query("SELECT * FROM presensi WHERE tgl_presensi = '$tgl_presensi' AND id_user = $id_user")->result_array();
            // var_dump($cek);
            // die;
            if ($cek != null) {
                redirect(base_url('DataAbsensi'));
            } else {
                $id_presensi = date('dMY') . $id_user;
                $insert = $this->db->query("INSERT INTO `presensi` (`id_presensi`, `id_user`, `waktu_datang`, `waktu_pulang`, `tgl_presensi`, `ket_datang`, `ket_pulang`) VALUES ('$id_presensi', $id_user, '-', '-', '$tgl_presensi', 'Tidak Hadir', 'Tidak Hadir')");
            }
        }
        // foreach ($getUser as $key => $value) {
        //     $id_user = $value['id_user'];

        // }
        redirect(base_url('DataAbsensi'));
    }
}
