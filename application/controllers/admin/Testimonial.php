<?php
/**
 * Created by PhpStorm.
 * User: Luong Quoc Hung
 * Date: 1/23/18
 * Time: 11:33 AM
 */
class Testimonial extends Admin_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('testimonial_model');


    }

    public function index(){
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'admin/testimonial/index';
        $total_rows = $this->testimonial_model->count_all();
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $testimonials = $this->testimonial_model->get_all_with_pagination($per_page, $this->data['page']);
        $this->data['testimonials'] = $testimonials;

        $this->render('admin/testimonial/list_testimonial_view');
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Họ tên', 'required');
        $this->form_validation->set_rules('position', 'Chức danh', 'required');
        $this->form_validation->set_rules('content', 'Nội dung', 'required');
        if( $this->form_validation->run() == false ){
            $this->render('admin/testimonial/create_testimonial_view');
        }else{
            if($this->input->post()){
                $slug = $this->input->post('slug');
                $unique_slug = $this->testimonial_model->build_unique_slug($slug);
                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/testimonial', 'assets/upload/testimonial/thumb');
                $data = array(
                    'image' => $image,
                    'name' => $this->input->post('name'),
                    'slug' => $unique_slug,
                    'position' => $this->input->post('position'),
                    'content' => $this->input->post('content'),
                    'created_at' => $this->author_info['created_at'],
                    'created_by' => $this->author_info['created_by'],
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );
                try {
                    if($this->testimonial_model->insert($data) == true){
                        $this->session->set_flashdata('message', 'Item added successfully');
                        redirect('admin/testimonial', 'refresh');
                    }
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error inserting item: ' . $e->getMessage());
                }
            }
        }

    }

    public function edit($id = null) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $input_id = isset($id) ? (int) $id : (int) $this->input->post('id');
        $result = $this->testimonial_model->get_by_id($input_id);
        if(!$result){
            redirect('admin/testimonial', 'refresh');
        }

        $this->form_validation->set_rules('name', 'Họ tên', 'required');
        $this->form_validation->set_rules('position', 'Chức danh', 'required');
        $this->form_validation->set_rules('content', 'Nội dung', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->data['testimonial'] = $result;
            $this->render('admin/testimonial/edit_testimonial_view');
        } else {
            if ($this->input->post()) {
                $slug = $this->input->post('slug');
                $unique_slug = $this->testimonial_model->build_unique_slug($slug);
                $image = $this->upload_image('picture', $_FILES['picture']['name'], 'assets/upload/testimonial', 'assets/upload/testimonial/thumb');

                $data = array(
                    'image' => $image,
                    'name' => $this->input->post('name'),
                    'slug' => $unique_slug,
                    'position' => $this->input->post('position'),
                    'content' => $this->input->post('content'),
                    'modified_at' => $this->author_info['modified_at'],
                    'modified_by' => $this->author_info['modified_by']
                );

                if ($image == '') {
                    unset($data['image']);
                }

                try {
                    $this->testimonial_model->update($input_id, $data);

                    $this->session->set_flashdata('message', 'Item update successfully');
                } catch (Exception $e) {
                    $this->session->set_flashdata('message', 'There was an error when update item: ' . $e->getMessage());
                }

                redirect('admin/testimonial', 'refresh');
            }
        }
    }


    public function remove(){
        $id = $_GET['id'];
        $isExist = false;
        if($this->testimonial_model->delete($id) == true){
            $isExist = true;
        }
        $this->output->set_status_header(200)->set_output(json_encode(array('isExist' => $isExist)));
    }

}