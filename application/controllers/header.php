<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Header extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users');
    }


    public function refresh_header()

    {

       $user_id = $this->facebook->getUser();
       $unread_messages=$this->Users->check_unread_messages($user_id);
       $unconfirmed_endorsements=$this->Users->check_unconfirmed_endorsements($user_id);

       if ($unread_messages) echo count($unread_messages);

        echo ',';

       if ($unconfirmed_endorsements)   echo count($unconfirmed_endorsements);

    }


}