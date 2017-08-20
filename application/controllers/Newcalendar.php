<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newcalendar extends SC_Controller {

    function index($year = null, $month = null) {

        if (!$year) {
            $year = date ('Y');
        }
        if (!$month) {
            $month = date ('m');
        }

        $this->load->model('Newcalendar_Model');

        if ($day = $this->input->post('day')) {
            $this->Newcalendar_Model->add_calendar_data(
                "$year-$month-$day",
                $this->input->post('data')
            );

        }
        $data['calendar'] = $this->Newcalendar_Model->generate($year, $month);

        $this->load->view('newcalendar', $data);
        //$this->build('newcalendar', $data);
    }
}
