<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_category(){
        $this->db->select('*')
            ->from('category')
            ->join('category_lang', 'category_lang.category_id = category.id', 'left')
            ->where('category.is_deleted', 0)
            ->where('category_lang.language', 'vi')
            ->order_by('category.id', 'desc');

        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_category($id, $lang){
        $this->db->select('category_lang.title')
            ->from('category')
            ->join('category_lang', 'category_lang.category_id = category.id', 'left')
            ->where('category.id', $id)
            ->where('category_lang.language', $lang)
            ->where('category.is_deleted', 0)
            ->limit(1);

        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_list_category($lang){
        $this->db->select('*')
            ->from('category')
            ->join('category_lang', 'category_lang.category_id = category.id', 'left')
            ->where('category_lang.language', $lang)
            ->where('category.is_deleted', 0);

        $result = $this->db->get()->result_array();
        return $result;
    }

}
