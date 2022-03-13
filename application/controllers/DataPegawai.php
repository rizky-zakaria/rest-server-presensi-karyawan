<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPegawai extends CI_Controller
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
        $data['data'] = $this->db->query("SELECT * FROM user JOIN pegawai ON user.id_user = pegawai.id_user WHERE user.role = '2' OR user.role = '3' ")->result_array();
        $this->load->view('templates/header');
        $this->load->view('base/index', $data);
        $this->load->view('templates/footer');
    }

    public function logout()
    {
        $data = array('username', 'password', 'role', 'status');
        $this->session->unset_userdata($data);
        redirect(base_url("LoginController"));
    }

    public function tambah()
    {
        $this->load->view('templates/header');
        $this->load->view('base/tambah');
        $this->load->view('templates/footer');
    }

    public function insert()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role = $this->input->post('role');
        $nama = $this->input->post('nama');
        $jabatan = $this->input->post('jabatan');
        $ttl = $this->input->post('ttl');
        $alamat = $this->input->post('alamat');
        $jk = $this->input->post('jk');
        $no_telp = $this->input->post('no_telp');
        // var_dump($username, $password, $role, $nama, $jabatan, $ttl, $alamat, $jk, $alamat, $no_telp);
        // die;
        $cekUser = $this->db->query("SELECT * FROM user WHERE username = '$username' AND password = '$password'")->row_array();
        // var_dump($cekUser);
        // die;
        if ($cekUser !== null) {
            redirect(base_url("DataPegawai"));
        } else {
            $insertUser = $this->db->query("INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES (NULL, '$username', MD5('$password'), '$role')");
            if ($insertUser) {
                $data = $this->db->query("SELECT * FROM user WHERE username = '$username' AND password = MD5('$password')")->row_array();
                // var_dump($data);
                // die;
                $id = $data['id_user'];
                $inserPegawai = $this->db->query("INSERT INTO `pegawai` (`id_pegawai`, `id_user`, `nama`, `jabatan`, `tempat_tgl_lahir`, `alamat`, `jenis_kelamin`, `no_telp`) VALUES (NULL, '$id', '$nama', '$jabatan', '$ttl', '$alamat', '$jk', '$no_telp')");
                if ($inserPegawai) {
                    redirect(base_url("DataPegawai"));
                } else {
                    redirect(base_url("DataPegawai"));
                }
            }
        }
    }

    public function hapus($id_user)
    {
        $id = $this->db->query("SELECT id_presensi FROM presensi WHERE id_user = $id_user")->row_array();
        if ($id) {
            $this->db->query("DELETE FROM pegawai WHERE id_user = $id_user");
            $this->db->query("DELETE FROM laporan_kerja WHERE id_presensi = $id");
            $this->db->query("DELETE FROM presensi WHERE id_user = $id_user");
            $this->db->query("DELETE FROM user WHERE id_user = $id_user");
            redirect(base_url("DataPegawai"));
        } else {
            $this->db->query("DELETE FROM pegawai WHERE id_user = $id_user");
            $this->db->query("DELETE FROM user WHERE id_user = $id_user");
            redirect(base_url("DataPegawai"));
        }
    }

    public function edit($id_user)
    {
        $data['id_user'] = $id_user;
        $this->load->view('templates/header');
        $this->load->view('base/reset', $data);
        $this->load->view('templates/footer');
    }

    public function reset()
    {
        $password = $this->input->post('password');
        $id = $this->input->post('id_user');
        $this->db->query("UPDATE `user` SET `password` = MD5('$password') WHERE `user`.`id_user` = $id");
        redirect(base_url("DataPegawai"));
    }
}
