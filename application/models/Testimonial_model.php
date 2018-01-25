<?php
/**
 * Created by PhpStorm.
 * User: Luong Quoc Hung
 * Date: 1/23/18
 * Time: 11:35 AM
 */
class Testimonial_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function get_all_with_pagination($limit = NULL, $start = NULL) {
        $this->db->select('*');
        $this->db->from('testimonial');
        $this->db->where('is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->result_array();
    }
    public function count_all() {
        $this->db->select('*');
        $this->db->from('testimonial');
        $this->db->where('is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }

    public function build_unique_slug($slug, $id = null){
        $count = 0;
        $temp_slug = $slug;
        while(true) {
            $this->db->select('id');
            $this->db->where('slug', $temp_slug);
            if($id != null){
                $this->db->where('id !=', $id);
            }
            $query = $this->db->get('testimonial');
            if ($query->num_rows() == 0) break;
            $temp_slug = $slug . '-' . (++$count);
        }
        return $temp_slug;
    }

    public function get_by_id($id, $lang = '') {
        $this->db->select('*');
        $this->db->from('testimonial');
        $this->db->where('is_deleted', 0);
        $this->db->where('id', $id);
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function insert($data) {
        $this->db->set($data)->insert('testimonial');

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

    public function update($id, $data) {
        $this->db->where('id', $id);

        return $this->db->update('testimonial', $data);
    }

    public function delete($id){
        $this->db->set('is_deleted', 1);
        $this->db->where('id', $id);
        $this->db->update('testimonial');

        if($this->db->affected_rows() == 1){
            return true;
        }

        return false;
    }

}