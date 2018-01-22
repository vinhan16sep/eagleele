<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Library_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_with_pagination($limit = NULL, $start = NULL) {
        $this->db->select('library.*, al.*');
        $this->db->from('library');
        $this->db->join('library_lang al', 'al.library_id = library.id');
        $this->db->where('library.is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by("library.id", "desc");

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
        $this->db->from('library');
        $this->db->join('library_lang', 'library_lang.library_id = library.id', 'left');
        $this->db->where('library_lang.language', $lang);
        $this->db->where('library.is_deleted', 0);
        $this->db->order_by("library.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function get_last_five_by_language($lang){
        $this->db->select('*');
        $this->db->from('library');
        $this->db->join('library_lang', 'library_lang.library_id = library.id', 'left');
        $this->db->where('library_lang.language', $lang);
        $this->db->where('library.is_deleted', 0);
        $this->db->limit(5);
        $this->db->order_by("library.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function get_latest_library($lang){
        $this->db->select('*');
        $this->db->from('library');
        $this->db->join('library_lang', 'library_lang.library_id = library.id', 'left');
        $this->db->where('library_lang.language', $lang);
        $this->db->where('library.is_deleted', 0);
        $this->db->limit(3);
        $this->db->order_by("library.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function count_all() {
        $this->db->select('*');
        $this->db->from('library');
        $this->db->where('is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }

    public function get_by_id($id, $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select('library.*, GROUP_CONCAT(library_lang.title ORDER BY library_lang.language separator \'|||\') as library_title, 
                            GROUP_CONCAT(library_lang.slug ORDER BY library_lang.language separator \'|||\') as library_slug,
                            GROUP_CONCAT(library_lang.meta_description ORDER BY library_lang.language separator \'|||\') as library_meta_description,
                            GROUP_CONCAT(library_lang.meta_keywords ORDER BY library_lang.language separator \'|||\') as library_meta_keywords,
                            GROUP_CONCAT(library_lang.description ORDER BY library_lang.language separator \'|||\') as library_description,
                            GROUP_CONCAT(library_lang.content ORDER BY library_lang.language separator \'|||\') as library_content');
        $this->db->from('library');
        $this->db->join('library_lang', 'library_lang.library_id = library.id', 'left');
        if($lang != ''){
            $this->db->where('library_lang.language', $lang);
        }
        $this->db->where('library.is_deleted', 0);
        $this->db->where('library.id', $id);
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function get_news_in_category_by_language($category_id, $lang = '') {
        $this->db->select('*');
        $this->db->from('library');
        $this->db->join('library_lang', 'library_lang.library_id = library.id', 'left');
        $this->db->where('library.type', 1);
        $this->db->where('library.category_id', $category_id);
        $this->db->where('library_lang.language', $lang);
        $this->db->where('library.is_deleted', 0);
        $this->db->order_by("library.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function insert($data) {
        $this->db->set($data)->insert('library');

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }

    public function insert_with_language($data_vi, $data_en){
        $data_merge = array($data_vi, $data_en);
        return $this->db->insert_batch('library_lang', $data_merge);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);

        return $this->db->update('library', $data);
    }

    public function update_with_language_vi($id, $data_vi){
        $this->db->where('library_id', $id);
        $this->db->where('language', 'vi');
        return $this->db->update('library_lang', $data_vi);
    }

    public function update_with_language_en($id, $data_en){
        $this->db->where('library_id', $id);
        $this->db->where('language', 'en');
        return $this->db->update('library_lang', $data_en);
    }

    public function remove($id, $set_delete) {
        $this->db->where('id', $id);

        return $this->db->update('library', $set_delete);
    }

}
