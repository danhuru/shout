<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hobbies extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function delete_hobby($user_id,$hobby)
    {
        //delete from user_hobbies where user_id=$1 and hobby=$2
        $this->db->where('user_id', $user_id);
        $this->db->where('hobby', $hobby);
        $this->db->delete('user_hobbies');
    }

}