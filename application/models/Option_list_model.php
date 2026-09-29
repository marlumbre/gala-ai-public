<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Option_list_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function add_option($option_name, $option_type)
    {
        $data = array(
            'value' => $this->db->escape_str($option_name),
            'type' => $option_type,
            'valid' => 1
        );
        return $this->db->insert('data', $data);
    }

    public function get_options($option_type)
    {
        $this->db->where('type', $option_type);
        $this->db->where('valid', 1);
        $this->db->order_by('value');
        $query = $this->db->get('data');
        return $query->result_array();
    }

    public function delete_option($id)
    {
        $this->db->set('valid', 0);
        $this->db->where('id', $id);
        return $this->db->update('data');
    }
}
