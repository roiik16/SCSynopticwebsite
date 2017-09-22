<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends SC_Controller {

	public function index()
	{
		$data = array (
			'form'		=> array (
				'full_name'		=> array (
					'type'			=> 'text',
					'name'			=> 'input-full-name',
					'placeholder'	=> 'Name',
				),

				'username' 		=> array(
					'type'		=> 'text',
					'name' 		=> 'input-username',
					'placeholder'	=> 'Username',
				),

				'name'			=> array (
					'type'			=> 'name',
					'name'			=> 'input-name',
					'placeholder'	=> 'Name',
				),

				'email'			=> array (
					'type'			=> 'email',
					'name'			=> 'input-email',
					'placeholder'	=> 'me@example.com',
				),
				'surname'			=> array (
					'type'			=> 'text',
					'name'			=> 'input-surname',
					'placeholder'	=> 'Surname',
				)
			)
		);
		# load the registration page
		$this->build('profile', $data);
	}

	public function update_users()
	{
		$this->load->library ('form_validation');

		$id = $this->session->userdata('user_id');

		$name = $this->input->post ('input-name');
		if ($name == '') $name = NULL;

		$surname = $this->input->post ('input-surname');
		if ($name == '') $name = NULL;

		$email = $this->input->post ('input-email');
		if ($name == '') $name = NULL;

		$username = $this->input->post ('input-username');
		if ($username == '') $username = NULL;




		$this->users_model->update_users($id, $name, $surname, $email, $phone, $username);


		redirect('profile');
	}
}
