<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_with_pagination($limit = NULL, $start = NULL) {
        $this->db->select('teacher.*, tl.*');
        $this->db->from('teacher');
        $this->db->join('teacher_lang tl', 'tl.teacher_id = teacher.id');
        $this->db->where('teacher.is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by("teacher.id", "desc");

        $result = $this->db->get()->result_array();

        $converted_data = array();

        for($i = 0; $i < count($result); $i++){
            if(($i % 2) == 0){
                $converted_data[] = array_merge_recursive($result[$i], $result[$i + 1]);
            }
        }

        return $converted_data;
    }

    public function get_all_by_language($lang){
        $this->db->select('*');
        $this->db->from('teacher');
        $this->db->join('teacher_lang', 'teacher_lang.teacher_id = teacher.id', 'left');
        $this->db->where('teacher_lang.language', $lang);
        $this->db->where('teacher.is_deleted', 0);
        $this->db->order_by("teacher.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function get_all() {
        $this->db->select('*');
        $this->db->from('blog');
        $this->db->where('is_deleted', 0);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function get_latest_article($lang){
        $this->db->select('*');
        $this->db->from('teacher');
        $this->db->join('teacher_lang', 'teacher_lang.teacher_id = teacher.id', 'left');
        $this->db->where('teacher_lang.language', $lang);
        $this->db->where('teacher.is_deleted', 0);
        $this->db->limit(3);
        $this->db->order_by("teacher.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function count_all() {
        $this->db->select('*');
        $this->db->from('teacher');
        $this->db->where('is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }

    public function get_by_id($id, $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select('teacher.*, GROUP_CONCAT(teacher_lang.name ORDER BY teacher_lang.language separator \'|||\') as teacher_name, 
                            GROUP_CONCAT(teacher_lang.slug ORDER BY teacher_lang.language separator \'|||\') as teacher_slug,
                            GROUP_CONCAT(teacher_lang.meta_description ORDER BY teacher_lang.language separator \'|||\') as teacher_meta_description,
                            GROUP_CONCAT(teacher_lang.meta_keywords ORDER BY teacher_lang.language separator \'|||\') as teacher_meta_keywords,
                            GROUP_CONCAT(teacher_lang.position ORDER BY teacher_lang.language separator \'|||\') as teacher_position,
                            GROUP_CONCAT(teacher_lang.bio ORDER BY teacher_lang.language separator \'|||\') as teacher_bio');
        $this->db->from('teacher');
        $this->db->join('teacher_lang', 'teacher_lang.teacher_id = teacher.id', 'left');
        if($lang != ''){
            $this->db->where('teacher_lang.language', $lang);
        }
        $this->db->where('teacher.is_deleted', 0);
        $this->db->where('teacher.id', $id);
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function insert($data) {
        $this->db->set($data)->insert('teacher');

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }

    public function insert_with_language($data_vi, $data_en){
        $data_merge = array($data_vi, $data_en);
        return $this->db->insert_batch('teacher_lang', $data_merge);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);

        return $this->db->update('teacher', $data);
    }

    public function update_with_language_vi($id, $data_vi){
        $this->db->where('teacher_id', $id);
        $this->db->where('language', 'vi');
        return $this->db->update('teacher_lang', $data_vi);
    }

    public function update_with_language_en($id, $data_en){
        $this->db->where('teacher_id', $id);
        $this->db->where('language', 'en');
        return $this->db->update('teacher_lang', $data_en);
    }

    public function remove($id, $set_delete) {
        $this->db->where('id', $id);

        return $this->db->update('teacher', $set_delete);
    }

}
