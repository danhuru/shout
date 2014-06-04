<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Endorse extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function select_endorsement($user_id,$hobby)
    {
        //add endorsement


        $this->db->select('endorsements');
        $this->db->from('user_hobbies');
        $this->db->where('user_id', $user_id);
        $this->db->where('hobby', $hobby);
        $query = $this->db->get();

        if ($query->num_rows() > 0)  return $query->result_array();

    }

    public function endorse_hobby($user_id,$hobby,$value)
    {

        //add endorsement

        $data = array(
            'endorsements' => $value
        );
        $this->db->where('user_id', $user_id);
        $this->db->where('hobby', $hobby);
        $this->db->update('user_hobbies', $data);
    }

}