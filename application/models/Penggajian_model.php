<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penggajian_model extends CI_Model
{
	public function get_karyawan()
	{
		return $this->db->get('karyawan')->result();
	}

	public function insert_karyawan($data)
	{
		return $this->db->insert('karyawan', $data);
	}

	public function get_gaji()
	{
		$this->db->select('gaji.*, karyawan.nama, karyawan.posisi');
		$this->db->from('gaji');
		$this->db->join('karyawan', 'karyawan.id = gaji.karyawan_id', 'left');
		$this->db->order_by('gaji.tanggal', 'DESC');
		return $this->db->get()->result();
	}

	public function insert_gaji($data)
	{
		return $this->db->insert('gaji', $data);
	}

	public function update_gaji($id, $data)
	{
		return $this->db->where('id', $id)->update('gaji', $data);
	}

	public function delete_gaji($id)
	{
		return $this->db->where('id', $id)->delete('gaji');
	}

	public function find_gaji($id)
	{
		return $this->db->where('id', $id)->get('gaji')->row();
	}
}

