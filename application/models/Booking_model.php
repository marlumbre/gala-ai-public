<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Booking_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_province_data()
    {
        $this->db->where(array(
            'type' => 'province',
            'valid' => 1
        ));
        $result = $this->db->get('data');
        return $result->result_array();
    }

    public function get_place_data()
    {
        $this->db->where(array(
            'type' => 'place',
            'valid' => 1
        ));
        $this->db->order_by('value', 'ASC');
        $result = $this->db->get('data');
        return $result->result_array();
    }

    public function get_budget_data()
    {
        $this->db->where(array(
            'type' => 'budget',
            'valid' => 1
        ));
        $result = $this->db->get('data');
        return $result->result_array();
    }

    public function get_filter_data()
    {
        $this->db->where(array(
            'type' => 'filter',
            'valid' => 1
        ));
        $result = $this->db->get('data');
        return $result->result_array();
    }

    public function get_count_data()
    {
        $this->db->where(array(
            'type' => 'count',
            'valid' => 1
        ));
        $result = $this->db->get('data');
        return $result->result_array();
    }

    public function get_places($user_id)
    {
        $this->db->select('name AS title, date AS start, description, location, type');
        $this->db->from('places');

        $this->db->where('user_id', $user_id);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function save_place($data)
    {
        $this->db->insert('places', $data);
        return $this->db->insert_id();
    }
}
