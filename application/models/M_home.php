<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
        $this->db->join('tb_bahan', 'tb_bahan.id_bahan = tb_barang.id_bahan', 'left');

        $this->db->order_by('id_barang', 'asc');
        return $this->db->get()->result();
    }

    public function get_all_data_kategori()
    {
        $this->db->select('*');
        $this->db->from('tb_kategori');
        $this->db->order_by('id_kategori', 'asc');
        return $this->db->get()->result();
    }

    public function get_filter($id_kategori=null,$id_bahan=null,$min=0,$max=0)
    {
        $where="";
        $nowhere=0;
        if ($id_kategori !== null) {
            $where .= $nowhere > 0 ? " and " : "";
            $where .= " tb_barang.id_kategori = ".$id_kategori." ";   
            $nowhere++;
        }
        if ($id_bahan !== null) {
            $where .= $nowhere > 0 ? " and " : "";
            $where .= " tb_barang.id_bahan = ".$id_bahan." ";   
            $nowhere++;
        }
        if ($min !== null) {
            $where .= $nowhere > 0 ? " and " : "";
            $where .= " tb_barang.harga >= ".$min." ";   
            $nowhere++;
        }
        if ($max !== null) {
            $where .= $nowhere > 0 ? " and " : "";
            $where .= " tb_barang.harga <= ".$max." ";   
            $nowhere++;
        }
        $where = $nowhere > 0 ? " where ".$where : "";
        $sql="
        SELECT * FROM tb_barang
        LEFT JOIN tb_kategori on tb_kategori.id_kategori = tb_barang.id_kategori
        LEFT JOIN tb_bahan on tb_bahan.id_bahan = tb_barang.id_bahan
        $where
        ";
        // print_r($sql);exit;
        return $this->db->query($sql)->result();
    }

    public function detail_brg($id_barang)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
        $this->db->join('tb_bahan', 'tb_bahan.id_bahan = tb_barang.id_bahan', 'left');

        $this->db->where('id_barang', $id_barang);
        return $this->db->get()->row();
    }

    public function gambar_brg($id_barang)
    {
        $this->db->select('*');
        $this->db->from('tb_gambar');
        $this->db->where('id_barang', $id_barang);

        return $this->db->get()->result();
    }

    public function kategori($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('tb_kategori');
        $this->db->where('id_kategori', $id_kategori);

        return $this->db->get()->row();
    }

    public function get_all_data_brg($id_kategori)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
        $this->db->join('tb_bahan', 'tb_bahan.id_bahan = tb_barang.id_bahan', 'left');
        $this->db->where('tb_barang.id_kategori', $id_kategori);

        $this->db->order_by('id_barang', 'asc');
        return $this->db->get()->result();
    }

    public function get_all_data_bhn()
    {
        $this->db->select('*');
        $this->db->from('tb_bahan');
        $this->db->order_by('id_bahan', 'asc');
        return $this->db->get()->result();
    }

    public function bahan($id_bahan)
    {
        $this->db->select('*');
        $this->db->from('tb_bahan');
        $this->db->where('id_bahan', $id_bahan);

        return $this->db->get()->row();
    }

    public function get_all_data_bahan($id_bahan)
    {
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_barang.id_kategori', 'left');
        $this->db->join('tb_bahan', 'tb_bahan.id_bahan = tb_barang.id_bahan', 'left');
        $this->db->where('tb_barang.id_bahan', $id_bahan);

        $this->db->order_by('id_barang', 'asc');
        return $this->db->get()->result();
    }
}
