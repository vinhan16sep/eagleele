<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include "class.phpmailer.php";
include "class.smtp.php";

class Contact extends Public_Controller {

    private $_lang = '';

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->library('session');
        $this->data['lang'] = $this->session->userdata('langAbbreviation');
    }

    public function index($id = 1){
        $this->data['current_link'] = 'contact';

        $this->data['title'] = ($this->data['lang'] == 'vi') ? 'Liên hệ' : 'Contact';
        $this->data['meta_description'] = ($this->data['lang'] == 'vi') ? 'Liên hệ' : 'Contact';
        $this->data['meta_keywords'] = ($this->data['lang'] == 'vi') ? 'Liên hệ' : 'Contact';

        $this->render('contact_view');
    }

    public function create(){
        $this->load->model('contact_model');
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $params = array();
        parse_str($this->input->post('input'), $params);

        $send = $this->send_mail($params);

        if(!$send){
            $this->output->set_status_header(404)
                ->set_output(json_encode(array('message' => 'Fail', 'data' => $params)));
        }else{
            $data = array(
                'name' => $params['name'],
                'email' => $params['email'],
                'phone' => $params['phone'],
                'reason' => $params['reason'],
                'content' => $params['content'],
                'created_at' => date('Y-m-d H:i:s')
            );
            $contact = $this->contact_model->insert($data);

            if(!$contact){
                $this->output->set_status_header(404)
                    ->set_output(json_encode(array('message' => 'Fail', 'data' => $params)));
            }
            $this->output->set_status_header(200)
                ->set_output(json_encode(array('message' => 'Success', 'data' => $params)));
        }
    }

    public function send_mail($data) {
        $mail = new PHPMailer();
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->Host = "host07.emailserver.vn"; // specify main and backup server
        $mail->Port = 465; // set the port to use
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->SMTPSecure = 'ssl';
        $mail->Username = "system@eagleele.vn"; // your SMTP username or your gmail username
        $mail->Password = "2;P*9Rg,NxnE"; // your SMTP password or your gmail password
        $from = "system@eagleele.vn"; // Reply to this email
        $to = "info@eagleele.vn"; // Recipients email ID
        $name = 'WEBMAIL'; // Recipient's name
        $mail->From = $from;
        $mail->FromName = $name; // Name to indicate where the email came from when the recepient received
        $mail->AddAddress($to, "Eagle ele admin");
//        $mail->AddReplyTo($from);
        $mail->CharSet = 'UTF-8';
        $mail->WordWrap = 50; // set word wrap
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = "Mail từ " . strip_tags($data['name']);
        $message = $this->email_template($data);

        $mail->Body = $message; //HTML Body

        //$mail->SMTPDebug = 2;

        if(!$mail->Send()){
            return false;
        } else {
            return true;
        }
    }

    public function email_template($data){
        $message = '<html><body>';
        $message .= '<p>Chào Admin, bạn có mail mới từ người dùng trên website</p>';
        $message .= '<p>Thông tin như sau:</p>';
        $message .= '<p>Họ tên: ' . $data['name'] . '</p>';
        $message .= '<p>Email: ' . $data['email'] . '</p>';
        $message .= '<p>Số điện thoại: ' . $data['phone'] . '</p>';

        $options = array(
            '1' => '',
            '2' => $this->lang->line('contact_reason_2'),
            '3' => $this->lang->line('contact_reason_3'),
            '4' => $this->lang->line('contact_reason_4'),
            '5' => $this->lang->line('contact_reason_5'),
        );

        $message .= '<p>Lý do liên hệ: ' . $options[$data['reason']] . '</p>';
        $message .= '<p>Nội dung: ' . $data['content'] . '</p>';
        $message .= "</body></html>";

        return $message;
    }
}
