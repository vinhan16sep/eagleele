<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Advice_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_with_pagination($limit = NULL, $start = NULL) {
        $this->db->select('*');
        $this->db->from('advice');
        $this->db->where('is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->result_array();
    }

//    public function get_all_with_pagination($limit = NULL, $start = NULL) {
//        $this->db->select('advice.*, al.*');
//        $this->db->from('advice');
//        $this->db->join('advice_lang al', 'al.advice_id = advice.id');
//        $this->db->where('advice.is_deleted', 0);
//        $this->db->limit($limit, $start);
//        $this->db->order_by("advice.id", "asc");
//
//        $result = $this->db->get()->result_array();
//
//        $converted_data = array();
//
//        for($i = 0; $i < count($result); $i++){
//            if(($i % 2) == 0){
//                $converted_data[] = array_merge_recursive($result[$i], $result[$i + 1]);
//            }
//        }
//
//        return $converted_data;
//    }

    public function get_all_by_language($lang){
        $this->db->select('*');
        $this->db->from('advice');
        $this->db->join('advice_lang', 'advice_lang.advice_id = advice.id', 'left');
        $this->db->where('advice_lang.language', $lang);
        $this->db->where('advice.is_deleted', 0);
        $this->db->order_by("advice.id", "desc");

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
        $this->db->from('advice');
        $this->db->join('advice_lang', 'advice_lang.advice_id = advice.id', 'left');
        $this->db->where('advice_lang.language', $lang);
        $this->db->where('advice.is_deleted', 0);
        $this->db->limit(3);
        $this->db->order_by("advice.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function count_all() {
        $this->db->select('*');
        $this->db->from('advice');
        $this->db->where('is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }

    public function get_by_id($slug, $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select('advice.*, GROUP_CONCAT(advice_lang.title ORDER BY advice_lang.language separator \'|||\') as advice_title, 
                            GROUP_CONCAT(advice_lang.slug ORDER BY advice_lang.language separator \'|||\') as advice_slug,
                            GROUP_CONCAT(advice_lang.meta_description ORDER BY advice_lang.language separator \'|||\') as advice_meta_description,
                            GROUP_CONCAT(advice_lang.meta_keywords ORDER BY advice_lang.language separator \'|||\') as advice_meta_keywords,
                            GROUP_CONCAT(advice_lang.description ORDER BY advice_lang.language separator \'|||\') as advice_description,
                            GROUP_CONCAT(advice_lang.content ORDER BY advice_lang.language separator \'|||\') as advice_content,
                            GROUP_CONCAT(advice_lang.language ORDER BY advice_lang.language separator \'|||\') as advice_language');
        $this->db->from('advice');
        $this->db->join('advice_lang', 'advice_lang.advice_id = advice.id', 'left');
        if($lang != ''){
            $this->db->where('advice_lang.language', $lang);
        }
        $this->db->where('advice.is_deleted', 0);
        $this->db->where('advice_lang.slug', $slug);
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function get_by_id_admin($id, $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select('advice.*, GROUP_CONCAT(advice_lang.title ORDER BY advice_lang.language separator \'|||\') as advice_title, 
                            GROUP_CONCAT(advice_lang.slug ORDER BY advice_lang.language separator \'|||\') as advice_slug,
                            GROUP_CONCAT(advice_lang.meta_description ORDER BY advice_lang.language separator \'|||\') as advice_meta_description,
                            GROUP_CONCAT(advice_lang.meta_keywords ORDER BY advice_lang.language separator \'|||\') as advice_meta_keywords,
                            GROUP_CONCAT(advice_lang.description ORDER BY advice_lang.language separator \'|||\') as advice_description,
                            GROUP_CONCAT(advice_lang.content ORDER BY advice_lang.language separator \'|||\') as advice_content');
        $this->db->from('advice');
        $this->db->join('advice_lang', 'advice_lang.advice_id = advice.id', 'left');
        if($lang != ''){
            $this->db->where('advice_lang.language', $lang);
        }
        $this->db->where('advice.is_deleted', 0);
        $this->db->where('advice.id', $id);
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function insert($data) {
        $this->db->set($data)->insert('advice');

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }

    public function insert_with_language($data_vi, $data_en){
        $data_merge = array($data_vi, $data_en);
        return $this->db->insert_batch('advice_lang', $data_merge);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);

        return $this->db->update('advice', $data);
    }

    public function update_with_language_vi($id, $data_vi){
        $this->db->where('advice_id', $id);
        $this->db->where('language', 'vi');
        return $this->db->update('advice_lang', $data_vi);
    }

    public function update_with_language_en($id, $data_en){
        $this->db->where('advice_id', $id);
        $this->db->where('language', 'en');
        return $this->db->update('advice_lang', $data_en);
    }

    public function remove($id, $set_delete) {
        $this->db->where('id', $id);

        return $this->db->update('advice', $set_delete);
    }

    public function get_id($id, $language = 'vi') {
        $this->db->select('*');
        $this->db->from('advice_lang');
        $this->db->where('advice_id', $id);
        $this->db->where('language', $language);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->row_array();
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
            $query = $this->db->get('advice_lang');
            if ($query->num_rows() == 0) break;
            $temp_slug = $slug . '-' . (++$count);
        }
        return $temp_slug;
    }
    public function get_slug($slug) {
        $this->db->select('*');
        $this->db->from('advice_lang');
        $this->db->where('slug', $slug);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->row_array();
    }

}
