<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_with_pagination($limit = NULL, $start = NULL) {
        $this->db->select('article.*, al.*');
        $this->db->from('article');
        $this->db->join('article_lang al', 'al.article_id = article.id');
        $this->db->where('article.is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by("article.id", "desc");

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
        $this->db->from('article');
        $this->db->join('article_lang', 'article_lang.article_id = article.id', 'left');
        $this->db->where('article_lang.language', $lang);
        $this->db->where('article.is_deleted', 0);
        $this->db->order_by("article.id", "desc");

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
        $this->db->from('article');
        $this->db->join('article_lang', 'article_lang.article_id = article.id', 'left');
        $this->db->where('article_lang.language', $lang);
        $this->db->where('article.is_deleted', 0);
        $this->db->limit(3);
        $this->db->order_by("article.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function count_all() {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }

    public function get_by_id($id, $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select('article.*, GROUP_CONCAT(article_lang.title ORDER BY article_lang.language separator \'|||\') as article_title, 
                            GROUP_CONCAT(article_lang.slug ORDER BY article_lang.language separator \'|||\') as article_slug,
                            GROUP_CONCAT(article_lang.meta_description ORDER BY article_lang.language separator \'|||\') as article_meta_description,
                            GROUP_CONCAT(article_lang.meta_keywords ORDER BY article_lang.language separator \'|||\') as article_meta_keywords,
                            GROUP_CONCAT(article_lang.description ORDER BY article_lang.language separator \'|||\') as article_description,
                            GROUP_CONCAT(article_lang.content ORDER BY article_lang.language separator \'|||\') as article_content,
                            GROUP_CONCAT(article_lang.event_cost ORDER BY article_lang.language separator \'|||\') as article_cost,
                            GROUP_CONCAT(article_lang.event_time ORDER BY article_lang.language separator \'|||\') as article_time,
                            GROUP_CONCAT(article_lang.event_location ORDER BY article_lang.language separator \'|||\') as article_location,
                            GROUP_CONCAT(article_lang.event_address ORDER BY article_lang.language separator \'|||\') as article_address');
        $this->db->from('article');
        $this->db->join('article_lang', 'article_lang.article_id = article.id', 'left');
        if($lang != ''){
            $this->db->where('article_lang.language', $lang);
        }
        $this->db->where('article.is_deleted', 0);
        $this->db->where('article.id', $id);
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function fetch_latest_article_by_type($type, $limit, $lang = '') {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->join('article_lang', 'article_lang.article_id = article.id', 'left');
        $this->db->where('article.type', $type);
        $this->db->where('article_lang.language', $lang);
        $this->db->where('article.is_deleted', 0);
        $this->db->limit($limit);
        $this->db->order_by("article.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function get_news_in_category_by_language($category_id, $lang = '') {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->join('article_lang', 'article_lang.article_id = article.id', 'left');
        $this->db->where('article.type', 1);
        $this->db->where('article.category_id', $category_id);
        $this->db->where('article_lang.language', $lang);
        $this->db->where('article.is_deleted', 0);
        $this->db->order_by("article.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function insert($data) {
        $this->db->set($data)->insert('article');

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }

    public function insert_with_language($data_vi, $data_en){
        $data_merge = array($data_vi, $data_en);
        return $this->db->insert_batch('article_lang', $data_merge);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);

        return $this->db->update('article', $data);
    }

    public function update_with_language_vi($id, $data_vi){
        $this->db->where('article_id', $id);
        $this->db->where('language', 'vi');
        return $this->db->update('article_lang', $data_vi);
    }

    public function update_with_language_en($id, $data_en){
        $this->db->where('article_id', $id);
        $this->db->where('language', 'en');
        return $this->db->update('article_lang', $data_en);
    }

    public function remove($id, $set_delete) {
        $this->db->where('id', $id);

        return $this->db->update('article', $set_delete);
    }

}
