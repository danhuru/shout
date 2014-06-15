<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {


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



                 //User is logged in
        $this->Users->update_redirect_page($user_id,'home');
        $fb_info=$this->Users->select_user($user_id);
        $hobbies=$this->Users->get_hobbies($user_id);
        $aboutme=$this->Users->get_aboutme($user_id);

        // GET USER_EVENTS

        $events=$this->Users->get_user_events($user_id);

             if ($fb_info['REDIRECT_PAGE']=='home'){

        // LOAD THE VIEWS
        $this->load->view('header',array('data' => $fb_info));
        $this->load->view('popups_loggedin',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
        $this->load->view('popups_message'); // load the view
        $this->load->view('home',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme,'events' => $events)); // load the view
        $this->load->view('footer');

             }
             else redirect($fb_info['REDIRECT_PAGE']);

        } else {
             echo "Your FB session expired";
        }

            }
         catch (FacebookApiException $e) {
    //User is not logged in


          //   $login_url = $this->facebook->getLoginUrl();
          //   echo 'Please <a href="' . $login_url . '">login.</a>';
           //  $this->load->view('home',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme,'events' => $events)); // load the view
             $this->load->view('popups_message'); // load the view
             $this->load->view('popups_session',array('current_url' => current_url()));

          //   redirect('/');
    }
}
        else {
            // No user, so print a link for the user to login
            //$login_url = $this->facebook->getLoginUrl();
            //echo 'Please <a href="' . $login_url . '">login.</a>';
         //   echo "Your FB session            redirect('/');
          //  expired";
            redirect('/');
        }


}

    public function view_message()
    {
       $event_id=$this->input->post('event_id');
       $message_info=$this->Users->view_event($event_id);

       echo '<i>Received from '.$message_info['user_name_initiator'].' at '.$message_info['event_timestamp'];
       echo '</i><br><br>';
       echo $message_info['message_content'];
       echo '<br><br>';
       echo '<div id="userid">'.$message_info['user_id_initiator'].'</div>';
       $this->Users->update_event($event_id,5);

    }

    public function confirm_endorsement()
    {

        $event_id=$this->input->post('event_id');
        $event_info=$this->Users->view_event($event_id);
        $user_id_receiving=$event_info['user_id_receiving'];
        $endorsement_value=$event_info['endorsement_value'];

        if($event_info['event_type']==1)

        {
        $hobby_id=$event_info['target_id'];
        $endorsement_initial=$this->Users->get_hobby_value($hobby_id);
        $endorsement=$endorsement_initial['endorsements'] + $endorsement_value;

      //update user_hobbies
        $this->Users->update_user_hobby($hobby_id,$user_id_receiving,$endorsement);
      //update_user_events
        $this->Users->update_event($event_id,1);

        }

        if($event_info['event_type']==2)

        {
            $aboutme_id=$event_info['target_id'];
            $endorsement_initial=$this->Users->get_aboutme_value($aboutme_id);
            $endorsement=$endorsement_initial['endorsements'] + $endorsement_value;
            //update user_hobbies
            $this->Users->update_user_aboutme($aboutme_id,$user_id_receiving,$endorsement);
            //update_user_events
            $this->Users->update_event($event_id,2);
        }

        if($event_info['event_type']==3)

        {

        $hobby=$event_info['endorsement_desc'];
        $hobbydetails=$event_info['endorsement_details'];
        $this->Users->update_event($event_id,3);
        $this->Hobbies->insert_user_new_hobby($user_id_receiving,$hobby,$hobbydetails);

        }

        if($event_info['event_type']==4)
        {


            $aboutme=$event_info['endorsement_desc'];
            $names=explode(" ",$event_info['user_name_initiator']);
            $author=$names[0];

           $this->Users->update_event($event_id,4);
            $this->Hobbies->insert_user_new_aboutme($user_id_receiving,$aboutme,$author);
        }

    }

    public function logout()
    {
        $this->facebook->destroySession();
        redirect('/');
    }
}