<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users'); // Load the Users Model Class
    }

 //LANDING PAGE

    public function index()
    {
        $this->load->view('login');
      }

 // AFTER FACEBOOK LOGIN

    public function redirect()
    {

     //FIRST CHECK IF USER IS LOGGED IN FACEBOOK

        $user_id = $this->facebook->getUser();
      //  echo $user_id;

    if($user_id) {

        // We have a user ID, so probably a logged in user.
        // If not, we'll get an exception, which we handle below.
        try {

         //  $username = $this->facebook->api('/me','GET');

            $user_id="TestId"; //TEMP
            $username="Test User"; //TEMP



         //  $user_exists=$this->Users->select_user($user_id); // Check username and redirect status
        $user_exists=0;
          if($user_exists) // If the user is in the db or not
          {
            echo $user_exists['username']; // TEMP
            //$this->load->view('home',$user_exists['redirect']); // Redirect user to the proper page
            redirect(site_url($user_exists['redirect']));
          }
            else {
             //     $this->Users->insert_user($user_id, $username, 'create_profile');
             //$this->load->view('create_profile'); // User has never logged in before. Redirect to Create_profile
            redirect(site_url('create'));
            }


        } catch(FacebookApiException $e) {
            // If the user is logged out, you can have a
            // user ID even though the access token is invalid.
            // In this case, we'll get an exception, so we'll
            // just ask the user to login again here.
            $login_url = $this->facebook->getLoginUrl();
            echo 'Please <a href="' . $login_url . '">login.</a>';
            error_log($e->getType());
            error_log($e->getMessage());

        }
    } else {

        // No user, so print a link for the user to login
        $login_url = $this->facebook->getLoginUrl();
        echo 'Please <a href="' . $login_url . '">login.</a>';

    }



    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */