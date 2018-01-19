<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advice extends Public_Controller {

	private $_lang = '';

	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
    }

    public function index($id = 1){
        $this->load->model('advice_model');

        $this->data['advices'] = $this->advice_model->get_all_by_language($this->data['lang']);

        $request_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $this->data['current_link'] = 'advice';
        $this->data['advice_id'] = $request_id;
        $this->data['advice'] = $this->advice_model->get_by_id($request_id, $this->data['lang']);

        if (!$this->data['advice']) {
            redirect('', 'refresh');
        }

        $this->data['title'] = $this->data['advice']['advice_title'];
        $this->data['meta_description'] = $this->data['advice']['advice_meta_description'];
        $this->data['meta_keywords'] = $this->data['advice']['advice_meta_keywords'];

        //$this->render('advice_view');
        $this->render('page_404_view');
    }
}
