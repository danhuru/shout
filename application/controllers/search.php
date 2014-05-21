<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Passions');

    }

    public function index()
    {

       $this->load->view('search');

    }

    public function facebook_search()
    {
/* make the API call */

     $access_token =  $this->facebook->getAccessToken();
        $this->facebook->setAccessToken($access_token);

        $user_id = $this->facebook->getUser();

$response = $this->facebook->api("1570612986/home");

$fb_json=json_encode($response);

echo $fb_json;
/* handle the result */
    }

    public function passions_search($str)
    {

        $result=$this->Passions->get_hints($str);

       // print_r($result);
        echo json_encode($result);

    /*  if ($result) {

       foreach ($result as $row)

        {
            echo $row['user_id'].' '.$row['passions'].'<Br>';
        }
    }*/
    }


}