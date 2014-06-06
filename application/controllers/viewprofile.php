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
                        else echo "Different user";

             //if user is logged in then show more

                        //   $hobbies=$this->Users->get_hobbies($fb_info['USER_ID']);
                        //    $aboutme=$this->Users->get_aboutme($fb_info['USER_ID']);


                        //  $this->load->view('header',array('data' => $fb_info));
                        //  $this->load->view('popups',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
                        //  $this->load->view('viewprofile',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
                        //  $this->load->view('footer');


                    } else {


                        //else show only public profile
                        redirect('/'); // Your FB session expired
                    }

                }
                catch (FacebookApiException $e) {
                    //User is not logged in or redirect('/'); // Your FB session expired

                    $hobbies=$this->Users->get_hobbies($fb_info['USER_ID']);
                    $aboutme=$this->Users->get_aboutme($fb_info['USER_ID']);

                    $this->load->view('header',array('data' => $fb_info));
                    $this->load->view('popups',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme, 'user_is_logged_in' => 0)); // load the view
                    $this->load->view('viewprofile_public',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
                    $this->load->view('footer');

                }
            }
            else {

                $hobbies=$this->Users->get_hobbies($fb_info['USER_ID']);
                $aboutme=$this->Users->get_aboutme($fb_info['USER_ID']);

                $this->load->view('header',array('data' => $fb_info));
                $this->load->view('popups',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme, 'user_is_logged_in' => 0)); // load the view
                $this->load->view('viewprofile_public',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
                $this->load->view('footer');

            }






        }
        // else this user does not exist

        // if user is owner then

        // load corresponding view

        else
        {
            echo "Sorry this user does not exist";
        }

    }

    public function add_hobby_endorsement()

    {
    //USER IS NOT LOGGED IN
    $hobby=$this->input->post('hobby'); // GET HOBBY
    $profile=$this->input->post('thisUser'); // GET PROFILE
    $user_info=$this->Users->select_user_profile($profile); //GET USER_ID FROM PROFILE
    $user_ip = $this->input->ip_address(); //GET IP
    $user_id_receiving=$user_info['USER_ID']; // GET USER RECEIVING
    $user_name_receiving=$user_info['USER_NAME']; // GET USER RECEIVING
    $user_profilelink_receiving=$user_info['PROFILE_URL']; // GET USER RECEIVING
    $endorsement_desc=$hobby; //GET ENDORSEMENT
    $endorsement_value=0.1; // not logged in

    //INSERT EVENT
    $this->Users->insert_user_events(1,'endorsement-hobby','1',$user_ip,null,null,null,$user_id_receiving,$user_name_receiving,$user_profilelink_receiving,$endorsement_desc,$endorsement_value,null);
    //ECHO RESULT
    echo 'Endorsed for '.$hobby.'!';
    }

    public function check_already_endorsed_hobby()

    {
        //user is not logged in
        $hobby=$this->input->post('hobby'); // GET HOBBY
        $profile=$this->input->post('thisUser'); // GET PROFILE
        $user_info=$this->Users->select_user_profile($profile); //GET USER_ID FROM PROFILE
        $user_ip = $this->input->ip_address();
        $user_id_receiving=$user_info['USER_ID'];
        $user_name_receiving=$user_info['USER_NAME'];
        $user_profilelink_receiving=$user_info['PROFILE_URL'];
        $endorsement_desc=$hobby;
        $endorsement_value=0.1; // not logged in
        // Check if hobby is already endorsed by user
        $ok=$this->Users->check_already_endorsed_anonymous($endorsement_desc,$user_ip,$user_id_receiving,1);
        if($ok) echo "TRUE"; else echo "FALSE";
    }

    public function add_aboutme_endorsement()

    {
        //USER IS NOT LOGGED IN
        $aboutme=$this->input->post('aboutme'); // GET HOBBY
        $profile=$this->input->post('thisUser'); // GET PROFILE
        $user_info=$this->Users->select_user_profile($profile); //GET USER_ID FROM PROFILE
        $user_ip = $this->input->ip_address(); //GET IP
        $user_id_receiving=$user_info['USER_ID']; // GET USER RECEIVING
        $user_name_receiving=$user_info['USER_NAME']; // GET USER RECEIVING
        $user_profilelink_receiving=$user_info['PROFILE_URL']; // GET USER RECEIVING
        $endorsement_desc=$aboutme; //GET ENDORSEMENT
        $endorsement_value=0.1; // not logged in

        //INSERT EVENT
        $this->Users->insert_user_events(2,'endorsement-aboutme','1',$user_ip,null,null,null,$user_id_receiving,$user_name_receiving,$user_profilelink_receiving,$endorsement_desc,$endorsement_value,null);
        //ECHO RESULT
        echo 'Endorsed for '.$aboutme.'!';
    }

    public function check_already_endorsed_aboutme()

    {
        //user is not logged in
        $aboutme=$this->input->post('aboutme'); // GET ABOUTME
        $profile=$this->input->post('thisUser'); // GET PROFILE
        $user_info=$this->Users->select_user_profile($profile); //GET USER_ID FROM PROFILE
        $user_ip = $this->input->ip_address();
        $user_id_receiving=$user_info['USER_ID'];
        $user_name_receiving=$user_info['USER_NAME'];
        $user_profilelink_receiving=$user_info['PROFILE_URL'];
        $endorsement_desc=$aboutme;
        $endorsement_value=0.1; // not logged in
        // Check if hobby is already endorsed by user
        $ok=$this->Users->check_already_endorsed_anonymous($endorsement_desc,$user_ip,$user_id_receiving,1);
        if($ok) echo "TRUE"; else echo "FALSE";
    }


}