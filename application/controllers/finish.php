<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Finish extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users');
    }

    public function index()
    {
        $user_id = $this->facebook->getUser();
        $username=$this->Users->select_user($user_id);
       // var_dump($username['PROFILE_URL']);
        $this->load->view('finish',array('data' => $username)); // load the view
    }
}