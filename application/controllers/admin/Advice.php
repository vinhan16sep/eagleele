<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Advice extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('advice_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'admin/advice/index';
        $total_rows = $this->advice_model->count_all();
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $result = $this->advice_model->get_all_with_pagination($per_page, $this->data['page']);

        $output = array();
        foreach($result as $key => $value){
            $output[$key]['id'] = $value['id'];
            $output[$key]['data'] = $this->advice_model->get_by_id_admin($value['id']);
        }
        $this->data['advices'] = $output;

        $this->render('admin/advice/list_advice_view');
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');
        $this->form_validation->set_rules('description_vi', 'Tóm tắt', 'required');
        $this->form_validation->set_rules('description_en', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->render('admin/advice/create_advice_view');
        } else {
            if ($this->input->post()) {
                $slug_vi = $this->input->post('slug_vi');
                $unique_slug_vi = $this->advice_model->build_unique_slug($slug_vi);

                $slug_en = $this->input->post('slug_en');
                $unique_slug_en = $this->advice_model->build_unique_slug($slug_en);

                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/advice', 'assets/upload/advice/thumb');
                $data = array(
                    'description_image' => $image,
                    'created_at' => $this->author_info['created_at'],
                    'created_by' => $this->author_info['created_by'],
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                try {
                    $insert_id = $this->advice_model->insert($data);
                    $data_vi = array(
                        'advice_id' => $insert_id,
                        'language' => 'vi',
                        'title' => $this->input->post('title_vi'),
                        'slug' => $unique_slug_vi,
                        'meta_description' => $this->input->post('meta_description_vi'),
                        'meta_keywords' => $this->input->post('meta_keywords_vi'),
                        'description' => $this->input->post('description_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $data_en = array(
                        'advice_id' => $insert_id,
                        'language' => 'en',
                        'title' => $this->input->post('title_en'),
                        'slug' => $unique_slug_en,
                        'meta_description' => $this->input->post('meta_description_en'),
                        'meta_keywords' => $this->input->post('meta_keywords_en'),
                        'description' => $this->input->post('description_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->advice_model->insert_with_language($data_vi, $data_en);

                    $this->session->set_flashdata('message', 'Item added successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error inserting item: ' . $e->getMessage());
                }

                redirect('admin/advice', 'refresh');
            }
        }
    }

    public function edit($id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');
        $this->form_validation->set_rules('description_vi', 'Tóm tắt', 'required');
        $this->form_validation->set_rules('description_en', 'Description', 'required');

        $input_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $result = $this->advice_model->get_by_id_admin($input_id);

        if (!$result || $result['id'] == null) {
            redirect('admin/advice', 'refresh');
        }

        // Name
        $title = explode('|||', $result['advice_title']);
        $result['title_en'] = $title[0];
        $result['title_vi'] = $title[1];

        // Slug
        $slug = explode('|||', $result['advice_slug']);
        $result['slug_en'] = isset($slug[0]) ? $slug[0] : '';
        $result['slug_vi'] = isset($slug[1]) ? $slug[1] : '';

        // Meta description
        $meta_description = explode('|||', $result['advice_meta_description']);
        $result['meta_description_en'] = isset($meta_description[0]) ? $meta_description[0] : '';
        $result['meta_description_vi'] = isset($meta_description[1]) ? $meta_description[1] : '';

        // Meta keywords
        $meta_keywords = explode('|||', $result['advice_meta_keywords']);
        $result['meta_keywords_en'] = isset($meta_keywords[0]) ? $meta_keywords[0] : '';
        $result['meta_keywords_vi'] = isset($meta_keywords[1]) ? $meta_keywords[1] : '';

        // Description
        $description = explode('|||', $result['advice_description']);
        $result['description_en'] = isset($description[0]) ? $description[0] : '';
        $result['description_vi'] = isset($description[1]) ? $description[1] : '';

        // Content
        $content = explode('|||', $result['advice_content']);
        $result['content_en'] = isset($content[0]) ? $content[0] : '';
        $result['content_vi'] = isset($content[1]) ? $content[1] : '';

        if ($this->form_validation->run() == FALSE) {
            $this->data['advice'] = $result;
            $this->render('admin/advice/edit_advice_view');
        } else {
            if ($this->input->post()) {
                $slug_vi = $this->input->post('slug_vi');
                $unique_slug_vi = $this->advice_model->build_unique_slug($slug_vi);

                $slug_en = $this->input->post('slug_en');
                $unique_slug_en = $this->advice_model->build_unique_slug($slug_en);

                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/advice', 'assets/upload/advice/thumbs');
                $data = array(
                    'description_image' => $image,
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                if ($image == '') {
                    unset($data['description_image']);
                }

                try {
                    $this->advice_model->update($input_id, $data);
                    $data_vi = array(
                        'title' => $this->input->post('title_vi'),
                        'slug' => $unique_slug_vi,
                        'meta_description' => $this->input->post('meta_description_vi'),
                        'meta_keywords' => $this->input->post('meta_keywords_vi'),
                        'description' => $this->input->post('description_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $this->advice_model->update_with_language_vi($input_id, $data_vi);

                    $data_en = array(
                        'title' => $this->input->post('title_en'),
                        'slug' => $unique_slug_en,
                        'meta_description' => $this->input->post('meta_description_en'),
                        'meta_keywords' => $this->input->post('meta_keywords_en'),
                        'description' => $this->input->post('description_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->advice_model->update_with_language_en($input_id, $data_en);

                    $this->session->set_flashdata('message', 'Item updated successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                }

                redirect('admin/advice', 'refresh');
            }
        }
    }

    public function delete($id = NULL) {
        $input = $this->input->get();
        $blog = $this->advice_model->get_by_id_admin($input['id']);

        if (!$blog) {
            $this->output->set_status_header(404)
                ->set_output(json_encode(array('message' => 'Fail', 'data' => $input)));
        }

        $set_delete = array('is_deleted' => 1);
        $result = $this->advice_model->remove($input['id'], $set_delete);

        if($result == false){
            $this->output->set_status_header(404)
                ->set_output(json_encode(array('message' => 'Fail', 'data' => $input)));
        }else{
            $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 'Success', 'data' => $input)));
        }
    }

}
