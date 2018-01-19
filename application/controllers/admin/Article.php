<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('article_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'admin/article/index';
        $total_rows = $this->article_model->count_all();
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->data['articles'] = $this->article_model->get_all_with_pagination($per_page, $this->data['page']);

        $this->render('admin/article/list_article_view');
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->data['categories'] = $this->build_category_dropdown();
            $this->render('admin/article/create_article_view');
        } else {
            if ($this->input->post()) {
                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/article', 'assets/upload/article/thumb');
                $banner = $this->upload_image('banner', $_FILES['banner']['name'], 'assets/upload/article/banner', 'assets/upload/article/banner/thumb');
                $type = $this->input->post('type');

                // Convert date time
                if($type == 0){
                    $event_time = $this->input->post('eventtime_birthDay') . ' ' . $this->input->post('event_hour') . ':' . $this->input->post('event_min') . ':00';
                }
                $data = array(
                    'type' => $type,
                    'description_image' => $image,
                    'banner' => $banner,
                    'category_id' => ($type == 0) ? null : $this->input->post('category'),
                    'created_at' => $this->author_info['created_at'],
                    'created_by' => $this->author_info['created_by'],
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                try {
                    $insert_id = $this->article_model->insert($data);
                    $data_vi = array(
                        'article_id' => $insert_id,
                        'language' => 'vi',
                        'event_time' => ($type == 0) ? $event_time : null,
                        'event_location' => ($type == 0) ? $this->input->post('location_vi') : null,
                        'event_address' => ($type == 0) ? $this->input->post('address_vi') : null,
                        'event_cost' => ($type == 0) ? $this->input->post('cost_vi') : null,
                        'title' => $this->input->post('title_vi'),
                        'slug' => $this->input->post('slug_vi'),
                        'meta_description' => $this->input->post('meta_description_vi'),
                        'meta_keywords' => $this->input->post('meta_keywords_vi'),
                        'description' => $this->input->post('description_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $data_en = array(
                        'article_id' => $insert_id,
                        'language' => 'en',
                        'event_time' => ($type == 0) ? $event_time : null,
                        'event_location' => ($type == 0) ? $this->input->post('location_en') : null,
                        'event_address' => ($type == 0) ? $this->input->post('address_en') : null,
                        'event_cost' => ($type == 0) ? $this->input->post('cost_en') : null,
                        'title' => $this->input->post('title_en'),
                        'slug' => $this->input->post('slug_en'),
                        'meta_description' => $this->input->post('meta_description_en'),
                        'meta_keywords' => $this->input->post('meta_keywords_en'),
                        'description' => $this->input->post('description_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->article_model->insert_with_language($data_vi, $data_en);

                    $this->session->set_flashdata('message', 'Item added successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error inserting item: ' . $e->getMessage());
                }

                redirect('admin/article', 'refresh');
            }
        }
    }

    public function edit($id = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title_vi', 'Tiêu đề', 'required');
        $this->form_validation->set_rules('title_en', 'Title', 'required');

        $input_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $result = $this->article_model->get_by_id($input_id);

        if (!$result || $result['id'] == null) {
            redirect('admin/article', 'refresh');
        }

        // Title
        $title = explode('|||', $result['article_title']);
        $result['title_en'] = $title[0];
        $result['title_vi'] = $title[1];

        // Slug
        $slug = explode('|||', $result['article_slug']);
        $result['slug_en'] = isset($slug[0]) ? $slug[0] : '';
        $result['slug_vi'] = isset($slug[1]) ? $slug[1] : '';

        // Meta description
        $meta_description = explode('|||', $result['article_meta_description']);
        $result['meta_description_en'] = isset($meta_description[0]) ? $meta_description[0] : '';
        $result['meta_description_vi'] = isset($meta_description[1]) ? $meta_description[1] : '';

        // Meta keywords
        $meta_keywords = explode('|||', $result['article_meta_keywords']);
        $result['meta_keywords_en'] = isset($meta_keywords[0]) ? $meta_keywords[0] : '';
        $result['meta_keywords_vi'] = isset($meta_keywords[1]) ? $meta_keywords[1] : '';

        // Description
        $description = explode('|||', $result['article_description']);
        $result['description_en'] = $description[0];
        $result['description_vi'] = $description[1];

        // Content
        $content = explode('|||', $result['article_content']);
        $result['content_en'] = $content[0];
        $result['content_vi'] = $content[1];

        // Time
        $raw_time = explode('|||', $result['article_time']);
        $time = isset($raw_time[0]) ? $raw_time[0] : '';
        if($time != ''){
            $this->data['time'] = $this->build_datetime_dropdown($time);
        }

        // Cost
        $cost = explode('|||', $result['article_cost']);
        $result['cost_en'] = isset($cost[0]) ? $cost[0] : '';
        $result['cost_vi'] = isset($cost[1]) ? $cost[1] : '';

        // Location
        $location = explode('|||', $result['article_location']);
        $result['location_en'] = isset($location[0]) ? $location[0] : '';
        $result['location_vi'] = isset($location[1]) ? $location[1] : '';

        // Address
        $address = explode('|||', $result['article_address']);
        $result['address_en'] = isset($address[0]) ? $address[0] : '';
        $result['address_vi'] = isset($address[1]) ? $address[1] : '';

        if ($this->form_validation->run() == FALSE) {
            $this->data['categories'] = $this->build_category_dropdown();
            $this->data['article'] = $result;
            $this->render('admin/article/edit_article_view');
        } else {
            if ($this->input->post()) {
                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/article', 'assets/upload/article/thumb');
                $banner = $this->upload_image('banner', $_FILES['banner']['name'], 'assets/upload/article/banner', 'assets/upload/article/banner/thumb');
                $type = $this->input->post('type');

                // Convert date time
                if($type == 0){
                    $event_time = $this->input->post('eventtime_birthDay') . ' ' . $this->input->post('event_hour') . ':' . $this->input->post('event_min') . ':00';
                }

                $data = array(
                    'type' => $type,
                    'description_image' => $image,
                    'banner' => $banner,
                    'category_id' => ($type == 0) ? null : $this->input->post('category'),
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                if ($image == '') {
                    unset($data['description_image']);
                }

                try {
                    $this->article_model->update($input_id, $data);
                    $data_vi = array(
                        'event_time' => ($type == 0) ? $event_time : null,
                        'event_location' => ($type == 0) ? $this->input->post('location_vi') : null,
                        'event_address' => ($type == 0) ? $this->input->post('address_vi') : null,
                        'event_cost' => ($type == 0) ? $this->input->post('cost_vi') : null,
                        'title' => $this->input->post('title_vi'),
                        'slug' => $this->input->post('slug_vi'),
                        'meta_description' => $this->input->post('meta_description_vi'),
                        'meta_keywords' => $this->input->post('meta_keywords_vi'),
                        'description' => $this->input->post('description_vi'),
                        'content' => $this->input->post('content_vi')
                    );
                    $this->article_model->update_with_language_vi($input_id, $data_vi);

                    $data_en = array(
                        'event_time' => ($type == 0) ? $event_time : null,
                        'event_location' => ($type == 0) ? $this->input->post('location_en') : null,
                        'event_address' => ($type == 0) ? $this->input->post('address_en') : null,
                        'event_cost' => ($type == 0) ? $this->input->post('cost_en') : null,
                        'title' => $this->input->post('title_en'),
                        'slug' => $this->input->post('slug_en'),
                        'meta_description' => $this->input->post('meta_description_en'),
                        'meta_keywords' => $this->input->post('meta_keywords_en'),
                        'description' => $this->input->post('description_en'),
                        'content' => $this->input->post('content_en')
                    );

                    $this->article_model->update_with_language_en($input_id, $data_en);

                    $this->session->set_flashdata('message', 'Item updated successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error updating the item: ' . $e->getMessage());
                }

                redirect('admin/article', 'refresh');
            }
        }
    }

    public function delete($id = NULL) {
        $result = $this->article_model->get_by_id($id);

        if (!$result) {
            redirect('admin/article', 'refresh');
        }

        $set_delete = array('is_deleted' => 1);
        try {
            $this->article_model->remove($id, $set_delete);
            $this->session->set_flashdata('message', 'Item has deleted successful.');
        } catch (Exception $e) {
            $this->session->set_flashdata('message', 'Have error while delete item: ' . $e->getMessage());
        }
        redirect('admin/article', 'refresh');
    }

    public function build_category_dropdown(){
        $this->load->model('category_model');

        // Get categories for dropdown
        $categories = $this->category_model->get_all_category();
        $categories_title = array(
            '' => 'Danh mục'
        );
        foreach($categories as $key => $item){
            $categories_title[$key] = $item['title'];
        }

        return $categories_title;
    }

    public function build_datetime_dropdown($time){
        $year = substr($time, 0, 4);
        $month = substr($time, 5,  2);
        $day = substr($time, 8,  2);
        $hour = substr($time, 11,  2);
        $minute = substr($time, 14,  2);

        return array($year, $month, $day, $hour, $minute);
    }

}
