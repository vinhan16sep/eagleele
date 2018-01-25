<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Introduce_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_with_pagination($limit = NULL, $start = NULL) {
        $this->db->select('*');
        $this->db->from('introduce');
        $this->db->where('is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->result_array();
    }

//    public function get_all_with_pagination($limit = NULL, $start = NULL) {
//        $this->db->select('introduce.*, il.*');
//        $this->db->from('introduce');
//        $this->db->join('introduce_lang il', 'il.introduce_id = introduce.id');
//        $this->db->where('introduce.is_deleted', 0);
//        $this->db->limit($limit, $start);
//        $this->db->order_by("introduce.id", "desc");
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
        $this->db->from('introduce');
        $this->db->join('introduce_lang', 'introduce_lang.introduce_id = introduce.id', 'left');
        $this->db->where('introduce_lang.language', $lang);
        $this->db->where('introduce.is_deleted', 0);
        $this->db->order_by("introduce.id", "desc");

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
        $this->db->from('introduce');
        $this->db->join('introduce_lang', 'introduce_lang.introduce_id = introduce.id', 'left');
        $this->db->where('introduce_lang.language', $lang);
        $this->db->where('introduce.is_deleted', 0);
        $this->db->limit(3);
        $this->db->order_by("introduce.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function count_all() {
        $this->db->select('*');
        $this->db->from('introduce');
        $this->db->where('is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }

    public function get_by_id($id, $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select('introduce.*, GROUP_CONCAT(introduce_lang.title ORDER BY introduce_lang.language separator \'|||\') as introduce_title, 
                            GROUP_CONCAT(introduce_lang.content ORDER BY introduce_lang.language separator \'|||\') as introduce_content');
        $this->db->from('introduce');
        $this->db->join('introduce_lang', 'introduce_lang.introduce_id = introduce.id', 'left');
        if($lang != ''){
            $this->db->where('introduce_lang.language', $lang);
        }
        $this->db->where('introduce.is_deleted', 0);
        $this->db->where('introduce.id', $id);
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function insert($data) {
        $this->db->set($data)->insert('introduce');

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }

    public function insert_with_language($data_vi, $data_en){
        $data_merge = array($data_vi, $data_en);
        return $this->db->insert_batch('introduce_lang', $data_merge);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);

        return $this->db->update('introduce', $data);
    }

    public function update_with_language_vi($id, $data_vi){
        $this->db->where('introduce_id', $id);
        $this->db->where('language', 'vi');
        return $this->db->update('introduce_lang', $data_vi);
    }

    public function update_with_language_en($id, $data_en){
        $this->db->where('introduce_id', $id);
        $this->db->where('language', 'en');
        return $this->db->update('introduce_lang', $data_en);
    }

    public function remove($id, $set_delete) {
        $this->db->where('id', $id);

        return $this->db->update('introduce', $set_delete);
    }

}
