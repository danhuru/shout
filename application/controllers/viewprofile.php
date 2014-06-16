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
        if($user_id)
        {
            // We have a user ID, so probably a logged in user.
            // If not, we'll get an exception, which we handle below.
            try
            {
                $test = $this->facebook->api('/me?fields=id');
                if ($test)
                {


        $fb_info=$this->Users->select_user($user_id);

        //Get last education

        $hobbies=$this->Users->get_hobbies($user_id);
        $aboutme=$this->Users->get_aboutme($user_id);

        $this->load->view('header',array('data' => $fb_info));
        $this->load->view('popups',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme));
        $this->load->view('viewprofile',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
        $this->load->view('footer');
                } else {

                    redirect('/'); // Your FB session expired
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

    public function template($profile)
    {

        $fb_info=$this->Users->select_user_profile($profile);

        if ($fb_info['PROFILE_URL'])
        {

            // if user exists then
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



                        if ($user_id==$fb_info['USER_ID']) redirect("/viewprofile");

             //if user is logged in then show more


                           $user_info=$this->Users->select_user($user_id);

                        if ($user_info['REDIRECT_PAGE']=='home'){

                           $hobbies=$this->Users->get_hobbies($fb_info['USER_ID']);
                           $aboutme=$this->Users->get_aboutme($fb_info['USER_ID']);


                          $this->load->view('header',array('data' => $user_info));
                          $this->load->view('popups_loggedin',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
                          $this->load->view('viewprofile_loggedin',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
                          $this->load->view('footer');

                        }
                        else redirect($user_info['REDIRECT_PAGE']);

                    } else {


                        //else show only public profile
                      ;
                    }

                }
                catch (FacebookApiException $e) {
                    //User is not logged in or redirect('/'); // Your FB session expired
                    $this->load->view('popups_message'); // load the view
                    $this->load->view('popups_session',array('current_url' => current_url()));
                 //   redirect(current_url());
                }
            }
            else {
                $hobbies=$this->Users->get_hobbies($fb_info['USER_ID']);
                $aboutme=$this->Users->get_aboutme($fb_info['USER_ID']);
                $this->load->view('header_public',array('data' => $fb_info));
                $this->load->view('popups_public',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme, 'user_is_logged_in' => 0)); // load the view
                $this->load->view('viewprofile_public',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
                $this->load->view('footer');
            }
        }
        // else this user does not exist
        else echo "//Sorry this user does not exist";
    }

    public function suggest_form()
    {

        $this->output->enable_profiler(TRUE);

        $hobbylist=$this->input->post('hobbylist');
        $hobbydetailslist=$this->input->post('hobbydetailslist');
        $aboutmelist=$this->input->post('aboutmelist');

        if($hobbylist || $aboutmelist) {

        // GET TARGET USER
        $profile=$this->input->post('thisUser');
        $user_info=$this->Users->select_user_profile($profile);

        $user_id_receiving=$user_info['USER_ID']; // GET USER RECEIVING
        $user_name_receiving=$user_info['USER_NAME']; // GET USER RECEIVING
        $user_profilelink_receiving=$user_info['PROFILE_URL']; // GET USER RECEIVING

        // GET CURRENT USER

        $user_id_initiator = $this->facebook->getUser();
        $thisUser_info=$this->Users->select_user($user_id_initiator);

        $user_id_initiator=$thisUser_info['USER_ID']; // GET USER RECEIVING
        $user_name_initiator=$thisUser_info['USER_NAME']; // GET USER RECEIVING
        $user_profilelink_initiator=$thisUser_info['PROFILE_URL']; // GET USER RECEIVING

        $user_ip = $this->input->ip_address();

        if ($hobbylist)
        {

            for($i=0; $i<count($hobbylist); $i++)
            {

              $hobby=$hobbylist[$i];
              $hobbydetails=$hobbydetailslist[$i];
              $this->Users->insert_user_events(3,'referral-hobby',null,'0',$user_ip,$user_id_initiator,$user_name_initiator,$user_profilelink_initiator,$user_id_receiving,$user_name_receiving,$user_profilelink_receiving,$hobby,$hobbydetails,1,null);
            }
        }

        if ($aboutmelist)
        {

            for($i=0; $i<count($aboutmelist); $i++)
            {

                $aboutme=$aboutmelist[$i];
                $this->Users->insert_user_events(4,'referral-aboutme',null,'0',$user_ip,$user_id_initiator,$user_name_initiator,$user_profilelink_initiator,$user_id_receiving,$user_name_receiving,$user_profilelink_receiving,$aboutme,null,1 ,null);
            }
        }

        }

    }

    public function add_hobby_endorsement()

    {
        $hobby_id=$this->input->post('hobby_id'); // GET HOBBY
        $profile=$this->input->post('thisUser'); // GET PROFILE
        $user_info=$this->Users->select_user_profile($profile); //GET USER_ID FROM PROFILE
        $user_id_receiving=$user_info['USER_ID']; // GET USER RECEIVING
        $user_name_receiving=$user_info['USER_NAME']; // GET USER RECEIVING
        $user_profilelink_receiving=$user_info['PROFILE_URL']; // GET USER RECEIVING

        $hobby_desc=$this->Users->get_hobby_desc($hobby_id);
        $endorsement_desc=$hobby_desc['hobby']; //GET ENDORSEMENT

        $user_ip = $this->input->ip_address(); //GET IP
        $loggedin=$this->input->post('loggedin');
        if ($loggedin==1)
        {
            //USER IS LOGGED IN
            $endorsement_value=1;
            $user_id_initiator = $this->facebook->getUser();
            $user_info=$this->Users->select_user($user_id_initiator);
            $user_name_initiator=$user_info['USER_NAME'];
            $user_profilelink_initiator=$user_info['PROFILE_URL'];
            $this->Users->insert_user_events(1,'endorsement-hobby',$hobby_id,'0',$user_ip,$user_id_initiator,$user_name_initiator,$user_profilelink_initiator,$user_id_receiving,$user_name_receiving,$user_profilelink_receiving,$endorsement_desc,null,$endorsement_value,null);
            echo 'Endorsed for '.$endorsement_desc.'!';
        }
        else {
            //USER IS NOT LOGGED IN

            // CALCULATE FRIENDS IN COMMON

          $endorsement_value=0.1; // not logged in
          //INSERT EVENT
         $this->Users->insert_user_events(1,'endorsement-hobby',$hobby_id,'1', $user_ip,null,null,null,$user_id_receiving,$user_name_receiving,$user_profilelink_receiving,$endorsement_desc,null,$endorsement_value,null);
          //ECHO RESULT
         echo 'Endorsed for '.$endorsement_desc.'!';
        }
    }

    public function check_already_endorsed_hobby()

    {
        $hobby_id=$this->input->post('hobby_id'); // GET HOBBY
        $profile=$this->input->post('thisUser'); // GET PROFILE
        $user_info=$this->Users->select_user_profile($profile); //GET USER_ID FROM PROFILE
        $user_ip = $this->input->ip_address();
        $user_id_receiving=$user_info['USER_ID'];
        $loggedin=$this->input->post('loggedin');
        if ($loggedin==1)
        {
            //USER IS LOGGED IN
            $user_id_initiator = $this->facebook->getUser();
            $ok=$this->Users->check_already_endorsed_loggedin($hobby_id,$user_id_initiator,$user_id_receiving,1);
            if($ok) echo "TRUE"; else echo "FALSE";
        }
        else
        {
            //USER IS NOT LOGGED IN
            // Check if hobby is already endorsed by user
            $ok=$this->Users->check_already_endorsed_anonymous($hobby_id,$user_ip,$user_id_receiving,1);
            if($ok) echo "TRUE"; else echo "FALSE";
        }
    }

    public function add_aboutme_endorsement()

    {
        $aboutme_id=$this->input->post('aboutme_id'); // GET ABOUTME
        $profile=$this->input->post('thisUser'); // GET PROFILE
        $user_info=$this->Users->select_user_profile($profile); //GET USER_ID FROM PROFILE
        $user_id_receiving=$user_info['USER_ID']; // GET USER RECEIVING
        $user_name_receiving=$user_info['USER_NAME']; // GET USER RECEIVING
        $user_profilelink_receiving=$user_info['PROFILE_URL']; // GET USER RECEIVING

        $aboutme_desc=$this->Users->get_aboutme_desc($aboutme_id);
        $endorsement_desc=$aboutme_desc['aboutme']; //GET ENDORSEMENT

        $user_ip = $this->input->ip_address(); //GET IP
        $loggedin=$this->input->post('loggedin');
        if ($loggedin==1)
        {
            //USER IS LOGGED IN
            $endorsement_value=1;
            $user_id_initiator = $this->facebook->getUser();
            $user_info=$this->Users->select_user($user_id_initiator);
            $user_name_initiator=$user_info['USER_NAME'];
            $user_profilelink_initiator=$user_info['PROFILE_URL'];
            $this->Users->insert_user_events(2,'endorsement-aboutme',$aboutme_id,'0',$user_ip,$user_id_initiator,$user_name_initiator,$user_profilelink_initiator,$user_id_receiving,$user_name_receiving,$user_profilelink_receiving,$endorsement_desc,null,$endorsement_value,null);
            echo 'Endorsed for '.$endorsement_desc.'!';
        }
        else {
            //USER IS NOT LOGGED IN

            // CALCULATE FRIENDS IN COMMON

            $endorsement_value=0.1; // not logged in
            //INSERT EVENT
            $this->Users->insert_user_events(2,'endorsement-aboutme',$aboutme_id,'1',$user_ip,null,null,null,$user_id_receiving,$user_name_receiving,$user_profilelink_receiving,$endorsement_desc,null,$endorsement_value,null);
            //ECHO RESULT
            echo 'Endorsed for '.$endorsement_desc.'!';
        }
    }

    public function check_already_endorsed_aboutme()

    {
      //  $this->output->enable_profiler(TRUE);
        $aboutme_id=$this->input->post('aboutme_id'); // GET ABOUTME
        $profile=$this->input->post('thisUser'); // GET PROFILE
        $user_info=$this->Users->select_user_profile($profile); //GET USER_ID FROM PROFILE
        $user_ip = $this->input->ip_address();
        $user_id_receiving=$user_info['USER_ID'];
         $loggedin=$this->input->post('loggedin');
        if ($loggedin==1)
        {
            //USER IS LOGGED IN
            $user_id_initiator = $this->facebook->getUser();
            $ok=$this->Users->check_already_endorsed_loggedin($aboutme_id,$user_id_initiator,$user_id_receiving,2);
            if($ok) echo "TRUE"; else echo "FALSE";
        }
        else
        {
            //USER IS NOT LOGGED IN
            // Check if aboutme is already endorsed by user
            $ok=$this->Users->check_already_endorsed_anonymous($aboutme_id,$user_ip,$user_id_receiving,2);
            if($ok) echo "TRUE"; else echo "FALSE";
        }
    }

    public function send_message()

    {
        $profile=$this->input->post('thisUser'); // GET PROFILE
        $message_content=$this->input->post('message_content');
        $user_info=$this->Users->select_user_profile($profile); //GET USER_ID FROM PROFILE
        $user_id_receiving=$user_info['USER_ID']; // GET USER RECEIVING
        $user_name_receiving=$user_info['USER_NAME']; // GET USER RECEIVING
        $user_profilelink_receiving=$user_info['PROFILE_URL']; // GET USER RECEIVING
        $user_ip = $this->input->ip_address(); //GET IP
        $loggedin=$this->input->post('loggedin');
        $user_id_initiator = $this->facebook->getUser();
        $user_info=$this->Users->select_user($user_id_initiator);
        $user_name_initiator=$user_info['USER_NAME'];
        $user_profilelink_initiator=$user_info['PROFILE_URL'];
        $this->Users->insert_user_events(5,'message',null,'0',$user_ip,$user_id_initiator,$user_name_initiator,$user_profilelink_initiator,$user_id_receiving,$user_name_receiving,$user_profilelink_receiving,null,null,null,$message_content);
    }
}