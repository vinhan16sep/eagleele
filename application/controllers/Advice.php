<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Advice extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('advice_model');
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
    }

    public function index() {
        $this->data['current_link'] = 'list_advice';
        $this->data['advices'] = $this->advice_model->get_all_by_language($this->data['lang']);
//        print_r($this->data['advices']);die;

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Tư vấn' : 'Advice';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Tư vấn' : 'advice';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Tư vấn' : 'advice';

        $this->render('advice_view');
    }

    public function detail($slug = null){
        $this->load->model('comment_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->data['category'] = 'advice';
        $detail_id = $this->advice_model->get_slug($slug);
        $where = array('category' => 'advice', 'detail_id' => $detail_id['advice_id']);
        $comment = $this->comment_model->fetch_all($where, 5, 0);
        if($comment){
            $this->data['comment'] = $comment;
        }
        $this->data['total_comment'] = $this->comment_model->count_all($where);

        $this->data['current_link'] = 'detail_advice';

        $this->data['latest_advice'] = $this->advice_model->get_latest_article($this->data['lang']);
        $advice = $this->advice_model->get_by_id($slug, $this->data['lang']);
        $this->data['advice'] = $advice;
        switch ($advice['advice_language']){
            case 'vi':
                $this->data['advice_slug_vi'] = $slug;
                $advice_language = $this->advice_model->get_id($advice['id'], 'en');
                $this->data['advice_slug_en'] = $advice_language['slug'];
                break;
            case 'en':
                $this->data['advice_slug_en'] = $slug;
                $advice_language = $this->advice_model->get_id($advice['id'], 'vi');
                $this->data['advice_slug_vi'] = $advice_language['slug'];
                break;
        };

        if (!$this->data['advice']) {
            redirect('', 'refresh');
        }

        $this->data['title'] = $this->data['advice']['advice_title'];
        $this->data['meta_description'] = $this->data['advice']['advice_meta_description'];
        $this->data['meta_keywords'] = $this->data['advice']['advice_meta_keywords'];

        $this->render('detail_advice_view');
    }

}
