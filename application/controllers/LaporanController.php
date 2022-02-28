<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
    }

    public function laporan_seluruh()
    {
        $data['waktu'] = date('DMY');
        $data['data'] = $this->db->query("SELECT tb_transaksi.id,  tb_barang.nama AS nama_barang, tb_biodata.nama, tb_biodata.no_hp, tb_transaksi.tgl_sewa FROM tb_transaksi JOIN tb_user JOIN tb_biodata JOIN tb_barang ON tb_transaksi.id_user = tb_user.id AND tb_transaksi.id_barang = tb_barang.id AND tb_user.id = tb_biodata.id_user")->result_array();
        $this->load->view('laporan_pdf', $data);
    }

    public function laporan_tahunan()
    {
        $tahun = date('Y');
        var_dump($tahun);
        die;
        $data['data'] = $this->db->query("SELECT tb_transaksi.id,  tb_barang.nama AS nama_barang, tb_biodata.nama, tb_biodata.no_hp, tb_transaksi.tgl_sewa FROM tb_transaksi JOIN tb_user JOIN tb_biodata JOIN tb_barang ON tb_transaksi.id_user = tb_user.id AND tb_transaksi.id_barang = tb_barang.id AND tb_user.id = tb_biodata.id_user WHERE tb_transaksi.tgl_sewa LIKE '%$tahun%'")->result_array();
        $data['waktu'] = date('Y');
        $this->load->view('laporan_pdf', $data);
    }

    public function laporan_bulanan()
    {
        $bulan = date('m-Y');
        $data['data'] = $this->db->query("SELECT tb_transaksi.id,  tb_barang.nama AS nama_barang, tb_biodata.nama, tb_biodata.no_hp, tb_transaksi.tgl_sewa FROM tb_transaksi JOIN tb_user JOIN tb_biodata JOIN tb_barang ON tb_transaksi.id_user = tb_user.id AND tb_transaksi.id_barang = tb_barang.id AND tb_user.id = tb_biodata.id_user WHERE tb_transaksi.tgl_sewa LIKE '%$bulan%'")->result_array();
        $data['waktu'] = date('M');
        $this->load->view('laporan_pdf', $data);
    }

    public function laporan_batal()
    {
        $data['data'] = $this->db->query("SELECT tb_transaksi.id, tb_transaksi.keterangan, tb_barang.nama AS nama_barang, tb_biodata.nama, tb_biodata.no_hp, tb_transaksi.tgl_sewa FROM tb_transaksi JOIN tb_user JOIN tb_biodata JOIN tb_barang ON tb_transaksi.id_user = tb_user.id AND tb_transaksi.id_barang = tb_barang.id AND tb_user.id = tb_biodata.id_user WHERE tb_transaksi.status = 'dibatalkan' ")->result_array();
        // var_dump($data);
        $this->load->view('laporan_batal', $data);
    }

    public function laporan_diajukan()
    {
        $data['data'] = $this->db->query("SELECT tb_transaksi.id, tb_transaksi.keterangan, tb_barang.nama AS nama_barang, tb_biodata.nama, tb_biodata.no_hp, tb_transaksi.tgl_sewa FROM tb_transaksi JOIN tb_user JOIN tb_biodata JOIN tb_barang ON tb_transaksi.id_user = tb_user.id AND tb_transaksi.id_barang = tb_barang.id AND tb_user.id = tb_biodata.id_user WHERE tb_transaksi.status = 'diajukan' ")->result_array();
        // var_dump($data);
        $this->load->view('laporan_diajukan', $data);
    }
}
