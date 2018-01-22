<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Intro extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('intro_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'admin/intro/index';
        $total_rows = $this->intro_model->count_all();
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $result = $this->intro_model->get_all_with_pagination($per_page, $this->data['page']);

        $output = array();
        foreach($result as $key => $value){
            $output[$key]['id'] = $value['id'];
            $output[$key]['data'] = $this->intro_model->get_by_id($value['id']);
        }
        $this->data['intros'] = $output;

        $this->render('admin/intro/list_intro_view');
    }

//    public function create() {
//        $this->load->helper('form');
//        $this->load->library('form_validation');
//
//        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
//        $this->form_validation->set_rules('title_en', 'Title', 'required');
//
//        if ($this->form_validation->run() == FALSE) {
//            $this->render('admin/intro/create_intro_view');
//        } else {
//            if ($this->input->post()) {
//                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/intro', 'assets/upload/intro/thumb');
//                $data = array(
//                    'created_at' => $this->author_info['created_at'],
//                    'created_by' => $this->author_info['created_by'],
//                    'modified_at' => $this->author_info['modified_at'],
//                    'modified_by' => $this->author_info['modified_by']
//                );
//
//                try {
//                    $insert_id = $this->intro_model->insert($data);
//                    $data_vi = array(
//                        'intro_id' => $insert_id,
//                        'language' => 'vi',
//                        'title' => $this->input->post('title_vi'),
//                        'content' => $this->input->post('content_vi')
//                    );
//                    $data_en = array(
//                        'intro_id' => $insert_id,
//                        'language' => 'en',
//                        'title' => $this->input->post('title_en'),
//                        'content' => $this->input->post('content_en')
//                    );
//
//                    $this->intro_model->insert_with_language($data_vi, $data_en);
//
//                    $this->session->set_flashdata('message', 'Item added successfully');
//                } catch (Exception $e) {
//                    $this->session->set_flashdata('message', 'There was an error inserting item: ' . $e->getMessage());
//                }
//
//                redirect('admin/intro', 'refresh');
//            }
//        }
//    }

    public function edit($id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');

        $input_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $result = $this->intro_model->get_by_id($input_id);

        if (!$result || $result['id'] == null) {
            redirect('admin/intro', 'refresh');
        }

        // Title
        $title = explode('|||', $result['intro_title']);
        $result['title_en'] = isset($title[0]) ? $title[0] : '';
        $result['title_vi'] = isset($title[1]) ? $title[1] : '';

        // Content
        $content = explode('|||', $result['intro_content']);
        $result['content_en'] = $content[0];
        $result['content_vi'] = $content[1];

        if ($this->form_validation->run() == FALSE) {
            $this->data['intro'] = $result;
            $this->render('admin/intro/edit_intro_view');
        } else {
            if ($this->input->post()) {
                $data = array(
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                try {
                    $this->intro_model->update($input_id, $data);
                    $data_vi = array(
                        'title' => $this->input->post('title_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $this->intro_model->update_with_language_vi($input_id, $data_vi);

                    $data_en = array(
                        'title' => $this->input->post('title_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->intro_model->update_with_language_en($input_id, $data_en);

                    $this->session->set_flashdata('message', 'Item updated successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                }

                redirect('admin/intro', 'refresh');
            }
        }
    }

//    public function delete($id = NULL) {
//        $result = $this->intro_model->get_by_id($id);
//
//        if (!$result) {
//            redirect('admin/intro', 'refresh');
//        }
//
//        $set_delete = array('is_deleted' => 1);
//        try {
//            $this->intro_model->remove($id, $set_delete);
//            $this->session->set_flashdata('message', 'Item has deleted successful.');
//        } catch (Exception $e) {
//            $this->session->set_flashdata('message', 'Have error while delete item: ' . $e->getMessage());
//        }
//        redirect('admin/intro', 'refresh');
//    }

}
