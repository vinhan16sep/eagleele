<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('project_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'admin/project/index';
        $total_rows = $this->project_model->count_all();
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $result = $this->project_model->get_all_with_pagination($per_page, $this->data['page']);

        $output = array();
        foreach($result as $key => $value){
            $output[$key]['id'] = $value['id'];
            $output[$key]['data'] = $this->project_model->get_by_id($value['id']);
        }
        $this->data['projects'] = $output;

        $this->render('admin/project/list_project_view');
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->render('admin/project/create_project_view');
        } else {
            if ($this->input->post()) {
                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/project', 'assets/upload/project/thumb');
                $data = array(
                    'description_image' => $image,
                    'created_at' => $this->author_info['created_at'],
                    'created_by' => $this->author_info['created_by'],
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                try {
                    $insert_id = $this->project_model->insert($data);
                    $data_vi = array(
                        'project_id' => $insert_id,
                        'language' => 'vi',
                        'title' => $this->input->post('title_vi'),
                        'slug' => $this->input->post('slug_vi'),
                        'meta_description' => $this->input->post('meta_description_vi'),
                        'meta_keywords' => $this->input->post('meta_keywords_vi'),
                        'description' => $this->input->post('description_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $data_en = array(
                        'project_id' => $insert_id,
                        'language' => 'en',
                        'title' => $this->input->post('title_en'),
                        'slug' => $this->input->post('slug_en'),
                        'meta_description' => $this->input->post('meta_description_en'),
                        'meta_keywords' => $this->input->post('meta_keywords_en'),
                        'description' => $this->input->post('description_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->project_model->insert_with_language($data_vi, $data_en);

                    $this->session->set_flashdata('message', 'Item added successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error inserting item: ' . $e->getMessage());
                }

                redirect('admin/project', 'refresh');
            }
        }
    }

    public function edit($id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');

        $input_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $result = $this->project_model->get_by_id($input_id);

        if (!$result || $result['id'] == null) {
            redirect('admin/project', 'refresh');
        }

        // Name
        $title = explode('|||', $result['project_title']);
        $result['title_en'] = $title[0];
        $result['title_vi'] = $title[1];

        // Slug
        $slug = explode('|||', $result['project_slug']);
        $result['slug_en'] = isset($slug[0]) ? $slug[0] : '';
        $result['slug_vi'] = isset($slug[1]) ? $slug[1] : '';

        // Meta description
        $meta_description = explode('|||', $result['project_meta_description']);
        $result['meta_description_en'] = isset($meta_description[0]) ? $meta_description[0] : '';
        $result['meta_description_vi'] = isset($meta_description[1]) ? $meta_description[1] : '';

        // Meta keywords
        $meta_keywords = explode('|||', $result['project_meta_keywords']);
        $result['meta_keywords_en'] = isset($meta_keywords[0]) ? $meta_keywords[0] : '';
        $result['meta_keywords_vi'] = isset($meta_keywords[1]) ? $meta_keywords[1] : '';

        // Description
        $description = explode('|||', $result['project_description']);
        $result['description_en'] = isset($description[0]) ? $description[0] : '';
        $result['description_vi'] = isset($description[1]) ? $description[1] : '';

        // Content
        $content = explode('|||', $result['project_content']);
        $result['content_en'] = isset($content[0]) ? $content[0] : '';
        $result['content_vi'] = isset($content[1]) ? $content[1] : '';

        if ($this->form_validation->run() == FALSE) {
            $this->data['project'] = $result;
            $this->render('admin/project/edit_project_view');
        } else {
            if ($this->input->post()) {
                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/project', 'assets/upload/project/thumbs');
                $data = array(
                    'description_image' => $image,
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                if ($image == '') {
                    unset($data['description_image']);
                }

                try {
                    $this->project_model->update($input_id, $data);
                    $data_vi = array(
                        'title' => $this->input->post('title_vi'),
                        'slug' => $this->input->post('slug_vi'),
                        'meta_description' => $this->input->post('meta_description_vi'),
                        'meta_keywords' => $this->input->post('meta_keywords_vi'),
                        'description' => $this->input->post('description_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $this->project_model->update_with_language_vi($input_id, $data_vi);

                    $data_en = array(
                        'title' => $this->input->post('title_en'),
                        'slug' => $this->input->post('slug_en'),
                        'meta_description' => $this->input->post('meta_description_en'),
                        'meta_keywords' => $this->input->post('meta_keywords_en'),
                        'description' => $this->input->post('description_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->project_model->update_with_language_en($input_id, $data_en);

                    $this->session->set_flashdata('message', 'Item updated successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                }

                redirect('admin/project', 'refresh');
            }
        }
    }

    public function delete($id = NULL) {
        $input = $this->input->get();
        $blog = $this->project_model->get_by_id($input['id']);

        if (!$blog) {
            $this->output->set_status_header(404)
                ->set_output(json_encode(array('message' => 'Fail', 'data' => $input)));
        }

        $set_delete = array('is_deleted' => 1);
        $result = $this->project_model->remove($input['id'], $set_delete);

        if($result == false){
            $this->output->set_status_header(404)
                ->set_output(json_encode(array('message' => 'Fail', 'data' => $input)));
        }else{
            $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 'Success', 'data' => $input)));
        }
    }

}
