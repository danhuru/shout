<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewprofile extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users');
     //   $this->load->model('Endorse');
    }

    public function index()
    {

        $user_id = $this->facebook->getUser();
        $fb_info=$this->Users->select_user($user_id);

        //Get last education

        $hobbies=$this->Users->get_hobbies($user_id);
        $aboutme=$this->Users->get_aboutme($user_id);

        $this->load->view('header',array('data' => $fb_info));
        $this->load->view('popups',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme));
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


          //  $this->load->view('header',array('data' => $fb_info));
          //  $this->load->view('popups',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
          //  $this->load->view('viewprofile',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
         //  $this->load->view('footer');

            //else show only public profile

             $user_is_loggedin=0;

              $this->load->view('header',array('data' => $fb_info));
              $this->load->view('popups',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme, 'user_is_logged_in' => $user_is_loggedin)); // load the view
              $this->load->view('viewprofile_public',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
              $this->load->view('footer');


        }
        // else this user does not exist

        // if user is owner then

        // load corresponding view

        else
        {
     //   echo "Sorry this profile does not exist";

            //REDIRECT TO ERROR PAGE;

        }

    }

    public function add_hobby_endorsement()

    {


        //user is not logged in

        $hobby=$this->input->post('hobby'); // GET HOBBY
        $profile=$this->input->post('thisUser'); // GET PROFILE
        $user_info=$this->Users->select_user_profile($profile); //GET USER_ID FROM PROFILE

      //  $currentvalue=$this->Endorse->select_endorsement($user_id['USER_ID'],$hobby); //GET CURRENT ENDORSEMENT
      //  $newvalue=$currentvalue[0]["endorsements"]+$amount;

//        $this->Endorse->endorse_hobby($user_id['USER_ID'],$hobby,$newvalue);


    $user_ip = $this->input->ip_address();
    $user_id_receiving=$user_info['USER_ID'];
    $user_name_receiving=$user_info['USER_NAME'];
    $user_profilelink_receiving=$user_info['PROFILE_URL'];
    $endorsement_desc=$hobby;
    $endorsement_value=0.1; // not logged in



$this->Users->insert_user_events(1,'endorsement-hobby','1',$user_ip,null,null,null,$user_id_receiving,$user_name_receiving,$user_profilelink_receiving,$endorsement_desc,$endorsement_value,null);

 echo 'Endorsed for '.$hobby.'!';

    }

}