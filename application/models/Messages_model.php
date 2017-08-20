<?php
class Messages_model extends CI_Model
{
    public function __construct()
    {
      $this->load->database();
    }

    public function add_messages($content)
    {
        $data = array
        (
            'msg_content' => $content,
            # 'msg_date'  => time(),
            'msg_senderID' => $this->session->userdata('user_id')
            //'msg_recepientID' => $getusers
        );

        $this->db->insert ('tbl_messages', $data);

        return $this->db->insert_id ();
    }

    public function get_messages ($id) {

        $this->db->select ('msg_content')
        ->where ('msg_recepientID', $id);

        # Give the controller all the data as an array
        return $this->db->get ('tbl_messages');
    }
}
