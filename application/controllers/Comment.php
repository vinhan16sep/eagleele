<?php 
class Comment extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('comment_model');
	}
	public function create_comment(){
		$this->load->helper('date');
		$name = $_GET['name'];
		$email = $_GET['email'];
		$content = nl2br($_GET['content']);
		$category = $_GET['category'];
		$id = $_GET['id'];
		// echo date(DATE_RFC822, time());die;
//		 print_r($name);die;
        $ip = $_SERVER['REMOTE_ADDR'];
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
		$data = array(
				'name' => $name,
				'email' => $email,
				'content' => $content,
				'detail_id' => $id,
				'category' => $category,
				'created_at' => date("Y/m/d"),
                'ip_address' => $ip
				);
		$this->comment_model->save($data);

//        $this->load->model('count_comment_model');
//        $this->count_comment_model->save($data);

        $comment = '<div class="media cmt">';
        $comment .= '<div class="media-left">';
        $comment .= '<img class="media-object" src="'.site_url('assets/public/img/comment_ava.png').'" alt="Comment Avatar" width="64">';
        $comment .= '</div>';
        $comment .= '<div class="media-body">';
        $comment .= '<h3 class="media-heading" style="color: #f4aa1c">'.$name.':</h3>';
        $comment .= '<span>'.$content.'</span>';
        $comment .= '<span style="float: right; font-size: 1em">'.date('Y/m/d').'</span>';
        $comment .= '</div>';
        $comment .= '</div>';

//		$comment = '<p><span style="color: red">'.$name.' :</span style="color: red"> <span>'.$content.'</span> <span style="float: right; font-size: 10px">'.date("d/m/Y").'</span></p>';

		$this->output->set_status_header(200)->set_output(json_encode(array('comment' => $comment)));

	}

	public function see_more_comment(){
        $this->load->model('comment_model');
        $detail_id = $_GET['id'];
        $category = $_GET['category'];
        $page = $_GET['page'];
        $limit  = 5;
        $start = ($page - 1)*5;
        $where = array('detail_id' => $detail_id, 'category' => $category);
        $count = count($this->comment_model->fetch_all($where));
        $comment = $this->comment_model->fetch_all($where, $limit, $start);
        $stop = ceil($count / $limit);
        if($page <= $stop){
            foreach ($comment as $value){
                echo '<div class="media cmt">';
                echo '<div class="media-left">';
                echo '<img class="media-object" src="'.site_url('assets/public/img/comment_ava.png').'" alt="Comment Avatar" width="64">';
                echo '</div>';
                echo '<div class="media-body">';
                echo '<h3 class="media-heading" style="color: #f4aa1c">'.$value['name'].':</h3>';
                echo '<span>'.$value['content'].'</span>';
                echo '<span style="float: right; font-size: 1em">'.$value['created_at'].'</span>';
                echo '</div>';
                echo '</div>';
            }
        }

    }
}

?>