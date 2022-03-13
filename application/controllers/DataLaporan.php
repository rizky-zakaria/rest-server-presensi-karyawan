<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataLaporan extends CI_Controller
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
        $data['data'] = $this->db->query("SELECT * FROM laporan_kerja JOIN presensi JOIN user JOIN pegawai ON laporan_kerja.id_presensi = presensi.id_presensi AND presensi.id_user = user.id_user AND pegawai.id_user = user.id_user")->result_array();
        $this->load->view('templates/header');
        $this->load->view('laporan/index', $data);
        $this->load->view('templates/footer');
    }

    public function logout()
    {
        $data = array('username', 'password', 'role', 'status');
        $this->session->unset_userdata($data);
        redirect(base_url("LoginController"));
    }
}
