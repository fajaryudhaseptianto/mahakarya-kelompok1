<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Feedback_model', 'feedback');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Kritik & Saran';
		$data['feedbacks'] = $this->feedback->latest();
		$this->load->view('feedback', $data);
	}

	public function submit()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('pesan', 'Pesan', 'required|trim|min_length[5]');

		if ($this->form_validation->run() === FALSE) {
			$message = strip_tags(validation_errors());
			$this->session->set_flashdata('toast', [
				'type' => 'error',
				'message' => $message
			]);
			redirect('feedback');
			return;
		}

		$payload = [
			'nama' => html_escape($this->input->post('nama', TRUE)),
			'email' => html_escape($this->input->post('email', TRUE)),
			'pesan' => html_escape($this->input->post('pesan', TRUE)),
			'created_at' => date('Y-m-d H:i:s')
		];

		if ($this->feedback->insert($payload)) {
			$this->session->set_flashdata('toast', [
				'type' => 'success',
				'message' => 'Terima kasih atas masukannya!'
			]);
		} else {
			$this->session->set_flashdata('toast', [
				'type' => 'error',
				'message' => 'Gagal menyimpan data, coba lagi.'
			]);
		}

		redirect('feedback');
	}
}

