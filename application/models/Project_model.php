<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class project_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_with_pagination($limit = NULL, $start = NULL) {
        $this->db->select('*');
        $this->db->from('project');
        $this->db->where('is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->result_array();
    }

//    public function get_all_with_pagination($limit = NULL, $start = NULL) {
//        $this->db->select('project.*, pl.*');
//        $this->db->from('project');
//        $this->db->join('project_lang pl', 'pl.project_id = project.id');
//        $this->db->where('project.is_deleted', 0);
//        $this->db->limit($limit, $start);
//        $this->db->order_by("project.id", "desc");
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
        $this->db->from('project');
        $this->db->join('project_lang', 'project_lang.project_id = project.id', 'left');
        $this->db->where('project_lang.language', $lang);
        $this->db->where('project.is_deleted', 0);
        $this->db->order_by("project.id", "desc");

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
        $this->db->from('project');
        $this->db->join('project_lang', 'project_lang.project_id = project.id', 'left');
        $this->db->where('project_lang.language', $lang);
        $this->db->where('project.is_deleted', 0);
        $this->db->limit(3);
        $this->db->order_by("project.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function count_all() {
        $this->db->select('*');
        $this->db->from('project');
        $this->db->where('is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }

    public function get_by_id($slug, $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select('project.*, GROUP_CONCAT(project_lang.title ORDER BY project_lang.language separator \'|||\') as project_title, 
                            GROUP_CONCAT(project_lang.slug ORDER BY project_lang.language separator \'|||\') as project_slug,
                            GROUP_CONCAT(project_lang.meta_description ORDER BY project_lang.language separator \'|||\') as project_meta_description,
                            GROUP_CONCAT(project_lang.meta_keywords ORDER BY project_lang.language separator \'|||\') as project_meta_keywords,
                            GROUP_CONCAT(project_lang.description ORDER BY project_lang.language separator \'|||\') as project_description,
                            GROUP_CONCAT(project_lang.content ORDER BY project_lang.language separator \'|||\') as project_content,
                            GROUP_CONCAT(project_lang.language ORDER BY project_lang.language separator \'|||\') as project_language');
        $this->db->from('project');
        $this->db->join('project_lang', 'project_lang.project_id = project.id', 'left');
        if($lang != ''){
            $this->db->where('project_lang.language', $lang);
        }
        $this->db->where('project.is_deleted', 0);
        $this->db->where('project_lang.slug', $slug);
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function insert($data) {
        $this->db->set($data)->insert('project');

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }

    public function insert_with_language($data_vi, $data_en){
        $data_merge = array($data_vi, $data_en);
        return $this->db->insert_batch('project_lang', $data_merge);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);

        return $this->db->update('project', $data);
    }

    public function update_with_language_vi($id, $data_vi){
        $this->db->where('project_id', $id);
        $this->db->where('language', 'vi');
        return $this->db->update('project_lang', $data_vi);
    }

    public function update_with_language_en($id, $data_en){
        $this->db->where('project_id', $id);
        $this->db->where('language', 'en');
        return $this->db->update('project_lang', $data_en);
    }

    public function remove($id, $set_delete) {
        $this->db->where('id', $id);

        return $this->db->update('project', $set_delete);
    }

    public function get_id($id, $language = 'vi') {
        $this->db->select('*');
        $this->db->from('project_lang');
        $this->db->where('project_id', $id);
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
            $query = $this->db->get('project_lang');
            if ($query->num_rows() == 0) break;
            $temp_slug = $slug . '-' . (++$count);
        }
        return $temp_slug;
    }

    public function get_slug($slug) {
        $this->db->select('*');
        $this->db->from('project_lang');
        $this->db->where('slug', $slug);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->row_array();
    }

}
