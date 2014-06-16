<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Default_404 extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {

        //;
       // $this->load->view('popups_session',array('current_url' => current_url()));

    }

    public function error()
    {
        $this->load->view("404");
    }
}