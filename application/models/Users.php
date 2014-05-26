<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

public function select_user($user_id)
    {
    $this->db->select('*');
    $this->db->from('users_facebook');
    $this->db->where('user_id', $user_id);
    $query = $this->db->get();

    if ($query->num_rows() > 0)  return $query->row_array();
    }

public function insert_user($fb_info)
    {
        $data = array(
            'USER_ID' => $fb_info[0]['uid'] ,
            'USER_NAME' => $fb_info[0]['name'] ,
            'PIC_BIG' => $fb_info[0]['pic_big'] ,
            'PIC' => $fb_info[0]['pic'] ,
            'PIC_SMALL' => $fb_info[0]['pic_small'] ,
            'BIRTHDAY_DATE' => $fb_info[0]['birthday_date'] ,
            'USER_SEX' => $fb_info[0]['sex'] ,
            'RELATIONSHIP' => $fb_info[0]['relationship_status'] ,
            'FRIEND_COUNT' => $fb_info[0]['friend_count'] ,
            'CURRENT_LOCATION' => $fb_info[0]['current_location']['name'] ,
            'CURRENT_EDUCATION' => $fb_info[0]['education'][0]['school']['name'] ,
            'CURRENT_WORK' => $fb_info[0]['work'][0]['employer']['name'] ,
            'REDIRECT_PAGE' => 'create'
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