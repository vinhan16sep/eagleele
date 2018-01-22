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

    public function detail($slug = null){
        $this->load->model('comment_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->data['category_cmt'] = 'article';

        $detail_id = $this->article_model->get_slug($slug);
        $where = array('category' => 'article', 'detail_id' => $detail_id['article_id']);
        $comment = $this->comment_model->fetch_all($where, 5, 0);
        if($comment){
            $this->data['comment'] = $comment;
        }
        $this->data['total_comment'] = $this->comment_model->count_all($where);


        $request_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $this->data['current_link'] = 'detail_article';

        $article = $this->article_model->get_by_id($slug, $this->_lang);

        $this->data['article'] = $article;

        switch ($article['article_language']){
            case 'vi':
                $this->data['article_slug_vi'] = $slug;
                $article_language = $this->article_model->get_id($article['id'], 'en');
                $this->data['article_slug_en'] = $article_language['slug'];
                break;
            case 'en':
                $this->data['article_slug_en'] = $slug;
                $article_language = $this->article_model->get_id($article['id'], 'vi');
                $this->data['article_slug_vi'] = $article_language['slug'];
                break;
        };

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
