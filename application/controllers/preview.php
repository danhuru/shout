<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preview extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users');
    }

    public function index()
    {
        $user_id='1570612986';

        $fromDatabase=$this->session->userdata('fb_info'); // retrieve from ci_sessions
        $fb_info=unserialize(base64_decode($fromDatabase)); // decode $fb_info

        //Get last education

        $i=0;
        foreach ($fb_info[0]['education'] as $school)
        $schools[$i++]= $school['school']['name'];

        $hobbies=$this->Users->get_hobbies($user_id);
        $aboutme=$this->Users->get_aboutme($user_id);
        $bckpic=$this->Users->get_bckpic($user_id);

        $this->load->view('preview',array('data' => $fb_info, 'hobbies' => $hobbies,'aboutme' => $aboutme,'bckpic' => $bckpic, 'schools' => $schools)); // load the view
    }

    public function template($user)
    {

        // if user exists then

        if ($user == 'danhuru')
        {
        echo $user.' profile';
        }
        // else this user does not exist

        // if user is owner then

        // load corresponding view

        else
        {
        echo "Sorry this profile does not exist";
        }

    }

}