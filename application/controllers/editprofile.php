<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Editprofile extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users');
        $this->load->model('Hobbies');
    }

    public function index()
    {
        try {


       $user_id = $this->facebook->getUser();

    //    $username = $this->facebook->api('/me','GET'); //test login



       // $fromDatabase=$this->session->userdata('fb_info'); // retrieve from ci_sessions
       // $fb_info=unserialize(base64_decode($fromDatabase)); // decode $fb_info

        $fb_info=$this->Users->select_user($user_id); // GET USER FACEBOOK INFO

        $hobbies=$this->Users->get_hobbies($user_id);
        $aboutme=$this->Users->get_aboutme($user_id);


        $this->load->view('header',array('data' => $fb_info));
        $this->load->view('editprofile',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
        $this->load->view('footer');


//            $login_url = $this->facebook->getLogoutUrl();

  //          echo 'Please <a href="' . $login_url . '">logout.</a>';

        }catch(FacebookApiException $e) {
            // If the user is logged out, you can have a
            // user ID even though the access token is invalid.
            // In this case, we'll get an exception, so we'll
            // just ask the user to login again here.
            $login_url = $this->facebook->getLoginUrl();
            echo 'Please <a style="color:black" href="' . $login_url . '">login.</a>';
            error_log($e->getType());
            error_log($e->getMessage());
        }
    }

    public function delete_hobby($user_id,$hobby)
    {
        $this->Hobbies->delete_hobby($user_id,$hobby);
    }

    public function edit_details($user_id,$hobby)
    {
        $this->Hobbies->update_hobby($user_id,$hobby);
    }

}