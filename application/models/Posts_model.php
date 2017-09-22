<?php
  class Posts_model extends CI_Model{
    public function __construct()
    {
      $this->load->database();
    }


    // Merging two tables to achieve the comment section. Getting the user email for tbl_users.
    public function get_posts()
    {
        $query = $this->db
            //Getting the username = tbl_users.'DATA YOU WANT TO BE ACHIEVED FROM TABLE'
            ->select ('tbl_comments.*, tbl_users.user_name')
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

    function update_posts($id, $content = NULL)
    {
        $update = array();

        if ($content != NULL ) $update['c_content'] = $content;

        if (count($update) == 0) return TRUE;

        $this->db->where('tbl_users_user_ID', $id)
                ->update('tbl_comments', $update);

        return ($this->db->affected_rows() == 1);
    }
}
