<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->Model('Users');
        $this->load->Model('Hobbies');
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

                    if ($fb_info['REDIRECT_PAGE']=='home'){

        $this->load->view('header',array('data' => $fb_info));
        $this->load->view('popups_message');
        $this->load->view('search');
        $this->load->view('footer');

                    }
                    else redirect($fb_info['REDIRECT_PAGE']);

                } else {
                    echo "Your FB session expired";
                    //redirect('/'); // Your FB session expired
                }

            }
            catch (FacebookApiException $e) {
                //User is not logged in


                //   $login_url = $this->facebook->getLoginUrl();
                //   echo 'Please <a href="' . $login_url . '">login.</a>';
                $this->load->view('popups_message'); // load the view
                $this->load->view('popups_session',array('current_url' => current_url()));
            }
        }
        else {
            // No user, so print a link for the user to login
            //$login_url = $this->facebook->getLoginUrl();
            //echo 'Please <a href="' . $login_url . '">login.</a>';

            redirect('/');
        }
    }

    public function searchResult()

    {

        $filter=$this->input->get('str');

        $user_id = $this->facebook->getUser();

        if ($filter=='show_me_all')
        $data=$this->Hobbies->search_hobbies_default($user_id);
        else
        $data=$this->Hobbies->search_hobbies($filter,$user_id);

        if($data)
        {

       foreach($data as $row)
       {

         echo '<div id="user">';
         echo '<div id="profile_info_left">';
         echo '<div id="pic"><img src="'.$row['PIC'].'"></img></div>';
         echo '<div id="username">'.$row['USER_NAME'].'</div>';
         echo '<div id="userid">'.$row['USER_ID'].'</div>';
         echo '</div>';
         echo '<div id="profile_info">';

         if ($row['CURRENT_LOCATION']) echo '<div id="cur_location">'.$row['CURRENT_LOCATION'].'</div>';

           echo '<br><br><div id="hobby">'.ucfirst($row['hobby']).'</div>';
           echo '<div id="endorse_nr1">';

           for ($i=1;$i<=$row['endorsements'];$i++)

           {
               echo '<img src='.base_url('images/endorse_nr.png').' width="22px" >';
           }
           echo '</div>';
           echo '<div id="show_nr_endorsement">';
           echo $row['endorsements'];
           echo '</div>';

           echo '<br>';
           echo '<div id="interact" class="interaction">';
           echo '<a href="'.'profile/'.$row['PROFILE_URL'].'">';
           echo '<div id="viewprofile" class="pressviewprofile">';
           echo '<div id="pic_interact"> <img width="24px" height="24px" src="'.base_url('images/profile.png').'"></img></div>';
           echo '<div id="visitprofile">';
           echo 'Profile';
           echo '</div>';
           echo '</div>';
           echo '</a>';

           echo '<div id="message" class="pressmessage">';
           echo '<div id="pic_interact"> <img width="24px" height="24px" src="'.base_url('images/message.png').'"></img></div>';
           echo '<div id="sendmessage">';
           echo 'Message';
           echo '</div>';
           echo '</div>';

           echo '</div>';

         echo '</div>';
         echo '</div>';

       }
        }

    }

    public function send_message()

    {
        $user_id=$this->input->post('thisUser'); // GET PROFILE
        $message_content=$this->input->post('message_content');
        $user_info=$this->Users->select_user($user_id); //GET USER_ID FROM PROFILE
        $user_id_receiving=$user_info['USER_ID']; // GET USER RECEIVING
        $user_name_receiving=$user_info['USER_NAME']; // GET USER RECEIVING
        $user_profilelink_receiving=$user_info['PROFILE_URL']; // GET USER RECEIVING
        $user_ip = $this->input->ip_address(); //GET IP
        $user_id_initiator = $this->facebook->getUser();
        $user_info=$this->Users->select_user($user_id_initiator);
        $user_name_initiator=$user_info['USER_NAME'];
        $user_profilelink_initiator=$user_info['PROFILE_URL'];
        $this->Users->insert_user_events(5,'message',null,'0',$user_ip,$user_id_initiator,$user_name_initiator,$user_profilelink_initiator,$user_id_receiving,$user_name_receiving,$user_profilelink_receiving,null,null,$message_content);
    }

}