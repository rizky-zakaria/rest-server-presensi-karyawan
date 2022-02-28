<?php

class User_model extends CI_Model
{
    public function login($username, $password)
    {
        return $this->db->query("SELECT * FROM user WHERE username='$username' AND password='$password' ")->row_array();
    }
}
