<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends SC_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

     function __construct ()
         {
             # Inherit the parent class' properties
             parent::__construct ();

             $this->load->model ('messages_model');
         }

     public function index()
    	{
            $this->add_messages ();
    	}

     public function add_messages()
     {
         $data = array(
			 //this will display all the users in a dropdown menu
		 	'userlist' => $this->users_model->get_all_users_dropdown($this->session->userdata('user_id')),

             'form' => array(
                 'content' => array(
                     'type' => 'text',
                     'name' => 'input-messagecontent',
                     'placeholder' => 'Write your message here',
                     'required' => TRUE
                 )
             ),
			 'messages'	=> $this->messages_model->get_messages($this->session->userdata('user_id'))
         );

         $this->build ('contact' ,$data);


     }

	 public function do_add_messages()
     {
         $this->load->library ('form_validation');

         $rules = array(
             array(
                'field' => 'input-messagecontent',
 				'label' => 'Message content',
 				'rules' => 'required'
            )

        );

        $this->form_validation->set_rules ($rules);

		if ($this->form_validation->run () === FALSE)
		{
			echo validation_errors();
			return;
		}

		$content = $this->input->post ('input-messagecontent');


		if ($this->messages_model->add_messages($content))
		{
			echo "Message sent";
		}
		else
		{
			echo "Message was not sent";
		}
     }



	 public function get_all_users()
	 {
		 $data = array(
			 'form_dropdown' => array(
				 'getusers' => $this->get->get_all_users_dropdown
			 ),

			 'messages'	=> $this->messages_model->get_messages($this->session->userdata('user_id'))
		 );


		 $this->build ('contact' ,$data);
	 }


	 public function view_messages($id)
	 {
		 echo $id;
	 }
}
