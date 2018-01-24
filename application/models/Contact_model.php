<?php
/**
 * Created by PhpStorm.
 * User: Luong Quoc Hung
 * Date: 1/24/18
 * Time: 10:27 AM
 */
class Contact_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function insert($data) {
        $this->db->set($data)->insert('contact');

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }

    public function get_all_with_pagination($limit = NULL, $start = NULL) {
        $this->db->select('*');
        $this->db->from('contact');
        $this->db->where('is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function count_all() {
        $this->db->select('*');
        $this->db->from('contact');
        $this->db->where('is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }
}