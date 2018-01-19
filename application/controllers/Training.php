<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends Public_Controller {

	private $_lang = '';

	public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
    }

    public function index($id = 1){
        $this->data['current_link'] = 'list_training';

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Danh sách chương trình đào tạo' : 'List training';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Danh sách chương trình đào tạo' : 'List training';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Danh sách chương trình đào tạo' : 'List training';

        //$this->render('training_view');
        $this->render('page_404_view');
    }

    public function training_seven_steps(){
        $this->data['current_link'] = 'training_seven_steps';

        $this->data['title'] = ($this->data['lang'] == 'vi') ? '7 bước đào tạo' : 'seven steps training';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? '7 bước đào tạo' : 'seven steps training';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? '7 bước đào tạo' : 'seven steps training';

        $this->render('training_seven_steps_view');
    }

    public function training_high_class(){
        $this->data['current_link'] = 'training_high_class';

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Đào tạo cấp cao' : 'High class training';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Đào tạo cấp cao' : 'High class training';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Đào tạo cấp cao' : 'High class training';

        $this->render('training_high_class_view');
    }

    public function training_middle_class(){
        $this->data['current_link'] = 'training_middle_class';

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Đào tạo trung cấp' : 'Middle class training';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Đào tạo trung cấp' : 'Middle class training';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Đào tạo trung cấp' : 'Middle class training';

        $this->render('training_middle_class_view');
    }

    public function training_people(){
        $this->data['current_link'] = 'training_people';

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Đào tạo nguồn lực' : 'People training';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Đào tạo nguồn lực' : 'People training';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Đào tạo nguồn lực' : 'People training';

        $this->render('training_people_view');
    }
}
