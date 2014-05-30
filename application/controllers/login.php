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

           $test = $this->facebook->api('/me','GET');

            $user_id = $this->facebook->getUser();
            $user_fb_info=$this->Users->select_user($user_id);

            if($user_fb_info) {

            redirect(site_url('home'));

            }

            else

            {
                $fql ='select uid, pic_big, pic, pic_small, name, birthday_date, sex, relationship_status, friend_count, current_location, education, work from user where uid='.$user_id;
                $fb_info = $this->facebook->api(array(
                    'method' => 'fql.query',
                    'query' => $fql,
                ));

                $this->Users->insert_user($fb_info); //insert facebook info in db
                $this->Users->update_redirect_page($user_id,'create');
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