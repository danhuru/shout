<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

public function select_user($user_id)
    {
    $this->db->select('user_id,username,redirect');
    $this->db->from('users_facebook');
    $this->db->where('user_id', $user_id);
    $query = $this->db->get();

    if ($query->num_rows() > 0)  return $query->row_array();

    else return 0;
    }

public function insert_user($user_id,$user,$redirect)
    {
        $data = array(
            'user_id' => $user_id ,
            'username' => $user,
            'redirect' => $redirect ,
        );

        $this->db->insert('users_facebook', $data);

// Produces: INSERT INTO users_facebook (user, redirect) VALUES ($user,$redirect)

     }

 public function get_hobbies($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_hobbies');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0)  return $query->result_array();
    }



public function get_aboutme($user_id)
    {
        $this->db->select('user_id,aboutme,endorsements,author');
        $this->db->from('user_aboutme');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0)  return $query->result_array();
}
public function get_bckpic($user_id)
{
        $this->db->select('user_id,bckpic');
        $this->db->from('user_bckpic');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0)  return $query->row_array();
}

    public function get_user_events($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_events');
        $this->db->where('user_id_receiving', $user_id);
        $this->db->order_by('event_timestamp', "desc");
        $query = $this->db->get();

        if ($query->num_rows() > 0)  return $query->result_array();
    }


}