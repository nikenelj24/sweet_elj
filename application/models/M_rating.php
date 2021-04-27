<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_rating extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function add($data)
    {
        $this->db->insert('tb_rating', $data);
    }
    public function getRating($id_barang){
        return $this->db->select('avg(rating) as rating')->from('tb_rating')->where("id_barang",$id_barang)->get()->row()->rating;
    }
    public function getAllUsers(){
        return $this->db->query('SELECT DISTINCT user from tb_rating ORDER BY user asc')->result();
    }
    public function getCoordinates($user,$id_barang){
        return @$this->db->select('rating')->from('tb_rating')->where("id_barang",$id_barang)->where("user",$user)->get()->row()->rating;
    }


    // Fetch records
    public function getAllPosts($id_pelanggan)
    {

        // Posts
        $this->db->select('*');
        $this->db->from('tb_barang');
        $this->db->order_by("id_barang", "asc");
        $postsquery = $this->db->get();

        $postResult = $postsquery->result_array();

        $posts_arr = array();
        foreach ($postResult as $post) {
            $id_barang = $post['id_barang'];
            $nama_barang = $post['nama_barang'];
            // $id_kategori = $post['id_kategori'];
            // $harga = $post['harga'];
            // $deskripsi = $post['deskripsi'];
            // $id_bahan = $post['id_bahan'];
            // $gambar = $post['gambar'];
            // $berat = $post['berat'];

            // User rating
            $this->db->select('rating');
            $this->db->from('tb_rating');
            $this->db->where("id_pelanggan", $id_pelanggan);
            $this->db->where("id_barang", $id_barang);
            $userRatingquery = $this->db->get();

            $userpostResult = $userRatingquery->result_array();

            $userRating = 0;
            if (count($userpostResult) > 0) {
                $userRating = $userpostResult[0]['rating'];
            }

            // Average rating
            $this->db->select('ROUND(AVG(rating),1) as averageRating');
            $this->db->from('tb_rating');
            $this->db->where("id_barang", $id_barang);
            $ratingquery = $this->db->get();

            $postResult = $ratingquery->result_array();

            $rating = $postResult[0]['averageRating'];

            if ($rating == '') {
                $rating = 0;
            }

            $posts_arr[] = array(
                "id_barang" => $id_barang, "nama_barang" => $nama_barang,
                // "id_kategori" => $id_kategori, "harga" => $harga,
                // "deskripsi" => $deskripsi, "id_bahan" => $id_bahan,
                // "gambar" => $gambar, "berat" => $berat,
                "rating" => $userRating, "averagerating" => $rating
            );
        }

        return $posts_arr;
    }
    public function viewRating($id_barang)
    {
        $this->db->select('*');
        $this->db->from('tb_rating');
        $this->db->where("id_barang", $id_barang);
        return $this->db->get()->result();
    }
    // Save user rating
    public function userRating($id_pelanggan, $id_barang, $rating)
    {
        $this->db->select('*');
        $this->db->from('tb_rating');
        $this->db->where("id_barang", $id_barang);
        $this->db->where("id_pelanggan", $id_pelanggan);
        $userRatingquery = $this->db->get();

        $userRatingResult = $userRatingquery->result_array();
        if (count($userRatingResult) > 0) {

            $postRating_id = $userRatingResult[0]['id_rating'];
            // Update
            $value = array('rating' => $rating);
            $this->db->where('id_rating', $postRating_id);
            $this->db->update('tb_rating', $value);
        } else {
            $userRating = array(
                "id_barang" => $id_barang,
                "id_pelanggan" => $id_pelanggan,
                "rating" => $rating
            );

            $this->db->insert('tb_rating', $userRating);
        }

        // Average rating
        $this->db->select('ROUND(AVG(rating),1) as averageRating');
        $this->db->from('tb_rating');
        $this->db->where("id_barang", $id_barang);
        $ratingquery = $this->db->get();

        $postResult = $ratingquery->result_array();

        $rating = $postResult[0]['averageRating'];

        if ($rating == '') {
            $rating = 0;
        }

        return $rating;
    }
}
