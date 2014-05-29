<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users');
        $this->load->model('Hobbies');
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        $user_id = $this->facebook->getUser();
        $user_fb_info=$this->Users->select_user($user_id);

      // $toDatabse = base64_encode(serialize($fb_info)); // encode $fb_info
       // $this->session->set_userdata('fb_info', $toDatabse); // save to ci_sessions

        $this->load->view('create',array('data' => $user_fb_info, 'error'=>' '));
      //  $this->load->view('upload_form', array('error' => ' ' ));

    }
    public function get_hints($term)
    {
        //if (strlen($str)>1) // Hint string has at least 2 chars
        //{
        $hints=$this->Hobbies->get_hobbies_hints($term);
        if($hints)
        {

       foreach($hints as $hint)
         {
             echo '<text id="option">'.$hint['hobby_desc'].'</text><br>';
          }
        }
      }

    public function do_upload()
    {
       $user_id = $this->facebook->getUser();

       $config['upload_path'] = './images/upload/';
       $config['allowed_types'] = 'jpg';
       $config['overwrite']='TRUE';
       $config['max_size']	= '2048';
       $config['file_name'] = 'bckpic_'.$user_id.'.jpg';
     //   $config['max_width']  = '1024';
     //   $config['max_height']  = '768';

        $this->load->library('upload', $config);


        if ( ! $this->upload->do_upload('userpic'))
        {
            $error =$this->upload->display_errors('','');
           // $this->upload->display_errors('<text>', '</text>');
            echo 'Error: '.$error;
        }
        else
        {
            $data =$this->upload->data();
            //var_dump( $data);
            echo $data['orig_name'];
        }
    }

    public function process_form()
    {

        var_dump($_FILES);

        var_dump($_POST);

        echo "Form processed";

    }

}

