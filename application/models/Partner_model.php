<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Partner_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_with_pagination($limit = NULL, $start = NULL) {
        $this->db->select('partner.*, pl.*');
        $this->db->from('partner');
        $this->db->join('partner_lang pl', 'pl.partner_id = partner.id');
        $this->db->where('partner.is_deleted', 0);
        $this->db->limit($limit, $start);
        $this->db->order_by("partner.id", "desc");

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
        $this->db->from('partner');
        $this->db->join('partner_lang', 'partner_lang.partner_id = partner.id', 'left');
        $this->db->where('partner_lang.language', $lang);
        $this->db->where('partner.is_deleted', 0);
        $this->db->order_by("partner.id", "desc");

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
        $this->db->from('partner');
        $this->db->join('partner_lang', 'partner_lang.partner_id = partner.id', 'left');
        $this->db->where('partner_lang.language', $lang);
        $this->db->where('partner.is_deleted', 0);
        $this->db->limit(3);
        $this->db->order_by("partner.id", "desc");

        return $result = $this->db->get()->result_array();
    }

    public function count_all() {
        $this->db->select('*');
        $this->db->from('partner');
        $this->db->where('is_deleted', 0);

        return $result = $this->db->get()->num_rows();
    }

    public function get_by_id($slug, $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select('partner.*, GROUP_CONCAT(partner_lang.name ORDER BY partner_lang.language separator \'|||\') as partner_name, 
                            GROUP_CONCAT(partner_lang.slug ORDER BY partner_lang.language separator \'|||\') as partner_slug,
                            GROUP_CONCAT(partner_lang.meta_description ORDER BY partner_lang.language separator \'|||\') as partner_meta_description,
                            GROUP_CONCAT(partner_lang.meta_keywords ORDER BY partner_lang.language separator \'|||\') as partner_meta_keywords,
                            GROUP_CONCAT(partner_lang.content ORDER BY partner_lang.language separator \'|||\') as partner_content,
                            GROUP_CONCAT(partner_lang.language ORDER BY partner_lang.language separator \'|||\') as partner_language');
        $this->db->from('partner');
        $this->db->join('partner_lang', 'partner_lang.partner_id = partner.id', 'left');
        if($lang != ''){
            $this->db->where('partner_lang.language', $lang);
        }
        $this->db->where('partner.is_deleted', 0);
        $this->db->where('partner_lang.slug', $slug);
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function get_by_id_admin($id, $lang = '') {
        $this->db->query('SET SESSION group_concat_max_len = 10000000');
        $this->db->select('partner.*, GROUP_CONCAT(partner_lang.name ORDER BY partner_lang.language separator \'|||\') as partner_name, 
                            GROUP_CONCAT(partner_lang.slug ORDER BY partner_lang.language separator \'|||\') as partner_slug,
                            GROUP_CONCAT(partner_lang.meta_description ORDER BY partner_lang.language separator \'|||\') as partner_meta_description,
                            GROUP_CONCAT(partner_lang.meta_keywords ORDER BY partner_lang.language separator \'|||\') as partner_meta_keywords,
                            GROUP_CONCAT(partner_lang.content ORDER BY partner_lang.language separator \'|||\') as partner_content');
        $this->db->from('partner');
        $this->db->join('partner_lang', 'partner_lang.partner_id = partner.id', 'left');
        if($lang != ''){
            $this->db->where('partner_lang.language', $lang);
        }
        $this->db->where('partner.is_deleted', 0);
        $this->db->where('partner.id', $id);
        $this->db->limit(1);

        return $this->db->get()->row_array();
    }

    public function insert($data) {
        $this->db->set($data)->insert('partner');

        if($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }

        return false;
    }

    public function insert_with_language($data_vi, $data_en){
        $data_merge = array($data_vi, $data_en);
        return $this->db->insert_batch('partner_lang', $data_merge);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);

        return $this->db->update('partner', $data);
    }

    public function update_with_language_vi($id, $data_vi){
        $this->db->where('partner_id', $id);
        $this->db->where('language', 'vi');
        return $this->db->update('partner_lang', $data_vi);
    }

    public function update_with_language_en($id, $data_en){
        $this->db->where('partner_id', $id);
        $this->db->where('language', 'en');
        return $this->db->update('partner_lang', $data_en);
    }

    public function remove($id, $set_delete) {
        $this->db->where('id', $id);

        return $this->db->update('partner', $set_delete);
    }

    public function get_id($id, $language = 'vi') {
        $this->db->select('*');
        $this->db->from('partner_lang');
        $this->db->where('partner_id', $id);
        $this->db->where('language', $language);
        $this->db->order_by("id", "desc");

        return $result = $this->db->get()->row_array();
    }

}
