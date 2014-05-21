<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {


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

        $hobbies=$this->Users->get_hobbies($user_id);
        $aboutme=$this->Users->get_aboutme($user_id);

        // GET USER_EVENTS

        $events=$this->Users->get_user_events($user_id);

        // LOAD THE VIEWS
        $this->load->view('header',array('data' => $fb_info));
        $this->load->view('home',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme,'events' => $events)); // load the view
        $this->load->view('footer');
    }

    public function logout()
    {
        $this->facebook->destroySession();
        redirect('/');
    }
}