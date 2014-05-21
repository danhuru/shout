<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Create extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Users');
    }

    public function index()
    {
        $user_id = $this->facebook->getUser();
        $user_fb_info=$this->Users->select_user($user_id);

      // $toDatabse = base64_encode(serialize($fb_info)); // encode $fb_info
       // $this->session->set_userdata('fb_info', $toDatabse); // save to ci_sessions

        $this->load->view('create',array('data' => $user_fb_info));

    }
    public function get_hints($str)
    {
        //if (strlen($str)>1) // Hint string has at least 2 chars
        //{
        $hint=$this->Passions->get_hints($str);
        if($hint)
        {

       foreach($hint as $row)
         {
             echo $row['passions'];

                 //'<text id="added" onclick="addPassion(this.value)">'.$row['passions'].'</text> ';

            // echo $row['passions'];
          }
        }
      }

    public function search($term) {
        //connect to your database

        //$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

        $hint=$this->Passions->get_hints($term);
       // if($hint)
//        {

  //          foreach($hint as $row)
    //        {
      //          echo $row['passions'];

       //     }
       // }

        echo json_encode($hint);//format the array into json data

   /*     while ($row = mysql_fetch_array($result,MYSQL_ASSOC))//loop through the retrieved values
        {
            $row['value']=htmlentities(stripslashes($row['value']));
            $row['id']=(int)$row['id'];
            $row_set[] = $row;//build an array
        }
        echo json_encode($row_set);//format the array into json data
    }
*/

}

    public function commit_form()

    {
        // if all ok than redirect to
        // insert new step into db

        echo site_url('invite');
        redirect(site_url('invite')); // or published_profile

    }


}

