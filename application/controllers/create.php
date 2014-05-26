<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users');
        $this->load->model('Hobbies');
    }

    public function index()
    {
        $user_id = $this->facebook->getUser();
        $user_fb_info=$this->Users->select_user($user_id);

      // $toDatabse = base64_encode(serialize($fb_info)); // encode $fb_info
       // $this->session->set_userdata('fb_info', $toDatabse); // save to ci_sessions

        $this->load->view('create',array('data' => $user_fb_info));

    }
    public function get_hints($term)
    {
        //if (strlen($str)>1) // Hint string has at least 2 chars
        //{
        $hints=$this->Hobbies->get_hobbies_hints($term);
        if($hints)
        {

       foreach($hints as $hint)
         {
             echo '<text id="option">'.$hint['hobby_desc'].'</text><br>';
          }
        }
      }

    public function commit_form()

    {
        // if all ok than redirect to
        // insert new step into db

        echo site_url('invite');
        redirect(site_url('invite')); // or published_profile

    }


}

