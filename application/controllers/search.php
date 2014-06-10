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

        $this->load->view('header',array('data' => $fb_info));
        $this->load->view('search');
        $this->load->view('footer');

                } else {
                    echo "Your FB session expired";
                    //redirect('/'); // Your FB session expired
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

    public function searchResult($filter)

    {
        $user_id = $this->facebook->getUser();

        if ($filter=='show_me_all') $data=$this->Hobbies->search_hobbies_default($user_id);
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
           echo '<div id="interact">';

           echo '<div id="viewprofile">';
           echo '<div id="pic_interact"> <img width="24px" height="24px" src="'.base_url('images/profile.png').'"></img></div>';
           echo '<div id="text">';
          // echo $row['PROFILE_URL'];
           echo 'Profile';
           echo '</div>';
           echo '</div>';

           echo '<div id="message">';
           echo '<div id="pic_interact"> <img width="24px" height="24px" src="'.base_url('images/message.png').'"></img></div>';
           echo '<div id="text">';
           echo 'Message';
           echo '</div>';
           echo '</div>';

           echo '</div>';

         echo '</div>';
         echo '</div>';

       }
        }

    }

}