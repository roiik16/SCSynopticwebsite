<?php
  class Notes_model extends CI_Model{

    public function __construct()
    {
      $this->load->database();
    }


    public function add_notes($notetitle, $notecontent)
    {

      $data = array
      (
        'note_title' => $notetitle,
        'note_content' => $notecontent,
        'note_date'    => time(),
        'tbl_users_user_ID' => $this->session->userdata('user_id')
      );

      $this->db->insert ('tbl_notes', $data);

      return $this->db->insert_id ();

    }


    # get the note information and load according to the user
    public function get_notes($id)
    {
        $this->db->select ('notes_id, note_title, note_content, note_date')
            ->where ('tbl_users_user_ID', $id);

        $result = $this->db->get ('tbl_notes');

        //This bi** below will not allow the notes page to load when it fails to find a note
        
        //if ($result->num_rows() == 0)
        //    return false;

        return $result;
    }

}
