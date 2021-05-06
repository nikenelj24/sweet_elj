<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_laporan');
    }

    public function index()
    {
        $data = array(
            'tittle'            => 'Laporan Penjualan',
            // 'total_barang'      => $this->m_admin->total_barang(),   
            // 'total_kategori'    => $this->m_admin->total_kategori(),
            'isi'               => 'v_laporan'

        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function lap_harian()
    {   
        $input      = $this->input->post('tanggal');
        $tanggal    = date_format(date_create($input),'d');
        $bulan      = date_format(date_create($input),'m');
        $tahun      = date_format(date_create($input),'Y');

        $data = array(
            'tittle'    => 'Laporan Penjualan Harian',
            'tanggal'   => $tanggal,
            'bulan'     => $bulan,
            'tahun'     => $tahun,
            'laporan'   => $this->m_laporan->lap_harian($tanggal, $bulan, $tahun),
            'isi'       => 'v_lap_harian'

        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function lap_bulanan()
    {

        $input      = $this->input->post('bulan');
        $bulan      = date_format(date_create($input),'m');
        $tahun      = date_format(date_create($input),'Y');

        $data = array(
            'tittle'    => 'Laporan Penjualan Bulanan',
            'bulan'     => $bulan,
            'tahun'     => $tahun,
            'laporan'   => $this->m_laporan->lap_bulanan($bulan, $tahun),
            'isi'       => 'v_lap_bulanan'

        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function lap_tahunan()
    {

        $input      = $this->input->post('tahun');
        $tahun      = date_format(date_create($input),'Y');

        $data = array(
            'tittle'    => 'Laporan Penjualan Tahunan',
            'tahun'     => $tahun,
            'laporan'   => $this->m_laporan->lap_tahunan($tahun),
            'isi'       => 'v_lap_tahunan'

        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }
}

/* End of file Laporan.php */
