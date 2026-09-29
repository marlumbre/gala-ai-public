<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_data_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_data($search, $limit, $offset)
    {
        $this->db->select('*');
        $this->db->where('valid', 1);
        $this->db->from('trending_places');

        if (!empty($search)) {
            $this->db->like('trend_place_name', $search);
            $this->db->or_like('trend_place_address', $search);
            $this->db->or_like('trend_place_id', $search);
        }

        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function count_data($search)
    {
        $this->db->select('COUNT(*) as count');
        $this->db->from('trending_places');

        if (!empty($search)) {
            $this->db->like('trend_place_name', $search);
            $this->db->or_like('trend_place_address', $search);
        }

        $query = $this->db->get();
        return $query->row()->count;
    }

    public function delete($id)
    {
        $this->db->set('valid', 0);
        $this->db->where('trend_place_id', $id);
        $this->db->update('trending_places');
    }

    public function insert_place($data)
    {
        $this->db->insert('trending_places', $data);
        return ($this->db->affected_rows() > 0);
    }

    public function get_carousel_images()
    {
        return $this->db->get('carousel_images')->result_array();
    }
}
