<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Introduce extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('introduce_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'admin/introduce/index';
        $total_rows = $this->introduce_model->count_all();
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $result = $this->introduce_model->get_all_with_pagination($per_page, $this->data['page']);

        $output = array();
        foreach($result as $key => $value){
            $output[$key]['id'] = $value['id'];
            $output[$key]['data'] = $this->introduce_model->get_by_id($value['id']);
        }
        $this->data['introduces'] = $output;

        $this->render('admin/introduce/list_introduce_view');
    }

    public function edit($id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');

        $input_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $result = $this->introduce_model->get_by_id($input_id);

        if (!$result || $result['id'] == null) {
            redirect('admin/introduce', 'refresh');
        }

        // Title
        $title = explode('|||', $result['introduce_title']);
        $result['title_en'] = isset($title[0]) ? $title[0] : '';
        $result['title_vi'] = isset($title[1]) ? $title[1] : '';

        // Content
        $content = explode('|||', $result['introduce_content']);
        $result['content_en'] = $content[0];
        $result['content_vi'] = $content[1];

        if ($this->form_validation->run() == FALSE) {
            $this->data['introduce'] = $result;
            $this->render('admin/introduce/edit_introduce_view');
        } else {
            if ($this->input->post()) {
                $data = array(
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                try {
                    $this->introduce_model->update($input_id, $data);
                    $data_vi = array(
                        'title' => $this->input->post('title_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $this->introduce_model->update_with_language_vi($input_id, $data_vi);

                    $data_en = array(
                        'title' => $this->input->post('title_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->introduce_model->update_with_language_en($input_id, $data_en);

                    $this->session->set_flashdata('message', 'Item updated successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                }

                redirect('admin/introduce', 'refresh');
            }
        }
    }

}
