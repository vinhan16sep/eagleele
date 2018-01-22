<?php 

class Comment extends Admin_Controller{
	function __construct(){
		parent::__construct();
        $this->load->model('comment_model');


	}

	public function index(){
        $detail_id = $this->uri->segment(5);
        $category = $this->uri->segment(4);
//        switch ($category){
//            case 'recruitment':
//                $model = $this->re
//        }
        $this->load->model($category.'_model');
        $model = $category.'_model';
        if($category == 'new-comment'){
            $this->load->model('count_comment_model');
            $list_comment = $this->count_comment_model->fetch_all();
        }else{
            $where =  array('detail_id' => $detail_id, 'category' => $category);
            $list_comment = $this->comment_model->fetch_all($where);
        }
        $recruitment = $this->$model->get_id($detail_id);
        $this->data['title'] = $recruitment['title'];
		$this->data['list_comment'] = $list_comment;
		$this->render('admin/comment/list_comment_view');
	}



	public function delete_all(){
        $this->db->empty_table('count_comment');
        redirect('admin/dashboard');

    }

	public function remove(){
		$id = $_GET['id'];
		$this->comment_model->delete($id);
	}

    public function check_status(){
        $slug = $this->input->get('slug');
        $category = $this->input->get('category');
        $where = array('category' => $category, 'slug' => $slug);
        $data =  array('status' => 1);
        $this->comment_model->update($where, $data);
    }

}

 ?>