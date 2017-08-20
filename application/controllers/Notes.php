<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends SC_Controller {

	 function __construct ()
	 {
		 # Inherit the parent class' properties
		 parent::__construct ();

		 $this->load->model ('notes_model');
	 }

	public function index()
	{
    	$this->add_notes ();
	}

	public function add_notes()
	{

		$data = array (
			'notes' => $this->notes_model->get_notes ($this->session->userdata('user_id')),
			'form' => array (
				'n_title' => array(
					'type' => 'text',
					'name' => 'input-notetitle',
					'placeholder' => 'Write your title here',
					'required' => TRUE
				),

				'n_content' 	=> array (
					'type'			=> 'text',
					'name'			=> 'input-content',
					'placeholder'	=> 'Write your text here',
					'required'		=> TRUE,
					'style'			=> 'width: 500px; height: 30px;'
				)
			)
		);

		$this->build ('notes', $data);
	}

	public function do_add_notes()
    {
        $this->load->library ('form_validation');

        $rules = array (
            array(
                'field' => 'input-notetitle',
				'label' => 'Note title',
				'rules' => 'required'
            ),
			array(
                'field' => 'input-content',
				'label' => 'Note title',
				'rules' => 'required'
            )
        );
        $this->form_validation->set_rules ($rules);

		if ($this->form_validation->run () === FALSE)
		{
			echo validation_errors();
			return;
		}

		$n_title = $this->input->post ('input-notetitle');

		$n_content = $this->input->post('input-content');


		if ($this->notes_model->add_notes ($n_title, $n_content))
		{
			redirect('notes');
		}
		else
		{
			echo "Note was not saved";
		}
    }

	public function view_note($id) {
		echo $id;
	}
}
