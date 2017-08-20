<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends SC_Controller {

	 # The registration form
	 	public function register () {
			$this->load->view ('struct/header');
	 		# first: load the form helper
	 		$this->load->helper ('form');

	 		# the page info goes into an array
	 		$data = array (
	 			'form'		=> array (
	 				'full_name'		=> array (
	 					'type'			=> 'text',
	 					'name'			=> 'input-full-name',
	 					'placeholder'	=> 'Name',
	 					'required'		=> TRUE
	 				),
					'full_surname'		=> array (
	 					'type'			=> 'text',
	 					'name'			=> 'input-full-surname',
	 					'placeholder'	=> 'Surname',
	 					'required'		=> TRUE
	 				),
					'username'		=> array (
	 					'type'			=> 'text',
	 					'name'			=> 'input-username',
	 					'placeholder'	=> 'Username',
	 					'required'		=> TRUE
	 				),
	 				'email'			=> array (
	 					'type'			=> 'email',
	 					'name'			=> 'input-email',
	 					'placeholder'	=> 'me@example.com',
	 					'required'		=> TRUE
	 				),
	 				'password'		=> array (
	 					'type'			=> 'password',
	 					'name'			=> 'input-password',
	 					'placeholder'	=> 'password',
	 					'required'		=> TRUE
	 				),
					'profilepicture' => array (
						'type'  	=> 'image',
						'name'		=> 'input-image',
						'required'  => TRUE
						)
	 			)
	 		);

 		# load the registration page
 		$this->load->view ('register', $data);

 	}

 	# The registration process
 	public function do_register () {

 		# load the form validator
 		$this->load->library ('form_validation');
		$this->load->library('upload');

 		# set the form rules
 		$rules = array (
 			array (
 				'field'	=> 'input-full-name',
 				'label' => 'Full Name',
 				'rules' => 'required|alpha'
 			),
			array (
 				'field'	=> 'input-full-surname',
 				'label' => 'Surname',
 				'rules' => 'required|alpha'
 			),
			array (
 				'field'	=> 'input-username',
 				'label' => 'Username',
 				'rules' => 'required|alpha'
 			),
			array (
 				'field'	=> 'input-password',
 				'label' => 'Password',
 				'rules' => 'required|min_length[8]|max_length[20]'
 			),
 			array (
 				'field'	=> 'input-email',
 				'label' => 'Email',
 				'rules' => 'required|valid_email'
 			)
 		);

 		# set the rules in the library
 		$this->form_validation->set_rules ($rules);

 		# check for validation errors on the page, if there are any, stop here
 		if ($this->form_validation->run () === FALSE) {
 			echo validation_errors ();
 			return;
 		}

 		$name 	= $this->input->post ('input-full-name');
		$surname = $this->input->post ('input-full-surname');
 		$username = $this->input->post ('input-username');
 		$password 	= $this->input->post ('input-password');
 		$email 		= $this->input->post ('input-email');

 		if ($this->users_model->register ($name,$surname,$username,$password,$email)) {
 			redirect('users/signin');
 		} else {
 			echo "The user could not be registered.";
 		}

 	}
	# The login form
		public function signin ()
		{
			# first: load the form helper
				$this->load->helper ('form');

				$data = array (
					'form'		=> array (
						'email'			=> array (
							'type'			=> 'email',
							'name'			=> 'input-email',
							'placeholder'	=> 'me@example.com',
							'required'		=> TRUE
						),
						'password'		=> array (
							'type'			=> 'password',
							'name'			=> 'input-password',
							'placeholder'	=> 'password',
							'required'		=> TRUE
						)
					)
				);

				# load the login page
				$this->load->view('struct/header');
				$this->load->view ('sign-in', $data);
				$this->load->view ('struct/footer');
			}



			# The login process
			public function do_signin ()
			{
				# load the form validator
				$this->load->library ('form_validation');

				# set the form rules
				$rules = array (
					array (
						'field'	=> 'input-email',
						'label' => 'Email',
						'rules' => 'required|valid_email'
					),
					array (
						'field'	=> 'input-password',
						'label' => 'Password',
						'rules' => 'required'
					)
				);

				# set the rules in the library
				$this->form_validation->set_rules ($rules);

				# check for validation errors on the page, if there are any, stop here
				if ($this->form_validation->run () === FALSE) {
					echo validation_errors ();
					return;
				}

				$email 		= $this->input->post ('input-email');
				$password 	= $this->input->post ('input-password');

				# Set the result of this query in a variable
				$login_id = $this->users_model->email_id ($email);

				# If the email doesn't exist, stop here
				if (!$login_id)
				{
					echo "The email does not exist.";
					return;
				}

				# The email is OK, so now we should check the password
				if (!$this->users_model->check_password ($login_id, $password))
				{
					echo "The password is incorrect";
					return;
				}

				# Get the user information and set it in a session
				$userdata = $this->users_model->get_userdata ($login_id);

				# We set the userdata, however we need to set an encryption key
				$this->session->set_userdata ($userdata);

				redirect ("home");
			}

			public function logout()
			{
				$user_data = $this->session->get_userdata();

				foreach ($user_data as $key => $value)
				{
					$this->session->unset_userdata($key);
				}

				redirect('login');
			}
}
