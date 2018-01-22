<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('video_model');
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
    }

    public function index() {
        $this->data['current_link'] = 'list_video';
        $this->data['videos'] = $this->video_model->get_all_by_language($this->data['lang']);

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Thư viện' : 'video';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Thư viện' : 'video';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Thư viện' : 'video';

        $this->render('video_view');
    }

    public function detail($id = null){
        $this->load->model('comment_model');
        $this->load->helper('form');
        $this->load->video('form_validation');

        $this->data['category'] = $this->uri->segment(1);

        $where = array('category' => $this->uri->segment(1), 'detail_id' => $this->uri->segment(3));
        $comment = $this->comment_model->fetch_all($where, 5, 0);
        if($comment){
            $this->data['comment'] = $comment;
        }
        $this->data['total_comment'] = $this->comment_model->count_all($where);

        $request_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $this->data['current_link'] = 'detail_video';
        $this->data['video_id'] = $request_id;

        $video = $this->video_model->get_by_id($request_id, $this->data['lang']);
        $this->data['video'] = $video;

        if (!$this->data['video']) {
            redirect('', 'refresh');
        }

        $this->data['title'] = $this->data['video']['video_title'];
        $this->data['meta_description'] = $this->data['video']['video_meta_description'];
        $this->data['meta_keywords'] = $this->data['video']['video_meta_keywords'];

        $this->render('detail_video_view');
    }

}
