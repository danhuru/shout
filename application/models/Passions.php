<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Passions extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_hints($str)
    {
        $this->db->select('passions,user_id');
        $this->db->from('passions');
        $this->db->like('passions', $str);
        $query = $this->db->get();

       if ($query->num_rows() > 0)  return $query->result_array();

        else return 0;
    }

}