<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invite extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users');
    }

    private function get_friends()
    {
        $user_id = $this->facebook->getUser();

        // FQL select

        try {
            $fql = 'select pic_square, name,uid from user where uid in ( select uid2 from friend where uid1='.$user_id.') order by name ';
            $friends_info=$this->facebook->api(array(
                'method' => 'fql.query',
                'query' => $fql,
            ));

            $toDatabse = base64_encode(serialize($friends_info)); // encode $friends_info
            $this->session->set_userdata('friends', $toDatabse); // save to ci_sessions

        } catch(FacebookApiException $e) {

            // Your FB session expired

        }

    }
    public function index()
    {
        $user_id = $this->facebook->getUser();
        if($user_id)
        {
        try
        {
            $test = $this->facebook->api('/me?fields=id');
            if ($test)
            {



        $fb_info=$this->Users->select_user($user_id);

                if ($fb_info['REDIRECT_PAGE']=='invite'){


        $this->Users->update_redirect_page($user_id,'invite');
        $this->get_friends(); // call get_friends to retrieve facebook friends
        $this->load->view('invite',array('data' => $fb_info)); // load the view

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
    public function showfriends()
    {

        $fromDatabase=$this->session->userdata('friends');  // retrieve from ci_sessions
        $data=unserialize(base64_decode($fromDatabase));  // decode $friends

        // Build HTML list

        $filter=$this->input->get('str');

             for ($id=0; $id<count($data); $id++)
        {
            if ($filter!="show_me_all") {
                if (stripos($data[$id]['name'],$filter) !== FALSE)
                {
                    echo "<div id='divfriends'>".'<img id="pic" src="'.$data[$id]['pic_square'].'"><text id="textname">'.$data[$id]['name'].'</text><button class ="invitebutton" id="friend_'.$data[$id]['uid'].'" onclick="invite('.$data[$id]['uid'].',\''.'\')">Invite</button>'."</div>";
                }
            }
            else
            {
                echo "<div id='divfriends'>".'<img id="pic" src="'.$data[$id]['pic_square'].'"><text id="textname">'.$data[$id]['name'].'</text><button class ="invitebutton" id="friend_'.$data[$id]['uid'].'" onclick="invite('.$data[$id]['uid'].',\''.'\')">Invite</button>'."</div>";
            }
        }

    }

}