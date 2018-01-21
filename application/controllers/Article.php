<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends Public_Controller {

    private $_lang = '';

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('article_model');
        $this->load->model('category_model');
        $this->_lang = $this->session->userdata('langAbbreviation');
    }

    public function index() {
        $this->data['current_link'] = 'list_article';
        $this->data['lang'] = $this->_lang;
        $this->data['articles'] = $this->article_model->get_all_by_language($this->_lang);

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Tin tức - sự kiên' : 'News and event';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Tin tức - sự kiên' : 'News and event';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Tin tức - sự kiên' : 'News and event';

        $this->render('article_view');
    }

    public function detail($id = null){
        $request_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $this->data['current_link'] = 'detail_article';
        $this->data['article_id'] = $request_id;

        $article = $this->article_model->get_by_id($request_id, $this->_lang);

        $this->data['article'] = $article;

        // Get article's category
        if($article['category_id'] != null){
            $category = $this->category_model->get_category($article['category_id'], $this->_lang);
            $this->data['category'] = $category['title'];
        }else{
            $this->data['category'] = 'Event';
        }

        // Get list categories
        $this->data['list_categories'] = $this->category_model->get_list_category($this->_lang);

        if (!$this->data['article']) {
            redirect('', 'refresh');
        }

        $this->data['title'] = $this->data['article']['article_title'];
        $this->data['meta_description'] = $this->data['article']['article_meta_description'];
        $this->data['meta_keywords'] = $this->data['article']['article_meta_keywords'];

        $this->render('detail_article_view');
    }

    public function news($category_id = null){
        $this->data['current_link'] = 'list_news';
        $this->data['lang'] = $this->_lang;
        $this->data['category_id'] = $category_id;
        $this->data['news'] = $this->article_model->get_news_in_category_by_language($category_id, $this->_lang);

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Tin tức' : 'News';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Tin tức' : 'News';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Tin tức' : 'News';

        $this->render('news_view');
    }

}