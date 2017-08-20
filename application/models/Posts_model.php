<?php
  class Posts_model extends CI_Model{
    public function __construct()
    {
      $this->load->database();
    }

    public function get_posts()
    {
        $query = $this->db
            ->select ('tbl_comments.*, tbl_users.user_email')
            ->join ('tbl_users', 'tbl_users.User_ID = tbl_comments.tbl_users_user_ID', 'left')
            ->get('tbl_comments');

        return $query->result_array();

    }

    public function add_posts($body)
    {

      $data = array
      (
        'c_content' => $body,
        'c_date'    => time(),
        'tbl_users_user_ID' => $this->session->userdata('user_id')
      );

      $this->db->insert ('tbl_comments', $data);

      return $this->db->insert_id ();
    }

}
