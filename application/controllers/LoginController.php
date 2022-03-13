<?php

class LoginController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') == 'logedIn') {
            redirect(base_url("DataPegawai"));
        }
    }

    public function index()
    {
        $this->load->view('auth/index');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $data = $this->db->query("SELECT * FROM user WHERE username = '$username' AND password = '$password'")->row_array();
        if ($data) {
            $session = array(
                'username' => $data['username'],
                'password' => $data['password'],
                'role' => $data['role'],
                'status' => 'logedIn'
            );
            $this->session->set_userdata($session);
            redirect(base_url("DataPegawai"));
        } else {
            redirect(base_url("LoginController"));
        }
    }
}
