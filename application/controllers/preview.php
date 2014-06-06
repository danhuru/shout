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
        if($user_id)
        {
            // We have a user ID, so probably a logged in user.
            // If not, we'll get an exception, which we handle below.
            try
            {
                $test = $this->facebook->api('/me?fields=id');
                if ($test)
                {
                    //User is logged in
                    $this->Users->update_redirect_page($user_id,'preview');
                    $fb_info=$this->Users->select_user($user_id);
                    $hobbies=$this->Users->get_hobbies($user_id);
                    $aboutme=$this->Users->get_aboutme($user_id);
                    $this->load->view('preview',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view

                } else {

                    redirect('/');  // Your FB session expired
                }

            }
            catch (FacebookApiException $e) {
                //User is not logged in


                //   $login_url = $this->facebook->getLoginUrl();
                //   echo 'Please <a href="' . $login_url . '">login.</a>';
                redirect('/');
            }
        }
        else {
            // No user, so print a link for the user to login
            //$login_url = $this->facebook->getLoginUrl();
            //echo 'Please <a href="' . $login_url . '">login.</a>';

            redirect('/');
        }


    }

}