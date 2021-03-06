<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users');
        $this->load->model('Hobbies');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('security');
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


                $user_fb_info=$this->Users->select_user($user_id);

                    if ($user_fb_info['REDIRECT_PAGE']=='home'){

                $this->load->view('header',array('data' => $user_fb_info));
                $this->load->view('add',array('data' => $user_fb_info, 'error'=>' '));
                $this->load->view('footer');

                    }
                    else redirect($user_fb_info['REDIRECT_PAGE']);
                }
                else {
                    // No user, so print a link for the user to login
                    //$login_url = $this->facebook->getLoginUrl();
                    //echo 'Please <a href="' . $login_url . '">login.</a>';

                    echo "Your FB session expired";
                }
            }   catch (FacebookApiException $e) {
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

        $user_id = $this->facebook->getUser();
        // Fetch variables and run XSS filtering
        $hobbylist=$this->input->post('hobbylist',TRUE);
        $hobbydetailslist=$this->input->post('hobbydetailslist',TRUE);
        $aboutmelist=$this->input->post('aboutmelist',TRUE);
        if($hobbylist) $this->Users->insert_user_hobbies($user_id,$hobbylist,$hobbydetailslist); //insert hobbies
        if($aboutmelist) $this->Users->insert_user_aboutme($user_id,$aboutmelist); //insert aboutme
    }

    public function update_bckpic($value)

    {
        $user_id = $this->facebook->getUser();
        $this->Users->update_bck_pic($user_id,$value);
    }

}

