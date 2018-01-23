<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Background extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('background_model');
        $this->load->library('session');
    }

    public function index() {
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'admin/background/index';
        $total_rows = $this->background_model->count_all();
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $this->data['backgrounds'] = $this->background_model->get_all_with_pagination($per_page, $this->data['page']);

        $this->render('admin/background/list_background_view');
    }

    public function edit($id = null) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $input_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $result = $this->background_model->get_by_id($input_id);
        if(!$result){
            redirect('admin/background', 'refresh');
        }

        $this->form_validation->set_rules('background', 'background', 'callback_file_selected_test');
        $this->form_validation->set_rules('background', 'background', 'callback_check_size_image');

        if ($this->form_validation->run() == FALSE) {
            $this->data['background'] = $result;
            $this->render('admin/background/edit_background_view');
        } else {
            if ($this->input->post()) {
                $image = $this->upload_image('background', $_FILES['background']['name'], 'assets/upload/background', 'assets/upload/background/thumb');

                $data = array(
                    'image' => $image,
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                try {
                    $this->background_model->update($input_id, $data);

                    $this->session->set_flashdata('message', 'Item update successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error when update item: ' . $e->getMessage());
                }

                redirect('admin/background', 'refresh');
            }
        }
    }

    function file_selected_test(){

        $this->form_validation->set_message('file_selected_test', 'Please select file.');
        if (empty($_FILES['background']['name'])) {
            return false;
        }else{
            return true;
        }
    }

    function check_size_image(){
        $this->form_validation->set_message('check_size_image', 'Ảnh đã vượt quá dung lượng 1 MB, vui lòng kiểm tra lại');
        if(!empty($_FILES)){
            if($_FILES['background']['size'] > 1048576 || $_FILES['background']['size'] <= 0){
                return false;
            }

            return true;
        }
    }

}
