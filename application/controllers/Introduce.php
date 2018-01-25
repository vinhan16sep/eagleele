<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Introduce extends Public_Controller {

	private $_lang = '';

	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
    }

	public function index(){
        $this->data['current_link'] = 'introduce';

        $this->load->model('partner_model');
        $this->data['partners'] = $this->partner_model->get_all_by_language($this->data['lang']);

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Giới thiệu về chúng tôi' : 'About us';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Giới thiệu về chúng tôi' : 'About us';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Giới thiệu về chúng tôi' : 'About us';

        $this->render('introduce_view');
	}

	public function why_us(){
        $this->data['current_link'] = 'why_us';

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Tại sao nên chọn chúng tôi ' : 'Why choose us';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Tại sao nên chọn chúng tôi ' : 'Why choose us';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Tại sao nên chọn chúng tôi ' : 'Why choose us';

        $this->render('why_us_view');
	}
 
 	public function study_path(){
        $this->data['current_link'] = 'study_path';

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Lộ trình học' : 'Study path';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Lộ trình học' : 'Study path';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Lộ trình học' : 'Study path';

        $this->render('study_path_view');
	}

	public function message(){
        $this->data['current_link'] = 'message';

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Thông điệp' : 'Message';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Thông điệp' : 'Message';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Thông điệp' : 'Message';

        $this->render('message_view');
	}

	public function vision(){
        $this->data['current_link'] = 'vision';

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Tầm nhìn' : 'Vision';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Tầm nhìn' : 'Vision';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Tầm nhìn' : 'Vision';

        $this->render('vision_view');
	}

	public function teachers(){
        $this->load->model('teacher_model');
        $this->data['current_link'] = 'teachers';
        $this->data['teachers'] = $this->teacher_model->get_all_by_language($this->data['lang']);

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Giáo viên' : 'Teacher';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Giáo viên' : 'Teacher';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Giáo viên' : 'Teacher';

        $this->render('teachers_view');
	}

    public function detail_teacher($slug = null){
        $this->load->model('teacher_model');
        $request_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $this->data['current_link'] = 'detail_teacher';
        $teacher = $this->teacher_model->get_by_id($slug, $this->data['lang']);
        $this->data['teacher'] = $teacher;

        switch ($teacher['teacher_language']){
            case 'vi':
                $this->data['teacher_slug_vi'] = $slug;
                $teacher_language = $this->teacher_model->get_id($teacher['id'], 'en');
                $this->data['teacher_slug_en'] = $teacher_language['slug'];
                break;
            case 'en':
                $this->data['teacher_slug_en'] = $slug;
                $teacher_language = $this->teacher_model->get_id($teacher['id'], 'vi');
                $this->data['teacher_slug_vi'] = $teacher_language['slug'];
                break;
        };

        if (!$this->data['teacher']) {
            redirect('', 'refresh');
        }

        $this->data['title'] = $this->data['teacher']['teacher_name'];
        $this->data['meta_description'] = $this->data['teacher']['teacher_meta_description'];
        $this->data['meta_keywords'] = $this->data['teacher']['teacher_meta_keywords'];

        $this->render('detail_teacher_view');
    }

	public function partners(){
        $this->load->model('partner_model');
        $this->data['current_link'] = 'partners';
        $this->data['partners'] = $this->partner_model->get_all_by_language($this->data['lang']);

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Đối tác' : 'Partner';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Đối tác' : 'Partner';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Đối tác' : 'Partner';

        $this->render('partners_view');
    }

    public function detail_partner($slug = null){
        $this->load->model('partner_model');
        $request_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $this->data['current_link'] = 'detail_partner';
        $partner = $this->partner_model->get_by_id($slug, $this->data['lang']);
        $this->data['partner'] = $partner;
//        print_r($partner);die;

        switch ($partner['partner_language']){
            case 'vi':
                $this->data['partner_slug_vi'] = $slug;
                $partner_language = $this->partner_model->get_id($partner['id'], 'en');
                $this->data['partner_slug_en'] = $partner_language['slug'];
                break;
            case 'en':
                $this->data['partner_slug_en'] = $slug;
                $partner_language = $this->partner_model->get_id($partner['id'], 'vi');
                $this->data['partner_slug_vi'] = $partner_language['slug'];
                break;
        };

        if (!$this->data['partner']) {
            redirect('', 'refresh');
        }

        $this->data['title'] = $this->data['partner']['partner_slug'];
        $this->data['meta_description'] = $this->data['partner']['partner_meta_description'];
        $this->data['meta_keywords'] = $this->data['partner']['partner_meta_keywords'];

        $this->render('detail_partner_view');
    }
}
