<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('project_model');
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
    }

    public function index() {
        $this->data['current_link'] = 'list_project';
        $this->data['projects'] = $this->project_model->get_all_by_language($this->data['lang']);

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Dự án đào tạo' : 'project';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Dự án đào tạo' : 'project';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Dự án đào tạo' : 'project';

        $this->render('project_view');
    }

    public function detail($slug = null){
        $this->load->model('comment_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->data['category'] = $this->uri->segment(1);

        $where = array('category' => $this->uri->segment(1), 'detail_id' => $this->uri->segment(3));
        $comment = $this->comment_model->fetch_all($where, 5, 0);
        if($comment){
            $this->data['comment'] = $comment;
        }
        $this->data['total_comment'] = $this->comment_model->count_all($where);

        $this->data['current_link'] = 'detail_project';
        $this->data['project_id'] = $slug;
        $this->data['latest_project'] = $this->project_model->get_latest_article($this->data['lang']);
        $this->data['project'] = $this->project_model->get_by_id($slug, $this->data['lang']);

        if (!$this->data['project']) {
            redirect('', 'refresh');
        }

        $this->data['title'] = $this->data['project']['project_title'];
        $this->data['meta_description'] = $this->data['project']['project_meta_description'];
        $this->data['meta_keywords'] = $this->data['project']['project_meta_keywords'];

        $this->render('detail_project_view');
    }

}
