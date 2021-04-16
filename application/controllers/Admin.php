<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_pesanan_masuk');
    }

    public function index()
    {
        $data = array(
            'tittle'            => 'Dashboard',
            'total_barang'      => $this->m_admin->total_barang(),
            'total_kategori'    => $this->m_admin->total_kategori(),
            'total_pesanan'     => $this->m_admin->total_pesanan(),
            'total_user'        => $this->m_admin->total_user(),
            'isi'               => 'v_admin'

        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    //setting raja ongkir
    public function setting()
    {
        $this->form_validation->set_rules(
            'nama_toko',
            'Nama Toko',
            'required',
            array('required' => '%s Harus Dipilih !')
        );
        $this->form_validation->set_rules(
            'kota',
            'Kota',
            'required',
            array('required' => '%s Harus Dipilih !')
        );
        $this->form_validation->set_rules(
            'alamat_toko',
            'Alamat Toko',
            'required',
            array('required' => '%s Harus Dipilih !')
        );
        $this->form_validation->set_rules(
            'no_tlp',
            'No Telepon',
            'required',
            array('required' => '%s Harus Dipilih !')
        );

        if ($this->form_validation->run() == FALSE) {

            $data = array(
                'tittle'            => 'Setting',
                'setting'           => $this->m_admin->data_setting(),
                'isi'               => 'v_setting'

            );
            $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        } else {
            $data = array(
                'id'   => 1,
                'lokasi' => $this->input->post('kota'),
                'nama_toko' => $this->input->post('nama_toko'),
                'alamat_toko' => $this->input->post('alamat_toko'),
                'no_tlp' => $this->input->post('no_tlp'),
            );
            $this->m_admin->edit($data);
            $this->session->set_flashdata('pesan', 'Settingan Berhasil di Ganti !');
            redirect('admin/setting');
        }
    }

    public function pesanan_masuk()
    {
        $data = array(
            'tittle'            => 'Pesanan Masuk',
            'pesanan'           => $this->m_pesanan_masuk->pesanan(),
            'pesanan_diproses'  => $this->m_pesanan_masuk->pesanan_diproses(),
            'pesanan_dikirim'  => $this->m_pesanan_masuk->pesanan_dikirim(),
            'pesanan_selesai'  => $this->m_pesanan_masuk->pesanan_selesai(),
            'isi'               => 'v_pesanan_masuk'

        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function proses($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'status_order' => '1'
        );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Pesanan Berhasil DiProses !');
        redirect('admin/pesanan_masuk');
    }

    public function kirim($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'no_resi'      => $this->input->post('no_resi'),
            'status_order' => '2'
        );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Pesanan Berhasil Dikirim !');
        redirect('admin/pesanan_masuk');
    }
}
