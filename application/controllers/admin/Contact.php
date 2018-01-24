<?php
/**
 * Created by PhpStorm.
 * User: Luong Quoc Hung
 * Date: 1/24/18
 * Time: 10:39 AM
 */
class Contact extends Admin_Controller{
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('contact_model');
        $this->load->library('session');
    }
    public function index(){
        $this->load->library('pagination');
        $config = array();
        $base_url = base_url() . 'admin/contact/index';
        $total_rows = $this->contact_model->count_all();
        $per_page = 10;
        $uri_segment = 4;
        foreach ($this->pagination_config($base_url, $total_rows, $per_page, $uri_segment) as $key => $value) {
            $config[$key] = $value;
        }
        $this->pagination->initialize($config);

        $this->data['page_links'] = $this->pagination->create_links();
        $this->data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $result = $this->contact_model->get_all_with_pagination($per_page, $this->data['page']);
        $this->data['contacts'] = $result;

        $this->render('admin/contact/list_contact_view');
    }
}