<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Finish extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');

    }

    public function index()
    {
        $fromDatabase=$this->session->userdata('fb_info'); // retrieve from ci_sessions
        $username=unserialize(base64_decode($fromDatabase)); // decode $fb_info
        $this->load->view('finish',array('data' => $username)); // load the view
    }
}