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
        $user_id='1570612986';

        //GET FB INFO

        $fromDatabase=$this->session->userdata('fb_info'); // retrieve from ci_sessions
        $fb_info=unserialize(base64_decode($fromDatabase)); // decode $fb_info

        //GET_LAST EDUCATION

        $i=0;
        foreach ($fb_info[0]['education'] as $school)
            $schools[$i++]= $school['school']['name'];

        $hobbies=$this->Users->get_hobbies($user_id);
        $aboutme=$this->Users->get_aboutme($user_id);
        $bckpic=$this->Users->get_bckpic($user_id);

        // GET USER_EVENTS

        $events=$this->Users->get_user_events($user_id);

        // LOAD THE VIEWS
        $this->load->view('header',array('data' => $fb_info));
        $this->load->view('home',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme,'bckpic' => $bckpic, 'schools' => $schools,'events' => $events)); // load the view
        $this->load->view('footer');
    }
}