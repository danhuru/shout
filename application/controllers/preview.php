<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preview extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users');
    }

    public function index()
    {
        $user_id = $this->facebook->getUser();
        $fb_info=$this->Users->select_user($user_id);

      //  $fromDatabase=$this->session->userdata('fb_info'); // retrieve from ci_sessions
      //  $fb_info=unserialize(base64_decode($fromDatabase)); // decode $fb_info

        $hobbies=$this->Users->get_hobbies($user_id);
        $aboutme=$this->Users->get_aboutme($user_id);

        $this->load->view('preview',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
    }

}