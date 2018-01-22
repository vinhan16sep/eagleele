<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends Public_Controller {

	private $_lang = '';

	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('intro_model');
        $this->load->model('video_model');
        $this->load->model('library_model');
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
        $this->data['show_intro_popup'] = true;
        $this->data['popup_content'] = $this->intro_model->get_by_id(1, $this->data['lang']);
    }

	public function index(){
        $this->data['current_link'] = '';

        list($this->data['events'], $this->data['news']) = $this->list_latest_articles();
        $this->data['banners'] = $this->list_banners();
        $this->data['teachers'] = $this->list_teachers();
        $this->data['libraries'] = $this->list_libraries();

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Eagle Ele' : 'Eagle Ele';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Eagle Ele' : 'Eagle Ele';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Eagle Ele' : 'Eagle Ele';

        $this->data['video'] = $this->video_model->fetch_latest_videos(1);

        $this->render('homepage_view');
	}

	public function why_us(){
        $this->data['current_link'] = 'why_us';
        $this->render('why_us_view');
	}
 
 	public function study_path(){
        $this->data['current_link'] = 'study_path';
        $this->render('study_path_view');
	}

	public function message(){
        $this->data['current_link'] = 'message';
        $this->render('message_view');
	}

	public function vision(){
        $this->data['current_link'] = 'vision';
        $this->render('vision_view');
	}

	public function teachers(){
        $this->load->model('teacher_model');
        $this->data['current_link'] = 'teachers';
        $this->data['teachers'] = $this->teacher_model->get_all_by_language($this->data['lang']);

        $this->render('teachers_view');
	}

    public function detail_teacher($id = null){
        $this->load->model('teacher_model');
        $request_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $this->data['current_link'] = 'detail_teacher';
        $this->data['teacher_id'] = $request_id;
        $this->data['teacher'] = $this->teacher_model->get_by_id($request_id, $this->data['lang']);

        if (!$this->data['teacher']) {
            redirect('', 'refresh');
        }

        $this->render('detail_teacher_view');
    }

	public function partners(){
        $this->load->model('partner_model');
        $this->data['current_link'] = 'partners';
        $this->data['partners'] = $this->partner_model->get_all_by_language($this->data['lang']);

        $this->render('partners_view');
    }

    public function detail_partner($id = null){
        $this->load->model('partner_model');
        $request_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $this->data['current_link'] = 'detail_partner';
        $this->data['partner_id'] = $request_id;
        $this->data['partner'] = $this->partner_model->get_by_id($request_id, $this->data['lang']);

        if (!$this->data['partner']) {
            redirect('', 'refresh');
        }

        $this->render('detail_partner_view');
    }

    public function list_latest_articles(){
        $this->load->model('article_model');
        $events = $this->article_model->fetch_latest_article_by_type(0, 4, $this->data['lang']);
        $news = $this->article_model->fetch_latest_article_by_type(1, 5, $this->data['lang']);

        return array($events, $news);
    }

    public function list_banners(){
        $this->load->model('banner_model');
        $banners = $this->banner_model->get_all();

        return $banners;
    }

    public function list_teachers(){
        $this->load->model('teacher_model');
        return $teachers = $this->teacher_model->get_all_by_language($this->data['lang']);
    }

    public function list_libraries(){
        return $libraries = $this->library_model->get_last_five_by_language($this->data['lang']);
    }
    
}
