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
        $this->data['current_link'] = 'detail_recruitment';
        $this->data['recruitment_id'] = $slug;
        $this->data['latest_recruitment'] = $this->recruitment_model->get_latest_article($this->data['lang']);
        $this->data['recruitment'] = $this->recruitment_model->get_by_id($slug, $this->data['lang']);

        if (!$this->data['recruitment']) {
            redirect('', 'refresh');
        }

        $this->data['title'] = $this->data['recruitment']['recruitment_title'];
        $this->data['meta_description'] = $this->data['recruitment']['recruitment_meta_description'];
        $this->data['meta_keywords'] = $this->data['recruitment']['recruitment_meta_keywords'];

        $this->render('detail_recruitment_view');
    }

}
