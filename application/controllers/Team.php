<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Team Owner';
		$this->load->view('team', $data);
	}
}

