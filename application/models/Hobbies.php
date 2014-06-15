<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hobbies extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function delete_hobby($user_id,$hobby_id)
    {
        //delete from user_hobbies where user_id=$1 and hobby=$2
        $this->db->where('user_id', $user_id);
        $this->db->where('hobby_id', $hobby_id);
        $this->db->delete('user_hobbies');
    }

    public function insert_user_new_hobby($user_id,$hobby,$hobbydetails)
    {
            $data = array(
                'USER_ID' => $user_id,
                'HOBBY' => ucfirst($hobby) ,
                'DETAILS' => $hobbydetails,
                'ENDORSEMENTS' => '1'
            );

            $this->db->insert('user_hobbies', $data);
    }

    public function delete_aboutme($user_id,$aboutme_id)
    {
        //delete from user_hobbies where user_id=$1 and hobby=$2
        $this->db->where('user_id', $user_id);
        $this->db->where('aboutme_id', $aboutme_id);
        $this->db->delete('user_aboutme');
    }

    public function insert_user_new_aboutme($user_id,$aboutme,$author)
    {

            $data = array(
                'USER_ID' => $user_id,
                'ABOUTME' => ucfirst($aboutme) ,
                'ENDORSEMENTS' => '1',
                'AUTHOR' => $author
            );

            $this->db->insert('user_aboutme', $data);
    }

    public function update_hobby_details($user_id,$hobby_id,$hobby_details)
    {
        $data = array(
            'details' => $hobby_details
        );
        $this->db->where('user_id', $user_id);
        $this->db->where('hobby_id', $hobby_id);
        $this->db->update('user_hobbies',$data);
    }

    public function search_hobbies($term,$user_id)
    {
        $this->db->select('*');
        $this->db->from('user_hobbies');
        $this->db->like('hobby', $term);
        $this->db->join('users_facebook', 'user_hobbies.user_id = users_facebook.user_id','inner');
        $this->db->where_not_in('users_facebook.user_id', $user_id);
        $this->db->order_by('user_hobbies.endorsements', "desc");
        $query = $this->db->get();

        if ($query->num_rows() > 0)  return $query->result_array();
    }

    public function search_hobbies_default($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_hobbies');
        $this->db->where_not_in('users_facebook.user_id', $user_id);
        $this->db->join('users_facebook', 'user_hobbies.user_id = users_facebook.USER_ID','inner');
        $this->db->order_by('user_hobbies.user_id', "random");
        $query = $this->db->get();

        if ($query->num_rows() > 0)  return $query->result_array();
    }

    public function get_hobbies_hints($term)

    {
        $this->db->select('*');
        $this->db->from('hobbies');
        $this->db->like('hobby_desc', $term);
        $this->db->order_by('hobby_desc','desc');
        $query = $this->db->get();

        if ($query->num_rows() > 0)  return $query->result_array();
    }

}