<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spread extends CI_Controller {


    public function __construct()
    {
        parent::__construct();

    }

    public function yahoo()
    {
       // $this->load->library('curl');
/*
        $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
        $yql_query = "select * from upcoming.events where location='San Francisco' and search_text='dance'";
        $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
        $yql_query_url .= "&format=json";

        $session = curl_init($yql_query_url);
        curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
        $json = curl_exec($session);
        $phpObj =  json_decode($json);

        if(!is_null($phpObj->query->results)){

            echo "Test Yahoo";
        } */

        $this->load->view('spread/yahoo');
    }

    public function gmail(){}

    public function aol () {}

    public function hotmail () {}
}
