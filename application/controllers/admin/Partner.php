<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('partner_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'admin/partner/index';
        $total_rows = $this->partner_model->count_all();
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $result = $this->partner_model->get_all_with_pagination($per_page, $this->data['page']);

        $output = array();
        foreach($result as $key => $value){
            $output[$key]['id'] = $value['id'];
            $output[$key]['data'] = $this->partner_model->get_by_id_admin($value['id']);
        }
        $this->data['partners'] = $output;

        $this->render('admin/partner/list_partner_view');
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name_vi', 'Tên', 'required');
        $this->form_validation->set_rules('name_en', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->render('admin/partner/create_partner_view');
        } else {
            if ($this->input->post()) {
                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/partner', 'assets/upload/partner/thumb');
                $data = array(
                    'description_image' => $image,
                    'created_at' => $this->author_info['created_at'],
                    'created_by' => $this->author_info['created_by'],
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                try {
                    $insert_id = $this->partner_model->insert($data);
                    $data_vi = array(
                        'partner_id' => $insert_id,
                        'language' => 'vi',
                        'name' => $this->input->post('name_vi'),
                        'slug' => $this->input->post('slug_vi'),
                        'meta_description' => $this->input->post('meta_description_vi'),
                        'meta_keywords' => $this->input->post('meta_keywords_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $data_en = array(
                        'partner_id' => $insert_id,
                        'language' => 'en',
                        'name' => $this->input->post('name_en'),
                        'slug' => $this->input->post('slug_en'),
                        'meta_description' => $this->input->post('meta_description_en'),
                        'meta_keywords' => $this->input->post('meta_keywords_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->partner_model->insert_with_language($data_vi, $data_en);

                    $this->session->set_flashdata('message', 'Item added successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error inserting item: ' . $e->getMessage());
                }

                redirect('admin/partner', 'refresh');
            }
        }
    }

    public function edit($id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name_vi', 'Tên', 'required');
        $this->form_validation->set_rules('name_en', 'Name', 'required');

        $input_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $result = $this->partner_model->get_by_id_admin($input_id);

        if (!$result || $result['id'] == null) {
            redirect('admin/partner', 'refresh');
        }

        // Name
        $title = explode('|||', $result['partner_name']);
        $result['name_en'] = $title[0];
        $result['name_vi'] = $title[1];

        // Slug
        $slug = explode('|||', $result['partner_slug']);
        $result['slug_en'] = isset($slug[0]) ? $slug[0] : '';
        $result['slug_vi'] = isset($slug[1]) ? $slug[1] : '';

        // Meta description
        $meta_description = explode('|||', $result['partner_meta_description']);
        $result['meta_description_en'] = isset($meta_description[0]) ? $meta_description[0] : '';
        $result['meta_description_vi'] = isset($meta_description[1]) ? $meta_description[1] : '';

        // Meta keywords
        $meta_keywords = explode('|||', $result['partner_meta_keywords']);
        $result['meta_keywords_en'] = isset($meta_keywords[0]) ? $meta_keywords[0] : '';
        $result['meta_keywords_vi'] = isset($meta_keywords[1]) ? $meta_keywords[1] : '';

        // Content
        $content = explode('|||', $result['partner_content']);
        $result['content_en'] = $content[0];
        $result['content_vi'] = $content[1];

        if ($this->form_validation->run() == FALSE) {
            $this->data['partner'] = $result;
            $this->render('admin/partner/edit_partner_view');
        } else {
            if ($this->input->post()) {
                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/partner', 'assets/upload/partner/thumbs');
                $data = array(
                    'description_image' => $image,
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                if ($image == '') {
                    unset($data['description_image']);
                }

                try {
                    $this->partner_model->update($input_id, $data);
                    $data_vi = array(
                        'name' => $this->input->post('name_vi'),
                        'slug' => $this->input->post('slug_vi'),
                        'meta_description' => $this->input->post('meta_description_vi'),
                        'meta_keywords' => $this->input->post('meta_keywords_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $this->partner_model->update_with_language_vi($input_id, $data_vi);

                    $data_en = array(
                        'name' => $this->input->post('name_en'),
                        'slug' => $this->input->post('slug_en'),
                        'meta_description' => $this->input->post('meta_description_en'),
                        'meta_keywords' => $this->input->post('meta_keywords_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->partner_model->update_with_language_en($input_id, $data_en);

                    $this->session->set_flashdata('message', 'Item updated successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                }

                redirect('admin/partner', 'refresh');
            }
        }
    }

    public function delete($id = NULL) {
        $result = $this->partner_model->get_by_id($id);

        if (!$result) {
            redirect('admin/teacher', 'refresh');
        }

        $set_delete = array('is_deleted' => 1);
        try {
            $this->partner_model->remove($id, $set_delete);
            $this->session->set_flashdata('message', 'Item has deleted successful.');
        } catch (Exception $e) {
            $this->session->set_flashdata('message', 'Have error while delete item: ' . $e->getMessage());
        }
        redirect('admin/teacher', 'refresh');
    }

}
