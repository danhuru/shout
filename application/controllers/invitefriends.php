<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invitefriends extends CI_Controller {

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

        } catch(FacebookApiException $e) {echo "Error";}

    }

     public function index()
    {
       // $fromDatabase=$this->session->userdata('fb_info'); // retrieve from ci_sessions
       // $username=unserialize(base64_decode($fromDatabase)); // decode $fb_info

        $user_id = $this->facebook->getUser();
        $fb_info=$this->Users->select_user($user_id);

        $this->get_friends(); // call get_friends to retrieve facebook friends

        $this->load->view('header',array('data' => $fb_info));
        $this->load->view('invitefriends',array('data' => $fb_info)); // load the view
        $this->load->view('footer');
    }


    public function showfriends($filter)
    {

        $fromDatabase=$this->session->userdata('friends');  // retrieve from ci_sessions
        $data=unserialize(base64_decode($fromDatabase));  // decode $friends

        // Build HTML list

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