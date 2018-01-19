<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends Public_Controller {

    private $_lang = '';

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('library_model');
        $this->_lang = $this->session->userdata('langAbbreviation');
    }

    public function index() {
        $this->data['current_link'] = 'list_library';
        $this->data['lang'] = $this->_lang;
        $this->data['libraries'] = $this->library_model->get_all_by_language($this->_lang);

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Thư viện' : 'Library';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Thư viện' : 'Library';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Thư viện' : 'Library';

        $this->render('library_view');
    }

    public function detail($id = null){
        $request_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $this->data['current_link'] = 'detail_library';
        $this->data['library_id'] = $request_id;

        $library = $this->library_model->get_by_id($request_id, $this->_lang);
        $this->data['library'] = $library;

        if (!$this->data['library']) {
            redirect('', 'refresh');
        }

        $this->data['title'] = $this->data['library']['library_title'];
        $this->data['meta_description'] = $this->data['library']['library_meta_description'];
        $this->data['meta_keywords'] = $this->data['library']['library_meta_keywords'];

        $this->render('detail_library_view');
    }

}
