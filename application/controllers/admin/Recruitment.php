<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recruitment extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('recruitment_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'admin/recruitment/index';
        $total_rows = $this->recruitment_model->count_all();
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->data['recruitments'] = $this->recruitment_model->get_all_with_pagination($per_page, $this->data['page']);

        $this->render('admin/recruitment/list_recruitment_view');
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->render('admin/recruitment/create_recruitment_view');
        } else {
            if ($this->input->post()) {
                $slug_vi = $this->input->post('slug_vi');
                $unique_slug_vi = $this->recruitment_model->build_unique_slug($slug_vi);

                $slug_en = $this->input->post('slug_en');
                $unique_slug_en = $this->recruitment_model->build_unique_slug($slug_en);

                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/recruitment', 'assets/upload/recruitment/thumb');
                $data = array(
                    'status' => $this->input->post('status'),
                    'description_image' => $image,
                    'created_at' => $this->author_info['created_at'],
                    'created_by' => $this->author_info['created_by'],
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                try {
                    $insert_id = $this->recruitment_model->insert($data);
                    $data_vi = array(
                        'recruitment_id' => $insert_id,
                        'language' => 'vi',
                        'title' => $this->input->post('title_vi'),
                        'slug' => $unique_slug_vi,
                        'meta_description' => $this->input->post('meta_description_vi'),
                        'meta_keywords' => $this->input->post('meta_keywords_vi'),
                        'description' => $this->input->post('description_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $data_en = array(
                        'recruitment_id' => $insert_id,
                        'language' => 'en',
                        'title' => $this->input->post('title_en'),
                        'slug' => $unique_slug_en,
                        'meta_description' => $this->input->post('meta_description_en'),
                        'meta_keywords' => $this->input->post('meta_keywords_en'),
                        'description' => $this->input->post('description_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->recruitment_model->insert_with_language($data_vi, $data_en);

                    $this->session->set_flashdata('message', 'Item added successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error inserting item: ' . $e->getMessage());
                }

                redirect('admin/recruitment', 'refresh');
            }
        }
    }

    public function edit($id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');

        $input_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $result = $this->recruitment_model->get_by_id($input_id);

        if (!$result || $result['id'] == null) {
            redirect('admin/recruitment', 'refresh');
        }

        // Title
        $title = explode('|||', $result['recruitment_title']);
        $result['title_en'] = isset($title[0]) ? $title[0] : '';
        $result['title_vi'] = isset($title[1]) ? $title[1] : '';

        // Slug
        $slug = explode('|||', $result['recruitment_slug']);
        $result['slug_en'] = isset($slug[0]) ? $slug[0] : '';
        $result['slug_vi'] = isset($slug[1]) ? $slug[1] : '';

        // Meta description
        $meta_description = explode('|||', $result['recruitment_meta_description']);
        $result['meta_description_en'] = isset($meta_description[0]) ? $meta_description[0] : '';
        $result['meta_description_vi'] = isset($meta_description[1]) ? $meta_description[1] : '';

        // Meta keywords
        $meta_keywords = explode('|||', $result['recruitment_meta_keywords']);
        $result['meta_keywords_en'] = isset($meta_keywords[0]) ? $meta_keywords[0] : '';
        $result['meta_keywords_vi'] = isset($meta_keywords[1]) ? $meta_keywords[1] : '';

        // Description
        $description = explode('|||', $result['recruitment_description']);
        $result['description_en'] = $description[0];
        $result['description_vi'] = $description[1];

        // Content
        $content = explode('|||', $result['recruitment_content']);
        $result['content_en'] = $content[0];
        $result['content_vi'] = $content[1];

        if ($this->form_validation->run() == FALSE) {
            $this->data['recruitment'] = $result;
            $this->render('admin/recruitment/edit_recruitment_view');
        } else {
            if ($this->input->post()) {
                $slug_vi = $this->input->post('slug_vi');
                $unique_slug_vi = $this->recruitment_model->build_unique_slug($slug_vi);

                $slug_en = $this->input->post('slug_en');
                $unique_slug_en = $this->recruitment_model->build_unique_slug($slug_en);

                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/recruitment', 'assets/upload/recruitment/thumb');
                $data = array(
                    'status' => $this->input->post('status'),
                    'description_image' => $image,
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                if ($image == '') {
                    unset($data['description_image']);
                }

                try {
                    $this->recruitment_model->update($input_id, $data);
                    $data_vi = array(
                        'title' => $this->input->post('title_vi'),
                        'slug' => $unique_slug_vi,
                        'meta_description' => $this->input->post('meta_description_vi'),
                        'meta_keywords' => $this->input->post('meta_keywords_vi'),
                        'description' => $this->input->post('description_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $this->recruitment_model->update_with_language_vi($input_id, $data_vi);

                    $data_en = array(
                        'title' => $this->input->post('title_en'),
                        'slug' => $unique_slug_en,
                        'meta_description' => $this->input->post('meta_description_en'),
                        'meta_keywords' => $this->input->post('meta_keywords_en'),
                        'description' => $this->input->post('description_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->recruitment_model->update_with_language_en($input_id, $data_en);

                    $this->session->set_flashdata('message', 'Item updated successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                }

                redirect('admin/recruitment', 'refresh');
            }
        }
    }

    public function delete($id = NULL) {
        $result = $this->recruitment_model->get_by_id($id);

        if (!$result) {
            redirect('admin/recruitment', 'refresh');
        }

        $set_delete = array('is_deleted' => 1);
        try {
            $this->recruitment_model->remove($id, $set_delete);
            $this->session->set_flashdata('message', 'Item has deleted successful.');
        } catch (Exception $e) {
            $this->session->set_flashdata('message', 'Have error while delete item: ' . $e->getMessage());
        }
        redirect('admin/recruitment', 'refresh');
    }

}
