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

        $fb_info=$this->Users->select_user($user_id);
        $hobbies=$this->Users->get_hobbies($user_id);
        $aboutme=$this->Users->get_aboutme($user_id);

        // GET USER_EVENTS

        $events=$this->Users->get_user_events($user_id);

             if ($fb_info['REDIRECT_PAGE']=='home'){

        // LOAD THE VIEWS
        $this->Users->update_redirect_page($user_id,'home');
        $this->load->view('header',array('data' => $fb_info));
        $this->load->view('popups',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme)); // load the view
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

    public function show_events()
    {

        //$value=$this->input->get('value');

        $value=$this->input->get('value');

        $user_id = $this->facebook->getUser();
        $events=$this->Users->get_user_events($user_id);

        if($value==1) // show messages only

        {
        $i=0;
        if ($events){

               foreach ($events as $event)
                {
                    if($event['event_type']==5)
                    {
                    $i++;
                    echo '<div id="event">';

                    if ($i%2==1)

                    {
                        $user_info=$this->Users->select_user($event['user_id_initiator']);
                        echo '<div id="user_pic">';
                        echo '<img id="user_profile_pic" src="'.$user_info['PIC_BIG'].'"</img>';
                        echo '</div>';
                        echo '<div id="triangle1"></div>';
                        echo '<div id="event_desc1">';
                        echo '<div id="userid">'.$event['event_id'].'</div>';

                                echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b>  sent you a message</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['message_status']==1) echo '<div id="status" class="status">Viewed</div>'; else echo '<div id="status" class="status">View message</div>';


                    }

                    else
                    {
                        echo '<div id="event_desc2">';
                        $user_info=$this->Users->select_user($event['user_id_initiator']);
                             echo '<div id="userid">'.$event['event_id'].'</div>';

                        echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b>  sent you a message</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['message_status']==1) echo '<div id="status" class="status">Viewed</div>'; else echo '<div id="status" class="status">View message</div>';
                        echo '</div>';
                        echo '<div id="triangle2"></div>';
                        echo '<div id="user_pic">';
                        echo '<img id="user_profile_pic" src="'.$user_info['PIC_BIG'].'"</img>';

                    }

                    echo '</div>';
                    echo '</div>';
                    }
                }
            }
        }

        if ($value==2) // show endorsements only
        {
        $i=0;
        if ($events){
            foreach ($events as $event)
            {
                if($event['event_type']!=5)
                {
                $i++;
                echo '<div id="event">';


                if ($i%2==1)

                {

                    echo '<div id="user_pic">';
                    $user_info=$this->Users->select_user($event['user_id_initiator']);
                    echo '<img id="user_profile_pic" src="'.$user_info['PIC_BIG'].'"</img>';
                    echo '</div>';
                    echo '<div id="triangle1"></div>';
                    echo '<div id="event_desc1">';
                    echo '<div id="userid">'.$event['event_id'].'</div>';
                    switch ($event['event_type']) {
                        case 1:
                            if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b> endorsed you for a hobby</div>';
                            else  echo '<div id="event_detail"><b id="username">Someone (anonymous)</b> endorsed you for a hobby</div>';
                            echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                            echo '<br>';
                            echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                            echo '<hr>';
                            if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                            break;
                        case 2:
                            if($event['user_name_initiator'])  echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b> subscribed to a referral about you</div>';
                            else echo '<div id="event_detail"><b id="username">Someone (anonymous)</b> subscribed to a referral about you</div>';
                            echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                            echo '<br>';
                            echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                            echo '<hr>';
                            if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                            break;
                        case 3:
                            if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b> said you one of you hobbies is</div>';
                            else '<div id="event_detail"><b id="username">Someone (anonymous)</b> said you one of you hobbies is</div>';
                            echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                            echo '<br>';
                            echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                            echo '<hr>';
                            if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                            break;
                        case 4:
                            if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b>  said about you</div>';
                            else echo '<div id="event_detail"><b id="username">Someone (anonymous)</b>  said about you</div>';
                            echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                            echo '<br>';
                            echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                            echo '<hr>';
                            if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                            break;
                        default:

                    }

                }

                else
                {
                    echo '<div id="event_desc2">';
                    $user_info=$this->Users->select_user($event['user_id_initiator']);
                    echo '<div id="userid">'.$event['event_id'].'</div>';
                    switch ($event['event_type']) {
                        case 1:
                            if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b> endorsed you for a hobby</div>';
                            else  echo '<div id="event_detail"><b id="username">Someone (anonymous)</b> endorsed you for a hobby</div>';
                            echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                            echo '<br>';
                            echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                            echo '<hr>';
                            if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                            break;
                        case 2:
                            if($event['user_name_initiator'])  echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b> subscribed to a referral about you</div>';
                            else echo '<div id="event_detail"><b id="username">Someone (anonymous)</b> subscribed to a referral about you</div>';
                            echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                            echo '<br>';
                            echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                            echo '<hr>';
                            if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                            break;
                        case 3:
                            if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b> said you one of you hobbies is</div>';
                            else '<div id="event_detail"><b id="username">Someone (anonymous)</b> said you one of you hobbies is</div>';
                            echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                            echo '<br>';
                            echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                            echo '<hr>';
                            if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                            break;
                        case 4:
                            if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b>  said about you</div>';
                            else echo '<div id="event_detail"><b id="username">Someone (anonymous)</b>  said about you</div>';
                            echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                            echo '<br>';
                            echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                            echo '<hr>';
                            if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                            break;
                        default:
                    }


                    echo '</div>';
                    echo '<div id="triangle2"></div>';
                    echo '<div id="user_pic">';
                    echo '<img id="user_profile_pic" src="'.$user_info['PIC_BIG'].'"</img>';
                }

                echo '</div>';
                echo '</div>';
                }
            }
            }
        }
        if ($value==3) // show both

        {
        $i=0;
        if ($events){
                foreach ($events as $event)
                {

                    $i++;
                    echo '<div id="event">';

                    if ($i%2==1)

                    {

                        echo '<div id="user_pic">';
                        $user_info=$this->Users->select_user($event['user_id_initiator']);
                        echo '<img id="user_profile_pic" src="'.$user_info['PIC_BIG'].'"</img>';
                        echo '</div>';
                        echo '<div id="triangle1"></div>';
                        echo '<div id="event_desc1">';
                        echo '<div id="userid">'.$event['event_id'].'</div>';
                        switch ($event['event_type']) {
                            case 1:

                                if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b> endorsed you for a hobby</div>';
                                else  echo '<div id="event_detail"><b id="username">Someone (anonymous)</b> endorsed you for a hobby</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 2:
                                if($event['user_name_initiator'])  echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b> subscribed to a referral about you</div>';
                                else echo '<div id="event_detail"><b id="username">Someone (anonymous)</b> subscribed to a referral about you</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 3:
                                if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b> said you one of you hobbies is</div>';
                                else '<div id="event_detail"><b id="username">Someone (anonymous)</b> said you one of you hobbies is</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 4:
                                if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b>  said about you</div>';
                                else echo '<div id="event_detail"><b id="username">Someone (anonymous)</b>  said about you</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 5:
                                echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b>  sent you a message</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['message_status']==1) echo '<div id="status" class="status">Viewed</div>'; else echo '<div id="status" class="status">View message</div>';
                                break;
                            default:

                        }

                    }

                    else
                    {
                        echo '<div id="event_desc2">';
                        $user_info=$this->Users->select_user($event['user_id_initiator']);
                        echo '<div id="userid">'.$event['event_id'].'</div>';
                        switch ($event['event_type']) {
                            case 1:
                                if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b> endorsed you for a hobby</div>';
                                else  echo '<div id="event_detail"><b id="username">Someone (anonymous)</b> endorsed you for a hobby</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 2:
                                if($event['user_name_initiator'])  echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b> subscribed to a referral about you</div>';
                                else echo '<div id="event_detail"><b id="username">Someone (anonymous)</b> subscribed to a referral about you</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 3:
                                if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b> said you one of you hobbies is</div>';
                                else '<div id="event_detail"><b id="username">Someone (anonymous)</b> said you one of you hobbies is</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 4:
                                if($event['user_name_initiator']) echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b>  said about you</div>';
                                else echo '<div id="event_detail"><b id="username">Someone (anonymous)</b>  said about you</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['endorsement_status']==1) echo '<div id="status" class="status">Confirmed</div>'; else echo '<div id="status" class="status">Confirm</div>';
                                break;
                            case 5:
                                echo '<div id="event_detail"><b id="username" onclick="window.location.assign(\'profile/'.$user_info['PROFILE_URL'].'\')">'.$event['user_name_initiator'].'</b>  sent you a message</div>';
                                echo '<div id="date">'.substr($event['event_timestamp'],0,-3).'</div>';
                                echo '<br>';
                                echo '<div id="event_message">'.ucfirst($event['endorsement_desc']).'</div>';
                                echo '<hr>';
                                if ($event['message_status']==1) echo '<div id="status" class="status">Viewed</div>'; else echo '<div id="status" class="status">View message</div>';
                                break;
                            default:

                        }

                        echo '</div>';
                        echo '<div id="triangle2"></div>';
                        echo '<div id="user_pic">';
                        echo '<img id="user_profile_pic" src="'.$user_info['PIC_BIG'].'"</img>';

                    }

                    echo '</div>';
                    echo '</div>';

                }
            }
        }

    }
}