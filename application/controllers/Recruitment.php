<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recruitment extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('recruitment_model');
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
    }

    public function index() {
        $this->data['current_link'] = 'list_recruitment';
        $this->data['recruitments'] = $this->recruitment_model->get_all_by_language($this->data['lang']);

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Tuyển dụng' : 'Recruitment';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Tuyển dụng' : 'Recruitment';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Tuyển dụng' : 'Recruitment';

        $this->render('recruitment_view');
    }

    public function detail($slug = null){
        $this->load->model('comment_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->data['category'] = 'recruitment';
        $detail_id = $this->recruitment_model->get_slug($slug);
        $where = array('category' => 'recruitment', 'detail_id' => $detail_id['recruitment_id']);
        $comment = $this->comment_model->fetch_all($where, 5, 0);
        if($comment){
            $this->data['comment'] = $comment;
        }
        $this->data['total_comment'] = $this->comment_model->count_all($where);

        $this->data['current_link'] = 'detail_recruitment';
        $this->data['latest_recruitment'] = $this->recruitment_model->get_latest_article($this->data['lang']);
        $recruitment = $this->recruitment_model->get_by_id($slug, $this->data['lang']);
        $this->data['recruitment'] = $recruitment;

        switch ($recruitment['recruitment_language']){
            case 'vi':
                $this->data['recruitment_slug_vi'] = $slug;
                $recruitment_language = $this->recruitment_model->get_id($recruitment['id'], 'en');
                $this->data['recruitment_slug_en'] = $recruitment_language['slug'];
                break;
            case 'en':
                $this->data['recruitment_slug_en'] = $slug;
                $recruitment_language = $this->recruitment_model->get_id($recruitment['id'], 'vi');
                $this->data['recruitment_slug_vi'] = $recruitment_language['slug'];
                break;
        };

        if (!$this->data['recruitment']) {
            redirect('', 'refresh');
        }

        $this->data['title'] = $this->data['recruitment']['recruitment_title'];
        $this->data['meta_description'] = $this->data['recruitment']['recruitment_meta_description'];
        $this->data['meta_keywords'] = $this->data['recruitment']['recruitment_meta_keywords'];

        $this->render('detail_recruitment_view');
    }

}
