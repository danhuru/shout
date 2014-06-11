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

public function select_user_profile($profile)
    {
        $this->db->select('*');
        $this->db->from('users_facebook');
        $this->db->where('PROFILE_URL', $profile);
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
            'REDIRECT_PAGE' => 'create',
            'PROFILE_URL' => $fb_info['profile_url'],
            'EMAIL' => $fb_info[0]['email']
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

public function get_hobby_value($hobby)
    {
        $this->db->select('endorsements');
        $this->db->from('user_hobbies');
        $this->db->where('hobby', $hobby);
        $query = $this->db->get();

        if ($query->num_rows() > 0)  return $query->row_array();
    }

public function get_aboutme_value($aboutme)
    {
        $this->db->select('endorsements');
        $this->db->from('user_aboutme');
        $this->db->where('aboutme', $aboutme);
        $query = $this->db->get();

        if ($query->num_rows() > 0)  return $query->row_array();
    }

public function insert_user_hobbies($user_id,$hobbylist,$hobbydetailslist)
    {


        for ($i=0; $i<count($hobbylist); $i++)

        {
            $data = array(
                'USER_ID' => $user_id,
                'HOBBY' => ucfirst($hobbylist[$i]) ,
                'DETAILS' => $hobbydetailslist[$i],
                'ENDORSEMENTS' => '0'
            );

            $this->db->insert('user_hobbies', $data);

        }



    }

public function update_redirect_page($user_id,$value)
{
$data = array(
'REDIRECT_PAGE' => $value,
);

$this->db->where('USER_ID', $user_id);
$this->db->update('users_facebook', $data);
}

public function get_aboutme($user_id)
    {
        $this->db->select('user_id,aboutme,endorsements,author');
        $this->db->from('user_aboutme');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0)  return $query->result_array();
}

public function insert_user_aboutme($user_id,$aboutmelist)
    {


        for ($i=0; $i<count($aboutmelist); $i++)

        {
            $data = array(
                'USER_ID' => $user_id,
                'ABOUTME' => ucfirst($aboutmelist[$i]),
                'AUTHOR' => 'you',
                'ENDORSEMENTS' => '0'
            );

            $this->db->insert('user_aboutme', $data);

        }



    }

public function get_bckpic($user_id)
{
        $this->db->select('user_id,bckpic');
        $this->db->from('user_bckpic');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0)  return $query->row_array();
}

public function update_bck_pic($user_id,$bckpic)
{
    $data = array(
        'BCK_PIC' => $bckpic,
    );

    $this->db->where('USER_ID', $user_id);
    $this->db->update('users_facebook', $data);

}

public function get_user_events($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_events');
        $this->db->where('user_id_receiving', $user_id);
        $this->db->order_by('message_status', "desc");
        $this->db->order_by('event_timestamp', "desc");
        $query = $this->db->get();

        if ($query->num_rows() > 0)  return $query->result_array();
    }

public function view_event($event_id)
{
    $this->db->select('*');
    $this->db->from('user_events');
    $this->db->where('event_id', $event_id);
    $query = $this->db->get();

    if ($query->num_rows() > 0)  return $query->row_array();
}

public function update_event($event_id,$event_type)
{
    if ($event_type==5)

    $data = array(
        'message_status' => 1,
    );

    else
        $data = array(
        'endorsement_status' => 1,
    );

    $this->db->where('event_id', $event_id);
    $this->db->update('user_events', $data);

}

public function update_user_hobby($hobby,$user_id_receiving,$endorsement_value)
    {
         $data = array(
               'endorsements' => $endorsement_value
            );

        $this->db->where('hobby', $hobby);
        $this->db->where('user_id', $user_id_receiving);
        $this->db->update('user_hobbies', $data);

    }

public function update_user_aboutme($aboutme,$user_id_receiving,$endorsement_value)
    {
        $data = array(
            'endorsements' => $endorsement_value
        );

        $this->db->where('aboutme', $aboutme);
        $this->db->where('user_id', $user_id_receiving);
        $this->db->update('user_aboutme', $data);
    }

public function check_already_endorsed_loggedin($endorsement_desc, $user_id_initiator,$user_id_receiving,$event_type)

{
    $this->db->select('*');
    $this->db->from('user_events');
    $this->db->where('user_id_initiator', $user_id_initiator);
    $this->db->where('user_id_receiving', $user_id_receiving);
    $this->db->where('endorsement_desc', $endorsement_desc);
    $this->db->where('event_type', $event_type);
    $query = $this->db->get();
    if ($query->num_rows() > 0)   return $query->result_array();

}

public function check_already_endorsed_anonymous($endorsement_desc, $user_ip,$user_id_receiving,$event_type)

    {
        $this->db->select('*');
        $this->db->from('user_events');
        $this->db->where('user_ip', $user_ip);
        $this->db->where('user_id_receiving', $user_id_receiving);
        $this->db->where('endorsement_desc', $endorsement_desc);
        $this->db->where('event_type', $event_type);
        $query = $this->db->get();

        if ($query->num_rows() > 0)   return $query->result_array();

    }

public function insert_user_events
(
    $event_type,
    $event_type_desc,
    $user_anonymous,
    $user_ip,
    $user_id_initiator,
    $user_name_initiator,
    $user_profilelink_initiator,
    $user_id_receiving,
    $user_name_receiving,
    $user_profilelink_receiving,
    $endorsement_desc,
    $endorsement_value,
    $message_content
)
    {
            $data = array(
                'EVENT_TYPE' => $event_type,
                'EVENT_TYPE_DESC' => $event_type_desc ,
                'USER_ANONYMOUS' => $user_anonymous ,
                'USER_IP' => $user_ip ,
                'USER_ID_INITIATOR' => $user_id_initiator,
                'USER_NAME_INITIATOR' => $user_name_initiator,
                'USER_PROFILELINK_INITIATOR' => $user_profilelink_initiator,
                'USER_ID_RECEIVING' => $user_id_receiving,
                'USER_NAME_RECEIVING' => $user_name_receiving,
                'USER_PROFILELINK_RECEIVING' => $user_profilelink_receiving,
                'ENDORSEMENT_STATUS' => '0',
                'ENDORSEMENT_DESC' => $endorsement_desc,
                'ENDORSEMENT_VALUE' => $endorsement_value,
                'MESSAGE_CONTENT' => $message_content,
                'MESSAGE_STATUS' => '0',
                'EVENT_TIMESTAMP' => date('Y-m-d').' '.date("h:i:s")
            );

          $this->db->insert('user_events', $data);

    }

}