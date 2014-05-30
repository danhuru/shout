<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewprofile extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users');
    }

    public function index()
    {

        $user_id = $this->facebook->getUser();
        $fb_info=$this->Users->select_user($user_id);

        //Get last education

        $hobbies=$this->Users->get_hobbies($user_id);
        $aboutme=$this->Users->get_aboutme($user_id);

        $this->load->view('header',array('data' => $fb_info));
        $this->load->view('viewprofile',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
        $this->load->view('footer');
    }

    public function template($profile)
    {

        // if user exists then


          $fb_info=$this->Users->select_user_profile($profile);

        if ($fb_info['PROFILE_URL'])
        {

            // get profile info of user

             //if user is logged in then show more

          //  $fb_info=$this->Users->select_user_profile($profile);

            //Get last education

            $hobbies=$this->Users->get_hobbies($fb_info['USER_ID']);
            $aboutme=$this->Users->get_aboutme($fb_info['USER_ID']);


            $this->load->view('header',array('data' => $fb_info));
            $this->load->view('viewprofile',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
            $this->load->view('footer');

            //else show only public profile

           // $this->load->view('header_public',array('data' => $fb_info));
         //   $this->load->view('viewprofile_public',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme,'bckpic' => $bckpic, 'schools' => $schools)); // load the view
          //  $this->load->view('footer');


        }
        // else this user does not exist

        // if user is owner then

        // load corresponding view

        else
        {
        echo "Sorry this profile does not exist";

            //REDIRECT TO ERROR PAGE;

        }

    }

}