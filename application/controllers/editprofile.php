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
            $fb_info=$this->Users->select_user($user_id); // GET USER FACEBOOK INFO
            $hobbies=$this->Users->get_hobbies($user_id);
            $aboutme=$this->Users->get_aboutme($user_id);
            $this->load->view('header',array('data' => $fb_info));
            $this->load->view('editprofile',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
            $this->load->view('footer');
                }
                else {

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

    public function delete_hobby($user_id,$hobby)
    {
        $this->Hobbies->delete_hobby($user_id,$hobby);
    }

    public function edit_details($user_id,$hobby)
    {
        $this->Hobbies->update_hobby($user_id,$hobby);
    }

}