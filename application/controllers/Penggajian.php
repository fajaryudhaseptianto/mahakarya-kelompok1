<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penggajian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Penggajian_model', 'payroll');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Penggajian Modern';
		$data['karyawan'] = $this->payroll->get_karyawan();
		$data['gaji'] = $this->payroll->get_gaji();
		$this->load->view('penggajian/index', $data);
	}

	public function store_karyawan()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|min_length[3]');
		$this->form_validation->set_rules('posisi', 'Posisi', 'required|trim|min_length[2]');

		if ($this->form_validation->run() === FALSE) {
			$this->_set_toast('error', strip_tags(validation_errors()));
			redirect('penggajian');
			return;
		}

		$data = [
			'nama' => html_escape($this->input->post('nama', TRUE)),
			'posisi' => html_escape($this->input->post('posisi', TRUE))
		];

		$this->payroll->insert_karyawan($data);
		$this->_set_toast('success', 'Karyawan baru berhasil ditambahkan.');
		redirect('penggajian');
	}

	public function store_gaji()
	{
		$this->_gaji_rules();

		if ($this->form_validation->run() === FALSE) {
			$this->_set_toast('error', strip_tags(validation_errors()));
			redirect('penggajian');
			return;
		}

		$base = (int)$this->input->post('jumlah_gaji', TRUE);
		$makan = (int)$this->input->post('tunjangan_makan', TRUE);
		$transport = (int)$this->input->post('tunjangan_transport', TRUE);
		$potongan = (int)$this->input->post('potongan', TRUE);
		$total = max(0, $base + $makan + $transport - $potongan);

		$data = [
			'karyawan_id' => $this->input->post('karyawan_id', TRUE),
			'jumlah_gaji' => $base,
			'tunjangan_makan' => $makan,
			'tunjangan_transport' => $transport,
			'potongan' => $potongan,
			'total_gaji' => $total,
			'tanggal' => $this->input->post('tanggal', TRUE)
		];

		$this->payroll->insert_gaji($data);
		$this->_set_toast('success', 'Data gaji berhasil disimpan.');
		redirect('penggajian');
	}

	public function update_gaji($id)
	{
		$this->_gaji_rules();

		if ($this->form_validation->run() === FALSE) {
			$this->_set_toast('error', strip_tags(validation_errors()));
			redirect('penggajian');
			return;
		}

		$base = (int)$this->input->post('jumlah_gaji', TRUE);
		$makan = (int)$this->input->post('tunjangan_makan', TRUE);
		$transport = (int)$this->input->post('tunjangan_transport', TRUE);
		$potongan = (int)$this->input->post('potongan', TRUE);
		$total = max(0, $base + $makan + $transport - $potongan);

		$data = [
			'karyawan_id' => $this->input->post('karyawan_id', TRUE),
			'jumlah_gaji' => $base,
			'tunjangan_makan' => $makan,
			'tunjangan_transport' => $transport,
			'potongan' => $potongan,
			'total_gaji' => $total,
			'tanggal' => $this->input->post('tanggal', TRUE)
		];

		$this->payroll->update_gaji($id, $data);
		$this->_set_toast('success', 'Data gaji berhasil diperbarui.');
		redirect('penggajian');
	}

	public function delete_gaji($id)
	{
		$this->payroll->delete_gaji($id);
		$this->_set_toast('success', 'Data gaji dihapus.');
		redirect('penggajian');
	}

	private function _gaji_rules()
	{
		$this->form_validation->set_rules('karyawan_id', 'Karyawan', 'required|integer');
		$this->form_validation->set_rules('jumlah_gaji', 'Gaji Pokok', 'required|integer');
		$this->form_validation->set_rules('tunjangan_makan', 'Tunjangan Makan', 'required|integer');
		$this->form_validation->set_rules('tunjangan_transport', 'Tunjangan Transport', 'required|integer');
		$this->form_validation->set_rules('potongan', 'Potongan', 'required|integer');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
	}

	private function _set_toast($type, $message)
	{
		$this->session->set_flashdata('toast', [
			'type' => $type,
			'message' => $message
		]);
	}
}

