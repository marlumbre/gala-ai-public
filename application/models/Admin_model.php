<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function login($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $result = $this->db->get('admin');

        if ($result->num_rows() === 1) {
            $user = $result->row_array();

            // if (password_verify($password, $admin['password'])) {
            return $user;
            // }
        }
        return false;
    }

    public function count_user()
    {
        $this->db->where('valid', 1);
        return $this->db->count_all_results('user');
    }

    public function get_most_searched()
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->where('valid', 1);
        $this->db->group_by('input');
        $this->db->order_by('COUNT(*)', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->row_array();
    }

    public function get_trending_places()
    {
        $this->db->where('valid', 1);
        $result = $this->db->get('trending_places');
        return $result->result_array();
    }

    public function save_input($data)
    {
        $this->db->insert('user_data', $data);

        if ($this->db->affected_rows() > 0) {
            echo "Data inserted successfully!";
        } else {
            echo "Failed to insert data.";
        }
    }
}
