<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsfeed extends SC_Controller {

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

	 function __construct () {

	 	 # Inherit the parent class' properties
	 	 parent::__construct ();

	 	 $this->load->model ('posts_model');

	 }
	public function index()
	{

		$this->add_posts ();
	}


	public function add_posts()
	{
		$this->load->helper ('form');

		$data = array (
			'comments'	=> $this->posts_model->get_posts(),
			'form' => array (
				'body' => array (
					'type'			=> 'text',
					'name'			=> 'input-comment',
					'placeholder'	=> 'Write your comment here',
					'required'		=> TRUE
				)
			)
		);
		$this->build ('newsfeed', $data);
	}


	public function do_add_posts()
	{
		$this->load->library ('form_validation');

		$rules = array (
			array(
				'field' => 'input-comment',
				'label' => 'Message Content',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules ($rules);

		if ($this->form_validation->run () === FALSE)
		{
			echo validation_errors();
			return;
		}

		$body = $this->input->post ('input-comment');

		if ($this->posts_model->add_posts ($body))
		{
			echo "message posted";
		}
		else
		{
			echo "Message was not posted";
		}
	}
}
