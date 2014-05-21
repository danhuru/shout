<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $fromDatabase=$this->session->userdata('fb_info'); // retrieve from ci_sessions
        $fb_info=unserialize(base64_decode($fromDatabase)); // decode $fb_info

        $this->load->view('header',array('data' => $fb_info));
        $this->load->view('search');
        $this->load->view('footer');
    }

    public function searchResult($filter)

    {



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