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
        if($user_id)
        {
            try
            {
                $test = $this->facebook->api('/me?fields=id');
                if ($test)
                {
                    $this->Users->update_redirect_page($user_id,'finish');
                    $username=$this->Users->select_user($user_id);
                    $this->load->view('finish',array('data' => $username)); // load the view
                } else {
                    echo "Your FB session expired";
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