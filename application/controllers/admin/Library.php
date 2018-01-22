<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('library_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'admin/library/index';
        $total_rows = $this->library_model->count_all();
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $result = $this->library_model->get_all_with_pagination($per_page, $this->data['page']);

        $output = array();
        foreach($result as $key => $value){
            $output[$key]['id'] = $value['id'];
            $output[$key]['data'] = $this->library_model->get_by_id($value['id']);
        }
        $this->data['libraries'] = $output;

        $this->render('admin/library/list_library_view');
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->model('category_model');

            // Get categories for dropdown
            $categories = $this->category_model->get_all_category();
            $categories_title = array(
                '' => 'Danh mục'
            );
            foreach($categories as $key => $item){
                $categories_title[$key] = $item['title'];
            }

            $this->data['categories'] = $categories_title;
            $this->render('admin/library/create_library_view');
        } else {
            if ($this->input->post()) {
                $slug_vi = $this->input->post('slug_vi');
                $unique_slug_vi = $this->library_model->build_unique_slug($slug_vi);

                $slug_en = $this->input->post('slug_en');
                $unique_slug_en = $this->library_model->build_unique_slug($slug_en);
              
                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/library', 'assets/upload/library/thumb');

                $data = array(
                    'description_image' => $image,
                    'created_at' => $this->author_info['created_at'],
                    'created_by' => $this->author_info['created_by'],
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                try {
                    $insert_id = $this->library_model->insert($data);
                    $data_vi = array(
                        'library_id' => $insert_id,
                        'language' => 'vi',
                        'title' => $this->input->post('title_vi'),
                        'slug' => $unique_slug_vi,
                        'meta_description' => $this->input->post('meta_description_vi'),
                        'meta_keywords' => $this->input->post('meta_keywords_vi'),
                        'description' => $this->input->post('description_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $data_en = array(
                        'library_id' => $insert_id,
                        'language' => 'en',
                        'title' => $this->input->post('title_en'),
                        'slug' => $unique_slug_en,
                        'meta_description' => $this->input->post('meta_description_en'),
                        'meta_keywords' => $this->input->post('meta_keywords_en'),
                        'description' => $this->input->post('description_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->library_model->insert_with_language($data_vi, $data_en);

                    $this->session->set_flashdata('message', 'Item added successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error inserting item: ' . $e->getMessage());
                }

                redirect('admin/library', 'refresh');
            }
        }
    }

    public function edit($id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');

        $input_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $result = $this->library_model->get_by_id($input_id);

        if (!$result || $result['id'] == null) {
            redirect('admin/library', 'refresh');
        }

        // Title
        $title = explode('|||', $result['library_title']);
        $result['title_en'] = $title[0];
        $result['title_vi'] = $title[1];

        // Slug
        $slug = explode('|||', $result['library_slug']);
        $result['slug_en'] = isset($slug[0]) ? $slug[0] : '';
        $result['slug_vi'] = isset($slug[1]) ? $slug[1] : '';

        // Meta description
        $meta_description = explode('|||', $result['library_meta_description']);
        $result['meta_description_en'] = isset($meta_description[0]) ? $meta_description[0] : '';
        $result['meta_description_vi'] = isset($meta_description[1]) ? $meta_description[1] : '';

        // Meta keywords
        $meta_keywords = explode('|||', $result['library_meta_keywords']);
        $result['meta_keywords_en'] = isset($meta_keywords[0]) ? $meta_keywords[0] : '';
        $result['meta_keywords_vi'] = isset($meta_keywords[1]) ? $meta_keywords[1] : '';

        // Description
        $description = explode('|||', $result['library_description']);
        $result['description_en'] = $description[0];
        $result['description_vi'] = $description[1];

        // Content
        $content = explode('|||', $result['library_content']);
        $result['content_en'] = $content[0];
        $result['content_vi'] = $content[1];

        if ($this->form_validation->run() == FALSE) {
            $this->data['library'] = $result;
            $this->render('admin/library/edit_library_view');
        } else {
            if ($this->input->post()) {
                $slug_vi = $this->input->post('slug_vi');
                $unique_slug_vi = $this->library_model->build_unique_slug($slug_vi);

                $slug_en = $this->input->post('slug_en');
                $unique_slug_en = $this->library_model->build_unique_slug($slug_en);

                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/library', 'assets/upload/library/thumb');
                $data = array(
                    'description_image' => $image,
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                if ($image == '') {
                    unset($data['description_image']);
                }

                try {
                    $this->library_model->update($input_id, $data);
                    $data_vi = array(
                        'title' => $this->input->post('title_vi'),
                        'slug' => $unique_slug_vi,
                        'meta_description' => $this->input->post('meta_description_vi'),
                        'meta_keywords' => $this->input->post('meta_keywords_vi'),
                        'description' => $this->input->post('description_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $this->library_model->update_with_language_vi($input_id, $data_vi);

                    $data_en = array(
                        'title' => $this->input->post('title_en'),
                        'slug' => $unique_slug_en,
                        'meta_description' => $this->input->post('meta_description_en'),
                        'meta_keywords' => $this->input->post('meta_keywords_en'),
                        'description' => $this->input->post('description_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->library_model->update_with_language_en($input_id, $data_en);

                    $this->session->set_flashdata('message', 'Item updated successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                }

                redirect('admin/library', 'refresh');
            }
        }
    }

    public function delete($id = NULL) {
        $input = $this->input->get();
        $library = $this->library_model->get_by_id($input['id']);

        if (!$library) {
            $this->output->set_status_header(404)
                ->set_output(json_encode(array('message' => 'Fail', 'data' => $input)));
        }

        $set_delete = array('is_deleted' => 1);
        $result = $this->library_model->remove($input['id'], $set_delete);

        if($result == false){
            $this->output->set_status_header(404)
                ->set_output(json_encode(array('message' => 'Fail', 'data' => $input)));
        }else{
            $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 'Success', 'data' => $input)));
        }
    }

}
